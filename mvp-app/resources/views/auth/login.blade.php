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
        </div>
      </a>
        <h2 class="text-2xl sm:text-3xl font-bold text-sakura-purple font-serif mb-2">
            Buddies コミュニティ
        </h2>
        <p class="text-sm sm:text-base text-gray-600">
            アカウントにログイン
        </p>
    </div>


    {{--Session Status--}}
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-4 sm:space-y-6">
        @csrf

         {{--Eメールアドレス--}}
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-sakura-purple font-semibold"/>
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
                                focus:outline-none
                                focus:ring-4 focus:ring-sakura-purple/20
                                focus:border-sakura-purple
                                transition-all duration-300"
                         type="email"
                         name="email"
                         :value="old('email')"
                         required
                         autofocus
                         autocomplete="username"
                         placeholder="example@email.com" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

       {{--password--}}
       <div>
            <x-input-label for="password"
                           :value="__('Password')"
                           class="text-sakura-purple font-semibold"/>
                <div class="relative mt-2">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-sakura-purple" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                  d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                  clip-rule="evenodd">
                            </path>
                        </svg>
                    </div>
                    <x-text-input id="password"
                                  class="block w-full pl-10 pr-4 py-3
                                  border border-sakura-pink
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
                               autocomplete="current-password"
                               placeholder="••••••••" />
                </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        {{-- Action Buttons --}}
        <div class="space-y-3 sm:space-y-4">
            {{-- Login Button --}}
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
                    <path fill-rule="evenodd" d="M3 3a1 1 0 011 1v12a1 1 0 11-2 0V4a1 1 0 011-1zm7.707 3.293a1 1 0 010 1.414L9.414 9H17a1 1 0 110 2H9.414l1.293 1.293a1 1 0 01-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                </svg>
                {{ __('Log in') }}
            </x-primary-button>

            {{-- Forgot Password Link --}}
            @if (Route::has('password.request'))
                <div class="text-center">
                    <a class="inline-flex items-center gap-1
                              text-sm sm:text-base text-sakura-purple
                              hover:text-sakura-pink
                              font-semibold
                              focus:outline-none focus:ring-2 focus:ring-sakura-purple/30
                              rounded-lg px-2 py-1
                              transition-all duration-300"
                       href="{{ route('password.request') }}">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"></path>
                        </svg>
                        {{ __('アカウントを忘れた方') }}
                    </a>
                </div>
            @endif

            {{-- Register Link --}}
            @if (Route::has('register'))
                <div class="text-center pt-4 border-t-2 border-sakura-pink/20">
                    <a class="inline-flex items-center gap-1
                              text-sm sm:text-base text-sakura-purple
                              hover:text-sakura-pink
                              font-bold
                              transition-all duration-300"
                       href="{{ route('register') }}">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z"></path>
                        </svg>
                        アカウントをお持ちでない方
                    </a>
                </div>
            @endif
        </div>
    </form>
</x-guest-layout>




