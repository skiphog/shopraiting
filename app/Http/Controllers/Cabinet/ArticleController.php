<?php

namespace App\Http\Controllers\Cabinet;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use App\Http\Requests\Cabinet\ArticleRequest;
use Illuminate\Contracts\View\View as ViewTemplate;

class ArticleController extends Controller
{
    /**
     * @return ViewTemplate
     */
    public function index(): ViewTemplate
    {
        $articles = Article::where('user_id', auth()->id())
            ->withoutGlobalScope('activity')
            ->latest()
            ->paginate(10);

        return view('cabinet.articles.index', compact('articles'));
    }

    /**
     * @return ViewTemplate
     */
    public function create(): ViewTemplate
    {
        return view('cabinet.articles.create')
            ->with(['article' => new Article(), 'user' => auth()->user()]);
    }

    /**
     * @param ArticleRequest $request
     *
     * @return JsonResponse
     */
    public function store(ArticleRequest $request): JsonResponse
    {
        $article = $request->user()
            ->articles()
            ->create($request->validated());

        session()->flash('flash', ['message' => 'Статья добавлена']);

        return response()->json(['redirect' => route('cabinet.articles.edit', $article['id'])]);
    }

    /**
     * @param Article $article
     *
     * @return ViewTemplate
     */
    public function edit(Article $article): ViewTemplate
    {
        return view('cabinet.articles.edit')
            ->with('article', $article)
            ->with('user', auth()->user());
    }

    /**
     * @param Article        $article
     * @param ArticleRequest $request
     *
     * @return JsonResponse
     */
    public function update(Article $article, ArticleRequest $request): JsonResponse
    {
        $article->update($request->validated());

        session()->flash('flash', ['message' => 'Данные статьи обновлены']);

        return response()->json(['redirect' => route('cabinet.articles.edit', $article->id)]);
    }

    /**
     * @param Request $request
     *
     * @return string
     */
    public function search(Request $request): string
    {
        $articles = $request->user()->articles()
            ->where('name', 'like', "%{$request['token']}%")
            ->take(30)
            ->get();

        if ($articles->isEmpty()) {
            return 'Ничего не найдено';
        }

        return View::make('cabinet.articles.table', compact('articles'))->render();
    }
}
