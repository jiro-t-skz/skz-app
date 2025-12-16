<div x-data="{ showForm:false }">
    {{-- 投稿ボタン（フォームが閉じている時）--}}
    <div x-show="!showForm" class="mb-6 flex items-start space-x-3">
        <div class="flex-shrink-0">
            <div class="w-12 h-12 bg-gray-300 rounded-full"></div>
        </div>
        <button
            @click="showForm = true" Transition-colors
            class="flex-1 px-4 py-3 bg-gray-100 border-gray-300 rounded-lg text-left text-gray-500 hover:bg-gray-50 transition-colors">
                同行者募集・トレードについて投稿しよう！
        </button>
    </div>

    {{-- 投稿フォーム（開いている時）--}}
    <div x-show="showForm"
    x-transition
    class="mb-6 bg-gray-50 p-4 rounded-lg border">
    <form method="POST" action="{{ route('community.posts.store')}}">
        @csrf

        <input
            type="text"
            name="title"
            placeholder="タイトル"
            required
            class="w-full mb-3 px-4 py-3 bg-white border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">

         <textarea
                name="body"
                placeholder="内容を入力してください"
                rows="4"
                required
                class="w-full mb-3 px-4 py-3 bg-white border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none"></textarea>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <input type="date" name="date" 
                       class="px-4 py-3 bg-white border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <input type="text" name="place" placeholder="場所" 
                       class="px-4 py-3 bg-white border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <input type="text" name="target" placeholder="対象" 
                       class="px-4 py-3 bg-white border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <input type="text" name="contact_info" placeholder="連絡先（例: X: @username）" 
                       class="px-4 py-3 bg-white border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

        <div class="flex justify-end space-x-3">
            <button
                type="button"
                @click="showForm=false"
                class="px-6 py-2 border rounded-lg hover:bg-gray-50 transition-colors">
                キャンセル
            </button>
            <button
            type="submit"
            class="px-6 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors">
                投稿
            </button>
        </div>
    </form>
    </div>

{{-- -検索バー --}}
<form method="GET" action="{{ route('community.index') }}" class="mb-6 flex space-x-3">
        <div class="flex-1 relative">
            <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
         </svg>
        </span>
        <input
            type="text"
            name="search"
            value="{{$search ?? ''}}"
            placeholder="同行者募集・トレードを検索"
            class="w-full pl-10 pr-4 py-3 bg-gray-100 border  rounded-lg focus:outline-none focus:ring-blue-500">
    </div>
    <button type="submit" class="px-6 py-3 bg-gray-100 border rounded-lg hover:bg-gray-200 transition-colors"
    >検索</button>
</form>

{{--投稿リスト--}}
<div class="space-y-4">
    @forelse($posts as $post)
        <div class="bg-white border rounded-lg p-5 hover:shadow-md transition-shadow"
          x-data="{editing:false}">
            <div class= "flex item-start space-x-3">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-gray-300 rounded-full flex items-center justify-center text-white font-bold">
                        {{substr($post->user->name, 0, 1)}}
                    </div>
                </div>

    {{--投稿内容--}}
        <div class="flex-1">
            <div x-show="!editing">
            <div class="flex items-start justify-between mb-2">
                <div class="flex-1">
                    <h3 class="font-bold text-lg mb-1">{{$post->title}}</h3>
                    <p class="font-semibold">{{$post->user->name}}</p>
                    <p class="text-sm text-gray-500">{{$post->created_at->diffForHumans()}}</p>
                </div>

            {{-- 自分の投稿なら編集・削除ボタン --}}
            @if($post->user_id === Auth::id())
            <div class="flex space-x-2">
                <button
                    @click="editing = true"
                   class="px-3 py-1 border rounded-full text-sm hover:bg-blue-50 hover:border-blue-300 hover:text-blue-600 transition-colors "
                >編集
                </button>
                <form method="POST" action="{{route('community.posts.destroy',$post->id)}}">

                    @csrf
                    @method('DELETE')
                <button
                    type="submit"
                    onclick="return confirm('本当に削除しますか？')"
                    class="px-3 py-1 border rounded-full text-sm hover:bg-red-50 hover:border-red-300 hover:text-red-600 transition-colors">
                    削除
                </button>
                </form>
            </div>
            @endif
        </div>

        <p class="text-sm text-gray-600 mb-3 whitespace-pre-wrap">{{$post->body}}</p>

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
                    </div>


    {{--編集モード--}}
    <div x-show="editing" x-transition>
        <form method="POST" action="{{ route('community.posts.update', $post->id)}}" class="space-y-3">

        @csrf
        @method('PUT')

        {{--タイトル--}}
        <input
            type="text"
            name="title"
            value="{{ $post->title}}"
            required
            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">


        {{-- 本文 --}}
        <textarea
            name="body"
            rows="4"
            required
            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none">{{ $post->body }}</textarea>

        {{-- グリッドレイアウト(2列) --}}
        <div class="grid grid-cols-2 gap-3">
            <input 
                type="date" 
                name="date" 
                value="{{ $post->date ? \Carbon\Carbon::parse($post->date)->format('Y-m-d') : '' }}"
                class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            <input 
                type="text" 
                name="place" 
                value="{{ $post->place }}"
                placeholder="場所" 
                class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            <input 
                type="text" 
                name="target" 
                value="{{ $post->target }}"
                placeholder="対象" 
                required
                class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            <input 
                type="text" 
                name="contact_info" 
                value="{{ $post->contact_info }}"
                placeholder="連絡先" 
                required
                 class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            {{-- ボタン --}}
             <div class="flex justify-end space-x-2">
                <button
                    type="button"
                    @click="editing = false"
                     class="px-4 py-2 border rounded-lg hover:bg-gray-50 transition-colors">
                    キャンセル
                </button>
                 <button
                    type="submit"
                     class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors">
                    保存
                </button>
            </div>
        </form>
    </div>
</div>
</div>
</div>


        @empty
            <div class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">投稿がありません</h3>
                <p class="mt-1 text-sm text-gray-500">最初の投稿を作成してみましょう!</p>
            </div>
        @endforelse
    </div>


    {{-- ページネーション --}}
    @if($posts->hasPages())
        <div class="mt-6">
            {{ $posts->links() }}
        </div>
    @endif
</div>