<?php

namespace App\Api\V1\Controllers;

use App\Models\News;
use App\Models\Channel;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use App\Api\V1\Transformers\NewsTransformer;

class NewsController extends BaseController
{
    // 首页
    public function index()
    {
        return ['message' => 'unfinished'];
    }

    // 获取所有频道
    public function channel()
    {
        return Channel::all();
    }

    public function search(Request $request)
    {
        try {
            $this->validate($request, [
                'field' => 'string',
                'start' => 'string',
                'end' => 'string',
                'keyword' => 'string',
                'channel' => 'integer',
            ]);
        } catch (ValidationException $e) {
            return $e->getResponse();
        }

        $field = $request->get('field');
        $start = $request->get('start');
        $end = $request->get('end');
        $keyword = $request->get('keyword');
        $channel = $request->get('channel');

        $rs = News::where('status', 1);
        if ( $channel )
            $rs = $rs->where('channel_id', $channel);
        if ( preg_match('/^(?:(?!0000)[0-9]{4}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-8])|(?:0[13-9]|1[0-2])-(?:29|30)|(?:0[13578]|1[02])-31)|(?:[0-9]{2}(?:0[48]|[2468][048]|[13579][26])|(?:0[48]|[2468][048]|[13579][26])00)-02-29)$/', $start) )
            $rs = $rs->where('created_at', '>=', $start);
        if ( preg_match('/^(?:(?!0000)[0-9]{4}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-8])|(?:0[13-9]|1[0-2])-(?:29|30)|(?:0[13578]|1[02])-31)|(?:[0-9]{2}(?:0[48]|[2468][048]|[13579][26])|(?:0[48]|[2468][048]|[13579][26])00)-02-29)$/', $end) )
            $rs = $rs->where('created_at', '<=', $end .' 23:59:59');        
        if ( in_array('field', ['title', 'keywords', 'content'], true) )
        {
            $rs = $rs->where($field, 'like', '%'.$keyword.'%');
        } else {
            $rs = $rs->where(function ($query) use ($keyword) {
                $query->where('title', 'like', '%'.$keyword.'%')->orWhere('keywords', 'like', '%'.$keyword.'%')->orWhere('content', 'like', '%'.$keyword.'%');
            });
        }

        $rs = $rs->orderByDesc('created_at')->paginate(10);
        return $this->paginator($rs, new NewsTransformer());
    }

    // 获取详情
    public function show($id)
    {
        return News::where('status', 1)->findOrFail($id);
    }

    // 获取最新列表
    public function getListLatest()
    {
        $news = News::where('status', 1)->orderByDesc('hot')->orderByDesc('created_at')->paginate(10);
        return $this->paginator($news, new NewsTransformer());
    }

    // 指定栏目下的新闻列表
    public function getListByChannel($channel_id)
    {
        $channel = Channel::find($channel_id);
        if ( $channel == null )
        {
            return $this->response->errorNotFound('不存在的栏目');
        }
        $news = $channel->news()->where('status', 1)->orderBy('hot', 'desc')->orderBy('created_at', 'desc')->paginate(10);
        return $this->paginator($news, new NewsTransformer());
    }

}
