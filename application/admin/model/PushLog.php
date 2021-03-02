<?php

namespace app\admin\model;

use think\Model;


class PushLog extends Model
{

    

    

    // 表名
    protected $name = 'push_log';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = false;

    // 定义时间戳字段名
    protected $createTime = false;
    protected $updateTime = false;
    protected $deleteTime = false;

    // 追加属性
    protected $append = [
        'push_type_text',
        'trigger_time_text',
        'sync_status_text',
        'sync_time_text'
    ];
    

    
    public function getPushTypeList()
    {
        return ['create' => __('Push_type create'), 'paid' => __('Push_type paid'), 'success' => __('Push_type success')];
    }

    public function getSyncStatusList()
    {
        return ['0' => __('Sync_status 0'), '1' => __('Sync_status 1')];
    }


    public function getPushTypeTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['push_type']) ? $data['push_type'] : '');
        $list = $this->getPushTypeList();
        return isset($list[$value]) ? $list[$value] : '';
    }


    public function getTriggerTimeTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['trigger_time']) ? $data['trigger_time'] : '');
        return is_numeric($value) ? date("Y-m-d H:i:s", $value) : $value;
    }


    public function getSyncStatusTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['sync_status']) ? $data['sync_status'] : '');
        $list = $this->getSyncStatusList();
        return isset($list[$value]) ? $list[$value] : '';
    }


    public function getSyncTimeTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['sync_time']) ? $data['sync_time'] : '');
        return is_numeric($value) ? date("Y-m-d H:i:s", $value) : $value;
    }

    protected function setTriggerTimeAttr($value)
    {
        return $value === '' ? null : ($value && !is_numeric($value) ? strtotime($value) : $value);
    }

    protected function setSyncTimeAttr($value)
    {
        return $value === '' ? null : ($value && !is_numeric($value) ? strtotime($value) : $value);
    }


}
