<?php

namespace App\Models;

use App\Models\Model;

class Client extends Model
{
    protected $table = 'clients';
    protected $guarded = ['id'];
    protected $fillable = ['name', 'email', 'realname', 'check_ip', 'ip', 'flag', 'password', 'update_user', 'create_user'];

    public function news()
    {
        return $this->belongsToMany(News::class, 'user_news', 'user_id', 'news_id')->withPivot(['user_id', 'news_id', 'created_at', 'updated_at']);
    }

}
