<?php

namespace App\Models;

use App\Models\Model;

class Lotto extends Model
{
    protected $table = 'lotto';
    protected $guarded = ['id'];
    protected $fillable = ['name', 'info'];
}
