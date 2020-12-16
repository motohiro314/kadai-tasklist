@if (count($tasks) > 0)
    <ul class="list-unstyled">
        @foreach ($tasklists as $tasklist)
            <li class="media mb-3">
               
                        {{-- 投稿の所有者のユーザ詳細ページへのリンク --}}
                        {!! link_to_route('users.show', $tasklist->user->name, ['user' => $tasklist->user->id]) !!}
                        <span class="text-muted">posted at {{ $tasklist->created_at }}</span>
                    </div>
                     @if (Auth::id() == $micropost->user_id)
                            {{-- 投稿削除ボタンのフォーム --}}
                            {!! Form::open(['route' => ['microposts.destroy', $micropost->id], 'method' => 'delete']) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                            {!! Form::close() !!}
                        @endif
                    <div>
                        {{-- 投稿内容 --}}
                        <p class="mb-0">{!! nl2br(e($tasklist->content)) !!}</p>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
    {{-- ページネーションのリンク --}}
    {{ $tasklists->links() }}
@endif

