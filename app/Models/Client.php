<?php

namespace App\Models;

use App\Models\Model;

class Client extends Model
{
    protected $table = 'clients';
    protected $guarded = ['id'];
    protected $hidden = ['email', 'password', 'created_at', 'updated_at', 'check_ip', 'ip', 'status', 'flag', 'create_user', 'update_user'];
    protected $fillable = ['name', 'email', 'realname', 'check_ip', 'status', 'ip', 'flag', 'password', 'update_user', 'create_user'];

    public function news()
    {
        return $this->belongsToMany(News::class, 'user_news', 'user_id', 'news_id');
    }

    public function apps()
    {
        return $this->belongsToMany(App::class, 'user_app', 'user_id', 'app_id')->withPivot(['user_id', 'app_id']);        
    }

    public function assignApp($app)
    {
        return $this->apps()->save($app);
    }

    public function deleteApp($app)
    {
        return $this->apps()->detach($app);
    }

    public function assignNews($news)
    {
        return $this->news()->save($news);
    }

    public function deleteNews($news)
    {
        return $this->news()->detach($news);
    }
}
