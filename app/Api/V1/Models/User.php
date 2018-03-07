<?php

namespace App\Api\V1\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'clients';

    public $timestamps = true;

    protected $hidden = ['email', 'password', 'created_at', 'updated_at', 'check_ip', 'ip', 'status', 'flag', 'create_user', 'update_user'];

    protected $fillable = ['name', 'email', 'password'];
}
