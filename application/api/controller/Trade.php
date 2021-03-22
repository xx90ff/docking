<?php

namespace app\api\controller;

use think\Log;
use app\common\controller\Api;
use app\common\library\Fxiaoke;
use app\admin\model\PushLog;
use app\admin\model\NotPushLog;
//use Youzan\Open\Helper\CryptoHelper;

/**
 * 有赞-CRM对接接口
 */
class Trade extends Api
{
    protected $noNeedLogin = ['*'];
    protected $noNeedRight = ['*'];

    protected $data = '';
    protected $msg_id = '';
    protected $isRecord = '';
    protected $fxiaoke = '';

    /**
     * 接收有赞推送消息
     *
     */
    public function notice()
    {
        //接收有赞推送消息
        $json = file_get_contents('php://input');

        //交易创建
//        $json = '{"msg":"%7B%22delivery_order%22%3A%5B%5D%2C%22order_promotion%22%3A%7B%22item%22%3A%5B%5D%2C%22adjust_fee%22%3A%220.00%22%2C%22order%22%3A%5B%5D%7D%2C%22refund_order%22%3A%5B%5D%2C%22full_order_info%22%3A%7B%22address_info%22%3A%7B%22self_fetch_info%22%3A%22%22%2C%22delivery_address%22%3A%22%22%2C%22delivery_postal_code%22%3A%22%22%2C%22receiver_name%22%3A%22%22%2C%22delivery_province%22%3A%22%22%2C%22delivery_city%22%3A%22%22%2C%22address_extra%22%3A%22%7B%7D%22%2C%22delivery_district%22%3A%22%22%2C%22receiver_tel%22%3A%22%22%7D%2C%22remark_info%22%3A%7B%22buyer_message%22%3A%22%22%7D%2C%22pay_info%22%3A%7B%22outer_transactions%22%3A%5B%5D%2C%22deduction_real_pay%22%3A1%2C%22real_payment%22%3A%220.00%22%2C%22post_fee%22%3A%220.00%22%2C%22deduction_pay%22%3A0%2C%22deduct_value_card_pay%22%3A0%2C%22deduct_gift_card_pay%22%3A0%2C%22phase_payments%22%3A%5B%5D%2C%22total_fee%22%3A%220.01%22%2C%22payment%22%3A%220.01%22%2C%22transaction%22%3A%5B%5D%7D%2C%22buyer_info%22%3A%7B%22outer_user_id%22%3A%22oPw1pt8GSW6qFxjhtSII_LHSUkwU%22%2C%22yz_open_id%22%3A%22yCKLYMKT630114409934508032%22%2C%22fans_type%22%3A1%2C%22buyer_id%22%3A496283533%2C%22fans_nickname%22%3A%22%22%2C%22fans_id%22%3A11351079281%7D%2C%22orders%22%3A%5B%7B%22is_cross_border%22%3A%22%22%2C%22outer_item_id%22%3A%22%22%2C%22discount_price%22%3A%220.01%22%2C%22item_type%22%3A182%2C%22num%22%3A1%2C%22oid%22%3A%222793339624048295999%22%2C%22title%22%3A%22%E5%95%86%E6%A0%87%E7%94%B3%E8%AF%B7%22%2C%22fenxiao_payment%22%3A%220.00%22%2C%22item_message%22%3A%22%7B%5C%22%E6%89%8B%E6%9C%BA%E5%8F%B7%5C%22%3A%5C%2213439302541%5C%22%7D%22%2C%22buyer_messages%22%3A%22%7B%5C%22%E6%89%8B%E6%9C%BA%E5%8F%B7%5C%22%3A%5C%2213439302541%5C%22%7D%22%2C%22cross_border_trade_mode%22%3A%22%22%2C%22is_present%22%3Afalse%2C%22sub_order_no%22%3A%22%22%2C%22price%22%3A%220.01%22%2C%22fenxiao_price%22%3A%220.00%22%2C%22total_fee%22%3A%220.01%22%2C%22alias%22%3A%223nqfk22qafg6h%22%2C%22payment%22%3A%220.01%22%2C%22outer_sku_id%22%3A%22100401%22%2C%22goods_url%22%3A%22https%3A%2F%2Fh5.youzan.com%2Fv2%2Fshowcase%2Fgoods%3Falias%3D3nqfk22qafg6h%22%2C%22customs_code%22%3A%22%22%2C%22item_id%22%3A900770653%2C%22sku_properties_name%22%3A%22%5B%7B%5C%22k%5C%22%3A%5C%22%E7%B1%BB%E5%88%AB%5C%22%2C%5C%22k_id%5C%22%3A9742%2C%5C%22v%5C%22%3A%5C%22%E4%B8%80%E7%B1%BB%5C%22%2C%5C%22v_id%5C%22%3A1833786%7D%5D%22%2C%22sku_id%22%3A37186796%2C%22pic_path%22%3A%22https%3A%2F%2Fimg01.yzcdn.cn%2Fupload_files%2F2018%2F02%2F06%2FFqBS9X_w3tvytjxEOTMRDLNZoZ5g.jpg%22%2C%22points_price%22%3A%220%22%7D%5D%2C%22source_info%22%3A%7B%22is_offline_order%22%3Afalse%2C%22book_key%22%3A%228d207ddc-18fa-4217-8747-1082fff66ae9%22%2C%22biz_source%22%3A%22%22%2C%22source%22%3A%7B%22platform%22%3A%22wx%22%2C%22wx_entrance%22%3A%22direct_buy%22%7D%7D%2C%22order_info%22%3A%7B%22consign_time%22%3A%22%22%2C%22order_extra%22%3A%7B%22is_from_cart%22%3A%22false%22%2C%22is_points_order%22%3A%220%22%7D%2C%22created%22%3A%222021-03-12+09%3A53%3A18%22%2C%22status_str%22%3A%22%E5%BE%85%E6%94%AF%E4%BB%98%22%2C%22expired_time%22%3A%222021-03-12+10%3A53%3A18%22%2C%22success_time%22%3A%22%22%2C%22type%22%3A0%2C%22confirm_time%22%3A%22%22%2C%22tid%22%3A%22E20210312095317090904167%22%2C%22pay_time%22%3A%22%22%2C%22update_time%22%3A%222021-03-12+09%3A53%3A18%22%2C%22is_retail_order%22%3Afalse%2C%22team_type%22%3A0%2C%22pay_type%22%3A0%2C%22refund_state%22%3A0%2C%22close_type%22%3A0%2C%22order_tags%22%3A%7B%22is_virtual%22%3Atrue%2C%22is_secured_transactions%22%3Atrue%7D%2C%22express_type%22%3A9%2C%22status%22%3A%22WAIT_BUYER_PAY%22%7D%7D%7D","kdt_name":"开业啦商城","test":false,"sign":"e626b820c151ee410b5a86f6cb1d1a65","type":"trade_TradeCreate","sendCount":1,"version":1615513998,"client_id":"c346b8b39599aaa677","mode":1,"kdt_id":13027865,"id":"E20210312095317090904167","msg_id":"be296f41-1cae-4f9e-b73e-c60c85f218ab","root_kdt_id":13027865,"status":"WAIT_BUYER_PAY"}';
        //买家付款
//        $json = '{"msg":"%7B%22delivery_order%22%3A%5B%5D%2C%22order_promotion%22%3A%7B%22item%22%3A%5B%5D%2C%22adjust_fee%22%3A%220.00%22%2C%22order%22%3A%5B%5D%7D%2C%22refund_order%22%3A%5B%5D%2C%22full_order_info%22%3A%7B%22address_info%22%3A%7B%22self_fetch_info%22%3A%22%22%2C%22delivery_address%22%3A%22123456+54646%22%2C%22delivery_postal_code%22%3A%22%22%2C%22receiver_name%22%3A%22%E6%82%9F%E7%A9%BA%22%2C%22delivery_province%22%3A%22%E5%8C%97%E4%BA%AC%E5%B8%82%22%2C%22delivery_city%22%3A%22%E5%8C%97%E4%BA%AC%E5%B8%82%22%2C%22address_extra%22%3A%22%7B%5C%22areaCode%5C%22%3A%5C%22110106%5C%22%2C%5C%22lon%5C%22%3A116.29355325507241%2C%5C%22lat%5C%22%3A39.86475703507108%7D%22%2C%22delivery_district%22%3A%22%E4%B8%B0%E5%8F%B0%E5%8C%BA%22%2C%22receiver_tel%22%3A%2213439302541%22%7D%2C%22remark_info%22%3A%7B%22buyer_message%22%3A%22%22%7D%2C%22pay_info%22%3A%7B%22outer_transactions%22%3A%5B%224200000886202103073391126524%22%5D%2C%22post_fee%22%3A%220.00%22%2C%22total_fee%22%3A%220.01%22%2C%22payment%22%3A%220.01%22%2C%22transaction%22%3A%5B%222103071757450002850744%22%5D%7D%2C%22buyer_info%22%3A%7B%22outer_user_id%22%3A%22oPw1pt8GSW6qFxjhtSII_LHSUkwU%22%2C%22yz_open_id%22%3A%22yCKLYMKT630114409934508032%22%2C%22fans_type%22%3A1%2C%22buyer_id%22%3A496283533%2C%22fans_nickname%22%3A%22%22%2C%22fans_id%22%3A11351079281%7D%2C%22orders%22%3A%5B%7B%22is_cross_border%22%3A%22%22%2C%22outer_item_id%22%3A%22test001%22%2C%22discount_price%22%3A%220.01%22%2C%22item_type%22%3A0%2C%22num%22%3A1%2C%22oid%22%3A%222792474284774916173%22%2C%22title%22%3A%22%E5%85%83%E6%B0%94%E6%A3%AE%E6%9E%97%E6%B0%94%E6%B3%A1%E6%B0%B4%22%2C%22fenxiao_payment%22%3A%220.00%22%2C%22item_message%22%3A%22%22%2C%22buyer_messages%22%3A%22%22%2C%22cross_border_trade_mode%22%3A%22%22%2C%22is_present%22%3Afalse%2C%22sub_order_no%22%3A%22%22%2C%22price%22%3A%220.01%22%2C%22fenxiao_price%22%3A%220.00%22%2C%22total_fee%22%3A%220.01%22%2C%22alias%22%3A%2236a8c432bd8y1%22%2C%22payment%22%3A%220.01%22%2C%22outer_sku_id%22%3A%22%22%2C%22goods_url%22%3A%22https%3A%2F%2Fh5.youzan.com%2Fv2%2Fshowcase%2Fgoods%3Falias%3D36a8c432bd8y1%22%2C%22customs_code%22%3A%22%22%2C%22item_id%22%3A495651017%2C%22sku_properties_name%22%3A%22%5B%5D%22%2C%22sku_id%22%3A0%2C%22pic_path%22%3A%22https%3A%2F%2Fimg01.yzcdn.cn%2Fupload_files%2F2019%2F11%2F07%2FFic4Jwq8Jd1yFl_JYNLrss3Fqk_V.jpg%22%2C%22points_price%22%3A%220%22%7D%5D%2C%22source_info%22%3A%7B%22is_offline_order%22%3Afalse%2C%22book_key%22%3A%228a135d4e-f9c4-43c3-bdc4-bf5087ae4e70%22%2C%22source%22%3A%7B%22platform%22%3A%22wx%22%2C%22wx_entrance%22%3A%22direct_buy%22%7D%7D%2C%22order_info%22%3A%7B%22consign_time%22%3A%22%22%2C%22order_extra%22%3A%7B%22is_from_cart%22%3A%22true%22%2C%22is_points_order%22%3A%220%22%7D%2C%22created%22%3A%222021-03-07+17%3A56%3A50%22%2C%22status_str%22%3A%22%E5%BE%85%E5%8F%91%E8%B4%A7%22%2C%22expired_time%22%3A%222021-03-07+18%3A56%3A50%22%2C%22success_time%22%3A%22%22%2C%22type%22%3A0%2C%22confirm_time%22%3A%22%22%2C%22tid%22%3A%22E20210307175649090904167%22%2C%22pay_time%22%3A%222021-03-07+17%3A57%3A51%22%2C%22update_time%22%3A%222021-03-07+17%3A57%3A56%22%2C%22is_retail_order%22%3Afalse%2C%22team_type%22%3A0%2C%22pay_type%22%3A10%2C%22refund_state%22%3A0%2C%22close_type%22%3A0%2C%22order_tags%22%3A%7B%22is_secured_transactions%22%3Atrue%2C%22is_payed%22%3Atrue%7D%2C%22express_type%22%3A0%2C%22status%22%3A%22WAIT_SELLER_SEND_GOODS%22%7D%7D%7D","kdt_name":"开业啦商城","test":false,"sign":"696aa7035fd4891d2047467cbdf48dc2","sendCount":1,"type":"trade_TradeBuyerPay","version":1615111076,"client_id":"c346b8b39599aaa677","mode":1,"kdt_id":13027865,"id":"E20210307175649090904167","msg_id":"d420e110-8c65-420c-9f58-ab7901102963","root_kdt_id":13027865,"status":"WAIT_SELLER_SEND_GOODS"}';
        //卖家部分发货
//        $json = '{"msg":"%7B%22express_id%22%3A0%2C%22update_time%22%3A%222021-03-07+18%3A02%3A56%22%2C%22express_no%22%3A%22%22%2C%22oids%22%3A%222792474284774916173%22%2C%22tid%22%3A%22E20210307175649090904167%22%7D","mode":1,"kdt_name":"开业啦商城","kdt_id":13027865,"test":false,"sign":"ae87ccba782993cf199b192d4ac0146b","id":"E20210307175649090904167","msg_id":"ef7b2402-5240-4b40-b223-11cbc0604a6c","type":"trade_TradePartlySellerShip","sendCount":1,"version":1615111376,"client_id":"c346b8b39599aaa677"}';
        //交易完成
//        $json = '{"msg":"%7B%22update_time%22%3A%222021-03-07+18%3A06%3A22%22%2C%22tid%22%3A%22E20210307175649090904167%22%7D","kdt_name":"开业啦商城","test":false,"sign":"4f4e7bcee79811e62a254968a83fc494","type":"trade_TradeSuccess","sendCount":1,"version":1615111582,"client_id":"c346b8b39599aaa677","mode":1,"kdt_id":13027865,"id":"E20210307175649090904167","msg_id":"dbda5478-76bf-4172-ac14-8d5ebac2002d","root_kdt_id":13027865,"status":"TRADE_SUCCESS"}';

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

        //记录消息id
        $this->msg_id = $data['msg_id'];

        //msg内容经过 urlencode 编码，需进行解码
        $this->data = json_decode(urldecode($msg),true);

        //日志记录
        Log::write(date('Y-m-d H:i:s',time()).'('.$data['type'].')：'.urldecode($msg));

        //实例化纷享销客CRM操作类
        $this->fxiaoke = Fxiaoke::instance();

        //根据 type 来识别消息事件类型
        switch ($data['type'])
        {
            case 'trade_TradeCreate':
               $this->tradeCreate();
                break;
            case 'trade_TradeBuyerPay':
                $this->tradeBuyerPay();
                break;
            case 'trade_TradePaid':
                $this->tradeBuyerPay();
                break;
            case 'trade_TradeSuccess':
                $this->tradeSuccess();
                break;
            default:
//                $this->saveNotPushLog($data['type'],$data['msg_id']);
                exit();
        }
    }

