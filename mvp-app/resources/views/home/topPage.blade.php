@php
    $slides = [
        ['image' => asset('images/hero/L1.jpeg'), 'alt' => '櫻坂46ライブ会場 マリンメッセ福岡'],
        ['image' => asset('images/hero/L3.jpeg'), 'alt' => '櫻坂46とライブ会場 Z0Z0マリンスタジアム'],
        ['image' => asset('images/hero/n3.jpeg'), 'alt' => 'ミーグリ アクスタショーケース'],
        ['image' => asset('images/hero/n-1.jpeg'), 'alt' => 'れなあのオムライス'],
        ['image' => asset('images/hero/n-2.jpeg'), 'alt' => 'ライブ会場'],
        ['image' => asset('images/hero/t1.jpeg'), 'alt' => 'グッズ販売'],
    ];
@endphp


<x-app-layout>
     <div x-data="heroSlider(@js($slides))" x-init="startSlideShow()">

        {{-- ヒーローセクション（背景スライドショー） --}}
        <section class="relative overflow-hidden min-h-[600px] lg:min-h-[700px] flex items-center">
            {{-- 背景画像スライドショー --}}
            <div class="absolute inset-0 z-0">
                <template x-for="(slide, index) in slides" :key="index">
                    <div 
                        x-show="currentSlide === index"
                        class="absolute inset-0 bg-cover bg-center transform transition-all duration-[8000ms] ease-out"
                        :class="currentSlide === index ? 'scale-110' : 'scale-100'"
                        :style="`background-image: url('${slide.image}')`"
                        x-transition:enter="transition ease-out duration-1000"
                        x-transition:enter-start="opacity-0"
                        x-transition:enter-end="opacity-100"
                        x-transition:leave="transition ease-in duration-1000"
                        x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0">

                        <div class="absolute inset-0 bg-black/30"></div>
                    </div>
                </template>
            </div>

            {{-- 装飾的な要素（アニメーション） --}}
            <div class="absolute top-10 left-10 w-4 h-4 
                        bg-sakura-white/80
                        rounded-full
                        opacity-70
                        animate-pulse z-20"></div>
            <div class="absolute bottom-20 right-20 w-6 h-6
                        bg-sakura-white/60
                        rounded-full
                        opacity-50 
                        animate-pulse z-20"
                        style="animation-delay: 2s;"></div>
            <div class="absolute 
                        top-1/3 right-10 w-2 h-2
                        bg-sakura-pink-light/80
                        rounded-full
                        opacity-60
                        animate-pulse z-20"
                        style="animation-delay: 4s;"></div>
            
            {{-- コンテンツエリア --}}
            <div class="relative z-30 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                    
                    {{-- 左側：メッセージ --}}
                    <div class="text-center lg:text-left">
                        <h1 class="font-serif 
                                   text-xl sm:text-4xl lg:text-6xl 
                                   font-bold
                                   text-sakura-white
                                   leading-tight
                                   mb-6
                                   drop-shadow-lg
                                   whitespace-nowrap">Buddies同士で
                            <span class="text-sakura-pink-light drop-shadow-md">交流しよう！</span>
                        </h1>
                        <p class="text-base sm:text-xl lg:text-2xl text-sakura-white/95 mb-8 leading-relaxed drop-shadow-md font-medium">
                            櫻坂46を愛するファンのための特別な場所。<br class="hidden sm:inline">
                            推しへの想いを共有し、ライブの感動を語り合い、<br class="hidden sm:inline">
                            新しいBuddiesとの出会いを見つけよう。
                        </p>
                    </div>
                </div>
            </div>

            {{-- スライドナビゲーション --}}
            <div class="absolute bottom-8 left-1/2 transform   -translate-x-1/2 z-40 flex gap-3">
                <template x-for="(slide, index) in slides" :key="'indicator-' + index">
                    <button 
                        @click="goToSlide(index)"
                        class="transition-all duration-300
                               rounded-full
                               hover:scale-125 
                               focus:outline-none 
                               focus:ring-2 
                               focus:ring-sakura-white/50"
                        :class="currentSlide === index ? 'w-8 h-3 bg-sakura-white' : 'w-3 h-3 bg-sakura-white/60 hover:bg-sakura-white/80'"
                        :aria-label="'スライド ' + (index + 1) + 'へ移動'">
                    </button>
                </template>
            </div>
        </section>


        {{-- 機能紹介セクション --}}
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="text-center mb-8">
                <h2 class="font-serif text-3xl font-bold text-sakura-text-primary mb-4">3つのメイン機能</h2>
                <p class="text-sakura-text-tertiary">Buddiesのための特別な機能をご紹介</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                {{-- 投稿機能 --}}
                <div class="bg-sakura-white
                            rounded-2xl p-8 shadow-lg
                            border border-sakura-divider">
                    <div class="w-16 h-16
                                bg-gradient-to-br from-sakura-pink to-sakura-pink-medium
                                rounded-xl
                                flex items-center justify-center
                                text-3xl mb-6">
                        📝
                    </div>

                    <h3 class="text-2xl
                               font-bold
                               text-sakura-text-primary
                               mb-4 font-serif">画像・文章投稿</h3>
                    <p class="text-sakura-text-tertiary leading-relaxed">
                        ライブの感想、推しへの愛、グッズ紹介など、画像や文章で自由に投稿。Buddies同士でコメントし合って交流を深めよう。
                    </p>
                </div>

                {{-- オフ会機能 --}}
                <div class="bg-sakura-white
                            rounded-2xl
                            p-8 shadow-lg
                            border border-sakura-divider">
                    <div class="w-16 h-16 
                                bg-gradient-to-br from-sakura-purple-light to-sakura-purple
                                rounded-xl
                                flex items-center justify-center
                                text-3xl
                                 mb-6">
                        🤝
                    </div>
                    <h3 class="text-2xl font-bold text-sakura-text-primary mb-4 font-serif">オフ会</h3>
                    <p class="text-sakura-text-tertiary leading-relaxed">
                        ライブ前後のオフ会、カラオケ会など。同じ熱量を持つBuddiesとリアルに繋がる機会を作ろう。
                    </p>
                </div>

                {{-- トレード機能 --}}
                <div class="bg-sakura-white
                            rounded-2xl 
                            p-8
                            shadow-lg
                            border border-sakura-divider">
                    <div class="w-16 h-16
                                bg-gradient-to-br from-sakura-pink-light to-sakura-pink-medium 
                                rounded-xl
                                flex items-center justify-center 
                                text-3xl
                                mb-6">
                        🔄
                    </div>
                    <h3 class="text-2xl font-bold text-sakura-text-primary mb-4 font-serif">同行者募集・トレード</h3>
                    <p class="text-sakura-text-tertiary leading-relaxed">
                        ライブやイベントの同行者募集、生写真・グッズのトレードを募集しよう。
                    </p>
                </div>
            </div>
        </section>

        {{-- 最終CTA --}}
        <section class="py-16 bg-white">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <div class="bg-gradient-to-r from-sakura-pink via-sakura-purple-light to-sakura-purple-dark 
                            rounded-3xl 
                            p-12 
                            text-sakura-text-light
                            relative
                            overflow-hidden
                            shadow-2xl">
                    <div class="absolute top-0 left-0 w-64 h-64 bg-sakura-white opacity-10 rounded-full -translate-x-32 -translate-y-32"></div>
                    <div class="absolute bottom-0 right-0 w-96 h-96 bg-sakura-white opacity-10 rounded-full translate-x-48 translate-y-48"></div>
                    
                    <div class="relative z-10">
                        <h2 class="font-serif text-3xl lg:text-4xl font-bold mb-6">
                            櫻坂の現場を、もっと特別な時間に。
                        </h2>
                        <p class="text-xl mb-8 opacity-90 leading-relaxed">
                            あなたの「好き」を共有するだけで、<br class="hidden sm:block">
                            同じ熱量のBuddiesと出会えるかもしれません。
                        </p>
                        <div class="flex flex-col sm:flex-row gap-4 justify-center">
                            <a href="{{ route('register') }}" 
                               class="px-8 py-4 
                                      bg-sakura-white
                                      text-sakura-text-secondary 
                                      font-bold 
                                      rounded-full
                                      text-lg
                                      shadow-lg
                                      hover:shadow-xl
                                      transform
                                      hover:scale-105
                                      transition-all
                                      duration-300">
                                アカウントを作成
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

