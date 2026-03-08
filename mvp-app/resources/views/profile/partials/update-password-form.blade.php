<section>
    <header>
        <h2 class="text-lg font-medium text-sakura-purple">
            {{ __('パスワードの更新') }}
        </h2>

    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        {{-- Current Password --}}
        <div>
            <x-input-label for="update_password_current_password" :value="__('Current Password')"
                           class="text-sakura-purple font-semibold mb-2" />
            <x-text-input id="update_password_current_password" name="current_password"
                          type="password"
                          class="mt-1 block w-full
                                 border-2 border-sakura-pink
                                 rounded-lg
                                 text-sakura-purple
                                 focus:outline-none
                                 focus:ring-4 focus:ring-sakura-purple/20
                                 focus:border-sakura-purple
                                 transition-all durtion-300"
                          autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        {{-- New Password --}}
        <div>
            <x-input-label for="update_password_password" :value="__('New Password')" 
                           class="text-sakura-purple font-semibold mb-2" />
            <x-text-input id="update_password_password" name="password" 
                          type="password" 
                          class="mt-1 block w-full
                                 border-2 border-sakura-pink
                                 rounded-lg
                                 text-sakura-purple
                                 focus:outline-none
                                 focus:ring-4 focus:ring-sakura-purple/20
                                 focus:border-sakura-purple
                                 transition-all durtion-300"
                          autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        {{-- Confirm Password --}}
        <div>
            <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" 
                           class="text-sakura-purple font-semibold mb-2" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" 
                          type="password" 
                          class="mt-1 block w-full 
                                 border-2 border-sakura-pink
                                 rounded-lg
                                 text-sakura-purple
                                 placeholder-gray-400
                                 focus:outline-none
                                 focus:ring-4 focus:ring-sakura-purple/20
                                 focus:border-sakura-purple
                                 transition-all durtion-300"
                          autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" 
                    class="px-6 py-2.5 
                           bg-gradient-to-r from-sakura-purple to-sakura-pink 
                           text-white font-bold 
                           rounded-lg 
                           hover:opacity-90 hover:shadow-lg 
                           focus:outline-none focus:ring-4 focus:ring-sakura-purple/30 
                           transition-all duration-300
                           flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M5 13l4 4L19 7" />
                </svg>
                {{ __('更新') }}
            </button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }"
                   x-show="show"
                   x-transition
                   x-init="setTimeout(() => show = false, 3000)"
                   class="text-sm text-green-600 font-semibold flex items-center gap-2">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    {{ __('Saved.') }}
                </p>
            @endif
        </div>
    </form>
</section>