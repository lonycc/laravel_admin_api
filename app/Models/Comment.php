<?php

namespace App\Models;

use App\Models\Model;

class Comment extends Model
{
    protected $table = 'comment';
    protected $guarded = ['id'];
    protected $fillable = ['content', 'status', 'news_id', 'create_user'];

    public function news()
    {
        return $this->belongsTo('App\Models\News', 'news_id', 'id');
    }
}
