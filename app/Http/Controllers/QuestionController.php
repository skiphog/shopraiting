<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\QuestionRequest;

class QuestionController extends Controller
{
    public function index()
    {
        $questions = Question::paginate(20);

        return view('questions.index', compact('questions'));
    }

    public function show(Question $question)
    {
        return view('questions.show', compact('question'));
    }

    public function create()
    {
        return view('questions.create');
    }

    public function store(QuestionRequest $request): JsonResponse
    {
        Question::create($request->safe()->all());

        return response()->json(['response' => 'Ваш вопрос отправлен администрации!']);
    }
}
