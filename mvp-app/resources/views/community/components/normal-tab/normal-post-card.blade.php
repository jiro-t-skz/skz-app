<div class="bg-white
            border-2
            border-sakura-pink
            rounded-xl
            p-4
            sm:p-5
            hover:shadow-xl
            hover:border-sakura-purple/50
            transition-all
            duration-300"
     x-data="{
         editing: false,
         previewUrl: null,
         removeImageFlag: false,
         hasExistingImage: @js(!!$normalPost->image_url),

         // フォームと同じ画像選択ロジック
         selectImage(event) {
             const file = event.target.files[0];
             if (!file) {
                 this.previewUrl = null;
                 return;
             }

             // フォームと同じバリデーション
             if (file.size > 5 * 1024 * 1024) {
                 alert('ファイルサイズは5MB以下にしてください');
                 event.target.value = '';
                 this.previewUrl = null;
                 return;
             }

             // 削除フラグをリセット
             this.removeImageFlag = false;

             // フォームと同じプレビュー生成
             const reader = new FileReader();
             reader.onload = (e) => {
                 this.previewUrl = e.target.result;
             };
             reader.readAsDataURL(file);
         },

         // フォームと同じ削除処理
         removeImage() {
             this.previewUrl = null;
             this.removeImageFlag = true; // 編集特有：既存画像削除フラグ
             if (this.$refs.fileInput) {
                 this.$refs.fileInput.value = '';
             }
         },

         // フォームのresetForm()に相当
         resetForm() {
             this.editing = false;
             this.previewUrl = null;
             this.removeImageFlag = false;
             if (this.$refs.fileInput) {
                 this.$refs.fileInput.value = '';
             }
             // テキストエリアを元の値に戻す
             if (this.$refs.bodyTextarea) {
                 this.$refs.bodyTextarea.value = @js($normalPost->body);
             }
         }
     }" x-cloak>

    <div class="flex items-start space-x-3">
        {{-- ユーザーアイコン --}}
        <div class="flex-shrink-0">
            @include('community.components.user-avatar', ['user' => $normalPost->user])
        </div>

        {{-- 投稿内容 --}}
        <div class="flex-1 min-w-0">
            {{-- 通常表示モード --}}
            <div x-show="!editing">
                <div class="mb-3">
                    {{--ユーザーネーム--}}
                    <span class="font-semibold mr-2">{{ $normalPost->user->name }}</span>
                    {{--時間--}}
                    <span class="text-sm text-gray-500">{{ $normalPost->created_at->diffForHumans() }}</span>
                </div>

                {{--本文--}}
                <p class="text-sm sm:text-base text-gray-700 mb-4 whitespace-pre-wrap break-words">{{$normalPost->body}}</p>

                @if($normalPost->image_url)
                    <div class="mt-4 mb-4">
                        <img
                            src="{{ asset('storage/' . $normalPost->image_url) }}"
                            alt="投稿画像"
                            class="w-full object-contain rounded-xl border-2 border-gray-200 cursor-pointer hover:opacity-95 transition-opacity">
                    </div>
                @endif


                {{--編集・削除ボタン（詳細情報の下、コンパクト版）--}}
                @if($normalPost->user_id === Auth::id())
                    <div class="flex gap-2 mb-3">
                        <button
                            @click="editing = true"
                            class="px-2.5 py-1
                                border border-sakura-purple
                                text-sakura-purple
                                rounded-md text-xs font-medium
                                hover:bg-sakura-purple hover:text-white
                                focus:outline-none focus:ring-2 focus:ring-sakura-purple/30
                                transition-all duration-200
                                flex items-center gap-1">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                            </svg>
                        編集
                        </button>

                        <form method="POST" action="{{route('community.normal.posts.destroy',$normalPost->id)}}">
                            @csrf
                            @method('DELETE')
                            <button
                                type='submit'
                                onclick="return confirm('本当に削除しますか？')"
                                class="px-2.5 py-1
                                    border border-red-400
                                    text-red-500
                                    rounded-md text-xs font-medium
                                    hover:bg-red-500 hover:text-white hover:border-red-500
                                    focus:outline-none focus:ring-2 focus:ring-red-300
                                    transition-all duration-200
                                    flex items-center gap-1">
                                  <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                  </svg>
                                  削除
                            </button>
                        </form>
                    </div>
                @endif
                {{-- コメントセクション --}}
                @include('community.components.normal-tab.normal-comment-section', ['normalPost' => $normalPost])
            </div>

            {{-- 編集モード --}}
            <div x-show="editing" 
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 transform scale-95"
                 x-transition:enter-end="opacity-100 transform scale-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 transform scale-100"
                 x-transition:leave-end="opacity-0 transform scale-95">

                <form method="POST"
                  action="{{ route('community.normal.posts.update', $normalPost->id) }}"
                  enctype="multipart/form-data" class="space-y-3 sm:space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-xs sm:text-sm font-semibold text-sakura-purple mb-1.5">
                            内容
                        </label>
                        <textarea
                            name="body"
                            x-ref="bodyTextarea"
                            rows="4"
                            required
                            class="w-full px-3 sm:px-4 py-2 sm:py-3
                                   border-2 border-sakura-pink
                                   rounded-lg
                                   text-sakura-purple text-sm sm:text-base
                                   focus:outline-none
                                   focus:ring-4 focus:ring-sakura-purple/20
                                   focus:border-sakura-purple
                                   resize-none
                                   transition-all duration-300">{{ old('body', $normalPost->body) }}</textarea>
                    </div>

                    <div x-show ="previewUrl" x-transition class="mb-4">
                        <div class="relative
                                    inline-block
                                    rounded-xl
                                    overflow-hidden
                                    border-2
                                    border-sakura-pink/30
                                    shadow-md">
                            <img :src="previewUrl" class="max-w-full max-h-80 object-contain bg-gray-50">
                            <button
                                type="button"
                                @click="removeImage()"
                                class="absolute top-1 right-1 z-10
                                       w-7 h-7
                                       bg-red-500 hover:bg-red-600
                                       text-white rounded-full
                                       flex items-center justify-center
                                       shadow-lg transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                    {{-- 既存画像の表示 --}}
                    @if($normalPost->image_url)
                        <div x-show="!previewUrl && !removeImageFlag" class="mb-4">
                            <div class="relative inline-block rounded-xl overflow-hidden border-2 border-gray-300 shadow-md">
                                <img src="{{asset('storage/'. $normalPost->image_url)}}"
                                alt="現在の画像"
                                class="max-w-full max-h-80 object-contain bg-gray-50">
                                <button
                                    type="button"
                                    @click="removeImage()"
                                    class="absolute top-2 right-2 w-8 h-8 bg-gray-600 hover:bg-red-500 text-white rounded-full flex items-center justify-center shadow-lg transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                                <span class="absolute bottom-0 left-0 bg-gray-600 text-white text-xs px-3 py-1 rounded-tr-lg">
                                    現在の画像
                                </span>
                            </div>
                        </div>
                    @endif

                     <div x-show="removeImageFlag && !previewUrl" x-transition class="mb-4">
                        <div class="flex items-center gap-2 p-3 bg-red-50 border-2 border-red-200 rounded-lg text-sm">
                            <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            <span class="text-red-700 font-semibold">画像は削除されます</span>
                            <button type="button" 
                                    @click="removeImageFlag = false" 
                                    class="text-xs text-blue-600 hover:text-blue-800 hover:underline ml-auto font-semibold">
                                元に戻す
                            </button>
                        </div>
                    </div>


                    {{-- 削除フラグ用隠しフィールド --}}
                    <input type="hidden" name="remove_image" :value="removeImageFlag ? '1' : '0' ">

                    {{-- 隠しファイル入力 --}}
                    <input 
                        type="file"
                        x-ref="fileInput"
                        name="image"
                        accept="image/*"
                        @change="selectImage($event)"
                        class="hidden">

                    <div class="flex flex-col sm:flex-row gap-2 sm:gap-3 pt-3 sm:pt-4 border-t-2 border-sakura-pink/30">
                        <button
                            type="button"
                            @click="resetForm()"
                            class="w-full sm:flex-1 px-4 sm:px-6 py-2.5 sm:py-3
                                   border-2 border-sakura-purple
                                   text-sakura-purple
                                   font-semibold
                                   rounded-lg text-sm sm:text-base
                                   hover:bg-sakura-purple hover:text-white
                                   focus:outline-none focus:ring-4 focus:ring-sakura-purple/30
                                   transition-all duration-300">
                            キャンセル
                        </button>
                        <button
                            type="submit"
                            class="w-full sm:flex-1 px-4 sm:px-6 py-2.5 sm:py-3
                                   bg-gradient-to-r from-sakura-purple to-sakura-pink
                                   text-white
                                   font-bold
                                   rounded-lg text-sm sm:text-base
                                   hover:from-sakura-purple-dark hover:to-sakura-pink-medium
                                   focus:outline-none focus:ring-4 focus:ring-sakura-purple/30
                                   transition-all duration-300
                                   shadow-md hover:shadow-lg
                                   transform hover:scale-105
                                   flex items-center justify-center gap-2">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M7.707 10.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V6h5a2 2 0 012 2v7a2 2 0 01-2 2H4a2 2 0 01-2-2V8a2 2 0 012-2h5v5.586l-1.293-1.293zM9 4a1 1 0 012 0v2H9V4z"></path>
                            </svg>
                            保存
                        </button>
                    </div>
                    {{-- 画像アップロードボタンを下部に配置 --}}
                    <div class="flex justify-center pt-2">
                        <button
                            type="button"
                            @click="$refs.fileInput.click()"
                            class="flex items-center gap-2 px-4 py-2 rounded-lg transition-all duration-300"
                            :class="previewUrl ? 'text-sakura-pink bg-sakura-pink/10' : 'text-sakura-purple hover:bg-sakura-pink/10'">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24  '画像を変更' : '画像を追加'">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span class="text-sm font-semibold" x-text="(previewUrl || hasExistingImage)? '画像を変更' : '画像を追加'"></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>













