<?php
namespace app\api\model;

use think\Model;

class DeviceUser extends BaseModel
{
    protected $hidden = ['property_id','id','isdelete','create_time','update_time'];
    protected $autoWriteTimestamp = true;//配置开启了
}
