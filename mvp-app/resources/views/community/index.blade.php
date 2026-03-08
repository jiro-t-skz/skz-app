<x-app-layout>

    {{--  メインコンテンツ --}}
    <div class="py-6 sm:py-12
                bg-gradient-to-br from-white via-sakura-pink/40 to-sakura-purple/40">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white
                        overflow-hidden 
                        shadow-xl sm:rounded-2xl 
                        border-2 border-sakura-purple/20">
                <div class="p-4 sm:p-6"
                x-data="{activeTab:'{{ $activeTab ?? 'trade' }}',showPostForm:false}">

                    {{-- タイトル --}}
                    <div class="flex flex-col items-center mb-6 sm:mb-0">
                        <div class="mb-4 w-20 h-20 
                                    bg-gradient-to-br from-sakura-purple to-sakura-pink
                                    rounded-2xl
                                    flex items-center
                                    justify-center
                                    shadow-xl">
                            <span class="text-white text-3xl font-bold font-serif">櫻</span>
                        </div>
                        <p class="text-gray-600">Buddies同士で交流しよう!</p>
                    </div>

                    {{-- 成功メッセージ --}}
                    @if(session('success'))
                        <div class="mb-4 sm:mb-6 p-3 sm:p-4
                                    bg-sakura-pink/20
                                    border-2 border-sakura-pink
                                    rounded-lg
                                    text-sakura-purple
                                    text-sm sm:text-base">
                            {{session('success')}}
                        </div>
                    @endif

                    {{-- タブナビゲーション --}}
                    <div class="bg-white
                                rounded-lg
                                shadow-sm
                                mb-4 sm:mb-6">
                        <div class="flex border-b-2 
                                    border-sakura-pink/30
                                    mb-4 
                                    overflow-x-auto
                                    scrollbar-hide">
                            <button
                                @click="activeTab = 'normal'"
                                :class="activeTab === 'normal' ? 'border-b-2 border-sakura-pink text-sakura-pink font-semibold' : 'text-gray-500'"
                                class="flex-shrink-0 py-3 sm:py-4 px-3 sm:px-6
                                       text-sm sm:text-base text-center
                                       font-medium
                                       hover:text-sakura-pink
                                       transition-colors
                                       whitespace-nowrap">
                                投稿
                            </button>

                            <button
                                @click="activeTab = 'offmeeting'"
                                :class="activeTab === 'offmeeting' ? 'border-b-2 border-sakura-pink text-sakura-pink font-semibold' : 'text-gray-500'"
                                class="flex-shrink-0 py-3 sm:py-4 px-3 sm:px-6 
                                       text-sm sm:text-base text-center 
                                       font-medium 
                                       hover:text-sakura-pink 
                                       transition-colors 
                                       whitespace-nowrap">
                                オフ会
                            </button>

                            <button
                                @click = "activeTab = 'trade'"
                                :class = "activeTab === 'trade' ? 'border-b-2 border-sakura-pink text-sakura-pink font-semibold' : 'text-gray-500'"
                                class="flex-shrink-0 
                                       py-3 sm:py-4 px-3 sm:px-6 
                                       text-sm sm:text-base text-center 
                                       font-medium 
                                       hover:text-sakura-pink 
                                       transition-colors 
                                       whitespace-nowrap">
                                同行者募集・トレード
                            </button>
                        </div>

                        {{-- タブの中身 --}}
                        <div class="pt-2 sm:pt-4">
                        <div x-show = "activeTab === 'normal'" x-cloak x-transition>
                                @include('community.partials.normal-tab')
                            </div>


                            <div x-show = "activeTab === 'offmeeting'" x-cloak x-transition>
                                @include('community.partials.offmeeting-tab')
                            </div>

                            <div x-show="activeTab === 'trade'" x-cloak x-transition>
                                @include('community.partials.trade-tab-ref')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
