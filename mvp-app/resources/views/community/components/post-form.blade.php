<div x-data="{ showForm:false }">
    {{-- 投稿ボタン（フォームが閉じている時）--}}
    <div x-show="!showForm" class="mb-6 flex items-start space-x-3">
        <div class="flex-shrink-0">
            <div class="w-12 h-12 bg-gray-300 rounded-full"></div>
        </div>
        <button
            @click="showForm = true" Transition-colors
            class="flex-1 px-4 py-3 bg-gray-100 border-gray-300 rounded-lg text-left text-gray-500 hover:bg-gray-50 transition-colors">
                同行者募集・トレードについて投稿しよう！
        </button>
    </div>

    {{-- 投稿フォーム（開いている時）--}}
    <div x-show="showForm"
        x-transition
        class="mb-6 bg-gray-50 p-4 rounded-lg border">
        <form method="POST" action="{{ route('community.posts.store')}}">
            @csrf
            <input
                type="text"
                name="title"
                placeholder="タイトル"
                required
                class="w-full mb-3 px-4 py-3 bg-white border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">

            <textarea
                name="body"
                placeholder="内容を入力してください"
                rows="4"
                required
                class="w-full mb-3 px-4 py-3 bg-white border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none"></textarea>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <select
                    name="type"
                     required
                     class="px-4 py-3 bg-white border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                     <option value="">選択してください</option>
                     <option value="companion">同行者募集</option>
                     <option value="trade">トレード</option>
                </select>
                <input type="date" name="date"
                       class="px-4 py-3 bg-white border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <input type="text" name="place" placeholder="場所" 
                       class="px-4 py-3 bg-white border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <input type="text" name="target" placeholder="対象" 
                       class="px-4 py-3 bg-white border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <input type="text" name="contact_info" placeholder="連絡先（例: X: @username）" 
                       class="px-4 py-3 bg-white border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

        <div class="flex justify-end space-x-3">
            <button
                type="button"
                @click="showForm=false"
                class="px-6 py-2 border rounded-lg hover:bg-gray-50 transition-colors">
                キャンセル
            </button>
            <button
                type="submit"
                class="px-6 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors">
                投稿
            </button>
        </div>
    </form>
</div>
