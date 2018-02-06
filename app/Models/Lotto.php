<?php

namespace App\Models;

use App\Models\Model;

class Lotto extends Model
{
    protected $table = 'lotto';
    protected $guarded = ['id'];
    protected $fillable = ['name', 'info'];
    public $timestamps = false;

    public function datas()
    {
        return $this->hasMany(LottoData::class)->orderBy('id', 'asc');
    }




}
