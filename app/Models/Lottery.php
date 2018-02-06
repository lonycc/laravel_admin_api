<?php

namespace App\Models;

use App\Models\Model;

class Lottery extends Model
{
    protected $table = 'lottery';
    protected $guarded = ['id'];
    protected $fillable = ['name', 'info'];

    public function assignLotto($lotto)
    {
        return $this->save($lotto);
    }

    public function deleteLotto($lotto)
    {
        return $this->detach($lotto);
    }
    
}
