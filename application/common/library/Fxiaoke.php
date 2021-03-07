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
        'getAccessToken' => 'cgi/corpAccessToken/get/V2',  //获取AccessToken
        'getList' => 'cgi/crm/v2/data/query',  //根据条件查询列表
        'getOne' => 'cgi/crm/v2/data/get',  //查询单个对象信息
        'getByMobile' => 'cgi/user/getByMobile',  //根据手机号查询员工
        'describe' => 'cgi/crm/v2/object/describe',  //获取对象描述接口
        'create' => 'cgi/crm/v2/data/create',  //创建对象
        'update' => 'cgi/crm/v2/data/update',  //修改对象
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
    public function createOrder($data,$account_id)
    {
        //产品详情
        $salesOrderProductObj = [];

        //根据产品编码查询产品详细信息
        foreach ($data['full_order_info']['orders'] as $k=>$v){
            if(!empty($v['outer_item_id'])){
                //根据产品编码查询产品详细信息
                $goodsList = $this->getList('ProductObj',[
                    [
                        'field_name' => 'product_code',
                        'field_values' => $v['outer_item_id'],
                        'operator' => 'EQ',
                    ]
                ]);
                //产品存在
                if(count($goodsList['data']['dataList']) > 0){
                    $goods = [
                        'quantity' => $v['num'],
                        'sales_price' => $v['price'],
                        'subtotal' => $v['total_fee'],
                        'life_status' => 'normal',
                        'discount' => 0,
                        'field_BZnw6__c' => 'c1jbw8hxa',
                        'lock_status ' => '0',//锁定状态
                        'product_price' => $goodsList['data']['dataList'][0]['price'],
                        'product_id' => $goodsList['data']['dataList'][0]['_id'],
                        'field_mgM2m__c' => $goodsList['data']['dataList'][0]['category'],
                        'name' => $goodsList['data']['dataList'][0]['product_code'],
                    ];
                    array_push($salesOrderProductObj,$goods);
                }
            }
        }

        //组装参数
        $params  = [
            'corpAccessToken' => $this->token,
            'corpId' => $this->corpId,
            'currentOpenUserId' => $this->openUserId,
            'data' => [
                'object_data' => [
                    'dataObjectApiName' => "SalesOrderObj",
                    'order_status' => 6,
                    'field_AoeY5__c' => '3epkbo5io',//订单来源
                    'field_Td3Of__c' => 'p773bstt4',//收款状态
                    'field_z7g58__c' => 'yTgougual',//订单编号前缀
                    'receipt_type' => 'wuU61s1ex',//订单性质
                    'account_id' => $account_id,
                    'lock_status ' => '0',//锁定状态
                    'owner' => ['FSUID_348A0A10A4E05B7D8A04ADFEBB064DB1'],//负责人
                    'field_6uKqS__c' => $data['full_order_info']['order_info']['tid'],
                    'order_amount' => $data['full_order_info']['pay_info']['total_fee'],
                    'field_qLr1g__c' => $data['full_order_info']['address_info']['receiver_tel'],
                    'order_time' => date('ymd',strtotime($data['full_order_info']['order_info']['created'])),
                ],
                'details' => [
                    'SalesOrderProductObj' => $salesOrderProductObj
                ]
            ],
        ];

        return Http::sendRequest($this->domain.$this->api['create'],$params, 'POST');
    }

    /**
     * 创建回款对象
     *
     */
    public function createPaymentObj($data,$orders)
    {
        //获取订单产品
        $goodsList = $this->getList('SalesOrderProductObj',[
            [
                'field_name' => 'field_fb1ce__c',
                'field_values' => $orders['name'],
                'operator' => 'EQ',
            ]
        ]);

        $orderPaymentObj = [];
        foreach ($goodsList['data']['dataList'] as $k=>$v){
            $obj = [
                'field_lC6gi__c' => $v['subtotal'],
                'payment_amount' => $data['orders'][$k]['payment'],
                'account_id' => $orders['account_id'],
                'order_id' => $v['order_id'],
                'field_7UTb1__c' => '123456',
                'field_BGl0D__c' => $v['_id'],
                'field_omXMk__c' => $v['field_3ZB9M__c'],
                'field_kC1f7__c' => $v['field_mgM2m__c'],
                'payment_time' => date('ymd',strtotime($data['order_info']['pay_time'])),
            ];

            array_push($orderPaymentObj,$obj);
        }

        //组装参数
        $params  = [
            'corpAccessToken' => $this->token,
            'corpId' => $this->corpId,
            'currentOpenUserId' => $this->openUserId,
            'data' => [
                'object_data' => [
                    'dataObjectApiName' => "PaymentObj",
                    'payment_time' => date('ymd',strtotime($data['order_info']['pay_time'])),
                    'field_o2Q55__c' => $orders['account_id'],
                    'payment_amount' => $data['pay_info']['payment'],
                    'field_s6c8v__c' => 'option1',
                    'order_id' => $orders['extend_obj_data_id'],
                    'field_7cvz9__c' => 'hID1cebo2',
                    'owner' => ['FSUID_348A0A10A4E05B7D8A04ADFEBB064DB1'],//负责人
                    'payment_term' => 'p4a0vc4FS',
                    'field_h0A7N__c' => 'wzNpHC5Kj',
                    'field_ak3f4__c' => 'Wfng06MG2',
                    'account_id' => $orders['account_id'],
                ],
                'details' => [
                    'OrderPaymentObj' => $orderPaymentObj
                ]
            ],
        ];

        return Http::sendRequest($this->domain.$this->api['create'],$params, 'POST');
    }

    /**
     * 创建客户
     *
     */
    public function createAccount($data)
    {
        //组装参数
        $params  = [
            'corpAccessToken' => $this->token,
            'corpId' => $this->corpId,
            'currentOpenUserId' => $this->openUserId,
            'data' => [
                'object_data' => [
                    'dataObjectApiName' => "AccountObj",
                    'name' => $data['address_info']['receiver_name'],
                    'tel' => $data['address_info']['receiver_tel'],
                    'currency__c' => 'option1',//币别:人民币
                    'account_source' => '4S9vxg1Vb', //来源默认有赞
                    'field_oR2HS__c' => $data['buyer_info']['yz_open_id'],//有赞yz_open_id
                    'province' => $data['address_info']['delivery_province'],
                    'city' => $data['address_info']['delivery_city'],
                    'district' => $data['address_info']['delivery_district'],
                    'address' => $data['address_info']['delivery_address'],
                    'field_8hNvk__c' => 'option1', //客户来源默认销售自招
                ]
            ],
        ];

        return Http::sendRequest($this->domain.$this->api['create'],$params, 'POST');
    }


    /**
     * 修改销售订单对象
     *
     */
    public function updateOrder($data,$orders,$update)
    {
        $object_data = [
            'dataObjectApiName' => "SalesOrderObj",
            '_id' => $orders['_id'],
        ];

        $object_data = array_merge($object_data,$update);

        //组装参数
        $params  = [
            'corpAccessToken' => $this->token,
            'corpId' => $this->corpId,
            'currentOpenUserId' => $this->openUserId,
            'data' => [
                'object_data' =>$object_data
            ],
        ];

        return Http::sendRequest($this->domain.$this->api['update'],$params, 'POST');
    }

    /**
     * 查询单个对象信息
     *
     */
    public function getOne($apiName,$id)
    {
        //组装参数
        $params  = [
            'corpAccessToken' => $this->token,
            'corpId' => $this->corpId,
            'currentOpenUserId' => $this->openUserId,
            'data' => [
                'dataObjectApiName' => $apiName,
                'objectDataId' => $id
            ],
        ];

        return Http::sendRequest($this->domain.$this->api['getOne'],$params, 'POST');
    }

    /**
     * 根据条件查询列表
     *
     */
    public function getList($apiName,$filters)
    {
        //组装参数
        $params  = [
            'corpAccessToken' => $this->token,
            'corpId' => $this->corpId,
            'currentOpenUserId' => $this->openUserId,
            'data' => [
                'dataObjectApiName' => $apiName,
                'search_query_info' => [
                    'limit' => 10,
                    'offset' => 0,
                    'filters' => $filters
                ]
            ],
        ];

        return Http::sendRequest($this->domain.$this->api['getList'],$params, 'POST');
    }

    /**
     * 获取对象描述接口
     *
     */
    public function describe($apiName)
    {
         //组装参数
        $params  = [
            'corpAccessToken' => $this->token,
            'corpId' => $this->corpId,
            'currentOpenUserId' => $this->openUserId,
            'includeDetail' => true,
            'apiName' => $apiName,
        ];

        return Http::sendRequest($this->domain.$this->api['describe'],$params, 'POST');
    }

    /**
     * 根据手机号查询员工
     *
     */
    public function getByMobile($mobile)
    {
        //组装参数
        $params  = [
            'corpAccessToken' => $this->token,
            'corpId' => $this->corpId,
            'mobile' => $mobile,
        ];

        return Http::sendRequest($this->domain.$this->api['getByMobile'],$params, 'POST');
    }
}
