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
        $category_data = json_decode('[{"label":"\\u8bbe\\u5907","value":"58"},{"label":"\\u914d\\u4ef6","value":"59"},{"label":"\\u5f00\\u4e1a\\u5566\\u4ea7\\u54c1\\u7ebf\\/\\u5de5\\u5546\\u670d\\u52a1\\u4ea7\\u54c1\\/\\u516c\\u53f8\\u6ce8\\u518c\\/\\u5185\\u8d44\\u6709\\u9650\\u516c\\u53f8\\u6ce8\\u518c","value":"17"},{"label":"\\u5f00\\u4e1a\\u5566\\u4ea7\\u54c1\\u7ebf\\/\\u5de5\\u5546\\u670d\\u52a1\\u4ea7\\u54c1\\/\\u516c\\u53f8\\u6ce8\\u518c\\/\\u4e2a\\u4eba\\u72ec\\u8d44\\u4f01\\u4e1a\\u6ce8\\u518c","value":"18"},{"label":"\\u5f00\\u4e1a\\u5566\\u4ea7\\u54c1\\u7ebf\\/\\u5de5\\u5546\\u670d\\u52a1\\u4ea7\\u54c1\\/\\u516c\\u53f8\\u6ce8\\u518c\\/\\u5408\\u4f19\\u4f01\\u4e1a\\u6ce8\\u518c","value":"19"},{"label":"\\u5f00\\u4e1a\\u5566\\u4ea7\\u54c1\\u7ebf\\/\\u5de5\\u5546\\u670d\\u52a1\\u4ea7\\u54c1\\/\\u516c\\u53f8\\u6ce8\\u518c\\/\\u5916\\u8d44\\u6709\\u9650\\u516c\\u53f8\\u6ce8\\u518c","value":"20"},{"label":"\\u5f00\\u4e1a\\u5566\\u4ea7\\u54c1\\u7ebf\\/\\u5de5\\u5546\\u670d\\u52a1\\u4ea7\\u54c1\\/\\u516c\\u53f8\\u6ce8\\u518c","value":"16"},{"label":"\\u5f00\\u4e1a\\u5566\\u4ea7\\u54c1\\u7ebf\\/\\u5de5\\u5546\\u670d\\u52a1\\u4ea7\\u54c1\\/\\u516c\\u53f8\\u6ce8\\u9500","value":"21"},{"label":"\\u5f00\\u4e1a\\u5566\\u4ea7\\u54c1\\u7ebf\\/\\u5de5\\u5546\\u670d\\u52a1\\u4ea7\\u54c1\\/\\u523b\\u7ae0","value":"22"},{"label":"\\u5f00\\u4e1a\\u5566\\u4ea7\\u54c1\\u7ebf\\/\\u5de5\\u5546\\u670d\\u52a1\\u4ea7\\u54c1\\/\\u6838\\u5b9a\\u7a0e\\u79cd","value":"24"},{"label":"\\u5f00\\u4e1a\\u5566\\u4ea7\\u54c1\\u7ebf\\/\\u5de5\\u5546\\u670d\\u52a1\\u4ea7\\u54c1\\/\\u5de5\\u5546\\u53d8\\u66f4","value":"25"},{"label":"\\u5f00\\u4e1a\\u5566\\u4ea7\\u54c1\\u7ebf\\/\\u5de5\\u5546\\u670d\\u52a1\\u4ea7\\u54c1\\/\\u7a0e\\u52a1\\u53d8\\u66f4","value":"26"},{"label":"\\u5f00\\u4e1a\\u5566\\u4ea7\\u54c1\\u7ebf\\/\\u5de5\\u5546\\u670d\\u52a1\\u4ea7\\u54c1\\/\\u767b\\u62a5\\u516c\\u544a","value":"27"},{"label":"\\u5f00\\u4e1a\\u5566\\u4ea7\\u54c1\\u7ebf\\/\\u5de5\\u5546\\u670d\\u52a1\\u4ea7\\u54c1","value":"7"},{"label":"\\u5f00\\u4e1a\\u5566\\u4ea7\\u54c1\\u7ebf\\/\\u5176\\u4ed6\\u5b9a\\u5236\\u670d\\u52a1\\u4ea7\\u54c1","value":"46"},{"label":"\\u5f00\\u4e1a\\u5566\\u4ea7\\u54c1\\u7ebf\\/\\u8d22\\u7a0e\\u670d\\u52a1\\u4ea7\\u54c1\\/\\u4ee3\\u7406\\u8bb0\\u8d26","value":"28"},{"label":"\\u5f00\\u4e1a\\u5566\\u4ea7\\u54c1\\u7ebf\\/\\u8d22\\u7a0e\\u670d\\u52a1\\u4ea7\\u54c1\\/\\u8d22\\u52a1\\u5916\\u52e4","value":"29"},{"label":"\\u5f00\\u4e1a\\u5566\\u4ea7\\u54c1\\u7ebf\\/\\u8d22\\u7a0e\\u670d\\u52a1\\u4ea7\\u54c1\\/\\u6838\\u5b9a\\u7a0e\\u79cd\\uff08\\u975e\\u9996\\u6b21\\uff09","value":"30"},{"label":"\\u5f00\\u4e1a\\u5566\\u4ea7\\u54c1\\u7ebf\\/\\u8d22\\u7a0e\\u670d\\u52a1\\u4ea7\\u54c1\\/\\u5f00\\u7968\\u670d\\u52a1","value":"32"},{"label":"\\u5f00\\u4e1a\\u5566\\u4ea7\\u54c1\\u7ebf\\/\\u8d22\\u7a0e\\u670d\\u52a1\\u4ea7\\u54c1\\/\\u5916\\u8d44\\u8054\\u5408\\u5e74\\u68c0","value":"33"},{"label":"\\u5f00\\u4e1a\\u5566\\u4ea7\\u54c1\\u7ebf\\/\\u8d22\\u7a0e\\u670d\\u52a1\\u4ea7\\u54c1\\/\\u4f01\\u4e1a\\u5de5\\u5546\\u516c\\u793a","value":"49"},{"label":"\\u5f00\\u4e1a\\u5566\\u4ea7\\u54c1\\u7ebf\\/\\u8d22\\u7a0e\\u670d\\u52a1\\u4ea7\\u54c1\\/\\u4f01\\u4e1a\\u6c47\\u7b97\\u6e05\\u7f34","value":"50"},{"label":"\\u5f00\\u4e1a\\u5566\\u4ea7\\u54c1\\u7ebf\\/\\u8d22\\u7a0e\\u670d\\u52a1\\u4ea7\\u54c1\\/\\u4e2a\\u4eba\\u6240\\u5f97\\u7a0e\\u6c47\\u7b97\\u6e05\\u7f34","value":"51"},{"label":"\\u5f00\\u4e1a\\u5566\\u4ea7\\u54c1\\u7ebf\\/\\u8d22\\u7a0e\\u670d\\u52a1\\u4ea7\\u54c1\\/\\u81ea\\u52a9\\u7535\\u5b50\\u53d1\\u7968\\u670d\\u52a1","value":"60"},{"label":"\\u5f00\\u4e1a\\u5566\\u4ea7\\u54c1\\u7ebf\\/\\u8d22\\u7a0e\\u670d\\u52a1\\u4ea7\\u54c1","value":"8"},{"label":"\\u5f00\\u4e1a\\u5566\\u4ea7\\u54c1\\u7ebf\\/\\u793e\\u4fdd\\u516c\\u79ef\\u670d\\u52a1\\u4ea7\\u54c1","value":"10"},{"label":"\\u5f00\\u4e1a\\u5566\\u4ea7\\u54c1\\u7ebf\\/\\u5546\\u6807\\u670d\\u52a1\\u4ea7\\u54c1","value":"11"},{"label":"\\u5f00\\u4e1a\\u5566\\u4ea7\\u54c1\\u7ebf\\/\\u94f6\\u884c\\u670d\\u52a1\\u4ea7\\u54c1","value":"12"},{"label":"\\u5f00\\u4e1a\\u5566\\u4ea7\\u54c1\\u7ebf\\/\\u5de5\\u5546\\u5b9a\\u5236\\u670d\\u52a1\\u4ea7\\u54c1\\/\\u7279\\u6b8a\\u67e5\\u540d","value":"34"},{"label":"\\u5f00\\u4e1a\\u5566\\u4ea7\\u54c1\\u7ebf\\/\\u5de5\\u5546\\u5b9a\\u5236\\u670d\\u52a1\\u4ea7\\u54c1\\/\\u6863\\u6848\\u52a0\\u6025","value":"35"},{"label":"\\u5f00\\u4e1a\\u5566\\u4ea7\\u54c1\\u7ebf\\/\\u5de5\\u5546\\u5b9a\\u5236\\u670d\\u52a1\\u4ea7\\u54c1\\/\\u6267\\u7167\\u52a0\\u6025","value":"36"},{"label":"\\u5f00\\u4e1a\\u5566\\u4ea7\\u54c1\\u7ebf\\/\\u5de5\\u5546\\u5b9a\\u5236\\u670d\\u52a1\\u4ea7\\u54c1\\/\\u5de5\\u5546\\u5f02\\u5e38\\u79fb\\u9664","value":"37"},{"label":"\\u5f00\\u4e1a\\u5566\\u4ea7\\u54c1\\u7ebf\\/\\u5de5\\u5546\\u5b9a\\u5236\\u670d\\u52a1\\u4ea7\\u54c1\\/\\u5f02\\u5e38\\u4f01\\u4e1a\\u6ce8\\u9500","value":"38"},{"label":"\\u5f00\\u4e1a\\u5566\\u4ea7\\u54c1\\u7ebf\\/\\u5de5\\u5546\\u5b9a\\u5236\\u670d\\u52a1\\u4ea7\\u54c1\\/\\u63d0\\u4f9b\\u5de5\\u5546\\u5730\\u5740","value":"39"},{"label":"\\u5f00\\u4e1a\\u5566\\u4ea7\\u54c1\\u7ebf\\/\\u5de5\\u5546\\u5b9a\\u5236\\u670d\\u52a1\\u4ea7\\u54c1\\/\\u5404\\u7c7b\\u524d\\u7f6e\\u540e\\u7f6e\\u8d44\\u8d28\\u529e\\u7406","value":"40"},{"label":"\\u5f00\\u4e1a\\u5566\\u4ea7\\u54c1\\u7ebf\\/\\u5de5\\u5546\\u5b9a\\u5236\\u670d\\u52a1\\u4ea7\\u54c1\\/\\u5168+\\u975e","value":"56"},{"label":"\\u5f00\\u4e1a\\u5566\\u4ea7\\u54c1\\u7ebf\\/\\u5de5\\u5546\\u5b9a\\u5236\\u670d\\u52a1\\u4ea7\\u54c1","value":"14"},{"label":"\\u5f00\\u4e1a\\u5566\\u4ea7\\u54c1\\u7ebf\\/\\u8d22\\u7a0e\\u5b9a\\u5236\\u670d\\u52a1\\u4ea7\\u54c1\\/\\u8d22\\u52a1\\u54a8\\u8be2\\/\\u5386\\u53f2\\u8d26\\u52a1\\u68b3\\u7406","value":"47"},{"label":"\\u5f00\\u4e1a\\u5566\\u4ea7\\u54c1\\u7ebf\\/\\u8d22\\u7a0e\\u5b9a\\u5236\\u670d\\u52a1\\u4ea7\\u54c1\\/\\u8d22\\u52a1\\u54a8\\u8be2\\/\\u4e0a\\u95e8\\u8d22\\u7a0e\\u670d\\u52a1","value":"48"},{"label":"\\u5f00\\u4e1a\\u5566\\u4ea7\\u54c1\\u7ebf\\/\\u8d22\\u7a0e\\u5b9a\\u5236\\u670d\\u52a1\\u4ea7\\u54c1\\/\\u8d22\\u52a1\\u54a8\\u8be2","value":"41"},{"label":"\\u5f00\\u4e1a\\u5566\\u4ea7\\u54c1\\u7ebf\\/\\u8d22\\u7a0e\\u5b9a\\u5236\\u670d\\u52a1\\u4ea7\\u54c1\\/\\u7a0e\\u52a1\\u54a8\\u8be2","value":"42"},{"label":"\\u5f00\\u4e1a\\u5566\\u4ea7\\u54c1\\u7ebf\\/\\u8d22\\u7a0e\\u5b9a\\u5236\\u670d\\u52a1\\u4ea7\\u54c1\\/\\u7a0e\\u52a1\\u5f02\\u5e38\\u79fb\\u9664","value":"43"},{"label":"\\u5f00\\u4e1a\\u5566\\u4ea7\\u54c1\\u7ebf\\/\\u8d22\\u7a0e\\u5b9a\\u5236\\u670d\\u52a1\\u4ea7\\u54c1\\/\\u81ea\\u52a9\\u7535\\u5b50\\u5f00\\u7968\\u670d\\u52a1","value":"61"},{"label":"\\u5f00\\u4e1a\\u5566\\u4ea7\\u54c1\\u7ebf\\/\\u8d22\\u7a0e\\u5b9a\\u5236\\u670d\\u52a1\\u4ea7\\u54c1","value":"15"},{"label":"\\u5f00\\u4e1a\\u5566\\u4ea7\\u54c1\\u7ebf\\/\\u4eba\\u4e8b\\u5b9a\\u5236\\u670d\\u52a1\\u4ea7\\u54c1","value":"44"},{"label":"\\u5f00\\u4e1a\\u5566\\u4ea7\\u54c1\\u7ebf\\/\\u4fe1\\u606f\\u5316\\u5b9a\\u5236\\u670d\\u52a1\\u4ea7\\u54c1","value":"45"},{"label":"\\u5f00\\u4e1a\\u5566\\u4ea7\\u54c1\\u7ebf\\/\\u8282\\u7a0e\\u4ea7\\u54c1","value":"57"},{"label":"\\u5f00\\u4e1a\\u5566\\u4ea7\\u54c1\\u7ebf\\/\\u9ad8\\u65b0\\u4ea7\\u54c1","value":"62"},{"label":"\\u5f00\\u4e1a\\u5566\\u4ea7\\u54c1\\u7ebf","value":"1"},{"label":"\\u5305\\u529e\\u4ea7\\u54c1\\u7ebf","value":"2"},{"label":"\\u96c6\\u56e2\\u4ea7\\u54c1\\u7ebf","value":"6"}]',true);

        //产品类型
        $productType_data = json_decode('[{"not_usable":false,"label":"\u54a8\u8be2\u670d\u52a1","value":"1621o16aK","config":{"edit":1,"enable":1,"remove":1}},{"not_usable":false,"label":"\u6218\u7565\u5ba2\u6237","value":"12z2i6uV2","config":{"edit":1,"enable":1,"remove":1}},{"not_usable":false,"label":"\u6167\u7a0e\u5566\u4ea7\u54c1","value":"G0y6qg20c","config":{"edit":1,"enable":1,"remove":1}},{"not_usable":false,"label":"\u5de5\u5546\u670d\u52a1\u4ea7\u54c1","value":"GvcT6lKrk","config":{"edit":1,"enable":1,"remove":1}},{"not_usable":false,"label":"\u8d22\u7a0e\u670d\u52a1\u4ea7\u54c1","value":"4zwR17mtS","config":{"edit":1,"enable":1,"remove":1}},{"not_usable":false,"label":"\u793e\u4fdd\u516c\u79ef\u91d1\u670d\u52a1\u4ea7\u54c1","value":"qiobcs1Yb","config":{"edit":1,"enable":1,"remove":1}},{"not_usable":false,"label":"\u5546\u6807\u670d\u52a1\u4ea7\u54c1","value":"3812U8Emu","config":{"edit":1,"enable":1,"remove":1}},{"not_usable":false,"label":"\u94f6\u884c\u670d\u52a1\u4ea7\u54c1","value":"z4cVYS5dk","config":{"edit":1,"enable":1,"remove":1}},{"not_usable":false,"label":"\u5de5\u5546\u5b9a\u5236\u670d\u52a1\u4ea7\u54c1","value":"n1KlHjyP8","config":{"edit":1,"enable":1,"remove":1}},{"not_usable":false,"label":"\u8d22\u7a0e\u5b9a\u5236\u670d\u52a1\u4ea7\u54c1","value":"Lb4JbM14S","config":{"edit":1,"enable":1,"remove":1}},{"not_usable":false,"label":"\u4eba\u4e8b\u5b9a\u5236\u670d\u52a1\u4ea7\u54c1","value":"7fq6bD0t4","config":{"edit":1,"enable":1,"remove":1}},{"not_usable":false,"label":"\u4fe1\u606f\u5316\u5b9a\u5236\u670d\u52a1\u4ea7\u54c1","value":"1LD8GhsXb","config":{"edit":1,"enable":1,"remove":1}},{"not_usable":false,"label":"\u5176\u4ed6\u5b9a\u5236\u670d\u52a1\u4ea7\u54c1","value":"18ZT3FD9J","config":{"edit":1,"enable":1,"remove":1}},{"not_usable":true,"label":"\u7cfb\u7edf\u96c6\u6210","value":"t1s8ushFR","config":{"edit":1,"enable":1,"remove":1}},{"not_usable":true,"label":"\u7cfb\u7edf\u7ef4\u4fdd","value":"uTX42Eh8W","config":{"edit":1,"enable":1,"remove":1}},{"not_usable":true,"label":"SAAS\u8f6f\u4ef6","value":"SwF6sVZvg","config":{"edit":1,"enable":1,"remove":1}},{"not_usable":true,"label":"SAAS\u8f6f\u4ef6\u7eed\u8d39","value":"f16zibh7l","config":{"edit":1,"enable":1,"remove":1}},{"not_usable":false,"label":"\u5176\u4ed6","value":"other","config":{"edit":1,"enable":1,"remove":1}}]',true);
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
                    'field_8weB5__c' => $productType,//产品类型
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
                    'field_ckLsq__c' => $v['product_price'], //本次应收金额（元）
                    'payment_amount' => $v['product_price'], //本次实收金额（元）
                    'order_id' => $v['order_id'],//销售订单编号
                    'field_ie2no__c' => '5f0ff4299b09cb000129d9d6',//银行
                    'field_BGl0D__c' => $v['_id'], //产品
                    'field_omXMk__c' => $v['field_3ZB9M__c'],//产品编号
                    'field_kC1f7__c' => $v['field_mgM2m__c'],//产品分类
                    'field_7UTb1__c' => $data['order_info']['tid'],//银行流水号
                    'field_lC6gi__c' => $v['product_price'], //订单交易额
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
                    'name' => $data['address_info']['receiver_name'].$data['buyer_info']['buyer_id'],
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
