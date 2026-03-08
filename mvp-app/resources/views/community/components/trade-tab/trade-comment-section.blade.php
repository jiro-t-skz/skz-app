
{{-- コメントセクション--}}
<div class="mt-4 pt-4 border-t-2 border-sakura-pink/30" x-data="{ showComments: false }">
    {{--コメント数表示とトグル--}}
    <button
        @click="showComments = !showComments"
        class="text-sm sm:text-base
               text-sakura-purple
               hover:text-sakura-pink
               flex items-center gap-2
               font-semibold
               focus:outline-none focus:ring-sakura-purple/30
               rounded-lg
               px-2 py-1
               transition-all duration-300">
            <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z" clip-rule="evenodd"></path>
            </svg>
             コメント ({{ $post->comments->count() }})
            <svg
                class="w-4 h-4 transition-transform duration-300"
                :class="{ 'rotate-180': showComments}"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
        </svg>
    </button>

    {{--コメント一覧--}}
    <div x-show="showComments"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 transform -translate-y-2"
         x-transition:enter-end="opacity-100 transform translate-y-0"
         x-transition class="mt-3 space-y-3">
        @forelse($post->comments as $comment)
            <div class="bg-gradient-to-br from-sakura-pink/5 to-white
                        rounded-xl
                        p-3 sm:p-4
                        border border-sakura-pink/30"
                        x-data="{ editingComment: false}">
                {{--コメント表示--}}
                <div x-show="!editingComment">
                    <div class="flex items-start justify-between mb-2 gap-2">
                        <div class="flex items-center gap-2 flex-1 min-w-0">
                            <div class="w-8 h-8 sm:w-9 sm:h-9
                                         bg-gray-300
                                         rounded-full flex items-center justify-center
                                        text-white text-xs sm:text-sm
                                        font-bold
                                        shadow-sm flex-shrink-0">
                                {{substr($comment->user->name,0,1)}}
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-xs
                                          font-semibold">
                                          {{ $comment->user->name}}
                                </p>
                                <p class="text-xs
                                          text-gray-500">
                                          {{ $comment->created_at->diffForHumans()}}
                                </p>
                            </div>
                        </div>
                        {{--自分のコメントなら編集・削除ボタン--}}
                        @if($comment->user_id === Auth::id())
                            <div class="flex gap-1.5 flex-shrink-0">
                                <button
                                    @click="editingComment = true"
                                    class="px-2 py-1
                                           border border-sakura-purple
                                           text-sakura-purple
                                           rounded-md text-xs font-medium
                                           hover:bg-sakura-purple hover:text-white
                                           focus:outline-none focus:ring-2 focus:ring-sakura-purple/30
                                           transition-all duration-200">
                                    編集
                                </button>
                                <form method="POST"
                                      action="{{ route('community.trade.comments.destroy', $comment->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        type="submit"
                                        onclick="return confirm('本当に削除しますか?')"
                                        class="px-2 py-1
                                               border border-red-400
                                               text-red-400
                                               rounded-md text-xs font-medium
                                               focus:outline-none
                                               focus:ring-2
                                               focus:ring-red-300
                                               hover:bg-red-500 
                                               hover:text-white 
                                               hover:border-red-500
                                               transition-all duration-200">
                                        削除
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>
                     <p class="text-sm text-gray-700 whitespace-pre-wrap">{{ $comment->body }}</p>
                </div>

                {{--コメント編集モード--}}
                <div x-show="editingComment"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 transform scale-95"
                     x-transition:enter-end="opacity-100 transform scale-100">
                    <form method="POST" action="{{route('community.trade.comments.update', $comment->id)}}">
                        @csrf
                        @method('PUT')
                        <textarea
                            name="body"
                            rows="3"
                            required
                            class="w-full px-3 py-2
                                   border-2 border-sakura-pink
                                   rounded-lg
                                   text-sakura-purple text-xs sm:tex-sm
                                   focus:outline-none
                                   focus:ring-4 focus:ring-sakura-purple/20
                                   focus:border-sakura-purple
                                   resize-none
                                   transition-all duration-300">{{ $comment->body }}
                        </textarea>

                        <div class="flex justify-end gap-2 mt-2">
                            <button
                                type="button"
                                @click="editingComment = false"
                                class="px-2.5 py-1
                                       border border-sakura-purple
                                       text-sakura-purple
                                       rounded-md text-xs font-medium
                                       hover:bg-sakura-purple hover:text-white
                                       focus:outline-none focus:ring-2 focus:ring-sakura-purple/30
                                       transition-all duration-200">
                                キャンセル
                            </button>
                            <button
                                type="submit"
                                class="px-2.5
                                       py-1
                                       bg-gradient-to-r from-sakura-purple to-sakura-pink
                                       text-white
                                       rounded-md text-xs font-semibold
                                       hover:from-sakura-purple-dark hover:to-sakura-pink-medium
                                       transition-all duration-200
                                       shadow-sm hover:shadow-md">
                                保存
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            @empty
            <div class="text-center py-6 sm:py-8">
                <svg class="w-12 h-12 sm:w-16 sm:h-16 mx-auto text-sakura-pink/40 mb-3" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z" clip-rule="evenodd"></path>
                </svg>
                <p class="text-xs sm:text-sm text-gray-500">
                    コメントはまだありません
                </p>
                <p class="text-xs text-gray-400 mt-1">
                    最初のコメントを投稿しましょう！
                </p>
            </div>

        @endforelse
        {{-- 新規コメント投稿フォーム --}}
        <form method="POST" action="{{ route('community.trade.comments.store', $post->id) }}" class="mt-4">
            @csrf
            <div class="flex flex-col sm:flex-row gap-2">
                <textarea
                    name="body"
                    rows="2"
                    required
                    placeholder="コメントを書く..."
                    class="flex-1 px-3 py-2 
                           border-2 border-sakura-pink 
                           rounded-lg 
                           text-sakura-purple text-xs sm:text-sm
                           placeholder-gray-400
                           focus:outline-none 
                           focus:ring-4 focus:ring-sakura-purple/20 
                           focus:border-sakura-purple 
                           resize-none
                           transition-all duration-300"></textarea>
                <button
                    type="submit"
                    class="px-4 py-2 
                           bg-gradient-to-r from-sakura-purple to-sakura-pink 
                           text-white 
                           rounded-lg text-xs sm:text-sm font-bold
                           hover:from-sakura-purple-dark hover:to-sakura-pink-medium 
                           focus:outline-none focus:ring-4 focus:ring-sakura-purple/30
                           transition-all duration-300 
                           shadow-md hover:shadow-lg 
                           transform hover:scale-105
                           whitespace-nowrap 
                           sm:self-end
                           flex items-center justify-center gap-1.5">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"></path>
                    </svg>
                    投稿
                </button>
            </div>
        </form>
    </div>
</div>

