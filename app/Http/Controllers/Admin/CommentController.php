<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    // 评论列表
    public function index()
    {
        $comments = Comment::latest()->paginate(10);
        return view('comment.index', compact('comments'));
    }

    // 编辑评论
    public function edit(Comment $comment)
    {
        return view('comment.edit', compact('comment'));
    }

    // 更新评论
    public function update(Comment $comment)
    {
        $this->validate(request(), [
            'status' => 'required|integer',
        ]);
        $comment->status = request('status');
        $comment->save();
        return redirect(route('comments.index'));
    }

    // 删除评论
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return [
            'error' => 0,
            'msg'   => 'success'
        ];
    }

}
