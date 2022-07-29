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
                        <div class="nk-tb-col tb-col-sm"><span class="sub-text"><em class="icon ni ni-eye"></em></span></div>
                        <div class="nk-tb-col tb-col-sm"><span class="sub-text">Автор</span></div>
                        <div class="nk-tb-col tb-col-md"><span class="sub-text">Дата</span></div>
                        <div class="nk-tb-col nk-tb-col-tools text-right"></div>
                    </div>
                    @foreach($articles as $article)
                        <div class="nk-tb-item">
                            <div class="nk-tb-col">
                                <a href="{{ route('admin.articles.edit', $article)  }}">
                                    <span class="fw-medium">{{ $article->name }}</span>
                                </a>
                            </div>
                            <div class="nk-tb-col tb-col-sm"><span>{{ $article->view }}</span></div>
                            <div class="nk-tb-col tb-col-sm"><span>{{ $article->user->name }}</span></div>
                            <div class="nk-tb-col tb-col-md">
                                <div><span>{{ $article->status_text }}</span></div>
                                <div>
                                    <span>{{ $article->created_at->format('d.m.Y \в H:i') }}</span>
                                    <br>
                                    <span>{{ $article->created_at->diffForHumans() }}</span>
                                </div>
                            </div>

                            <div class="nk-tb-col nk-tb-col-tools">
                                <ul class="nk-tb-actions gx-1">
                                    <li>
                                        <div class="drodown">
                                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger"
                                               data-toggle="dropdown"><em class="icon ni ni-more-h"></em>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <ul class="link-list-opt no-bdr">
                                                    <li>
                                                        <a href="{{ route('articles.show', $article) }}" target="_blank">
                                                            <em class="icon ni ni-eye-fill"></em>
                                                            <span>Посмотреть</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('admin.articles.edit', $article) }}">
                                                            <em class="icon ni ni-edit-fill"></em>
                                                            <span>Редактировать</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>