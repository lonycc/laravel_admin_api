<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
{
    // 新闻列表
    public function index()
    {
        $news = News::paginate(10);
        return view('news.index', compact('news'));
    }

    // 创建新闻
    public function create()
    {
        return view('news.create');
    }

    // 删除新闻
    public function destroy(News $news)
    {
        $news->delete();
        return [
            'error' => 0,
            'msg'   => 'success'
        ];
    }

}
