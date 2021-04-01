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
        $json = '{"msg":"%7B%22delivery_order%22%3A%5B%5D%2C%22order_promotion%22%3A%7B%22item%22%3A%5B%5D%2C%22adjust_fee%22%3A%220.00%22%2C%22order%22%3A%5B%5D%7D%2C%22refund_order%22%3A%5B%5D%2C%22full_order_info%22%3A%7B%22address_info%22%3A%7B%22self_fetch_info%22%3A%22%22%2C%22delivery_address%22%3A%22%22%2C%22delivery_postal_code%22%3A%22%22%2C%22receiver_name%22%3A%22%22%2C%22delivery_province%22%3A%22%22%2C%22delivery_city%22%3A%22%22%2C%22address_extra%22%3A%22%7B%7D%22%2C%22delivery_district%22%3A%22%22%2C%22receiver_tel%22%3A%22%22%7D%2C%22remark_info%22%3A%7B%22buyer_message%22%3A%22%22%7D%2C%22pay_info%22%3A%7B%22outer_transactions%22%3A%5B%5D%2C%22deduction_real_pay%22%3A1%2C%22real_payment%22%3A%220.00%22%2C%22post_fee%22%3A%220.00%22%2C%22deduction_pay%22%3A0%2C%22deduct_value_card_pay%22%3A0%2C%22deduct_gift_card_pay%22%3A0%2C%22phase_payments%22%3A%5B%5D%2C%22total_fee%22%3A%220.01%22%2C%22payment%22%3A%220.01%22%2C%22transaction%22%3A%5B%5D%7D%2C%22buyer_info%22%3A%7B%22outer_user_id%22%3A%22oPw1pt7-qn-bEoCWhp5V5eFitm1k%22%2C%22buyer_phone%22%3A%2218017720511%22%2C%22yz_open_id%22%3A%22wKozXUzB709060524846944256%22%2C%22fans_type%22%3A1%2C%22buyer_id%22%3A1111999412%2C%22fans_nickname%22%3A%22AnthonyMong%22%2C%22fans_id%22%3A11370174338%7D%2C%22orders%22%3A%5B%7B%22is_cross_border%22%3A%22%22%2C%22outer_item_id%22%3A%22200107004%22%2C%22discount_price%22%3A%220.01%22%2C%22item_type%22%3A182%2C%22num%22%3A1%2C%22oid%22%3A%222797062761566175276%22%2C%22title%22%3A%22%E9%A3%9F%E5%93%81%E7%BB%8F%E8%90%A5%E8%8C%83%E5%9B%B4%EF%BC%88%E5%A2%9E%E5%8A%A0%E5%A9%B4%E5%B9%BC%E5%84%BF%E5%A5%B6%E7%B2%89%EF%BC%89%EF%BC%88%E6%B5%8B%E8%AF%95%EF%BC%89%22%2C%22fenxiao_payment%22%3A%220.00%22%2C%22item_message%22%3A%22%22%2C%22buyer_messages%22%3A%22%22%2C%22cross_border_trade_mode%22%3A%22%22%2C%22is_present%22%3Afalse%2C%22sub_order_no%22%3A%22%22%2C%22price%22%3A%220.01%22%2C%22fenxiao_price%22%3A%220.00%22%2C%22total_fee%22%3A%220.01%22%2C%22alias%22%3A%223eu5pn7hwrac9%22%2C%22payment%22%3A%220.01%22%2C%22outer_sku_id%22%3A%22%22%2C%22goods_url%22%3A%22https%3A%2F%2Fh5.youzan.com%2Fv2%2Fshowcase%2Fgoods%3Falias%3D3eu5pn7hwrac9%22%2C%22customs_code%22%3A%22%22%2C%22item_id%22%3A926212695%2C%22sku_properties_name%22%3A%22%5B%5D%22%2C%22sku_id%22%3A0%2C%22pic_path%22%3A%22https%3A%2F%2Fimg01.yzcdn.cn%2Fupload_files%2F2021%2F04%2F01%2FFv-HXIH2gFg5_WDSmbcyFZQ0AiIn.jpg%22%2C%22points_price%22%3A%220%22%7D%5D%2C%22source_info%22%3A%7B%22is_offline_order%22%3Afalse%2C%22book_key%22%3A%22e044ddb2-6a1c-4a8c-a94b-ec517256fa11%22%2C%22biz_source%22%3A%22%22%2C%22source%22%3A%7B%22platform%22%3A%22wx%22%2C%22wx_entrance%22%3A%22direct_buy%22%7D%7D%2C%22order_info%22%3A%7B%22consign_time%22%3A%22%22%2C%22order_extra%22%3A%7B%22is_from_cart%22%3A%22false%22%2C%22is_points_order%22%3A%220%22%7D%2C%22created%22%3A%222021-04-01+11%3A28%3A06%22%2C%22status_str%22%3A%22%E5%BE%85%E6%94%AF%E4%BB%98%22%2C%22expired_time%22%3A%222021-04-01+12%3A28%3A06%22%2C%22success_time%22%3A%22%22%2C%22type%22%3A0%2C%22confirm_time%22%3A%22%22%2C%22tid%22%3A%22E20210401112806094800009%22%2C%22pay_time%22%3A%22%22%2C%22update_time%22%3A%222021-04-01+11%3A28%3A06%22%2C%22is_retail_order%22%3Afalse%2C%22team_type%22%3A0%2C%22pay_type%22%3A0%2C%22refund_state%22%3A0%2C%22close_type%22%3A0%2C%22order_tags%22%3A%7B%22is_virtual%22%3Atrue%2C%22is_secured_transactions%22%3Atrue%7D%2C%22express_type%22%3A9%2C%22status%22%3A%22WAIT_BUYER_PAY%22%7D%7D%7D","kdt_name":"开业啦商城","test":false,"sign":"e1e1adf2d829883dfaaf0c4a53da17a6","sendCount":1,"type":"trade_TradeCreate","version":1617247686,"client_id":"c346b8b39599aaa677","mode":1,"kdt_id":13027865,"id":"E20210401112806094800009","msg_id":"ee9f3e78-3147-4592-91e5-903792ce2c45","root_kdt_id":13027865,"status":"WAIT_BUYER_PAY"}';
