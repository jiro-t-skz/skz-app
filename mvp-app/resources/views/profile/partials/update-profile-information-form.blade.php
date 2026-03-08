
<section>
    <header>
        <h2 class="text-lg font-medium text-sakura-purple">
            {{ __('プロフィール情報') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("アカウントのプロフィール情報とメールアドレスを更新します。") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        {{-- 名前フィールド --}}
        <div>
            <x-input-label for="name" :value="__('名前')" 
                           class="text-sakura-purple font-semibold mb-2" />
            <x-text-input id="name" name="name" type="text" 
                          class="mt-1 block w-full
                                 border-2 border-sakura-pink
                                 rounded-lg
                                 text-sakura-purple
                                 placeholder-gray-400
                                 focus:outline-none
                                 focus:ring-4 focus:ring-sakura-purple/20
                                 focus:border-sakura-purple
                                 transition-all duration-300"
                          :value="old('name', $user->name)" 
                          required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>


        {{-- メールアドレスフィールド --}}
        <div>
            <x-input-label for="email" :value="__('メールアドレス')" 
                           class="text-sakura-purple font-semibold mb-2" />
            <x-text-input id="email" name="email" type="email" 
                          class="mt-1 block w-full
                                 border-2 border-sakura-pink
                                 rounded-lg
                                 text-sakura-purple
                                 placeholder-gray-400
                                 focus:outline-none
                                 focus:ring-4 focus:ring-sakura-purple/20
                                 focus:border-sakura-purple
                                 transition-all duration-300"
                          :value="old('email', $user->email)" 
                          required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />




            {{-- メール確認通知（強化版） --}}
            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-3 p-4 bg-yellow-50 border-2 border-yellow-200 rounded-lg">
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-yellow-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                        <div class="flex-1">
                            <p class="text-sm text-gray-800 font-semibold mb-3">
                                {{ __('メールアドレスが未確認です。') }}
                            </p>
                            <button form="send-verification" 
                                    class="inline-flex items-center gap-2 px-4 py-2 
                                           bg-white border-2 border-sakura-pink 
                                           text-sakura-purple text-sm font-semibold 
                                           rounded-full 
                                           hover:bg-sakura-pink/10 hover:border-sakura-purple
                                           focus:outline-none focus:ring-4 focus:ring-sakura-purple/20
                                           transition-all duration-300">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                {{ __('確認メールを再送信') }}
                            </button>

                            @if (session('status') === 'verification-link-sent')
                                <p class="mt-3 text-sm text-green-600 font-semibold flex items-center gap-2">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                    {{ __('新しい確認リンクをメールアドレスに送信しました。') }}
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
            @endif
        </div>

        {{-- 推しメン --}}
        <div>
            <x-input-label for="favorite_member" :value="__('推しメン')"
                           class="text-sakura-purple font-semibold mb-2" />
            <x-text-input id="favorite_member" name="favorite_member" type="text"
                          class="mt-1 block w-full
                                 border-2 border-sakura-pink
                                 rounded-lg
                                 text-sakura-purple
                                 placeholder-gray-400
                                 focus:outline-none
                                 focus:ring-4 focus:ring-sakura-purple/20
                                 focus:border-sakura-purple
                                 transition-all duration-300"
                          :value="old('favorite_member', $user->favorite_member)"
                          required autofocus autocomplete="off" />
            <x-input-error class="mt-2" :messages="$errors->get('favorite_member')" />
        </div>


        {{-- 好きな楽曲 --}}
        <div>
            <x-input-label for="favorite_song" :value="__('好きな楽曲')"
                           class="text-sakura-purple font-semibold mb-2" />
            <x-text-input id="favorite_song" name="favorite_song" type="text"
                          class="mt-1 block w-full
                                 border-2 border-sakura-pink
                                 rounded-lg
                                 text-sakura-purple
                                 placeholder-gray-400
                                 focus:outline-none
                                 focus:ring-4 focus:ring-sakura-purple/20
                                 focus:border-sakura-purple
                                 transition-all duration-300"
                          :value="old('favorite_song', $user->favorite_song)"
                          required autofocus autocomplete="off" />
            <x-input-error class="mt-2" :messages="$errors->get('favorite_song')" />
        </div>

        {{-- 好きなMV --}}
        <div>
            <x-input-label for="favorite_mv" :value="__('好きなMV')"
                           class="text-sakura-purple font-semibold mb-2" />
            <x-text-input id="favorite_mv" name="favorite_mv" type="text"
                          class="mt-1 block w-full
                                 border-2 border-sakura-pink
                                 rounded-lg
                                 text-sakura-purple
                                 placeholder-gray-400
                                 focus:outline-none
                                 focus:ring-4 focus:ring-sakura-purple/20
                                 focus:border-sakura-purple
                                 transition-all duration-300"
                          :value="old('favorite_mv', $user->favorite_mv)"
                          required autofocus autocomplete="off" />
            <x-input-error class="mt-2" :messages="$errors->get('favorite_mv')" />
        </div>


        {{-- 自己紹介 --}}
        <div>
            <x-input-label for="bio" :value="__('自己紹介')" class="text-sakura-purple font-semibold mb-2" />
                           <textarea id="bio"
                                    name="bio"
                                    rows="5"
                                    maxlength="500"
                                    class="mt-1 block w-full
                                           border-2 border-sakura-pink
                                           rounded-lg
                                           text-sakura-purple
                                           placeholder-gray-400
                                           focus:outline-none
                                           focus:ring-4 focus:ring-sakura-purple/20
                                           focus:border-sakura-purple
                                           transition-all duration-300
                                           resize-none
                                           px-4 py-3 pb-8"
                                    placeholder="例：櫻坂46が大好きです!ライブに行くのが趣味で、一緒に楽しめる仲間を探しています。"
                                    autocomplete="off">{{ old('bio', $user->bio) }}</textarea>

                            <div class="mt-2 flex items-start gap-2 text-xs text-gray-500">
                                 <svg class="w-4 h-4 text-sakura-purple flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                </svg>
                                <span>{{ __('あなたの趣味、好きなメンバー、参加したいイベントなどを自由に書いてください。') }}</span>
                            </div>
            <x-input-error class="mt-2" :messages="$errors->get('bio')" />
        </div>



        {{-- 保存ボタンと成功メッセージ --}}
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
                {{ __('保存') }}
            </button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }"
                   x-show="show"
                   x-transition
                   x-init="setTimeout(() => show = false, 3000)"
                   class="text-sm text-green-600 font-semibold flex items-center gap-2">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    {{ __('保存しました。') }}
                </p>
            @endif
        </div>
    </form>
</section>


<!-- <section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
 -->
