<?php
/**
 * tpAdmin [a web admin based ThinkPHP5]
 *
 * @author    yuan1994 <tianpian0805@gmail.com>
 * @link      http://tpadmin.yuan1994.com/
 * @copyright 2016 yuan1994 all rights reserved.
 * @license   http://www.apache.org/licenses/LICENSE-2.0
 */

namespace app\admin\controller;

use app\admin\Controller;
use think\Db;
use think\Exception;

class Upload extends Controller
{
    /**
     * 首页
     */
    public function index()
    {
        return $this->view->fetch();
    }

    /**
     * 文件上传
     */
    public function upload()
    {
        $file = $this->request->file('file');
        $path = ROOT_PATH . 'public/tmp/uploads/';
        $info = $file->move($path);
        if (false===$info) {
            return ajax_return_error($info->getError());
        }
        $data = $this->request->root() . '/tmp/uploads/' . $info->getSaveName();

        $from = 1;
        $res = $this->saveFile($data,$info->getInfo('type'),$info->getInfo('name'),$info->getInfo('size'),$from);
        return ajax_return(['name' => $data,'file_id'=>$res,'from'=>$from]);
    }

    /**
     * 远程图片抓取
     */
    public function remote()
    {
        $url = $this->request->post('url');
        // validate
        $name = ROOT_PATH . 'public/tmp/uploads/' . get_random();
        $name = \File::downloadImage($url, $name);

        $ret = $this->request->root() . '/tmp/uploads/' . basename($name);

        $from = 1;
        $res = $this->saveFile($ret,mime_content_type('.'.$ret),basename($url),filesize('.'.$ret),$from);

        return ajax_return(['url' => $ret,'file_id'=>$res,'from'=>$from], '抓取成功');
    }

    /**
     * 图片列表
     */
    public function listImage()
    {
        $page = $this->request->param('p', 1);
        if ($this->request->param('count')) {
            $ret['count'] = Db::name('File')->where('cate=3')->count();
        }
        $ret['list'] = Db::name('File')->where('cate=3')->field('id,name,original,from')->page($page, 10)->select();

        return ajax_return($ret);
    }

    public function saveFile($data,$type,$name,$size,$from=1)
    {
        $cate = $this->getFileCate($type);
        $insert = [
            'cate'     => $cate,
            'name'     => $data,
            'original' => $name,
            'domain'   => '',
            'type'     => $type,
            'size'     => $size,
            'from'     => $from,
            'mtime'    => time(),
        ];
//        $res = Db::name('File')->insert($insert);
        $res = Db::name('File')->insertGetId($insert);
        return $res;
    }

    private function getFileCate($type)
    {
        $cate = 3 ;
        $type_name = explode('/',$type);
        if(!empty($type_name[0])){
            switch ($type_name[0]){
                case 'image':
                    $cate = 1;
                    break;
                case 'video':
                    $cate = 2;
                    break;
            }
        }
        return $cate;
    }

    public function alioss()
    {
        set_time_limit(0);
        if($this->request->isPost()){
            $file = $this->request->file('file');
            if (empty($file)) {
                return ajax_return_error('请选择上传的文件');
            }

            $allow_max_size = config('alioss.allow_file_max_size') * pow(1024, 2);
            $allow_upload_ext = config('alioss.allow_file_upload_ext');
            $path = ROOT_PATH . 'public/tmp/uploads/';

            $info = $file->validate(['size' => $allow_max_size, 'ext' => $allow_upload_ext])->move($path);
            if ($info===false) {
                return ajax_return_error($file->getError());
            }

            try{
                $fileName = $this->request->root() . 'tmp/uploads/' . $info->getSaveName();
//                $type = $this->request->param('type');
//                $video_type = $type==1?'playback':'succinct';
//                $saveDir = 'video'.DS.$video_type;//子目录
                $saveName = basename($fileName);
                $alioss = new \Alioss();
                $ossClient = $alioss::getInstance();
                $bucket = $alioss::getBucketName();

                $res = $ossClient->multiuploadFile($bucket,$saveName,$fileName);
            }catch (Exception $e){
                return ajax_return_error($e->getMessage());
            }
            if(!isset($res['info']) || $res['info']['http_code'] !=200){

                return ajax_return_error($res);
            }

            $oss_request_url = $res['info']['url'];
            $from = 2;
            $res = $this->saveFile($oss_request_url,$info->getInfo('type'),$info->getInfo('name'),$info->getInfo('size'),$from);
            if(file_exists($fileName)){
                @unlink($fileName);
            }
            return ajax_return(['name' => $oss_request_url,'file_id'=>$res]);
        }else{
            return ajax_return_error('非法请求');
        }
    }
}