<footer class="bg-white 
               border-t-2 
               border-sakura-pink/30 
               py-8 
               mt-12">
    <div class="max-w-7xl mx-auto px-4 text-center">
        <div class="flex items-center justify-center gap-2 mb-4">
            <div class="w-8 h-8
                        bg-gradient-to-br from-sakura-purple to-sakura-pink 
                        rounded-lg
                        flex items-center
                        justify-center">
                <span class="text-white text-xs font-bold">櫻</span>
            </div>
            <span class="text-sakura-purple font-semibold">櫻坂46 Buddies Community</span>
        </div>
        <p class="text-sm text-gray-500">© 2026 ファンによる非公式コミュニティです</p>
    </div>
</footer>



    <script>
        // ヒーロースライダーの制御
        function heroSlider(slidesData) {
            return {
                currentSlide:0,
                slides:slidesData,
                intervalId: null,
                isPlaying: true,

                startSlideShow() {
                    this.intervalId = setInterval(() => {
                        if (this.isPlaying) {
                            this.nextSlide();
                        }
                    }, 6000); // 6秒ごとに切り替え
                },

                stopSlideShow() {
                    if (this.intervalId) {
                        clearInterval(this.intervalId);
                        this.intervalId = null;
                    }
                },

                pauseSlideShow() {
                    this.isPlaying = false;
                },

                resumeSlideShow() {
                    this.isPlaying = true;
                },

                nextSlide() {
                    this.currentSlide = (this.currentSlide + 1) % this.slides.length;
                },

                previousSlide() {
                    this.currentSlide = this.currentSlide === 0 
                        ? this.slides.length - 1 
                        : this.currentSlide - 1;

                    // 手動操作時は一時停止してから再開
                    this.pauseSlideShow();
                    setTimeout(() => this.resumeSlideShow(), 3000);
                },

                goToSlide(index) {
                    this.currentSlide = index;

                    // 手動操作時は一時停止してから再開
                    this.pauseSlideShow();
                    setTimeout(() => this.resumeSlideShow(), 3000);
                }
            }
        }

    </script>


</x-app-layout>