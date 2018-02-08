<?php

namespace App\Models;

use App\Models\Model;

class Lotto extends Model
{
    protected $table = 'lotto';
    protected $guarded = ['id'];
    protected $fillable = ['name', 'info'];
    public $timestamps = false;

    public function lottodata()
    {
        return $this->hasMany('App\Models\LottoData', 'lotto_id')->orderBy('id', 'asc');
    }

    public function lottery()
    {
        return $this->belongsTo('App\Models\Lottery');
    }


}
