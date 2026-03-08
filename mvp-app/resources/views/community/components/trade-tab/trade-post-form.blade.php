<div x-data="{ showForm:false }">
    {{-- 投稿ボタン（フォームが閉じている時）--}}
    <div x-show="!showForm" class="mb-6 flex items-start space-x-3">
        <div class="flex-shrink-0">
            <div class="w-12 h-12
                        bg-gray-300
                        rounded-full
                        bg-gradient-to-br from-sakura-purple to-sakura-pink
                        flex items-center justify-center
                        shadow-md
                        border-2
                        border-sakura-pink">
                <span class="text-white font-bold text-lg font-serif">櫻</span>
            </div>
        </div>
        <button
            @click="showForm = true"
            class="flex-1 px-4 py-3
                   bg-white
                   border-2 border-gray-200
                   rounded-xl
                   text-left
                   text-gray-500
                   hover:bg-sakura-pink/10
                   focus:outline-none
                   focus:ring-4
                   focus:ring-sakura-pink
                   transition-all
                   duration-300
                   shadow-sm
                   hover:shadow-md">
                投稿しよう！
        </button>
    </div>

    {{-- 投稿フォーム（開いている時）--}}
    <div x-show="showForm"
        x-transition
        class="mb-6
               bg-gradient-to-br from-white to-sakura-pink/5
               p-6
               rounded-2xl
               border-2
               border-sakura-pink
               shadow-xl">

        <div class="flex items-center gap-3 mb-5 pb-4 border-b-2 border-sakura-pink/30">
            <div class="w-10 h-10 
                        rounded-full 
                        bg-gradient-to-br from-sakura-purple to-sakura-pink
                        flex items-center 
                        justify-center 
                        shadow-md">
                <span class="text-white font-bold text-base font-serif">櫻</span>
            </div>
            <h3 class="text-lg font-bold text-sakura-purple font-serif">新しい投稿を作成</h3>
        </div>

        <form method="POST" action="{{ route('community.trade.posts.store')}}">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-semibold text-sakura-purple mb-2">
                タイトル
                </label>
                <input
                    type="text"
                    name="title"
                    placeholder="例: 5/10 リアルミーグリ 同行者募集"
                    required
                    class="w-full px-4 py-3
                        bg-white
                        border-2 border-sakura-pink
                        rounded-lg
                        text-sakura-purple
                        placeholder-gray-400
                        focus:outline-none
                        focus:ring-4 focus:ring-sakura-purple/20
                        focus:border-sakura-purple
                        transition-all durtion-300">
                @error('title')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-5">
                <div>
                    <label class="block text-sm font-semibold text-sakura-purple mb-2">
                        種類
                    </label>
                    <select
                        name="type"
                        required
                        class="w-full px-4 py-3
                            bg-white
                            border-2 border-sakura-pink
                            rounded-lg
                            focus:outline-none
                            focus:ring-4 focus:ring-sakura-purple/20
                            focus:border-sakura-purple
                            transition-all duration-300">
                        <option value="" class="text-gray-500">選択してください</option>
                        <option value="companion">同行者募集</option>
                        <option value="trade">トレード</option>
                    </select>
                @error('type')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold text-sakura-purple mb-2">
                        日時
                    </label>
                    <input
                        type="date"
                        name="date"
                        value="{{ old('date') }}"
                        min="{{ date('Y-m-d') }}"
                        class="w-full px-4 py-3
                               bg-white
                               border-2 border-sakura-pink
                               rounded-lg
                               text-sakura-purple
                               focus:outline-none
                               focus:ring-4 focus:ring-sakura-purple/20
                               focus:border-sakura-purple
                               transition-all duration-300">
                        @error('date')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold text-sakura-purple mb-2">
                        場所
                    </label>
                    <input type="text"
                       name="place"
                       placeholder="例：京都パルスプラザ"
                       class="w-full px-4 py-3 
                               bg-white 
                               border-2 border-sakura-pink 
                               rounded-lg 
                               text-sakura-purple
                               placeholder-gray-400
                               focus:outline-none 
                               focus:ring-4 focus:ring-sakura-purple/20 
                               focus:border-sakura-purple 
                               transition-all duration-300">
                        @error('place')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-sakura-purple mb-2">
                        対象
                    </label>
                    <input type="text"
                           name="target"
                           placeholder="例：缶バッジ、ミーグリ"
                           class="w-full px-4 py-3
                               bg-white
                               border-2 border-sakura-pink
                               rounded-lg
                               text-sakura-purple
                               placeholder-gray-400
                               focus:outline-none
                               focus:ring-4 focus:ring-sakura-purple/20
                               focus:border-sakura-purple
                               transition-all duration-300">
                        @error('target')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                </div>
            </div>

            <div class="mb-5">
                <label class="block text-sm font-semibold text-sakura-purple mb-2">
                    連絡先
                </label>
                <input type="text"
                       name="contact_info"
                       required
                       placeholder="@sakurazaka_fan / LINE: sakura123"
                       class="w-full px-4 py-3
                           bg-white
                           border-2 border-sakura-pink
                           rounded-lg
                           text-sakura-purple
                           placeholder-gray-400
                           focus:outline-none
                           focus:ring-4 focus:ring-sakura-purple/20
                           focus:border-sakura-purple
                           transition-all duration-300">
                        @error('contact_info')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-semibold text-sakura-purple mb-2">
                    内容
                </label>
                <textarea
                    name="body"
                    placeholder="詳細な内容を入力してください&#10;例: 一緒にライブを楽しめる方を募集しています！"
                    rows="4"
                    required
                    class="w-full px-4 py-3
                        bg-white
                        border-2 border-sakura-pink
                        rounded-lg
                        text-sakura-purple
                        focus:outline-none
                        focus:ring-4 focus:ring-sakura-purple/20
                        focus:border-sakura-purple
                        resize-none
                        transition-all duration-300"></textarea>
                    @error('body')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
            </div>

            <div class="flex justify-end space-x-3 pt-4 border-t-2 border-sakura-pink/30">
                <button
                    type="button"
                    @click="showForm=false"
                    class="px-6 py-3
                           border-2 border-sakura-purple
                           text-sakura-purple
                           font-semibold
                           rounded-lg
                           hover:bg-sakura-purple hover:text-white
                           focus:outline-none focus:ring-4 focus:ring-sakura-purple/30
                           transition-duration-300
                           shadow-sm hover:shadow-md">
                    キャンセル
                </button>
                <button
                    type="submit"
                    class="px-6 py-3
                           bg-gradient-to-r from-sakura-purple to-sakura-pink
                           text-white
                           font-bold
                           rounded-lg
                           hover:from-sakura-purple-dark hover:to-sakura-pink-medium
                           focus:outline-none focus:ring-4 focus:ring-sakura-purple/30
                           transition-all duration-300
                           shadow-md
                           hover:shadow-lg
                           transform
                           hover:scale-105">
                    <span class="flex items-center gap-2">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                        </svg>
                        投稿
                    </span>
                </button>
            </div>
        </form>
    </div>
</div>


