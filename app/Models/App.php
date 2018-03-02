<?php

namespace App\Models;

use App\Models\Model;

class App extends Model
{
    protected $table = 'apps';
    protected $guarded = ['id'];
    protected $fillable = ['name', 'url', 'info', 'logo'];

}
