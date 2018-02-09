<?php

namespace App\Models;

use App\Models\Model;

class Award extends Model
{
    protected $table = 'award';
    protected $guarded = ['id'];
    protected $fillable = ['name', 'info', 'rank', 'score', 'lottery_id'];

    /** 
     * 查找奖项所属项目
     */
    public function lottery()
    {
        return $this->belongsTo('App\Models\Lottery', 'lottery_id', 'id');
    }

}