    /**
     * 交易创建
     *
     */
    public function tradeCreate()
    {
        $tid = $this->data['full_order_info']['order_info']['tid'];

        //保存推送记录
        $this->insertPushLog($tid,'create');

        //是否存在收货人信息
        if(empty($this->data['full_order_info']['address_info']['receiver_tel'])){
            //不存在则取订单信息中手机号
            $buyer_messages = json_decode($this->data['full_order_info']['orders'][0]['buyer_messages'],true);
            $this->data['full_order_info']['address_info']['receiver_tel'] = $buyer_messages['手机号'];

            //收货人姓名
            if(!empty($this->data['full_order_info']['buyer_info']['fans_nickname'])){
                $this->data['full_order_info']['address_info']['receiver_name'] = $this->data['full_order_info']['buyer_info']['fans_nickname'];
            }else{
                $this->data['full_order_info']['address_info']['receiver_name'] = $buyer_messages['手机号'];
            }
        }

        //查询联系人是否存在
        $contactList = $this->fxiaoke->getList('ContactObj',[
            [
                'field_name' => 'mobile1',
                'field_values' => $this->data['full_order_info']['address_info']['receiver_tel'],
                'operator' => 'EQ',
            ],
            [
                'field_name' => 'life_status',
                'field_values' => 'normal',
                'operator' => 'EQ',
            ]
        ]);

        //不存在
        if($contactList['errorCode'] == 0 && count($contactList['data']['dataList'])  == 0){
            //创建客户
            $accountResult = $this->createAccount($tid);
            //客户ID
            $accountId = $accountResult['dataId'];
            //创建联系人
            $contactResult = $this->createContact($tid,$accountId);
            //联系人ID
            $contactId = $contactResult['dataId'];
        }else{
            //产品是否有一项为工商管理分类
            $businessCategory = $this->isBusinessCategory();
            //若有工商管理分类，则新建客户
            if($businessCategory){
                //创建客户
                $accountResult = $this->createAccount($tid);
                //客户ID
                $accountId = $accountResult['dataId'];
                //创建联系人
                $contactResult = $this->createContact($tid,$accountId);
                //联系人ID
                $contactId = $contactResult['dataId'];
            }else{
                //联系人信息
                $contactResult = $contactList['data']['dataList'][0];
                //联系人ID
                $contactId = $contactResult['_id'];

                //查询客户信息
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
                //客户信息
                $accountResult = $accountList['data']['dataList'][0];
                //客户ID
                $accountId = $accountResult['_id'];
            }
        }

        //同步CRM销售订单
        $result = $this->fxiaoke->createOrder($this->data,$accountId,$contactId);

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
    public function tradeBuyerPay()
    {
        $tid = $this->data['full_order_info']['order_info']['tid'];

        //保存推送记录
        $this->insertPushLog($tid,'paid');

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

        //创建回款对象成功，修改销售订单收款状态
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
    public function tradeSuccess()
    {
        //保存推送记录
        $this->insertPushLog($this->data['tid'],'success');

        //根据有赞订单号查询订单详细信息
        $orderList = $this->fxiaoke->getList('SalesOrderObj',[
            [
                'field_name' => 'field_6uKqS__c',
                'field_values' => $this->data['tid'],
                'operator' => 'EQ',
            ]
        ]);

        //修改销售订单对象(收货时间)
        $result = $this->fxiaoke->updateOrder($this->data,$orderList['data']['dataList'][0],['confirmed_receive_date'=>strtotime($this->data['update_time']) * 1000]);

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
     * 创建联系人
     *
     */
    protected function createContact($tid,$accountId)
    {
        //创建客户
        $result = $this->fxiaoke->createContact($this->data['full_order_info'],$accountId);

        //创建失败
        if($result['errorCode'] != 0){
            $this->savePushLog($tid,'create',0,$result);
            exit();
        }

        return $result;
    }

    /**
     * 创建客户
     *
     */
    protected function createAccount($tid)
    {
        //创建客户
        $result = $this->fxiaoke->createAccount($this->data['full_order_info']);

        //创建失败
        if($result['errorCode'] != 0){
            $this->savePushLog($tid,'create',0,$result);
            exit();
        }

        return $result;
    }

    /**
     * 产品是否有一项为工商管理分类
     *
     */
    protected function isBusinessCategory()
    {
        //产品是否有一项为工商管理分类
        $businessCategory = 0;

        //根据产品编码查询产品详细信息
        foreach ($this->data['full_order_info']['orders'] as $k=>$v){
            if(!empty($v['outer_item_id'])){
                //根据产品编码查询产品详细信息
                $goodsList = $this->fxiaoke->getList('ProductObj',[
                    [
                        'field_name' => 'product_code',
                        'field_values' => $v['outer_item_id'],
                        'operator' => 'EQ',
                    ]
                ]);
                //产品为工商管理分类
                if(count($goodsList['data']['dataList']) > 0 && $goodsList['data']['dataList'][0]['category'] == config('site.businessCategory')){
                    $businessCategory = 1;
                    break;
                }
            }
        }

        return $businessCategory;
    }

    /**
     * 新增推送记录
     *
     */
    protected function insertPushLog($order_sn,$push_type)
    {
        //组装参数
        $data  = [
            'msg_id' => $this->msg_id,
            'order_sn' => $order_sn,
            'push_type' => $push_type,
            'trigger_time' => time(),
        ];

        PushLog::insert($data);
    }

    /**
     * 保存同步记录
     *
     */
    protected function savePushLog($order_sn,$push_type,$sync_status,$sync_result)
    {
        //组装参数
        $data  = [
            'msg_id' => $this->msg_id,
            'order_sn' => $order_sn,
            'push_type' => $push_type,
            'trigger_time' => time(),
            'push_data' => json_encode($this->data,JSON_UNESCAPED_UNICODE),
            'sync_status' => $sync_status,
            'sync_result' => json_encode($sync_result,JSON_UNESCAPED_UNICODE),
            'sync_time' => time(),
        ];

        PushLog::where(['order_sn'=>$data['order_sn'],'push_type'=>$push_type])->update($data);
    }

    /**
     * 保存未同步记录
     *
     */
    protected function saveNotPushLog($push_type,$msg_id)
    {
        //组装参数
        $data  = [
            'msg_id' => $msg_id,
            'push_type' => $push_type,
            'trigger_time' => time(),
            'push_data' => json_encode($this->data,JSON_UNESCAPED_UNICODE),
        ];

        NotPushLog::insert($data);
    }
}
