<?php

namespace app\api\controller;

use app\common\controller\Api;
use app\common\library\Fxiaoke;
use app\admin\model\PushLog;
//use Youzan\Open\Helper\CryptoHelper;

/**
 * 有赞-CRM对接接口
 */
class Trade extends Api
{
    protected $noNeedLogin = ['*'];
    protected $noNeedRight = ['*'];

    protected $isRecord = '';
    protected $data = '';
    protected $fxiaoke = '';

    /**
     * 接收有赞推送消息
     *
     */
    public function notice()
    {
        //接收有赞推送消息
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        //获取有赞默认配置
        $youzan = config('site.youzan');

        //判断消息是否合法
        $msg = $data['msg'];
        $sign_string = $youzan['client_id']."".$msg."".$youzan['client_secret'];
        $sign = md5($sign_string);
        if($sign != $data['sign']){
            exit();
        }

        //msg内容经过 urlencode 编码，需进行解码
        $this->data = json_decode(urldecode($msg),true);

        //实例化纷享销客CRM操作类
        $this->fxiaoke = Fxiaoke::instance();

        //根据 type 来识别消息事件类型
        switch ($data['type'])
        {
            case 'trade_TradeCreate':
               $this->tradeCreate();
                break;
            case 'trade_TradePaid':
                $this->tradePaid();
                break;
            case 'trade_TradeSuccess':
                $this->tradeSuccess();
                break;
            default:
                exit();
        }
    }

    /**
     * 交易创建
     *
     */
    protected function tradeCreate()
    {
        $tid = $this->data['full_order_info']['order_info']['tid'];

        //查询是否存在此订单
        $this->isRecord = PushLog::where(['push_type'=>'create','order_sn'=>$tid])->column('id') ? 1 : 0;

        //查询客户是否存在
        $accountList = $this->fxiaoke->getList('AccountObj',[
            [
                'field_name' => 'tel',
                'field_values' => $this->data['full_order_info']['address_info']['receiver_tel'],
                'operator' => 'EQ',
            ],
            [
                'field_name' => 'life_status',
                'field_values' => 'normal',
                'operator' => 'EQ',
            ]
        ]);

        if($accountList['errorCode'] == 0 && count($accountList['data']['dataList'])  == 0){
            //创建客户
            $result = $this->fxiaoke->createAccount($this->data['full_order_info']);

            //创建失败
            if($result['errorCode'] != 0){
                $this->savePushLog($tid,'create',0,$result);
                exit();
            }

            $dataId = $result['dataId'];
        }else{
            $result = $accountList['data']['dataList'][0];
            $dataId = $result['_id'];
        }

        //同步CRM销售订单
        $result = $this->fxiaoke->createOrder($this->data,$dataId);

        //同步状态
        if($result['errorCode'] == 0){
            //保存同步结果
            $this->savePushLog($tid,'create',1,$result);
            $this->success('success',null,0);
        }else{
            $this->savePushLog($tid,'create',0,$result);
            exit();
        }
    }

    /**
     * 交易支付
     *
     */
    protected function tradePaid()
    {
        $tid = $this->data['full_order_info']['order_info']['tid'];

        //查询是否存在此订单
        $this->isRecord = PushLog::where(['push_type'=>'paid','order_sn'=>$tid])->column('id') ? 1 : 0;

        //根据有赞订单号查询订单详细信息
        $orderList = $this->fxiaoke->getList('SalesOrderObj',[
            [
                'field_name' => 'field_6uKqS__c',
                'field_values' => $tid,
                'operator' => 'EQ',
            ]
        ]);

        //创建回款对象
        $payResult = $this->fxiaoke->createPaymentObj($this->data['full_order_info'],$orderList['data']['dataList'][0]);

        //创建回款对象成功，修改销售订单状态
        if($payResult['errorCode'] == 0){
            $upResult = $this->fxiaoke->updateOrder($this->data,$orderList['data']['dataList'][0],['field_Td3Of__c'=>'de0Eh4gdS']);

            //保存同步结果
            if($upResult['errorCode'] == 0){
                //保存同步结果
                $this->savePushLog($tid,'paid',1,$upResult);
                $this->success('success',null,0);
            }else{
                $this->savePushLog($tid,'paid',0,$upResult);
                exit();
            }
        }else{
            $this->savePushLog($tid,'paid',0,$payResult);
            exit();
        }
    }

    /**
     * 交易成功
     *
     */
    protected function tradeSuccess()
    {
        //查询是否存在此订单
        $this->isRecord = PushLog::where(['push_type'=>'success','order_sn'=>$this->data['tid']])->column('id') ? 1 : 0;

        //根据有赞订单号查询订单详细信息
        $orderList = $this->fxiaoke->getList('SalesOrderObj',[
            [
                'field_name' => 'field_6uKqS__c',
                'field_values' => $this->data['tid'],
                'operator' => 'EQ',
            ]
        ]);

        //修改销售订单对象
        $result = $this->fxiaoke->updateOrder($this->data,$orderList['data']['dataList'][0],['confirmed_receive_date'=>$this->data['update_time']]);

        //修改销售订单对象成功
        if($result['errorCode'] == 0){
            //保存同步结果
            $this->savePushLog($this->data['tid'],'success',1,$result);
            $this->success('success',null,0);
        }else{
            $this->savePushLog($this->data['tid'],'success',0,$result);
            exit();
        }
    }

    /**
     * 保存记录
     *
     */
    protected function savePushLog($order_sn,$push_type,$sync_status,$sync_result)
    {
        //组装参数
        $data  = [
            'order_sn' => $order_sn,
            'push_type' => $push_type,
            'trigger_time' => time(),
            'push_data' => json_encode($this->data),
            'sync_status' => $sync_status,
            'sync_result' => json_encode($sync_result),
            'sync_time' => time(),
        ];

        $this->isRecord ? PushLog::where(['order_sn'=>$data['order_sn'],'push_type'=>$push_type])->update($data) : PushLog::insert($data);
    }
}
