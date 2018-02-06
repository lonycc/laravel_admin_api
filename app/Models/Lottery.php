<?php

namespace App\Models;

use App\Models\Model;

class Lottery extends Model
{
    protected $table = 'lottery';
    protected $guarded = ['id'];
    protected $fillable = ['name', 'info', 'lotto_id'];

    /**
     * 获得与项目关联的数据集
     */
    public function lotto()
    {
        return $this->hasOne('App\Models\Lotto');
    }

}
