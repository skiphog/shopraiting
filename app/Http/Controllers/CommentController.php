<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\CommentRequest;

class CommentController extends Controller
{
    public function article(Article $article, CommentRequest $request): JsonResponse
    {
        $article->comments()->create($request->safe()->all());

        return response()->json(['response' => 'Ваш комментарий отправлен на модерацию!']);
    }
}
