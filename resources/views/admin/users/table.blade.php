<?php

/**
 * @var \App\Models\User[] $users
 */

?>
<div class="nk-block">
    <div class="card card-bordered card-stretch">
        <div class="card-inner-group">
            <div class="card-inner p-0">
                <div class="nk-tb-list nk-tb-ulist">
                    <div class="nk-tb-item nk-tb-head">
                        <div class="nk-tb-col tb-col-xxl"><span class="sub-text">id</span></div>
                        <div class="nk-tb-col"><span class="sub-text">Пользователь</span></div>
                        <div class="nk-tb-col tb-col-md"><span class="sub-text">Email</span></div>
                        <div class="nk-tb-col tb-col-mb text-end"><span class="sub-text">Роль</span></div>
                    </div>
                    @foreach($users as $user)
                        <div class="nk-tb-item">
                            <div class="nk-tb-col tb-col-xxl"><span>{{ $user->id }}</span></div>
                            <div class="nk-tb-col">
                                <a href="{{ route('admin.users.edit', $user) }}">
                                    <div class="user-card">
                                        <div class="user-avatar sm bg-primary-dim">
                                            <img src="{{ $user->avatar }}" width="32" height="32" alt="">
                                        </div>
                                        <div class="user-info">
                                            <span class="tb-lead">{{ $user->name }}</span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="nk-tb-col tb-col-md"><span>{{ $user->email }}</span></div>
                            <div class="nk-tb-col tb-col-mb"><span>{{ $user->role_name }}</span></div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>