<?php

namespace App\Models;

use App\Models\Model;

class Lottery extends Model
{
    protected $table = 'lottery';
    protected $guarded = ['id'];
    protected $hidden = ['create_user', 'update_user', 'created_at', 'updated_at'];
    protected $fillable = ['name', 'info', 'lotto_id', 'create_user', 'update_user'];

    /**
     * 关联的数据集
     */
    public function lotto()
    {
        return $this->belongsTo('App\Models\Lotto', 'lotto_id', 'id');
    }

    /**
     * 查找项目所有关联奖项
     */
    public function awards()
    {
        return $this->hasMany('App\Models\Award', 'lottery_id', 'id');
    }

}
