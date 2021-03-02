<?php

namespace app\api\controller;

use app\common\controller\Api;
use Youzan\Open\Helper\CryptoHelper;

/**
 * 有赞-CRM对接接口
 */
class Trade extends Api
{
    protected $noNeedLogin = ['*'];
    protected $noNeedRight = ['*'];

    /**
     * 接收有赞推送消息
     *
     */
    public function notice()
    {
        //接收有赞推送消息
//        $json = file_get_contents('php://input');
        $json = '{"msg":"%7B%22delivery_order%22%3A%5B%5D%2C%22order_promotion%22%3A%7B%22item%22%3A%5B%5D%2C%22adjust_fee%22%3A%220.00%22%2C%22order%22%3A%5B%5D%7D%2C%22refund_order%22%3A%5B%5D%2C%22full_order_info%22%3A%7B%22address_info%22%3A%7B%22self_fetch_info%22%3A%22%22%2C%22delivery_address%22%3A%22%E5%8D%97%E6%B3%95%E4%BF%A1+5273%22%2C%22delivery_postal_code%22%3A%22%22%2C%22receiver_name%22%3A%22%E6%99%93%E5%B3%B0%22%2C%22delivery_province%22%3A%22%E5%8C%97%E4%BA%AC%E5%B8%82%22%2C%22delivery_city%22%3A%22%E5%8C%97%E4%BA%AC%E5%B8%82%22%2C%22address_extra%22%3A%22%7B%5C%22areaCode%5C%22%3A%5C%22110113%5C%22%2C%5C%22lon%5C%22%3A116.61735839723883%2C%5C%22lat%5C%22%3A40.12527926653763%7D%22%2C%22delivery_district%22%3A%22%E9%A1%BA%E4%B9%89%E5%8C%BA%22%2C%22receiver_tel%22%3A%2213439302541%22%7D%2C%22remark_info%22%3A%7B%22buyer_message%22%3A%22%22%7D%2C%22pay_info%22%3A%7B%22outer_transactions%22%3A%5B%5D%2C%22deduction_real_pay%22%3A100000%2C%22real_payment%22%3A%220.00%22%2C%22post_fee%22%3A%220.00%22%2C%22deduction_pay%22%3A0%2C%22deduct_value_card_pay%22%3A0%2C%22deduct_gift_card_pay%22%3A0%2C%22phase_payments%22%3A%5B%5D%2C%22total_fee%22%3A%221000.00%22%2C%22payment%22%3A%221000.00%22%2C%22transaction%22%3A%5B%5D%7D%2C%22buyer_info%22%3A%7B%22outer_user_id%22%3A%22%22%2C%22buyer_phone%22%3A%2213439302541%22%2C%22yz_open_id%22%3A%22fmYKJi5S780402721424506880%22%2C%22fans_type%22%3A0%2C%22buyer_id%22%3A13713132219%2C%22fans_nickname%22%3A%22%22%2C%22fans_id%22%3A0%7D%2C%22orders%22%3A%5B%7B%22is_cross_border%22%3A%22%22%2C%22outer_item_id%22%3A%22%22%2C%22discount_price%22%3A%221000.00%22%2C%22item_type%22%3A0%2C%22num%22%3A1%2C%22oid%22%3A%222791512317217210475%22%2C%22title%22%3A%22%E5%86%85%E8%B5%84%E4%B8%AA%E7%8B%AC%E4%BC%81%E4%B8%9A%E6%B3%A8%E5%86%8C%EF%BC%88%E5%A4%96%E7%9C%81%2F%E5%A5%89%E8%B4%A4%EF%BC%8C%E5%B4%87%E6%98%8E%E6%96%B0%E6%B2%B3%E5%9B%AD%E5%8C%BA%EF%BC%89%22%2C%22fenxiao_payment%22%3A%220.00%22%2C%22item_message%22%3A%22%22%2C%22buyer_messages%22%3A%22%22%2C%22cross_border_trade_mode%22%3A%22%22%2C%22is_present%22%3Afalse%2C%22sub_order_no%22%3A%22%22%2C%22price%22%3A%221000.00%22%2C%22fenxiao_price%22%3A%220.00%22%2C%22total_fee%22%3A%221000.00%22%2C%22alias%22%3A%22361m3p2gupnll%22%2C%22payment%22%3A%221000.00%22%2C%22outer_sku_id%22%3A%221010202109%22%2C%22goods_url%22%3A%22https%3A%2F%2Fh5.youzan.com%2Fv2%2Fshowcase%2Fgoods%3Falias%3D361m3p2gupnll%22%2C%22customs_code%22%3A%22%22%2C%22item_id%22%3A574609897%2C%22sku_properties_name%22%3A%22%5B%7B%5C%22k%5C%22%3A%5C%22%E4%B8%AA%E7%8B%AC%E6%B3%A8%E5%86%8C%5C%22%2C%5C%22k_id%5C%22%3A54383945%2C%5C%22v%5C%22%3A%5C%22%E5%A5%89%E8%B4%A4%E5%A4%B4%E6%A1%A5%5C%22%2C%5C%22v_id%5C%22%3A54312411%7D%5D%22%2C%22sku_id%22%3A37155730%2C%22pic_path%22%3A%22https%3A%2F%2Fimg01.yzcdn.cn%2Fupload_files%2F2019%2F06%2F12%2FFuoBeewDFpTu_rcqxsWYSvutESDw.jpg%22%2C%22points_price%22%3A%220%22%7D%5D%2C%22source_info%22%3A%7B%22is_offline_order%22%3Afalse%2C%22book_key%22%3A%221f154c84-bf16-4fce-b4a5-f5b856c1f4fb%22%2C%22biz_source%22%3A%22%22%2C%22source%22%3A%7B%22platform%22%3A%22browser%22%2C%22wx_entrance%22%3A%22direct_buy%22%7D%7D%2C%22order_info%22%3A%7B%22consign_time%22%3A%22%22%2C%22order_extra%22%3A%7B%22is_from_cart%22%3A%22true%22%2C%22is_points_order%22%3A%220%22%7D%2C%22created%22%3A%222021-03-02+13%3A30%3A35%22%2C%22status_str%22%3A%22%E5%BE%85%E6%94%AF%E4%BB%98%22%2C%22expired_time%22%3A%222021-03-02+14%3A30%3A35%22%2C%22success_time%22%3A%22%22%2C%22type%22%3A0%2C%22confirm_time%22%3A%22%22%2C%22tid%22%3A%22E20210302133034069904107%22%2C%22pay_time%22%3A%22%22%2C%22update_time%22%3A%222021-03-02+13%3A30%3A35%22%2C%22is_retail_order%22%3Afalse%2C%22team_type%22%3A0%2C%22pay_type%22%3A0%2C%22refund_state%22%3A0%2C%22close_type%22%3A0%2C%22order_tags%22%3A%7B%22is_secured_transactions%22%3Atrue%7D%2C%22express_type%22%3A0%2C%22status%22%3A%22WAIT_BUYER_PAY%22%7D%7D%7D","kdt_name":"开业啦商城","test":false,"sign":"4cc66e4d2efdb625b93273dccdfbb031","sendCount":1,"type":"trade_TradeCreate","version":1614663035,"client_id":"c346b8b39599aaa677","mode":1,"kdt_id":13027865,"id":"E20210302133034069904107","msg_id":"9814ebed-2452-4db7-9e4f-b65b2f489694","root_kdt_id":13027865,"status":"WAIT_BUYER_PAY"}';
        $data = json_decode($json, true);

        //获取有赞配置
        $youzan = config('site.youzan');

        //判断消息是否合法，若合法则返回成功标识
        $msg = $data['msg'];
        $sign_string = $youzan['client_id']."".$msg."".$youzan['client_secret'];
        $sign = md5($sign_string);
        if($sign != $data['sign']){
            $this->error(__('Invalid sign'));
        }

        //msg内容经过 urlencode 编码，需进行解码
        $msg = json_decode(urldecode($msg),true);

        //根据 type 来识别消息事件类型
        switch ($data['type'])
        {
            case 'trade_TradeCreate':
               $this->tradeCreate($msg);
                break;
            case 'trade_TradePaid':
                $this->tradePaid($msg);
                break;
            case 'trade_TradeSuccess':
                $this->tradeSuccess($msg);
                break;
            default:
                $this->error(__('Invalid type'));
        }

        //$this->success('请求成功');
    }

    /**
     * 交易创建
     *
     */
    protected function tradeCreate($msg)
    {
        echo 'tradeCreate';
    }

    /**
     * 交易支付
     *
     */
    protected function tradePaid($msg)
    {
        echo 'tradePaid';
    }

    /**
     * 交易成功
     *
     */
    protected function tradeSuccess($msg)
    {
        echo 'tradeCreate';
    }
}
