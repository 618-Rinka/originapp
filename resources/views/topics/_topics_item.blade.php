<div class="card">
    <div class="card-header">{{ $topic->user->name }}</div>
    <div class="card-body">
        <p class="card-text">{{ $topic->body }}</p>
        <p class="card-text"><a href="{{ route('topics.show', $topic->id) }}">詳細を見る</a></p>

        @auth
            <div class="d-flex justify-content-between">
                <div>
                    @php
                        $user = $topic->likingUsers->firstWhere('id', Auth::id());
                        $count = optional(optional($user)->pivot)->count ?? 0;
                    @endphp
                    @if($count < 101)
                        <form method="POST" action="{{ route('likes.add',$topic->id) }}">
                            @csrf
                            <button type="submit" class="btn btn-success">いいねする{{ $count > 0 ? '（' . $count . '）' : '' }}</button>
                        </form>
                    @else
                        <button type="submit" class="btn btn-success">いいねは100回までです</button>
                    @endif

                    @if($topic->likingUsers->contains(Auth::id()))
                        <form method="POST" action="{{ route('likes.remove', $topic->id) }}">
                        @csrf
                        <button type="submit" class="btn btn-danger">いいねを解除する</button>
                        </form>
                    @endif
                </div>
                <div>
                    @if(Auth::id() === $topic->user_id)
                        <form method="POST" action="{{ route('topics.delete', $topic->id) }}">
                        @csrf
                        <button type="submit" class="btn btn-danger">削除</button>
                        </form>
                    @endif
                </div>
            </div>
        @endauth
        
    </div>
</div> 