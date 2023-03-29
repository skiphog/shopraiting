<?php

namespace App\Http\Controllers\Cabinet;

use App\Models\User;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use App\Http\Requests\Cabinet\ArticleRequest;

class ArticleController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $articles = $user->articles()
            ->paginate(10);

        return view('cabinet.articles.index', compact('user','articles'));
    }

    public function create()
    {
        $user = auth()->user();

        return view('cabinet.articles.create')
            ->with(['article' => new Article(), 'user' => $user]);
    }

    public function store(ArticleRequest $request): JsonResponse
    {
        $data = [
            'img_alt'         => '',
            'img_title'       => '',
            'seo_h1'          => $request['title'],
            'seo_title'       => $request['title'],
            'seo_description' => $request['title']
        ];

        $article = Article::create(array_merge($request->safe()->all(), $data));

        session()->flash('flash', ['message' => 'Статья добавлена']);

        return response()->json(['redirect' => route('cabinet.articles.edit', $article)]);
    }

    public function edit(int $article_id)
    {
        $article = Article::withoutGlobalScope('activity')
            ->where('id', $article_id)
            ->firstOrFail();

        $user = auth()->user();

        return view('cabinet.articles.edit', compact('article', 'user'));
    }

    public function update(int $article_id, ArticleRequest $request): JsonResponse
    {
        $article = Article::withoutGlobalScope('activity')
            ->where('id', $article_id)
            ->firstOrFail();

        $article->update($request->safe()->all());

        session()->flash('flash', ['message' => 'Данные статьи обновлены']);

        return response()->json(['redirect' => route('cabinet.articles.edit', $article)]);
    }

    public function destroy(int $article_id)
    {
    }

    public function search(Request $request): string
    {
        $articles = auth()->user()->articles()
            ->where('name', 'like', "%{$request['token']}%")
            ->orWhereHas('user', static fn($q) => $q->where('name', 'like', "%{$request['token']}%"))
            ->take(30)
            ->get();

        if ($articles->isEmpty()) {
            return 'Ничего не найдено';
        }

        return View::make('cabinet.articles.table', compact('articles'))->render();
    }
}
