<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-gradient-to-br from-sakura-purple to-sakura-pink 
                       rounded-xl flex items-center justify-center shadow-md">
                <span class="text-white font-bold font-serif text-lg">櫻</span>
            </div>
            <h2 class="font-bold text-xl text-sakura-purple leading-tight">
                {{ __('Profile') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12 
                bg-gradient-to-br from-white via-sakura-pink/40 to-sakura-purple/40">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow-xl sm:rounded-2xl border-2 border-sakura-purple/20">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow-xl sm:rounded-2xl border-2 border-sakura-purple/20">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow-xl sm:rounded-2xl border-2 border-red-200">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>