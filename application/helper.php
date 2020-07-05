<?php
// +----------------------------------------------------------------------
// | tpadmin [a web admin based ThinkPHP5]
// +----------------------------------------------------------------------
// | Copyright (c) 2016 tianpian All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: tianpian <tianpian0805@gmail.com>
// +----------------------------------------------------------------------

//------------------------
// 助手函数
//-------------------------

/**
 * 对ID加密
 * @param null|int $length
 * @param null|string $salt
 * @param null|string $alphabet
 * @return Hashids\Hashids static
 */
function hashids($length = null, $salt = null, $alphabet = null)
{
    return \Hashids\Hashids::instance($length, $salt, $alphabet);
}

/**
 * 一键导出Excel 2007格式
 * @param array $header     Excel头部 ["COL1","COL2","COL3",...]
 * @param array $body       和头部长度相等字段查询出的数据就可以直接导出
 * @param null|string $name 文件名，不包含扩展名，为空默认为当前时间
 * @param string|int $version 版本 2007|2003|ods|pdf
 * @return string
 */
function export_excel($header, $body, $name = null, $version = '2007')
{
    return \Excel::export($header, $body, $name, $version);
}

/**
 * 获取七牛上传token
 * @return mixed
 */
function qiniu_token()
{
    return \Qiniu::token();
}

/**
 * 检查指定节点是否有权限
 * @param null $action
 * @param null $controller
 * @param null $module
 * @return bool
 */
function check_access($action = null, $controller = null, $module = null)
{
    return \Rbac::AccessCheck($action, $controller, $module);
}

/**
 * 文件下载
 * @param $file_path
 * @param string $file_name
 * @param string $file_size
 * @param string $ext
 * @return string
 */
function download($file_path, $file_name = '', $file_size = '', $ext = '')
{
    return \File::download($file_path, $file_name, $file_size, $ext);
}

/**计算年龄
 * @param $birthday
 * @return bool|int
 */
function birthday($birthday){
    $age = strtotime($birthday);
    if($age === false){
        return false;
    }
    list($y1,$m1,$d1) = explode("-",date("Y-m-d",$age));
    $now = strtotime("now");
    list($y2,$m2,$d2) = explode("-",date("Y-m-d",$now));
    $age = $y2 - $y1;
    if((int)($m2.$d2) < (int)($m1.$d1))
        $age -= 1;
    return $age;
}


function allergicWordFilter($str){

//    $str = iconv('UTF-8','GBK',"作硝化甘");
    $allergicWord = file_get_contents('./Docs/allergic_words.txt');
//    $allergicWord = str_replace(array("\r\n", "\r", "\n"), PHP_EOL, $allergicWord);
    $allergicWord = explode(PHP_EOL,$allergicWord);
    $info = 0;
    for ($i=0;$i<count($allergicWord);$i++){
        $match = trim($allergicWord[$i]);
        if(empty($match))
            continue;
        $content = mb_substr_count($str,$match);
        if($content>0){
            $info = $content;
            break;
        }
    }
    if($info>0){
        //有违法字符
        return TRUE;
    }else{
        //没有违法字符
        return FALSE;
    }
}