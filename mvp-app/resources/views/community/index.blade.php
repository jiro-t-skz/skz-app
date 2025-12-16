<x-app-layout>
    {{-- ヘッダー部分（ページタイトル） --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            {{ __('コミュニティ') }}
        </h2>
    </x-slot>

    {{--  メインコンテンツ --}}


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6"
                x-data="{activeTab:'trade',showPostForm:false}">

                {{-- タイトル --}}
                <div class="flex flex-col items-center mb-8">
                    <h2 class="text-2xl font-bold mb-2">コミュニティ</h2>
                    <p class="text-gray-600">Buddies同士で交流しよう!</p>
                </div>

                {{-- 成功メッセージ --}}
                @if(session('success'))
                    <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700">
                        {session{'success'}}
                    </div>
                @endif

            {{-- タブナビゲーション --}}
             <div class="bg-white rounded-lg shadow-sm mb-6">
                <div class="flex border-b border-gray-200">
                    <button
                        @click="activeTab = 'posts'"
                        :class="activeTab === 'posts' ? 'bg-gray-200 text-gray-900' : 'bg-gray-100 text-gray-600'"
                        class="flex-1 py-4 px-6 text-center font-medium rounded-tl-lg hover:bg-gray-150 transition-colors">投稿
                    </button>

                    <button
                        @click="activeTab = 'meetup'"
                        :class="activeTab === 'meetup' ? 'bg-gray-200 text-gray-900' : 'bg-gray-100 text-gray-600'"
                        class="flex-1 py-4 px-6 text-center font-medium hover:bg-gray-150 transition-colors">
                        オフ会
                    </button>

                    <button
                        @click = "activeTab = 'trade'"
                        :class = "activeTab === 'trade' ? 'bg-gray-200 text-gray-900' : 'bg-gray-100 text-gray-600'"
                        class="flex-1 py-4 px-6 text-center font-medium hover:bg-gray-150 transition-colors">
                        同行者募集・トレード
                    </button>
                </div>
            {{-- タブの中''身 --}}
            <div>
                <div x-show = "activeTab === 'posts'" x-transition>
                    <p class="text-gray-500 text-center py-8">投稿タブ（今後実装）</p>
                </div>


                <div x-show = "activeTab === 'meetup'" x-transition>
                    <p class="text-gray-500 text-center py-8">オフ会タブ（今後実装）</p>
                </div>

                <div x-show="activeTab === 'trade'" x-transition>
                    @include('community.partials.trade-tab')
                </div>
            </div>
        </div>
     </div>
 </div>
</div>
</div>



</x-app-layout>