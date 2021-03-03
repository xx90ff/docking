<?php

namespace app\common\library;

use fast\Http;
use think\Config;

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
     * CorpAccessToken有效时长
     * @var int
     */
    protected static $expire = 7200;

    /**
     * 默认配置
     */
    public $options = [];

    /**
     * 请求地址
     */
    protected static $domain = 'https://open.fxiaoke.com/';

    /**
     * 接口地址
     */
    public $api = [
        'getAccessToken' => 'cgi/corpAccessToken/get/V2'  //获取AccessToken
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
        $this->options = config::get('site.fxiaoke');
    }

    /**
     * 获取AccessToken
     *
     */
    public function getAccessToken()
    {
        //组装请求参数
        $params = [
            'appId' => $this->options['appId'],
            'appSecret' => $this->options['appSecret'],
            'permanentCode' => $this->options['permanentCode']
        ];

        $result = Http::sendRequest($this->domain.$this->api['getAccessToken'],$params, 'POST');
        print_r($result);die;
    }
}
