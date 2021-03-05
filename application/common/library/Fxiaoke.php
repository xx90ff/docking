<?php

namespace app\common\library;

use fast\Http;
use think\Config;
use think\Cache;

/**
 * 纷享销客CRM
 */
class Fxiaoke
{

    /**
     * 单例对象
     */
    protected static $instance;

    /**
     * Token
     */
    protected $token = '';

    /**
     * corpId
     */
    protected $corpId = '';

    /**
     * openUserId
     */
    protected $openUserId = '';

    /**
     * 请求地址
     */
    protected  $domain = 'https://open.fxiaoke.com/';

    /**
     * 接口地址
     */
    protected $api = [
        'getByMobile' => 'cgi/user/getByMobile',  //根据手机号查询员工
        'getAccessToken' => 'cgi/corpAccessToken/get/V2',  //获取AccessToken
        'createOrder' => 'cgi/crm/v2/data/create',  //创建销售订单对象
    ];


    /**
     * 初始化
     * @access public
     * @param array $options 参数
     * @return Email
     */
    public static function instance($options = [])
    {
        if (is_null(self::$instance)) {
            self::$instance = new static($options);
        }

        return self::$instance;
    }

    /**
     * 构造函数
     * @param array $options
     */
    public function __construct($options = [])
    {
        $this->corpId = config::get('site.corpId');
        $this->openUserId = config::get('site.openUserId');

        //token是否过期
        $this->token = Cache::get("corpAccessToken");
        if (!$this->token) {
            $resToken = $this->getAccessToken();
            if(isset($resToken['errorCode']) && $resToken['errorCode'] == 0){
                $this->token = $resToken['corpAccessToken'];
                Cache::set("corpAccessToken", $resToken['corpAccessToken'], $resToken['expiresIn']);
            }
        }
    }

    /**
     * 获取AccessToken
     *
     */
    public function getAccessToken()
    {
        return Http::sendRequest($this->domain.$this->api['getAccessToken'],config::get('site.fxiaoke'), 'POST');
    }

    /**
     * 创建销售订单对象
     *
     */
    public function createOrder()
    {

    }

    /**
     * 根据手机号查询员工
     *
     */
    public function getByMobile($mobile)
    {
        //组装参数
        $data  = [
            'corpAccessToken' => $this->token,
            'corpId' => $this->corpId,
            'mobile' => $mobile,
        ];

        return Http::sendRequest($this->domain.$this->api['getByMobile'],$data, 'POST');
    }
}
