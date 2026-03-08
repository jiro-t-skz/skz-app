{{-- 検索バー --}}
<form method="GET" action="{{ route('community.index') }}" class="mb-6 flex space-x-3">
        <div class="flex-1 relative">
            <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-sakura-purple">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z">
                    </path>
                </svg>
            </span>
            <input
                type="text"
                name="meetup_search"
                value="{{$search ?? ''}}"
                placeholder="検索"
                class="w-full pl-10 pr-4 py-3
                       border-2 border-gray-200 rounded-lg
                       focus:outline-none 
                       focus:border-sakura-pink/40 
                       focus:ring-2 
                       focus:ring-sakura-pink/40">
        </div>
        <button type="submit" 
                class="px-4 sm:px-6 py-3 
                       bg-gradient-to-r from-sakura-purple to-sakura-pink 
                       text-white 
                       rounded-lg 
                       font-semibold 
                       hover:opacity-90 
                       whitespace-nowrap">
            検索
        </button>

        {{-- 都道府県セレクトボックス --}}
        <div class="w-full sm:w-44 lg:w-48">
            <select
                name="prefecture"
                onchange="this.form.submit()"
                class="w-full h-full px-4 py-3 
                       border-2 border-gray-200
                       rounded-lg
                       focus:outline-none
                       focus:border-sakura-pink/40
                       focus:ring-2
                       focus:ring-sakura-pink/40
                       appearance-none
                       bg-white
                       cursor-pointer">
                <option value="">すべての都道府県</option>
                @foreach($prefectures as $prefecture)
                    <option value="{{ $prefecture }}"
                            {{ ($selectedPrefecture ?? '') === $prefecture ? 'selected' : '' }}>
                        {{ $prefecture }}
                    </option>
                @endforeach
            </select>
        </div>
</form>