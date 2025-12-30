
{{-- コメントセクション--}}
<div class="mt-4 pt-4 border-t border-gray-200" x-data="{ showComments: false }">
    {{--コメント数表示とトグル--}}
    <button
        @click="showComments = !showComments"
        class="text-sm text-gray-600 hover:text-gray-800 flex items-center gap-1">
        コメント ({{ $post->comments->count() }})
        <svg
            class="w-4 h-4 transition-transform"
            :class="{ 'rotate-180': showComments}"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
        </svg>
    </button>
    {{--コメント一覧--}}
    <div x-show="showComments" x-transition class="mt-3 space-y-3">
        @forelse($post->comments as $comment)
            <div class="bg-gray-50 rounded-lg p-3" x-data="{ editingComment: false}">
                {{--コメント表示--}}
                <div x-show="!editingComment">
                    <div class="flex items-start justify-between mb-2">
                        <div class="flex items-center gap-2">
                            <div class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center text-white text-xs font-bold">
                                {{substr($comment->user->name,0,1)}}
                            </div>
                            <div>
                                <p class="text-sm font-semibold">{{ $comment->user->name}}</p>
                                <p class="text-xs text-gray-500">{{ $comment->created_at->diffForHumans()}}</p>
                            </div>
                        </div>
                        {{--自分のコメントなら編集・削除ボタン--}}
                        @if($comment->user_id === Auth::id())
                            <div class="flex gap-2">
                                <button
                                    @click="editingComment = true"
                                    class="text-xs px-2 py-1 border rounded hover:bg-white transition-colors">
                                    編集
                                </button>
                                <form method="POST" action="{{ route('community.comments.destroy', $comment->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        type="submit"
                                        onclick="return confirm('本当に削除しますか?')"
                                        class="text-xs px-2 py-1 border rounded hover:bg-red-50 hover:text-red-600 transition-colors">
                                        削除
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>
                     <p class="text-sm text-gray-700 whitespace-pre-wrap">{{ $comment->body }}</p>
                </div>

                {{--コメント編集モード--}}
                <div x-show="editingComment" x-transition>
                    <form method="POST" action="{{route('community.comments.update', $comment->id)}}">
                        @csrf
                        @method('PUT')
                        <textarea
                            name="body"
                            rows="3"
                            required
                            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none text-sm">{{ $comment->body }}
                        </textarea>
                        <div class="flex justify-end gap-2 mt-2">
                            <button
                                type="button"
                                @click="editingComment = false"
                                class="text-xs px-3 py-1 border rounded hover:bg-gray-50 transition-colors">
                                キャンセル
                            </button>
                            <button
                                type="submit"
                                class="text-xs px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600 transition-colors">
                                保存
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            @empty
                <p class="text-sm text-gray-500 text-center py-3">
                    コメントはまだありません
                </p>
        @endforelse
        {{-- 新規コメント投稿フォーム --}}
        <form method="POST" action="{{ route('community.comments.store', $post->id) }}" class="mt-3">
            @csrf
            <div class="flex gap-2">
                <textarea
                    name="body"
                    rows="2"
                    required
                    placeholder="コメントを書く..."
                    class="flex-1 px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none text-sm">
                </textarea>
                <button
                    type="submit"
                    class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors text-sm whitespace-nowrap self-end">
                    投稿
                </button>
            </div>
        </form>
    </div>
</div>
