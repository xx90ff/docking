<?php

namespace app\api\controller;

use app\common\controller\Api;
use Youzan\Open\Helper\CryptoHelper;

/**
 * 首页接口
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
        // 接收到的订购消息密文
        $message = 'zanO3UZzEA5Fm6qKsCq6rJ70VoKdiqXDfgdqGvzOfIZ%2FVNB%2FUHuG7%2F6TxdL6NQIVkO8CFm20whTivoPj4%2B6nXLAoe9J%2BZc42nRAbkTg5GruMl8RohxSDS0%2F99FwGtLW9TmMbxs554ZWVaRaiB5KaHF%2FNTzuLHyEtrLB2xu8Y%2BAnMN%2FVVVO9PPgO8o1BSAuvJdNXa1%2ButpG%2BRSSSMbxXrvCkRC34X7kCK1z5Xg51r%2Fym8nxrrSFn2c4R3rMRxKQAMmzRfGBkcQ9XayS31oT5DNy0h5pWzP8W5pe9naUguCiPIIAqGmBo8etlIn1Y1FHAU';

        // 应用的clientSecret
        $youzan = config('site.youzan');
        $youzan['client_secret'] = 'def00000b1228e0f6ba8ef96be9';
        //解密
        $res = CryptoHelper::decrypt($message, $youzan['client_secret']);
        print_r($res);
        // {"appId":110,"buyerId":123456,"buyerPhone":"13800138000","env":"PROD","kdtId":160,"orderNo":"E201905060000001","payTime":1557138032000,"price":42,"skuIntervalText":"7","skuVersionText":"试用版","status":20,"type":"APP_SUBSCRIBE"}

        //$this->success('请求成功');
    }
}
