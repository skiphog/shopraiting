<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::latest('id')
            ->with('user:id,name,slug')
            ->paginate(5);

        return view('articles.index', compact('articles'));
    }

    public function show(Article $article)
    {
        $article->load(['comments' => static fn($q) => $q->latest('id')->take(10)]);
        $article->updateView();

        return view('articles.show', compact('article'));
    }

    public function vote(Article $article, Request $request): JsonResponse
    {
        $this->validate($request, [
            'vote' => ['required', 'integer', 'between:1,5']
        ]);

        $article->setVote((int)$request['vote']);

        return response()->json(['response' => 'OK']);
    }
}
