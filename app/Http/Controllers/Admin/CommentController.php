<?php

namespace App\Http\Controllers\Admin;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class CommentController extends Controller
{
    public function index()
    {
        $mod_comments = Comment::withoutGlobalScope('activity')
            ->with(['post' => static fn($q) => $q->withoutGlobalScope('activity')->select(['id', 'name'])])
            ->where('activity', 0)
            ->latest('id')
            ->get();

        $comments = Comment::with([
            'post' => static fn($q) => $q->withoutGlobalScope('activity')->select([
                'id',
                'name'
            ])
        ])
            ->latest('id')
            ->paginate(20);

        return view('admin.comments.index', compact('mod_comments', 'comments'));
    }

    public function edit(int $comment_id)
    {
        $comment = Comment::withoutGlobalScope('activity')
            ->where('id', $comment_id)
            ->with(['post' => static fn($q) => $q->withoutGlobalScope('activity')])
            ->firstOrFail();

        return view('admin.comments.edit', compact('comment'));
    }

    public function update(int $comment_id, Request $request): JsonResponse
    {
        $data = $this->validate($request, [
            'activity' => ['required', 'integer', Rule::in(Comment::$status)],
            'answer'   => ['nullable', 'string']
        ]);

        $comment = Comment::withoutGlobalScope('activity')
            ->where('id', $comment_id)
            ->firstOrFail();

        if (!empty($data['answer']) && empty($comment->answered_at)) {
            $data['answered_at'] = date('d.m.Y H:i:s');
        }

        $comment->update($data);

        session()->flash('flash', ['message' => 'Статус Комментария обновлён']);

        return response()->json(['redirect' => route('admin.comments.edit', $comment)]);
    }

    public function destroy(int $comment_id): JsonResponse
    {
        Comment::withoutGlobalScope('activity')
            ->where('id', $comment_id)
            ->firstOrFail()
            ->delete();

        session()->flash('flash', ['message' => 'Комментарий удалён']);

        return response()->json(['redirect' => route('admin.comments.index')]);
    }

    public function search(Request $request): string
    {
        $comments = Comment::where('name', 'like', "%{$request['token']}%")
            ->orWhere('message', 'like', "%{$request['token']}%")
            ->with(['post' => static fn($q) => $q->withoutGlobalScope('activity')->select(['id', 'name'])])
            ->withoutGlobalScope('activity')
            ->take(10)
            ->get();

        if ($comments->isEmpty()) {
            return 'Ничего не найдено';
        }

        return View::make('admin.comments.table', compact('comments'))->render();
    }
}
