<?php

namespace app\api\model;

use think\Model;

class Banner extends BaseModel
{
    // 指定表名,不含前缀
    protected $name = 'banners';
    protected $hidden = ['sort','type','image_id','from','display','status','isdelete','create_time','update_time'];

    public function img()
    {
        return $this->belongsTo('File', 'image_id', 'id');
    }

    /**
     * @param $id int banner所在位置
     * @return Banner
     */
    public static function getBannerById($id)
    {
        $banner = self::with('img')->where(['isdelete'=>0,'status'=>1,'display'=>1])
            ->find($id);
        return $banner;
    }

    public static function getBannersByTypeAndPosition($type,$position)
    {
        return self::with('img')->where(['isdelete'=>0,'status'=>1,'display'=>1,'type'=>$type,'position'=>$position])
            ->select();
    }


    protected function getPositionAttr($val)
    {
        $positions = config('app.banner_position');
        return !empty($positions[$val])?$positions[$val]:'未定义';
    }

}
