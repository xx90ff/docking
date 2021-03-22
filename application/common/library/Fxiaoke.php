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
    public function createOrder($data,$account_id,$contactId)
    {
        //产品详情
        $salesOrderProductObj = [];

        //产品分类
        $category_res = $this->describe('ProductObj');
        $category_data = $category_res['data']['describe']['fields']['category']['options'];

        //产品类型
        $productType_res = $this->describe('SalesOrderObj');
        $productType_data = $productType_res['data']['describe']['fields']['field_8weB5__c']['options'];
        $productType = [];

        //根据产品编码查询产品详细信息
        foreach ($data['full_order_info']['orders'] as $k=>$v){
            if(!empty($v['outer_sku_id'])){
                //根据产品编码查询产品详细信息
                $goodsList = $this->getList('ProductObj',[
                    [
                        'field_name' => 'product_code',
                        'field_values' => $v['outer_sku_id'],
                        'operator' => 'EQ',
                    ]
                ]);

                //产品存在
                if(count($goodsList['data']['dataList']) > 0){
                    //获取分类名称
                    foreach ($category_data as $kk=>$vv){
                        if($vv['value'] == $goodsList['data']['dataList'][0]['category']){
                            $categoryName = $vv['label'];
                        }
                    }
                    //拆分
                    $categoryName_arr = explode('/',$categoryName);

                    //查找产品类型
                    foreach ($productType_data as $kk=>$vv){
                        if($categoryName_arr[1] == $vv['label']){
                            $productType[] = $vv['value'];
                        }
                    }

                    $goods = [
                        'product_id' => $goodsList['data']['dataList'][0]['_id'], //产品名称
                        'product_price' => $goodsList['data']['dataList'][0]['price'], //标准价格(元）
                        'discount' => 0, //折扣率
                        'quantity' => $v['num'], //数量
                        'sales_price' => $v['price'], //销售单价（元）
                        'field_mgM2m__c' => $goodsList['data']['dataList'][0]['category'], //产品分类
                        'field_BZnw6__c' => 'c1jbw8hxa', //是否内包外包
                        'subtotal' => $v['total_fee'], //订单交易额
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
                    'account_id' => $account_id,//客户
                    'order_amount' => $data['full_order_info']['pay_info']['total_fee'],//订单总金额
                    'receipt_type' => 'wuU61s1ex',//订单性质
                    'field_lLh0C__c' => 'j72ob1uu8',//销售组织
                    'field_AoeY5__c' => '3epkbo5io',//订单来源
                    'order_time' => strtotime($data['full_order_info']['order_info']['created']) * 1000,
                    'field_11l66__c' => $account_id,//被服务主体
                    'field_0p914__c' => strtotime($data['full_order_info']['order_info']['created']) * 1000,//服务起始日期
                    'field_4atGg__c' => (strtotime($data['full_order_info']['order_info']['created']) + 604800) * 1000,//服务终止日期
                    'field_42A60__c' => '129qDtLy1',//收款条件
                    'field_5sQ2C__c' => '9S3i0j9aB',//服务方式
                    'field_d2IW5__c' => '49usHpyl9',//是否拆分业绩
                    'field_8weB5__c' => array_unique($productType),//产品类型
                    'field_61X4R__c' => $contactId,//客户联系人
                    'field_14D1i__c' => [1002],//销售部门
                    'field_Fs9mo__c' => $data['full_order_info']['pay_info']['total_fee'],//订单总金额
                    'field_z7g58__c' => 'yTgougual',//订单编号前缀
                    'field_6uKqS__c' => $data['full_order_info']['order_info']['tid'], //有赞订单号
                    'owner' => ['FSUID_348A0A10A4E05B7D8A04ADFEBB064DB1'],//负责人
                    'field_qLr1g__c' => $data['full_order_info']['address_info']['receiver_tel'] //联系方式
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
                'field_name' => 'field_fb1ce__c', //销售订单号
                'field_values' => $orders['name'],
                'operator' => 'EQ',
            ]
        ]);

        $orderPaymentObj = [];
        if(!empty($goodsList['data']['dataList'])){
            foreach ($goodsList['data']['dataList'] as $k=>$v){
                $obj = [
                    'field_ckLsq__c' => $data['orders'][$k]['price'], //本次应收金额（元）
                    'payment_amount' => $data['orders'][$k]['price'], //本次实收金额（元）
                    'order_id' => $v['order_id'],//销售订单编号
                    'field_ie2no__c' => '5f0ff4299b09cb000129d9d6',//银行
                    'field_BGl0D__c' => $v['_id'], //产品
                    'field_omXMk__c' => $v['field_3ZB9M__c'],//产品编号
                    'field_kC1f7__c' => $v['field_mgM2m__c'],//产品分类
                    'field_7UTb1__c' => $data['order_info']['tid'],//银行流水号
                    'field_lC6gi__c' => $data['pay_info']['payment'], //订单交易额
                    'account_id' => $orders['account_id'],//客户名称
                    'payment_time' => strtotime($data['order_info']['pay_time']) * 1000,//回款日期
                    'life_status' => 'normal',//状态
                ];

                array_push($orderPaymentObj,$obj);
            }
        }

        //组装参数
        $params  = [
            'corpAccessToken' => $this->token,
            'corpId' => $this->corpId,
            'currentOpenUserId' => $this->openUserId,
            'data' => [
                'object_data' => [
                    'dataObjectApiName' => "PaymentObj",
                    'payment_time' => strtotime($data['order_info']['pay_time']) * 1000,//回款日期
                    'payment_amount' => $data['pay_info']['payment'],//本次回款总金额
                    'order_id' => $orders['_id'],//订单编号
                    'payment_term' => 'p4a0vc4FS',//回款方式
                    'account_id' => $orders['account_id'],//客户名称
                    'field_ak3f4__c' => 'Wfng06MG2',//销售组织
                    'field_s6c8v__c' => 'option1',//币种
                    'field_navWt__c' => $orders['_id'],//销售订单
                    'field_7cvz9__c' => 'hID1cebo2',//订单性质
                    'field_h0A7N__c' => 'wzNpHC5Kj', //是否业绩拆分
                    'owner' => ['FSUID_348A0A10A4E05B7D8A04ADFEBB064DB1'],//负责人
                    'life_status' => 'normal',//状态
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
                    'name' => $data['address_info']['receiver_name'].'-'.$data['buyer_info']['buyer_id'],
                    'tel' => $data['address_info']['receiver_tel'],
//                    'area_location' => $data['address_info']['delivery_province'].$data['address_info']['delivery_city'].$data['address_info']['delivery_district'].$data['address_info']['delivery_address'],
                    'account_source' => '4S9vxg1Vb', //来源默认有赞
                    'field_oR2HS__c' => $data['buyer_info']['yz_open_id'],//有赞yz_open_id
                    'field_w2D3Y__c' => '2nwc905uc', //客户分类
                    'currency__c' => 'option1',//币别:人民币
                    'field_8hNvk__c' => 'option1', //客户来源默认销售自招
                    'owner' => ['FSUID_348A0A10A4E05B7D8A04ADFEBB064DB1'],//负责人
//                    'country' => '中国', //国家
                    'province' => $data['address_info']['delivery_province'],//省
                    'city' => $data['address_info']['delivery_city'],//市
                    'district' => $data['address_info']['delivery_district'],//区
                    'address' => $data['address_info']['delivery_address'],//详细地址
                ]
            ],
        ];

        return Http::sendRequest($this->domain.$this->api['create'],$params, 'POST');
    }

    /**
     * 创建联系人
     *
     */
    public function createContact($data,$accountId)
    {
        //组装参数
        $params  = [
            'corpAccessToken' => $this->token,
            'corpId' => $this->corpId,
            'currentOpenUserId' => $this->openUserId,
            'data' => [
                'object_data' => [
                    'dataObjectApiName' => "ContactObj",
                    'name' => $data['address_info']['receiver_name'],//姓名
                    'mobile1' => $data['address_info']['receiver_tel'],//手机1
                    'account_id' => $accountId,//客户
                    'owner' => ['FSUID_348A0A10A4E05B7D8A04ADFEBB064DB1'],//负责人
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
