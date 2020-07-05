<?php
namespace app\common\model;

use think\Model;

class CompetitionApply extends Model
{
    // 指定表名,不含前缀
    protected $name = 'competition_apply';
    // 开启自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';

    protected function member()
    {
        return $this->belongsTo('Member','member_id','id');
    }
    protected function competition()
    {
        return $this->belongsTo('Competition','competition_id','id');
    }
}
