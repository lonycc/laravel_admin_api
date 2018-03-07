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

    protected $hidden = ['udn', 'email', 'password', 'created_at', 'updated_at', 'check_ip', 'ip', 'status', 'flag', 'create_user', 'update_user'];

    protected $fillable = ['name', 'email', 'password', 'udn', 'realname', 'flag'];

    public function news()
    {
        return $this->belongsToMany(\App\Models\News::class, 'user_news', 'user_id', 'news_id');
    }

    public function assignNews($news)
    {
        return $this->news()->save($news);
    }
}
