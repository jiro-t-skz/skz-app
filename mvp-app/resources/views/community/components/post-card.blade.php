<div class="bg-white border rounded-lg p-5 hover:shadow-md transition-shadow" x-data="{ editing: false }">
    <div class="flex items-start space-x-3">
        {{-- ユーザーアイコン --}}
        @include('community.components.user-avatar', ['user' => $post->user])

        {{-- 投稿内容 --}}
        <div class="flex-1">
            {{-- 通常表示モード --}}
            <div x-show="!editing">
                <div class="flex items-start justify-between mb-2">
                    <div class="flex-1">
                        {{-- タイトルと種別バッジ --}}
                        <div class="flex items-center gap-2 mb-1">
                            <h3 class="font-bold text-lg">{{ $post->title }}</h3>
                            <span class="text-xs px-3 py-1 rounded-full {{ $post->type == 'companion' ? 'bg-green-100 text-green-700' : 'bg-purple-100 text-purple-700' }}">
                                {{ $post->type == 'companion' ? '同行者募集' : 'トレード' }}
                            </span>
                        </div>
                        <p class="font-semibold">{{ $post->user->name }}</p>
                        <p class="text-sm text-gray-500">{{ $post->created_at->diffForHumans() }}</p>
                    </div>

                    {{-- 編集・削除ボタン --}}
                    @if($post->user_id === Auth::id())
                        <div class="flex space-x-2">
                            <button @click="editing = true" class="px-3 py-1 border rounded-full text-sm hover:bg-blue-50 hover:border-blue-300 hover:text-blue-600 transition-colors">
                                編集
                            </button>
                            <form method="POST" action="{{ route('community.posts.destroy', $post->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('本当に削除しますか？')" class="px-3 py-1 border rounded-full text-sm hover:bg-red-50 hover:border-red-300 hover:text-red-600 transition-colors">
                                    削除
                                </button>
                            </form>
                        </div>
                    @endif
                </div>

                <p class="text-sm text-gray-600 mb-3 whitespace-pre-wrap">{{ $post->body }}</p>

                {{-- 詳細情報 --}}
                @if($post->date || $post->place || $post->target || $post->contact_info)
                    <div class="bg-gray-50 rounded-lg p-3">
                        <div class="grid grid-cols-2 gap-3 text-sm">
                            @if($post->date)
                                <div>
                                    <span class="font-semibold text-gray-700">日時:</span>
                                    <span class="text-gray-600">{{ \Carbon\Carbon::parse($post->date)->format('Y年m月d日') }}</span>
                                </div>
                            @endif
                            @if($post->place)
                                <div>
                                    <span class="font-semibold text-gray-700">場所:</span>
                                    <span class="text-gray-600">{{ $post->place }}</span>
                                </div>
                            @endif
                            @if($post->target)
                                <div>
                                    <span class="font-semibold text-gray-700">対象:</span>
                                    <span class="text-gray-600">{{ $post->target }}</span>
                                </div>
                            @endif
                            @if($post->contact_info)
                                <div>
                                    <span class="font-semibold text-gray-700">連絡先:</span>
                                    <span class="text-gray-600">{{ $post->contact_info }}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif

                {{-- コメントセクション --}}
                @include('community.components.comment-section', ['post' => $post])
            </div>

            {{-- 編集モード --}}
            <div x-show="editing" x-transition>
                <form method="POST" action="{{ route('community.posts.update', $post->id) }}" class="space-y-3">
                    @csrf
                    @method('PUT')

                    <input type="text" name="title" value="{{ $post->title }}" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <textarea name="body" rows="4" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none">{{ $post->body }}</textarea>

                    <div class="grid grid-cols-2 gap-3">
                        <select name="type" class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="companion" {{ $post->type == 'companion' ? 'selected' : '' }}>同行者募集</option>
                            <option value="trade" {{ $post->type == 'trade' ? 'selected' : '' }}>トレード</option>
                        </select>
                        <input type="date" name="date" value="{{ $post->date ? \Carbon\Carbon::parse($post->date)->format('Y-m-d') : '' }}" class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <input type="text" name="place" value="{{ $post->place }}" placeholder="場所" class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <input type="text" name="target" value="{{ $post->target }}" placeholder="対象" required class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <input type="text" name="contact_info" value="{{ $post->contact_info }}" placeholder="連絡先" required class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="flex justify-end space-x-2">
                        <button type="button" @click="editing = false" class="px-4 py-2 border rounded-lg hover:bg-gray-50 transition-colors">
                            キャンセル
                        </button>
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors">
                            保存
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
