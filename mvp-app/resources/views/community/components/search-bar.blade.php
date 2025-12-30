{{-- -検索バー --}}
<form method="GET" action="{{ route('community.index') }}" class="mb-6 flex space-x-3">
        <div class="flex-1 relative">
            <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </span>
            <input
                type="text"
                name="search"
                value="{{$search ?? ''}}"
                placeholder="同行者募集・トレードを検索"
                class="w-full pl-10 pr-4 py-3 bg-gray-100 border  rounded-lg focus:outline-none focus:ring-blue-500">
        </div>
        <button type="submit" class="px-6 py-3 bg-gray-100 border rounded-lg hover:bg-gray-200 transition-colors"
            >検索
        </button>
</form>