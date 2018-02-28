<?php

namespace App\Models;

use App\Models\Model;

class OperationLog extends Model
{
    protected $table = 'logs';
    protected $guarded = ['id'];
    protected $fillable = ['ip', 'method', 'path', 'input', 'user', 'update_user', 'create_user'];

}
