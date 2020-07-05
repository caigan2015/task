<?php

namespace app\api\model;

use think\Model;

class File extends BaseModel
{
    protected $hidden = ['id','mtime', 'from','domain','type','cate','size','original'];
    protected $autoWriteTimestamp = false;

    public function getNameAttr($value, $data)
    {
        return $this->prefixImgUrl($value, $data);
    }

    protected function getCateAttr($val)
    {
        $cates = config('app.file_cate');
        return !empty($cates[$val])?$cates[$val]:'未知文件类型';
    }
    
    
    
}