<?php

namespace App\Api\V1\Controllers;

use App\Models\News;
use App\Models\Channel;
use App\Api\V1\Transformers\NewsTransformer;

class NewsController extends BaseController
{
    // 获取列表
    public function index()
    {
        $news = News::orderByDesc('updated_at')->paginate(10);
        return $this->paginator($news, new NewsTransformer());
    }

    // 获取详情
    public function show($id)
    {
        return News::findOrFail($id);
    }

    // 指定栏目下的新闻列表
    public function getListByChannel($channel_id)
    {
        $channel = Channel::find($channel_id);
        if ( $channel == null )
        {
            return $this->response->errorNotFound('不存在的栏目');
        }
        $news = $channel->news()->paginate(10);
        return $this->paginator($news, new NewsTransformer());
    }

}
