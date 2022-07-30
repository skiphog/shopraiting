<?php

namespace App\Http\Controllers\Admin;

use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class QuestionController extends Controller
{
    public function index()
    {
        $mod_questions = Question::withoutGlobalScope('activity')
            ->where('activity', 0)
            ->latest('id')
            ->get();

        $questions = Question::latest('id')
            ->paginate(20);

        return view('admin.questions.index', compact('mod_questions', 'questions'));
    }

    public function edit(int $question_id)
    {
        $question = Question::withoutGlobalScope('activity')
            ->where('id', $question_id)
            ->firstOrFail();

        return view('admin.questions.edit', compact('question'));
    }

    public function update(int $question_id, Request $request): JsonResponse
    {
        $data = $this->validate($request, [
            'activity' => ['required', 'integer', Rule::in(Question::$status)],
            'answer'   => ['nullable', 'string']
        ]);

        $question = Question::withoutGlobalScope('activity')
            ->where('id', $question_id)
            ->firstOrFail();

        if (!empty($data['answer']) && empty($question->answered_at)) {
            $data['answered_at'] = date('d.m.Y H:i:s');
        }

        $question->update($data);

        session()->flash('flash', ['message' => 'Статус Вопроса обновлён']);

        return response()->json(['redirect' => route('admin.questions.edit', $question)]);
    }

    public function destroy(int $question_id): JsonResponse
    {
        Question::withoutGlobalScope('activity')
            ->where('id', $question_id)
            ->firstOrFail()
            ->delete();

        session()->flash('flash', ['message' => 'Вопрос удалён']);

        return response()->json(['redirect' => route('admin.questions.index')]);
    }

    public function search(Request $request): string
    {
        $questions = Question::where('name', 'like', "%{$request['token']}%")
            ->orWhere('message', 'like', "%{$request['token']}%")
            ->withoutGlobalScope('activity')
            ->take(10)
            ->get();

        if ($questions->isEmpty()) {
            return 'Ничего не найдено';
        }

        return View::make('admin.questions.table', compact('questions'))->render();
    }
}