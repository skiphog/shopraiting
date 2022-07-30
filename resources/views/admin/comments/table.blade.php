<?php

/**
 * @var \App\Models\Comment[] $comments
 */

?>
<div class="nk-block">
    <div class="card card-bordered card-stretch">
        <div class="card-inner-group">
            <div class="card-inner p-0">
                <div class="nk-tb-list nk-tb-ulist">
                    <div class="nk-tb-item nk-tb-head">
                        <div class="nk-tb-col"><span class="sub-text">Статья</span></div>
                        <div class="nk-tb-col"><span class="sub-text">Автор</span></div>
                        <div class="nk-tb-col"><span class="sub-text">Сообщение</span></div>
                        <div class="nk-tb-col"><span class="sub-text">Ответ</span></div>
                        <div class="nk-tb-col tb-col-md"><span class="sub-text">Дата</span></div>
                    </div>

                    @foreach($comments as $comment)
                        <a class="nk-tb-item" href="{{ route('admin.comments.edit', $comment) }}">
                            <div class="nk-tb-col">
                                {{ $comment->post['name'] }}
                            </div>
                            <div class="nk-tb-col">
                                {{ $comment->name }}
                            </div>
                            <div class="nk-tb-col">
                                {{ str($comment->message)->limit(120) }}
                            </div>

                            <div class="nk-tb-col">
                                {{ str($comment->answer ?: 'Без ответа')->limit(120) }}
                            </div>

                            <div class="nk-tb-col tb-col-md"><span>{{ $comment->created_at->format('d-m-Y H:i') }}</span></div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
