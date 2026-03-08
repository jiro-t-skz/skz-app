<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">

    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Logo -->
            <x-application-logo/>

            <!-- Desktop Navigation (640px以上) -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @auth
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2
                                        border border-transparent
                                        text-sm leading-4 
                                        font-medium 
                                        rounded-md 
                                        text-sakura-purple bg-white 
                                        hover:text-sakura-pink 
                                        focus:outline-none 
                                        transition
                                        ease-in-out
                                        duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4"
                                     xmlns="http://www.w3.org/2000/svg"
                                     viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('プロフィール') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('ログアウト') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
                @else
                {{-- 未ログインの場合：デスクトップ用ボタン --}}
                <div class="flex items-center space-x-4">
                    <a href="{{ route('login') }}" 
                       class="text-sm font-medium text-sakura-purple hover:text-sakura-pink transition-colors duration-200">
                        ログイン
                    </a>
                    <a href="{{ route('register') }}" 
                       class="px-5 py-2 text-sm font-bold text-sakura-text-light bg-gradient-to-r from-sakura-purple/70 to-sakura-pink/70 rounded-full shadow-md hover:shadow-lg transform hover:scale-105 transition-all duration-300">
                        新規登録
                    </a>
                </div>
                @endauth
            </div>

            <!-- Mobile Navigation (640px未満) -->
            <div class="flex items-center sm:hidden">
                @auth
                {{-- ログイン時：ハンバーガーメニュー --}}
                <button @click="open = ! open" 
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out"
                        :aria-expanded="open"
                        aria-label="メニューを開閉">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                @else
                {{-- 未ログイン時：小さめの認証ボタン --}}
                <div class="flex items-center gap-2">
                    <a href="{{ route('login') }}" 
                       class="px-3 py-1.5 text-xs font-medium text-sakura-purple hover:text-sakura-pink border border-sakura-purple/30 rounded-full transition-colors duration-200">
                        ログイン
                    </a>
                    <a href="{{ route('register') }}" 
                       class="px-3 py-1.5 text-xs font-bold text-sakura-text-light bg-gradient-to-r from-sakura-purple/70 to-sakura-pink/70 rounded-full shadow-sm hover:shadow-md transition-all duration-300">
                        新規登録
                    </a>
                </div>
                @endauth
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu (ログイン時のみ) -->
    @auth
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('プロフィール') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('ログアウト') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
    @endauth
</nav>





