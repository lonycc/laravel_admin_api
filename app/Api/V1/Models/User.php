<?php

namespace App\Api\V1\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'clients';

    public $timestamps = false;

    protected $hidden = ['password'];

    protected $fillable = ['name', 'email', 'password'];
}
