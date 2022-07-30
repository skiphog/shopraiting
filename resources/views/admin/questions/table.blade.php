<?php

/**
 * @var \App\Models\Question[] $questions
 */

?>
<div class="nk-block">
    <div class="card card-bordered card-stretch">
        <div class="card-inner-group">
            <div class="card-inner p-0">
                <div class="nk-tb-list nk-tb-ulist">
                    <div class="nk-tb-item nk-tb-head">
                        <div class="nk-tb-col"><span class="sub-text">Автор</span></div>
                        <div class="nk-tb-col"><span class="sub-text">Сообщение</span></div>
                        <div class="nk-tb-col"><span class="sub-text">Ответ</span></div>
                        <div class="nk-tb-col tb-col-md"><span class="sub-text">Дата</span></div>
                    </div>

                    @foreach($questions as $question)
                        <a class="nk-tb-item" href="{{ route('admin.questions.edit', $question) }}">
                            <div class="nk-tb-col">
                                {{ $question->name }}
                            </div>
                            <div class="nk-tb-col">
                                {{ str($question->message)->limit(120) }}
                            </div>

                            <div class="nk-tb-col">
                                {{ str($question->answer ?: 'Без ответа')->limit(120) }}
                            </div>

                            <div class="nk-tb-col tb-col-md"><span>{{ $question->created_at->format('d-m-Y H:i') }}</span></div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
