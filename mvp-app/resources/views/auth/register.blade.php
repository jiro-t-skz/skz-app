<x-guest-layout>
    {{-- ロゴセクション --}}
    <div class="text-center mb-6 sm:mb-8">
      <a href="{{ route('home') }}">
        <div class="inline-flex items-center justify-center w-20 h-20 sm:w-24 sm:h-24
                    bg-gradient-to-br from-sakura-purple to-sakura-pink
                    rounded-full shadow-xl mb-4 sm:mb-6">
            <span class="text-white font-bold text-3xl sm:text-4xl font-serif">櫻</span>
        </div>
      </a>
        <h2 class="text-2xl sm:text-3xl font-bold text-sakura-purple font-serif mb-2">
            Buddies コミュニティ
        </h2>
        <p class="text-sm sm:text-base text-gray-600">
            新規アカウント登録
        </p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-4 sm:space-y-5">
        @csrf

        {{-- Name --}}
        <div>
            <x-input-label for="name" :value="__('Name')" class="text-sakura-purple font-semibold" />
            <div class="relative mt-2">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="w-5 h-5 text-sakura-purple" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <x-text-input id="name"
                              class="block w-full pl-10 pr-4 py-3
                                     border-2 border-sakura-pink
                                     rounded-lg
                                     text-sakura-purple text-sm sm:text-base
                                     placeholder-gray-400
                                     focus:outline-none
                                     focus:ring-4 focus:ring-sakura-purple/20
                                     focus:border-sakura-purple
                                     transition-all duration-300"
                              type="text"
                              name="name"
                              :value="old('name')"
                              required
                              autofocus
                              autocomplete="name"
                              placeholder="山田 太郎" />
            </div>
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        {{-- Email Address --}}
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-sakura-purple font-semibold" />
            <div class="relative mt-2">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="w-5 h-5 text-sakura-purple" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                    </svg>
                </div>
                <x-text-input id="email"
                              class="block w-full pl-10 pr-4 py-3
                                     border-2 border-sakura-pink
                                     rounded-lg
                                     text-sakura-purple text-sm sm:text-base
                                     placeholder-gray-400
                                     focus:outline-none
                                     focus:ring-4 focus:ring-sakura-purple/20
                                     focus:border-sakura-purple
                                     transition-all duration-300"
                              type="email"
                              name="email"
                              :value="old('email')"
                              required
                              autocomplete="username"
                              placeholder="example@email.com" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        {{-- Password --}}
        <div>
            <x-input-label for="password" :value="__('Password')" class="text-sakura-purple font-semibold" />
            <div class="relative mt-2">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="w-5 h-5 text-sakura-purple" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <x-text-input id="password"
                              class="block w-full pl-10 pr-4 py-3
                                     border-2 border-sakura-pink
                                     rounded-lg
                                     text-sakura-purple text-sm sm:text-base
                                     placeholder-gray-400
                                     focus:outline-none
                                     focus:ring-4 focus:ring-sakura-purple/20
                                     focus:border-sakura-purple
                                     transition-all duration-300"
                              type="password"
                              name="password"
                              required
                              autocomplete="new-password"
                              placeholder="8文字以上" />
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
            <p class="mt-1.5 text-xs sm:text-sm text-gray-500">
                💡 8文字以上で、英数字を含めてください
            </p>
        </div>

        {{-- Confirm Password --}}
        <div>
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-sakura-purple font-semibold" />
            <div class="relative mt-2">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="w-5 h-5 text-sakura-purple" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <x-text-input id="password_confirmation"
                              class="block w-full pl-10 pr-4 py-3
                                     border-2 border-sakura-pink
                                     rounded-lg
                                     text-sakura-purple text-sm sm:text-base
                                     placeholder-gray-400
                                     focus:outline-none
                                     focus:ring-4 focus:ring-sakura-purple/20
                                     focus:border-sakura-purple
                                     transition-all duration-300"
                              type="password"
                              name="password_confirmation"
                              required
                              autocomplete="new-password"
                              placeholder="パスワードを再入力" />
            </div>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        {{-- Action Buttons --}}
        <div class="space-y-3 sm:space-y-4 pt-2">
            {{-- Register Button --}}
            <x-primary-button class="w-full justify-center py-3 sm:py-4
                                     bg-gradient-to-r from-sakura-purple to-sakura-pink
                                     text-white font-bold text-sm sm:text-base
                                     border-0
                                     rounded-lg
                                     hover:from-sakura-purple-dark hover:to-sakura-pink-medium
                                     focus:outline-none focus:ring-4 focus:ring-sakura-purple/30
                                     transition-all duration-300
                                     shadow-lg hover:shadow-xl
                                     transform hover:scale-105">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z"></path>
                </svg>
                {{ __('新規登録') }}
            </x-primary-button>

            {{-- Login Link --}}
            <div class="text-center pt-4 border-t-2 border-sakura-pink/20">
                <a class="inline-flex items-center gap-1
                          text-sm sm:text-base text-sakura-purple
                          hover:text-sakura-pink
                          font-bold
                          focus:outline-none focus:ring-2 focus:ring-sakura-purple/30
                          rounded-lg px-3 py-2
                          transition-all duration-300"
                   href="{{ route('login') }}">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M3 3a1 1 0 011 1v12a1 1 0 11-2 0V4a1 1 0 011-1zm7.707 3.293a1 1 0 010 1.414L9.414 9H17a1 1 0 110 2H9.414l1.293 1.293a1 1 0 01-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    すでにアカウントをお持ちの方
                </a>
            </div>
        </div>
    </form>
</x-guest-layout>
