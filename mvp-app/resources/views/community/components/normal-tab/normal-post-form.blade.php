<div x-data="{
        showForm:false,
        previewUrl:null,
        selectImage(event){
        const file = event.target.files[0];
        if(!file){
        this.previewUrl = null;
        return;
        }

        if (file.size > 5 * 1024 * 1024) {
            alert('ファイルサイズは5MB以下にしてください');
            event.target.value = '';
            this.previewUrl = null;
            return;
        }

        const reader = new FileReader();
        reader.onload = (e) => {
            this.previewUrl = e.target.result;
        };
        reader.readAsDataURL(file);
    },
    removeImage() {
        this.previewUrl = null;
        this.$refs.fileInput.value = '';
    },
    resetForm() {
        this.previewUrl = null;
        this.showForm = false;
        this.$refs.fileInput.value = '';
        // テキストエリアもクリア
        this.$refs.bodyTextarea.value = '';
        if (this.$refs.titleInput) {
            this.$refs.titleInput.value = '';
        }
    }
}" x-cloak>

{{-- 投稿ボタン（フォームが閉じている時）--}}
    <div x-show="!showForm" class="mb-6 flex items-start space-x-3">
        <div class="flex-shrink-0">
            <div class="w-12 h-12
                        bg-gray-300 
                        rounded-full 
                        bg-gradient-to-br from-sakura-purple to-sakura-pink 
                        flex items-center 
                        justify-center 
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
                border-2 
                border-gray-200 
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
            今何してる？
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

        {{-- エラー表示 --}}
        @if($errors->any())
            <div class="mb-4 p-4 bg-red-50 border-2 border-red-200 rounded-lg">
                <ul class="text-red-600 text-sm space-y-1">
                    @foreach($errors->all() as $error)
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                            {{ $error }}
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('community.normal.posts.store') }}" enctype="multipart/form-data">
            @csrf

            {{-- タイトル入力（オプション） --}}
            @if(isset($showTitle) && $showTitle)
            <div class="mb-4">
                <label class="block text-sm font-semibold text-sakura-purple mb-2">
                    タイトル
                </label>
                <input
                    type="text"
                    name="title"
                    x-ref="titleInput"
                    placeholder="投稿のタイトルを入力してください"
                    value="{{ old('title') }}"
                    class="w-full px-4 py-3 
                           bg-white 
                           border-2 
                           border-sakura-pink 
                           rounded-lg 
                           text-sakura-purple 
                           focus:outline-none 
                           focus:ring-4 
                           focus:ring-sakura-purple/20 
                           focus:border-sakura-purple 
                           transition-all 
                           duration-300">
            </div>
            @endif

            <div class="mb-4">
                <label class="block text-sm font-semibold text-sakura-purple mb-2">
                    内容
                </label>
                <textarea
                    name="body"
                    x-ref="bodyTextarea"
                    placeholder="詳細な内容を入力してください&#10;例: 一緒にライブを楽しめる方を募集しています！"
                    rows="4"
                    required
                    class="w-full px-4 py-3 
                           bg-white border-2 
                           border-sakura-pink 
                           rounded-lg 
                           text-sakura-purple 
                           focus:outline-none 
                           focus:ring-4 
                           focus:ring-sakura-purple/20 
                           focus:border-sakura-purple 
                           resize-none 
                           transition-all 
                           duration-300">{{ old('body') }}</textarea>
            </div>

            {{-- 画像プレビューエリア --}}
            <div x-show="previewUrl" x-transition class="mb-4">
                <div class="relative group inline-block rounded-xl overflow-hidden border-2 border-sakura-pink/30 shadow-md">
                    <img :src="previewUrl" class="max-w-full max-h-80 object-contain bg-gray-50">
                    <button
                        type="button"
                        @click="removeImage()"
                        class="absolute top-3 right-3 w-9 h-9
                               bg-black/70
                               hover:bg-black 
                               text-white 
                               rounded-full 
                               flex items-center 
                               justify-center
                               opacity-80 hover:opacity-100 
                               transition-all 
                               duration-200 
                               shadow-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>

            {{-- 隠しファイル入力 --}}
            <input
                type="file"
                x-ref="fileInput"
                name="image"
                accept="image/*"
                @change="selectImage($event)"
                class="hidden">

            <div class="flex justify-between items-center pt-4 border-t-2 border-sakura-pink/30">
                {{-- 左側：画像アップロードアイコン --}}
                <button
                    type="button"
                    @click="$refs.fileInput.click()"
                    class="flex items-center gap-2 px-4 py-2 rounded-lg transition-all duration-300"
                    :class="previewUrl ? 'text-sakura-pink bg-sakura-pink/10' : 'text-sakura-purple hover:bg-sakura-pink/10'">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <span class="text-sm font-semibold" x-text="previewUrl ? '画像を変更' : '画像を追加'"></span>
                </button>

                {{-- 右側：アクションボタン --}}
                <div class="flex space-x-3">
                    <button
                        type="button"
                        @click="resetForm()"
                        class="px-6 py-3
                               border-2
                               border-sakura-purple
                               text-sakura-purple
                               font-semibold
                               rounded-lg
                               hover:bg-sakura-purple
                               hover:text-white
                               focus:outline-none
                               focus:ring-4
                               focus:ring-sakura-purple/30
                               transition-all duration-300
                               shadow-sm
                               hover:shadow-md">
                        キャンセル
                    </button>
                    <button
                        type="submit"
                        class="px-6 py-3 
                               bg-gradient-to-r from-sakura-purple to-sakura-pink 
                               text-white 
                               font-bold 
                               rounded-lg 
                               hover:from-sakura-purple-dark 
                               hover:to-sakura-pink-medium 
                               focus:outline-none focus:ring-4 
                               focus:ring-sakura-purple/30 
                               transition-all 
                               duration-300 
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
            </div>
        </form>
    </div>
</div>
