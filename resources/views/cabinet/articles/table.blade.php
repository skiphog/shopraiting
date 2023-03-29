<?php

/**
 * @var \App\Models\Article[] $articles
 */

?>
<div class="nk-block">
    <div class="card card-bordered card-stretch">
        <div class="card-inner-group">
            <div class="card-inner p-0">
                <div class="nk-tb-list nk-tb-ulist">
                    <div class="nk-tb-item nk-tb-head">
                        <div class="nk-tb-col"><span class="sub-text">Статья</span></div>
                        <div class="nk-tb-col"><span class="sub-text"><em class="icon ni ni-eye"></em></span></div>
                        <div class="nk-tb-col"><span class="sub-text">Автор</span></div>
                        <div class="nk-tb-col"><span class="sub-text">Статус</span></div>
                        <div class="nk-tb-col tb-col-md"><span class="sub-text">Дата</span></div>
                    </div>

                    @foreach($articles as $article)
                        <a class="nk-tb-item" href="{{ route('cabinet.articles.edit', $article) }}">
                            <div class="nk-tb-col">
                                {{ $article->name }}
                            </div>
                            <div class="nk-tb-col">
                                {{ $article->view }}
                            </div>
                            <div class="nk-tb-col">
                                {{ $article->user->name }}
                            </div>
                            <div class="nk-tb-col">
                                {{ $article->status_text }}
                            </div>
                            <div class="nk-tb-col tb-col-md">
                                <span>{{ $article->created_at->format('d.m.Y \в H:i') }}</span>
                                <br>
                                <span>{{ $article->created_at->diffForHumans() }}</span>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>