//        $json = '{"msg":"%7B%22delivery_order%22%3A%5B%5D%2C%22order_promotion%22%3A%7B%22item%22%3A%5B%5D%2C%22adjust_fee%22%3A%220.00%22%2C%22order%22%3A%5B%5D%7D%2C%22refund_order%22%3A%5B%5D%2C%22full_order_info%22%3A%7B%22address_info%22%3A%7B%22self_fetch_info%22%3A%22%22%2C%22delivery_address%22%3A%22%E7%BB%BF%E6%B4%B2%C2%B7%E4%B8%B0%E6%80%A1%E5%9B%AD%28%E4%B8%8A%E6%B5%B7%E5%B8%82%E5%98%89%E5%AE%9A%E5%8C%BA%2922%E5%8F%B7504+%22%2C%22delivery_postal_code%22%3A%22201800%22%2C%22receiver_name%22%3A%22%E9%A9%AC%E6%99%93%E6%A0%8B%22%2C%22delivery_province%22%3A%22%E4%B8%8A%E6%B5%B7%E5%B8%82%22%2C%22delivery_city%22%3A%22%E4%B8%8A%E6%B5%B7%E5%B8%82%22%2C%22address_extra%22%3A%22%7B%5C%22areaCode%5C%22%3A%5C%22310114%5C%22%2C%5C%22lon%5C%22%3A121.2388702496894%2C%5C%22lat%5C%22%3A31.375931891359027%7D%22%2C%22delivery_district%22%3A%22%E5%98%89%E5%AE%9A%E5%8C%BA%22%2C%22receiver_tel%22%3A%2218017720511%22%7D%2C%22remark_info%22%3A%7B%22buyer_message%22%3A%22%22%7D%2C%22pay_info%22%3A%7B%22outer_transactions%22%3A%5B%5D%2C%22deduction_real_pay%22%3A1%2C%22real_payment%22%3A%220.00%22%2C%22post_fee%22%3A%220.00%22%2C%22deduction_pay%22%3A0%2C%22deduct_value_card_pay%22%3A0%2C%22deduct_gift_card_pay%22%3A0%2C%22phase_payments%22%3A%5B%5D%2C%22total_fee%22%3A%220.01%22%2C%22payment%22%3A%220.01%22%2C%22transaction%22%3A%5B%5D%7D%2C%22buyer_info%22%3A%7B%22outer_user_id%22%3A%22oPw1pt7-qn-bEoCWhp5V5eFitm1k%22%2C%22buyer_phone%22%3A%2218017720511%22%2C%22yz_open_id%22%3A%22wKozXUzB709060524846944256%22%2C%22fans_type%22%3A1%2C%22buyer_id%22%3A1111999412%2C%22fans_nickname%22%3A%22AnthonyMong%22%2C%22fans_id%22%3A11370174338%7D%2C%22orders%22%3A%5B%7B%22is_cross_border%22%3A%22%22%2C%22outer_item_id%22%3A%22%22%2C%22discount_price%22%3A%220.01%22%2C%22item_type%22%3A0%2C%22num%22%3A1%2C%22oid%22%3A%222796923531611602955%22%2C%22title%22%3A%22%E8%BF%9B%E5%87%BA%E5%8F%A3%E6%9D%83%EF%BC%88%E6%B5%8B%E8%AF%95%E7%94%A8%EF%BC%89%22%2C%22fenxiao_payment%22%3A%220.00%22%2C%22item_message%22%3A%22%22%2C%22buyer_messages%22%3A%22%22%2C%22cross_border_trade_mode%22%3A%22%22%2C%22is_present%22%3Afalse%2C%22sub_order_no%22%3A%22%22%2C%22price%22%3A%220.01%22%2C%22fenxiao_price%22%3A%220.00%22%2C%22total_fee%22%3A%220.01%22%2C%22alias%22%3A%223nfbld6j47h15%22%2C%22payment%22%3A%220.01%22%2C%22outer_sku_id%22%3A%22200107010%22%2C%22goods_url%22%3A%22https%3A%2F%2Fh5.youzan.com%2Fv2%2Fshowcase%2Fgoods%3Falias%3D3nfbld6j47h15%22%2C%22customs_code%22%3A%22%22%2C%22item_id%22%3A909787852%2C%22sku_properties_name%22%3A%22%5B%7B%5C%22k%5C%22%3A%5C%22%E8%AF%81%E7%85%A7%E7%B1%BB%E5%9E%8B%5C%22%2C%5C%22k_id%5C%22%3A18455014%2C%5C%22v%5C%22%3A%5C%22%E8%BF%9B%E5%87%BA%E5%8F%A3%E6%9D%83%E8%AF%81%5C%22%2C%5C%22v_id%5C%22%3A2072342%7D%5D%22%2C%22sku_id%22%3A37196971%2C%22pic_path%22%3A%22https%3A%2F%2Fimg01.yzcdn.cn%2Fupload_files%2F2018%2F02%2F06%2FFpzS4vqukegycfuKJVSaFl6izead.jpg%22%2C%22points_price%22%3A%220%22%7D%5D%2C%22source_info%22%3A%7B%22is_offline_order%22%3Afalse%2C%22book_key%22%3A%22702b3ab8-e17c-4cf0-bba4-02dd131e0992%22%2C%22biz_source%22%3A%22%22%2C%22source%22%3A%7B%22platform%22%3A%22wx%22%2C%22wx_entrance%22%3A%22direct_buy%22%7D%7D%2C%22order_info%22%3A%7B%22consign_time%22%3A%22%22%2C%22order_extra%22%3A%7B%22is_from_cart%22%3A%22true%22%2C%22is_points_order%22%3A%220%22%7D%2C%22created%22%3A%222021-03-31+17%3A27%3A27%22%2C%22status_str%22%3A%22%E5%BE%85%E6%94%AF%E4%BB%98%22%2C%22expired_time%22%3A%222021-03-31+18%3A27%3A27%22%2C%22success_time%22%3A%22%22%2C%22type%22%3A0%2C%22confirm_time%22%3A%22%22%2C%22tid%22%3A%22E20210331172726094804181%22%2C%22pay_time%22%3A%22%22%2C%22update_time%22%3A%222021-03-31+17%3A27%3A27%22%2C%22is_retail_order%22%3Afalse%2C%22team_type%22%3A0%2C%22pay_type%22%3A0%2C%22refund_state%22%3A0%2C%22close_type%22%3A0%2C%22order_tags%22%3A%7B%22is_secured_transactions%22%3Atrue%7D%2C%22express_type%22%3A0%2C%22status%22%3A%22WAIT_BUYER_PAY%22%7D%7D%7D","kdt_name":"开业啦商城","test":false,"sign":"ac924657d448333d82604de909441894","type":"trade_TradeCreate","sendCount":1,"version":1617182847,"client_id":"c346b8b39599aaa677","mode":1,"kdt_id":13027865,"id":"E20210331172726094804181","msg_id":"fda56bcd-12b1-42cf-8695-4cc9656f1fee","root_kdt_id":13027865,"status":"WAIT_BUYER_PAY"}';
        //买家付款
