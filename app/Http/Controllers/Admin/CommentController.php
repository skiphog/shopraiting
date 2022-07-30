<?php

namespace App\Http\Controllers\Admin;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    public function index()
    {
        $mod_comments = Comment::withoutGlobalScope('activity')
            ->with(['post' => static fn($q) => $q->withoutGlobalScope('activity')->select(['id', 'name'])])
            ->where('activity', 0)
            ->latest('id')
            ->get();

        $comments = Comment::with(['post' => static fn($q) => $q->withoutGlobalScope('activity')->select(['id', 'name'])])
            ->latest('id')
            ->paginate(20);

        return view('admin.comments.index', compact('mod_comments', 'comments'));
    }

    public function edit(int $comment_id)
    {
    }

    public function update(int $comment_id)
    {
    }

    public function destroy(int $comment_id)
    {
    }

    public function search(Request $request)
    {
    }
}
