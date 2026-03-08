<x-guest-layout>
{{--ロゴセクション--}}
    <div class="text-center mb-6 sm:mb-8">
        <a href="{{ route('home') }}">
        <div class="inline-flex items-center justify-center w-20 h-20 sm:w-24 sm:h-24
                    bg-gradient-to-br from-sakura-purple to-sakura-pink
                    rounded-full shadow-xl mb-4 sm:mb-6">
                <span class="text-white
                             font-bold text-3xl sm:text-4xl
                             font-serif">
                    櫻
                </span>
            </a>
        </div>
        <h2 class="text-2xl sm:text-3xl font-bold text-sakura-purple font-serif mb-2">
            Buddies コミュニティ
        </h2>
        <p class="text-sm sm:text-base text-gray-600">
            パスワード再設定
        </p>
    </div>


    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-sakura-purple font-semibold"/>
            <x-text-input id="email"
                          class="block w-full pl-10 pr-4 py-3
                                border-2 border-sakura-pink
                                rounded-lg
                                text-sakura-purple text-sm sm:text-base
                                placeholder-gray-400
                                focus:outline-none
                                focus:outline-none
                                focus:ring-4 focus:ring-sakura-purple/20
                                focus:border-sakura-purple
                                transition-all duration-300"
                          type="email"
                          name="email"
                          :value="old('email')"
                          required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="bg-gradient-to-r from-sakura-purple to-sakura-pink
                                     text-white font-bold text-sm sm:text-base
                                     border-0
                                     rounded-lg
                                     hover:from-sakura-purple-dark hover:to-sakura-pink-medium
                                     focus:outline-none focus:ring-4 focus:ring-sakura-purple/30
                                     transition-all duration-300
                                     shadow-lg hover:shadow-xl
                                     transform hover:scale-105">
                {{ __('パスワードをリセット') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