//        $json = '{"msg":"%7B%22delivery_order%22%3A%5B%5D%2C%22order_promotion%22%3A%7B%22item%22%3A%5B%5D%2C%22adjust_fee%22%3A%220.00%22%2C%22order%22%3A%5B%5D%7D%2C%22refund_order%22%3A%5B%5D%2C%22full_order_info%22%3A%7B%22address_info%22%3A%7B%22self_fetch_info%22%3A%22%22%2C%22delivery_address%22%3A%22%E7%BB%BF%E6%B4%B2%C2%B7%E4%B8%B0%E6%80%A1%E5%9B%AD%28%E4%B8%8A%E6%B5%B7%E5%B8%82%E5%98%89%E5%AE%9A%E5%8C%BA%2922%E5%8F%B7504+%22%2C%22delivery_postal_code%22%3A%22201800%22%2C%22receiver_name%22%3A%22%E9%A9%AC%E6%99%93%E6%A0%8B%22%2C%22delivery_province%22%3A%22%E4%B8%8A%E6%B5%B7%E5%B8%82%22%2C%22delivery_city%22%3A%22%E4%B8%8A%E6%B5%B7%E5%B8%82%22%2C%22address_extra%22%3A%22%7B%5C%22areaCode%5C%22%3A%5C%22310114%5C%22%2C%5C%22lon%5C%22%3A121.2388702496894%2C%5C%22lat%5C%22%3A31.375931891359027%7D%22%2C%22delivery_district%22%3A%22%E5%98%89%E5%AE%9A%E5%8C%BA%22%2C%22receiver_tel%22%3A%2218017720511%22%7D%2C%22remark_info%22%3A%7B%22buyer_message%22%3A%22%22%7D%2C%22pay_info%22%3A%7B%22outer_transactions%22%3A%5B%5D%2C%22deduction_real_pay%22%3A1%2C%22real_payment%22%3A%220.00%22%2C%22post_fee%22%3A%220.00%22%2C%22deduction_pay%22%3A0%2C%22deduct_value_card_pay%22%3A0%2C%22deduct_gift_card_pay%22%3A0%2C%22phase_payments%22%3A%5B%5D%2C%22total_fee%22%3A%220.01%22%2C%22payment%22%3A%220.01%22%2C%22transaction%22%3A%5B%5D%7D%2C%22buyer_info%22%3A%7B%22outer_user_id%22%3A%22oPw1pt7-qn-bEoCWhp5V5eFitm1k%22%2C%22buyer_phone%22%3A%2218017720511%22%2C%22yz_open_id%22%3A%22wKozXUzB709060524846944256%22%2C%22fans_type%22%3A1%2C%22buyer_id%22%3A1111999412%2C%22fans_nickname%22%3A%22AnthonyMong%22%2C%22fans_id%22%3A11370174338%7D%2C%22orders%22%3A%5B%7B%22is_cross_border%22%3A%22%22%2C%22outer_item_id%22%3A%22%22%2C%22discount_price%22%3A%220.01%22%2C%22item_type%22%3A0%2C%22num%22%3A1%2C%22oid%22%3A%222796923531611602955%22%2C%22title%22%3A%22%E8%BF%9B%E5%87%BA%E5%8F%A3%E6%9D%83%EF%BC%88%E6%B5%8B%E8%AF%95%E7%94%A8%EF%BC%89%22%2C%22fenxiao_payment%22%3A%220.00%22%2C%22item_message%22%3A%22%22%2C%22buyer_messages%22%3A%22%22%2C%22cross_border_trade_mode%22%3A%22%22%2C%22is_present%22%3Afalse%2C%22sub_order_no%22%3A%22%22%2C%22price%22%3A%220.01%22%2C%22fenxiao_price%22%3A%220.00%22%2C%22total_fee%22%3A%220.01%22%2C%22alias%22%3A%223nfbld6j47h15%22%2C%22payment%22%3A%220.01%22%2C%22outer_sku_id%22%3A%22200107010%22%2C%22goods_url%22%3A%22https%3A%2F%2Fh5.youzan.com%2Fv2%2Fshowcase%2Fgoods%3Falias%3D3nfbld6j47h15%22%2C%22customs_code%22%3A%22%22%2C%22item_id%22%3A909787852%2C%22sku_properties_name%22%3A%22%5B%7B%5C%22k%5C%22%3A%5C%22%E8%AF%81%E7%85%A7%E7%B1%BB%E5%9E%8B%5C%22%2C%5C%22k_id%5C%22%3A18455014%2C%5C%22v%5C%22%3A%5C%22%E8%BF%9B%E5%87%BA%E5%8F%A3%E6%9D%83%E8%AF%81%5C%22%2C%5C%22v_id%5C%22%3A2072342%7D%5D%22%2C%22sku_id%22%3A37196971%2C%22pic_path%22%3A%22https%3A%2F%2Fimg01.yzcdn.cn%2Fupload_files%2F2018%2F02%2F06%2FFpzS4vqukegycfuKJVSaFl6izead.jpg%22%2C%22points_price%22%3A%220%22%7D%5D%2C%22source_info%22%3A%7B%22is_offline_order%22%3Afalse%2C%22book_key%22%3A%22702b3ab8-e17c-4cf0-bba4-02dd131e0992%22%2C%22biz_source%22%3A%22%22%2C%22source%22%3A%7B%22platform%22%3A%22wx%22%2C%22wx_entrance%22%3A%22direct_buy%22%7D%7D%2C%22order_info%22%3A%7B%22consign_time%22%3A%22%22%2C%22order_extra%22%3A%7B%22is_from_cart%22%3A%22true%22%2C%22is_points_order%22%3A%220%22%7D%2C%22created%22%3A%222021-03-31+17%3A27%3A27%22%2C%22status_str%22%3A%22%E5%BE%85%E6%94%AF%E4%BB%98%22%2C%22expired_time%22%3A%222021-03-31+18%3A27%3A27%22%2C%22success_time%22%3A%22%22%2C%22type%22%3A0%2C%22confirm_time%22%3A%22%22%2C%22tid%22%3A%22E20210331172726094804181%22%2C%22pay_time%22%3A%22%22%2C%22update_time%22%3A%222021-03-31+17%3A27%3A27%22%2C%22is_retail_order%22%3Afalse%2C%22team_type%22%3A0%2C%22pay_type%22%3A0%2C%22refund_state%22%3A0%2C%22close_type%22%3A0%2C%22order_tags%22%3A%7B%22is_secured_transactions%22%3Atrue%7D%2C%22express_type%22%3A0%2C%22status%22%3A%22WAIT_BUYER_PAY%22%7D%7D%7D","kdt_name":"开业啦商城","test":false,"sign":"ac924657d448333d82604de909441894","type":"trade_TradeCreate","sendCount":1,"version":1617182847,"client_id":"c346b8b39599aaa677","mode":1,"kdt_id":13027865,"id":"E20210331172726094804181","msg_id":"fda56bcd-12b1-42cf-8695-4cc9656f1fee","root_kdt_id":13027865,"status":"WAIT_BUYER_PAY"}';
//        $json = '{"msg":"%7B%22delivery_order%22%3A%5B%5D%2C%22order_promotion%22%3A%7B%22item%22%3A%5B%5D%2C%22adjust_fee%22%3A%220.00%22%2C%22order%22%3A%5B%5D%7D%2C%22refund_order%22%3A%5B%5D%2C%22full_order_info%22%3A%7B%22address_info%22%3A%7B%22self_fetch_info%22%3A%22%22%2C%22delivery_address%22%3A%22%E7%BB%BF%E6%B4%B2%C2%B7%E4%B8%B0%E6%80%A1%E5%9B%AD%28%E4%B8%8A%E6%B5%B7%E5%B8%82%E5%98%89%E5%AE%9A%E5%8C%BA%2922%E5%8F%B7504+%22%2C%22delivery_postal_code%22%3A%22201800%22%2C%22receiver_name%22%3A%22%E9%A9%AC%E6%99%93%E6%A0%8B%22%2C%22delivery_province%22%3A%22%E4%B8%8A%E6%B5%B7%E5%B8%82%22%2C%22delivery_city%22%3A%22%E4%B8%8A%E6%B5%B7%E5%B8%82%22%2C%22address_extra%22%3A%22%7B%5C%22areaCode%5C%22%3A%5C%22310114%5C%22%2C%5C%22lon%5C%22%3A121.2388702496894%2C%5C%22lat%5C%22%3A31.375931891359027%7D%22%2C%22delivery_district%22%3A%22%E5%98%89%E5%AE%9A%E5%8C%BA%22%2C%22receiver_tel%22%3A%2218017720511%22%7D%2C%22remark_info%22%3A%7B%22buyer_message%22%3A%22%22%7D%2C%22pay_info%22%3A%7B%22outer_transactions%22%3A%5B%224200000880202103226334765219%22%5D%2C%22post_fee%22%3A%220.00%22%2C%22total_fee%22%3A%220.02%22%2C%22payment%22%3A%220.02%22%2C%22transaction%22%3A%5B%222103221741120000410380%22%5D%7D%2C%22buyer_info%22%3A%7B%22outer_user_id%22%3A%22oPw1pt7-qn-bEoCWhp5V5eFitm1k%22%2C%22buyer_phone%22%3A%2218017720511%22%2C%22yz_open_id%22%3A%22wKozXUzB709060524846944256%22%2C%22fans_type%22%3A1%2C%22buyer_id%22%3A1111999412%2C%22fans_nickname%22%3A%22AnthonyMong%22%2C%22fans_id%22%3A11370174338%7D%2C%22orders%22%3A%5B%7B%22is_cross_border%22%3A%22%22%2C%22outer_item_id%22%3A%22%22%2C%22discount_price%22%3A%220.01%22%2C%22item_type%22%3A0%2C%22num%22%3A1%2C%22oid%22%3A%222795255370608541715%22%2C%22title%22%3A%22ICP%E8%AE%B8%E5%8F%AF%EF%BC%88%E6%B5%8B%E8%AF%95%E7%94%A8%EF%BC%89%22%2C%22fenxiao_payment%22%3A%220.00%22%2C%22item_message%22%3A%22%22%2C%22buyer_messages%22%3A%22%22%2C%22cross_border_trade_mode%22%3A%22%22%2C%22is_present%22%3Afalse%2C%22sub_order_no%22%3A%22%22%2C%22price%22%3A%220.01%22%2C%22fenxiao_price%22%3A%220.00%22%2C%22total_fee%22%3A%220.01%22%2C%22alias%22%3A%222fyxd4otu1kp5%22%2C%22payment%22%3A%220.01%22%2C%22outer_sku_id%22%3A%22200107001%22%2C%22goods_url%22%3A%22https%3A%2F%2Fh5.youzan.com%2Fv2%2Fshowcase%2Fgoods%3Falias%3D2fyxd4otu1kp5%22%2C%22customs_code%22%3A%22%22%2C%22item_id%22%3A920537227%2C%22sku_properties_name%22%3A%22%5B%7B%5C%22k%5C%22%3A%5C%22%E8%AF%81%E7%85%A7%E7%B1%BB%E5%9E%8B%5C%22%2C%5C%22k_id%5C%22%3A18455014%2C%5C%22v%5C%22%3A%5C%22ICP%E8%AE%B8%E5%8F%AF%E8%AF%81%5C%22%2C%5C%22v_id%5C%22%3A13790215%7D%5D%22%2C%22sku_id%22%3A37201610%2C%22pic_path%22%3A%22https%3A%2F%2Fimg01.yzcdn.cn%2Fupload_files%2F2018%2F02%2F06%2FFvW7_r6LVwNJzt0ulnNv4CHcyWMR.jpg%22%2C%22points_price%22%3A%220%22%7D%2C%7B%22is_cross_border%22%3A%22%22%2C%22outer_item_id%22%3A%22%22%2C%22discount_price%22%3A%220.01%22%2C%22item_type%22%3A0%2C%22num%22%3A1%2C%22oid%22%3A%222795255370608541716%22%2C%22title%22%3A%22%E8%BF%9B%E5%87%BA%E5%8F%A3%E6%9D%83%EF%BC%88%E6%B5%8B%E8%AF%95%E7%94%A8%EF%BC%89%22%2C%22fenxiao_payment%22%3A%220.00%22%2C%22item_message%22%3A%22%22%2C%22buyer_messages%22%3A%22%22%2C%22cross_border_trade_mode%22%3A%22%22%2C%22is_present%22%3Afalse%2C%22sub_order_no%22%3A%22%22%2C%22price%22%3A%220.01%22%2C%22fenxiao_price%22%3A%220.00%22%2C%22total_fee%22%3A%220.01%22%2C%22alias%22%3A%223nfbld6j47h15%22%2C%22payment%22%3A%220.01%22%2C%22outer_sku_id%22%3A%22200107010%22%2C%22goods_url%22%3A%22https%3A%2F%2Fh5.youzan.com%2Fv2%2Fshowcase%2Fgoods%3Falias%3D3nfbld6j47h15%22%2C%22customs_code%22%3A%22%22%2C%22item_id%22%3A909787852%2C%22sku_properties_name%22%3A%22%5B%7B%5C%22k%5C%22%3A%5C%22%E8%AF%81%E7%85%A7%E7%B1%BB%E5%9E%8B%5C%22%2C%5C%22k_id%5C%22%3A18455014%2C%5C%22v%5C%22%3A%5C%22%E8%BF%9B%E5%87%BA%E5%8F%A3%E6%9D%83%E8%AF%81%5C%22%2C%5C%22v_id%5C%22%3A2072342%7D%5D%22%2C%22sku_id%22%3A37196971%2C%22pic_path%22%3A%22https%3A%2F%2Fimg01.yzcdn.cn%2Fupload_files%2F2018%2F02%2F06%2FFpzS4vqukegycfuKJVSaFl6izead.jpg%22%2C%22points_price%22%3A%220%22%7D%5D%2C%22source_info%22%3A%7B%22is_offline_order%22%3Afalse%2C%22book_key%22%3A%223b71094d-d9cd-4069-ab77-f4adc5dec269%22%2C%22source%22%3A%7B%22platform%22%3A%22wx%22%2C%22wx_entrance%22%3A%22direct_buy%22%7D%7D%2C%22order_info%22%3A%7B%22consign_time%22%3A%22%22%2C%22order_extra%22%3A%7B%22is_from_cart%22%3A%22true%22%2C%22is_points_order%22%3A%220%22%7D%2C%22created%22%3A%222021-03-22+17%3A41%3A11%22%2C%22status_str%22%3A%22%E5%B7%B2%E6%94%AF%E4%BB%98%22%2C%22expired_time%22%3A%222021-03-22+18%3A41%3A11%22%2C%22success_time%22%3A%22%22%2C%22type%22%3A0%2C%22confirm_time%22%3A%22%22%2C%22tid%22%3A%22E20210322174110094800093%22%2C%22pay_time%22%3A%222021-03-22+17%3A41%3A15%22%2C%22update_time%22%3A%222021-03-22+17%3A41%3A16%22%2C%22is_retail_order%22%3Afalse%2C%22team_type%22%3A0%2C%22pay_type%22%3A10%2C%22refund_state%22%3A0%2C%22close_type%22%3A0%2C%22order_tags%22%3A%7B%22is_secured_transactions%22%3Atrue%2C%22is_payed%22%3Atrue%7D%2C%22express_type%22%3A0%2C%22status%22%3A%22TRADE_PAID%22%7D%7D%7D","kdt_name":"开业啦商城","test":false,"sign":"926a249b708b6708d878fd73a96fe8c5","type":"trade_TradePaid","sendCount":1,"version":1616406076,"client_id":"c346b8b39599aaa677","mode":1,"kdt_id":13027865,"id":"E20210322174110094800093","msg_id":"c137cd44-3f8e-4fd8-9a76-dc664143524e","root_kdt_id":13027865,"status":"TRADE_PAID"}';
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
//            case 'trade_TradeBuyerPay':
//                $this->tradeBuyerPay();
//                break;
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

        //查询是否存在此订单
        $sync_status = PushLog::where(['push_type'=>'create','order_sn'=>$tid])->field('sync_status')->find();
        if(!empty($sync_status) && $sync_status->sync_status){
            exit();
        }else{
            $this->isRecord = PushLog::where(['push_type'=>'paid','order_sn'=>$tid])->column('id') ? 1 : 0;
        }

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

        if($contactList['errorCode'] != 0){
            $this->savePushLog($tid,'create',0,$contactList);
            exit();
        }

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
                if($accountList['errorCode'] == 0 && count($accountList['data']['dataList'])  == 0){
                    //创建客户
                    $accountResult = $this->createAccount($tid);
                    //客户ID
                    $accountId = $accountResult['dataId'];
                }else{
                    //客户信息
                    $accountResult = $accountList['data']['dataList'][0];
                    //客户ID
                    $accountId = $accountResult['_id'];
                }
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

        //查询是否存在此订单
        $sync_status = PushLog::where(['push_type'=>'paid','order_sn'=>$tid])->field('sync_status')->find();
        if(!empty($sync_status) && $sync_status->sync_status){
            exit();
        }else{
            $this->isRecord = PushLog::where(['push_type'=>'paid','order_sn'=>$tid])->column('id') ? 1 : 0;
        }

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
        //查询是否存在此订单
        $sync_status = PushLog::where(['push_type'=>'success','order_sn'=>$this->data['tid']])->field('sync_status')->find();
        if(!empty($sync_status) && $sync_status->sync_status){
            exit();
        }else{
            $this->isRecord = PushLog::where(['push_type'=>'success','order_sn'=>$this->data['tid']])->column('id') ? 1 : 0;
        }

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

        $this->isRecord ? PushLog::where(['order_sn'=>$data['order_sn'],'push_type'=>$push_type])->update($data) : PushLog::insert($data);
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
