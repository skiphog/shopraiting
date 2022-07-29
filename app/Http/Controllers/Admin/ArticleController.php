<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use App\Http\Requests\ArticleRequest;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::withoutGlobalScope('activity')
            ->with('user')
            ->latest('id')
            ->paginate(20);

        return view('admin.articles.index', compact('articles'));
    }

    public function create()
    {
        $users = User::where('status', '=', 1)
            ->where('role', '>', 1)
            ->get();

        return view('admin.articles.create')
            ->with(['article' => new Article(), 'users' => $users]);
    }

    public function store(ArticleRequest $request): JsonResponse
    {
        $article = Article::create($request->safe()->all());

        session()->flash('flash', ['message' => 'Статья добавлена']);

        return response()->json(['redirect' => route('admin.articles.edit', $article)]);
    }

    public function edit(int $article_id)
    {
        $article = Article::withoutGlobalScope('activity')
            ->where('id', $article_id)
            ->firstOrFail();

        $users = User::where('status', '=', 1)
            ->where('role', '>', 1)
            ->get();

        return view('admin.articles.edit', compact('article', 'users'));
    }

    public function update(int $article_id, ArticleRequest $request): JsonResponse
    {
        $article = Article::withoutGlobalScope('activity')
            ->where('id', $article_id)
            ->firstOrFail();

        $article->update($request->safe()->all());

        session()->flash('flash', ['message' => 'Данные статьи обновлены']);

        return response()->json(['redirect' => route('admin.articles.edit', $article)]);
    }

    public function destroy(int $article_id)
    {
    }

    public function search(Request $request): string
    {
        $articles = Article::where('name', 'like', "%{$request['token']}%")
            ->orWhereHas('user', static fn($q) => $q->where('name', 'like', "%{$request['token']}%"))
            ->take(30)
            ->get();

        if ($articles->isEmpty()) {
            return 'Ничего не найдено';
        }

        return View::make('admin.articles.table', compact('articles'))->render();
    }
}