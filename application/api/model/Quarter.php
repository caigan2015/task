<?php
namespace app\api\model;

use think\Model;

class Quarter extends BaseModel
{
    protected $hidden = ['property_id','standard_id','status','sort','isdelete','create_time','update_time'];


    protected function getLogoAttr($val,$data)
    {
        return $this->prefixImgUrl($val,$data);
    }

    public static function getCodeBreads($id){
        $data = self::field(['id','name','pid','level','number'])->find($id);
        $breads = !empty($data['number'])?$data['number']:'';
        if($data['level']>2){
            return self::getCodeBreads($data['pid']).'-'.$breads;
        }
        return $breads;
    }

    public static function getChildrenById($id)
    {
        $ids[] = $id;
        $quarters = self::all();
        $quarters = get_tree($quarters, $id);
        foreach ($quarters as $quarter) {
            $ids[] = $quarter['id'];
        }
        return $ids;
    }

}