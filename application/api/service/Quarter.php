<?php
namespace app\api\service;

use app\api\model\File;
use app\api\model\User;
use app\api\model\User as UserModel;
use app\lib\exception\IdentifyException;
use app\lib\exception\ImageException;
use app\lib\exception\SuccessMessage;
use app\lib\exception\UserException;
use think\Exception;
use think\Request;

class Quarter
{
    public static function process($quarters)
    {
        $parents = self::findTopParent($quarters);
        if($parents){
            foreach ($parents as &$parent) {
                $parent['child'] = self::build_tree($parent['child'],$parent['id'],$parent['max_depth']);
            }
        }
        return $parents;
    }


    private static function findTopParent($arr){
        $parent=[];
        foreach ($arr as $k => $v){
            if($v['pid']== 0){
                $tmp = get_tree($arr,$v['id']);
                if(!$tmp) continue;
                $max_level = max(self::getColumn($tmp,'depth'));
                $v['max_depth'] = $max_level;
                $v['max_level'] = $max_level+2;
                $v['child'] = $tmp;
                $parent[]=$v;
            }
        }
        return $parent;
    }
    private static function findChild(&$arr,$id){
        $children=[];
        foreach ($arr as $k => $v){
            if($v['pid']== $id){
                $children[]=$v;
            }
        }
        return $children;
    }
    private static function build_tree($rows,$root_id,$depth)
    {
        $children = self::findChild($rows, $root_id);
        if (empty($children)) {
            return null;
        }
        foreach ($children as $k => $v){
            $tree=self::build_tree($rows,$v['id'],$depth);

            if( null != $tree){
                $children[$k]['child']=$tree;
            }else{
                if($v['depth']!=$depth){
                    unset($children[$k]);
                }
            }
        }
        $children = array_values($children);
        return $children;
    }

    private static function getColumn($arr,$field)
    {
        $res = [];
        foreach ($arr as $item) {
            if(isset($item[$field])){
                $res[] = $item[$field];
            }
        }
        return $res;
    }

}