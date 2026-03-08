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
     x-data="{ editing: false }" x-cloak>

    <div class="flex items-start space-x-3">
        {{-- ユーザーアイコン --}}
        <div class="flex-shrink-0">
        @include('community.components.user-avatar', ['user' => $offmeetingPost->user])
        </div>

        {{-- 投稿内容 --}}
        <div class="flex-1 min-w-0">
            {{-- 通常表示モード --}}
            <div x-show="!editing">
                <div class="mb-3">
                    {{-- タイトル --}}
                    <h3 class="font-bold text-base sm:text-lg text-sakura-purple break-words mb-2">
                        {{ $offmeetingPost->title }}
                    </h3>
                    <div class="mb-3">
                        {{--ユーザーネーム--}}
                        <span class="font-semibold mr-2">{{ $offmeetingPost->user->name }}</span>
                    </div>
                    {{--時間--}}
                    <p class="text-sm text-gray-500">{{ $offmeetingPost->created_at->diffForHumans() }}</p>
                </div>


                {{-- 詳細情報 レスポンシブ対応--}}
                @if($offmeetingPost->date || $offmeetingPost->place || $offmeetingPost->target || $offmeetingPost->contact_info)
                    <div class="bg-gradient-to-br from-sakura-pink/5 to-white rounded-xl p-3 sm:p-4 border border-sakura-pink/30 mb-3">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 sm:gap-3 text-xs sm:text-sm">
                            @if($offmeetingPost->date)
                                <div class="flex-1 min-w-0">
                                    <span class="font-bold text-sakura-purple">日時:</span>
                                    <span class="text-gray-700 ml-1 break-words">{{ \Carbon\Carbon::parse($offmeetingPost->date)->format('Y年m月d日') }}</span>
                                </div>
                            @endif

                            @if($offmeetingPost->prefecture)
                                 <div class="flex-1 min-w-0">
                                    <span class="font-bold text-sakura-purple ">都道府県:</span>
                                    <span class="text-gray-700 ml-1 break-words">{{ $offmeetingPost->prefecture }}</span>
                                </div>
                            @endif
                            @if($offmeetingPost->place)
                                <div class="flex-1 min-w-0">
                                    <span class="font-bold text-sakura-purple">開催場所:</span>
                                    <span class="text-gray-700 ml-1 break-words">{{ $offmeetingPost->place }}</span>
                                </div>
                            @endif
                            @if($offmeetingPost->capacity)
                                <div class="flex-1 min-w-0">
                                    <span class="font-bold text-sakura-purple">定員:</span>
                                    <span class="text-gray-700 ml-1 break-words">{{ $offmeetingPost->capacity }}人</span>
                                </div>
                            @endif
                            @if($offmeetingPost->contact_info)
                                <div class="flex-1 min-w-0">
                                    <span class="font-bold text-sakura-purple">連絡先:</span>
                                    <span class="text-gray-700 ml-1 break-words">{{ $offmeetingPost->contact_info }}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif

                {{--本文--}}
                <p class="text-sm sm:text-base text-gray-700 mb-4 whitespace-pre-wrap break-words">{{$offmeetingPost->body}}</p>

                {{--編集・削除ボタン（詳細情報の下、コンパクト版）--}}
                @if($offmeetingPost->user_id === Auth::id())
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
                            </svg>編集
                        </button>
                        <form method="POST" action="{{route('community.offmeeting.posts.destroy',$offmeetingPost->id)}}">
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
                                  </svg>削除
                            </button>
                        </form>
                    </div>
                @endif

                {{-- コメントセクション --}}
                @include('community.components.offmeeting-tab.offmeeting-comment-section', ['offmeetingPost' => $offmeetingPost])
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
                   action="{{ route('community.offmeeting.posts.update', $offmeetingPost->id) }}"
                   class="space-y-3 sm:space-y-4">
                    @csrf
                    @method('PUT')
                    {{--タイトル--}}
                    <div>
                        <label class="block text-xs sm:text-sm font-semibold text-sakura-purple mb-1.5">
                            タイトル
                        </label>
                        <input
                            type="text"
                            name="title"
                            value="{{ old('title', $offmeetingPost->title) }}"
                            required class="w-full
                                            px-3 sm:px-4 py-2 sm:py-3
                                            border-2 border-sakura-pink
                                            rounded-lg
                                            text-sakura-purple
                                            text-sm sm:text-base
                                            focus:outline-none
                                            focus:ring-4 focus:ring-sakura-purple/20
                                            focus:border-sakura-purple">
                                    @error('title')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4">
                        <div>
                            <label class="block text-xs sm:text-sm font-semibold text-sakura-purple mb-1.5">
                                日時
                            </label>
                            <input
                                type="date"
                                name="date"
                                value="{{ $offmeetingPost->date ? \Carbon\Carbon::parse($offmeetingPost->date)->format('Y-m-d') : '' }}"
                                min="{{ date('Y-m-d') }}"
                                class="w-full px-3 sm:px-4 py-2 sm:py-3
                                           border-2 border-sakura-pink
                                           rounded-lg
                                           text-sakura-purple text-sm sm:text-base
                                           focus:outline-none
                                           focus:ring-4 focus:ring-sakura-purple/20
                                           focus:border-sakura-purple
                                           transition-all
                                           duration-300">
                                    @error('date')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                        </div>

                        <div>
                            <label class="block text-xs sm:text-sm font-semibold text-sakura-purple mb-1.5">
                                都道府県
                            </label>
                            <select
                                name="prefecture"
                                required
                                class="w-full px-4 py-3
                                bg-white
                                border-2 border-sakura-pink
                                rounded-lg
                                focus:outline-none
                                focus:ring-4 focus:ring-sakura-purple/20
                                focus:border-sakura-purple
                                transition-all duration-300
                                text-sakura-purple
                                ">
                                <option value="" class="text-sakura-purple">選択してください</option>
                                    @foreach($prefectures as $pref)
                                        <option value="{{ $pref }}"  @selected(old('prefecture',$offmeetingPost->prefecture) === $pref)>
                                            {{ $pref }}
                                        </option>
                                    @endforeach
                            </select>
                            @error('prefecture')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-xs sm:text-sm font-semibold text-sakura-purple mb-1.5">
                                場所
                            </label>
                            <input
                                type="text"
                                name="place"
                                value="{{ $offmeetingPost->place }}"
                                placeholder="場所"
                                class="w-full px-3 sm:px-4 py-2 sm:py-3
                                           border-2 border-sakura-pink
                                           rounded-lg
                                           text-sakura-purple text-sm sm:text-base
                                           focus:outline-none
                                           focus:ring-4 focus:ring-sakura-purple/20
                                           focus:border-sakura-purple
                                           transition-all duration-300">
                                    @error('place')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                        </div>

                        <div>
                            <label class="block text-xs sm:text-sm font-semibold text-sakura-purple mb-1.5">
                                定員
                            </label>
                            <select
                                name="capacity"
                                class="w-full px-4 py-3 
                                       bg-white border-2 border-sakura-pink
                                       rounded-lg
                                       text-sakura-purple 
                                       focus:outline-none 
                                       focus:ring-4 focus:ring-sakura-purple/20
                                       focus:border-sakura-purple
                                       transition-all duration-300">
                                <option value="" class="text-sakura-purple">選択してください（任意）</option>
                                    @for($i = 1; $i <= 50; $i++)
                                        <option value="{{ $i }}" @selected(old('capacity', $offmeetingPost->capacity ?? '') == $i)>
                                            {{ $i }}人
                                        </option>
                                    @endfor
                                <option value="999" @selected(old('capacity', $offmeetingPost->capacity ?? '') == 999)>制限なし</option>
                            </select>
                            @error('capacity')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-xs sm:text-sm font-semibold text-sakura-purple mb-1.5">
                                連絡先
                            </label>
                            <input type="text"
                                   name="contact_info"
                                   value="{{ $offmeetingPost->contact_info }}"
                                   placeholder="連絡先"
                                   required
                                   class="w-full px-3 sm:px-4 py-2 sm:py-3
                                           border-2 border-sakura-pink
                                           rounded-lg
                                           text-sakura-purple text-sm sm:text-base
                                           focus:outline-none
                                           focus:ring-4 focus:ling-sakura-purple/20
                                           focus:border-sakura-purple
                                           transition-all duration-300">
                        </div>
                     </div>
                     <div>
                        <label class="block text-xs sm:text-sm font-semibold text-sakura-purple mb-1.5">
                            内容
                        </label>
                        <textarea 
                            name="body" 
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
                                   transition-all duration-300">{{ $offmeetingPost->body }}
                        </textarea>
                        @error('body')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="flex flex-col sm:flex-row gap-2 sm:gap-3 pt-3 sm:pt-4 border-t-2 border-sakura-pink/30">
                        <button 
                            type="button" 
                            @click="editing = false" 
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
                </form>
            </div>
        </div>
    </div>
</div>

