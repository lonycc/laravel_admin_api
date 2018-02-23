<?php

namespace App\Models;

use App\Models\Model;

class Client extends Model
{
    protected $table = 'clients';
    protected $guarded = ['id'];
    protected $fillable = ['name', 'email', 'realname', 'check_ip', 'ip', 'flag', 'password', 'update_user', 'create_user'];

}
