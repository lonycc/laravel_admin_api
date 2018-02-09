<?php

namespace App\Models;

use App\Models\Model;

class Lotto extends Model
{
    protected $table = 'lotto';
    protected $guarded = ['id'];
    protected $fillable = ['name', 'info', 'create_user', 'update_user'];

    /**
     * 一对多: 
     */
    public function datas()
    {
        return $this->hasMany('App\Models\LottoData', 'lotto_id', 'id')->orderBy('id', 'asc');
    }

    /**
     * 关联的项目: Eloquent将在Lottery表的lotto_id字段查找与Lotto表的id字段相匹配的值
     */
    public function lottery()
    {
        return $this->hasOne('App\Models\Lottery', 'lotto_id', 'id');
    }


}
