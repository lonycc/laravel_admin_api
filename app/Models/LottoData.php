<?php

namespace App\Models;

use App\Models\Model;

class LottoData extends Model
{

    // public $incrementing = false;
    // protected $keyType = string;
    public $timestamps = false;
    // protected $dateFormat = 'U';
    // const CREATED_AT = 'creation_date';
    // const UPDATED_AT = 'last_update';
    // protected $connection = 'connection-name';
    protected $table = 'lotto_data';
    protected $guarded = ['id'];
    protected $fillable = ['main', 'other', 'lotto_id'];

    /**
     * 所属的lotto
     */
    public function lotto()
    {
        return $this->belongsTo('App\Models\Lotto', 'lotto_id', 'id');
    }


}
