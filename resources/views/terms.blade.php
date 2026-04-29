<x-guest-layout>
    <form action="{{ route('terms.store') }}" method="POST" class="w-full">
        <div class="text-center">
            <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-2xl bg-indigo-600 shadow-sm shadow-indigo-500/30">
                <svg class="h-6 w-6 text-white" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="M9 11V7a3 3 0 0 1 6 0v4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M7 11h10a2 2 0 0 1 2 2v6a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2v-6a2 2 0 0 1 2-2Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>

            <h1 class="mt-4 text-2xl font-semibold tracking-tight text-gray-900 dark:text-gray-100">Điều khoản sử dụng</h1>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Vui lòng xác nhận bạn đã đọc và đồng ý để tiếp tục.</p>
        </div>

        @csrf

        <div class="mt-6 rounded-2xl border border-gray-200 bg-white/70 p-4 shadow-sm backdrop-blur dark:border-gray-700 dark:bg-gray-900/40">
            <label class="flex cursor-pointer items-start gap-3">
                <input name="terms_accept" type="checkbox" value="1" class="mt-1 h-5 w-5 rounded-md border-gray-300 text-indigo-600 shadow-sm focus:ring-2 focus:ring-indigo-600 focus:ring-offset-2 dark:border-gray-600 dark:bg-gray-800 dark:focus:ring-offset-gray-800">
                <span class="flex-1">
                    <span class="block text-sm font-medium text-gray-900 dark:text-gray-100">Tôi đồng ý với điều khoản</span>
                    <span class="mt-0.5 block text-sm text-gray-600 dark:text-gray-400">Bạn cần tích chọn để có thể gửi biểu mẫu.</span>
                </span>
            </label>

            @error('terms_accept')
            <div class="mt-4 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700 dark:border-red-900/40 dark:bg-red-950/40 dark:text-red-200">
                {{$message}}
            </div>
            @enderror
        </div>

        <button type="submit" class="group mt-6 inline-flex w-full items-center justify-center gap-2 rounded-xl bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm shadow-indigo-500/30 transition hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:ring-offset-2 active:translate-y-px dark:focus:ring-offset-gray-900">
            Chấp nhận điều khoản
            <svg class="h-4 w-4 opacity-90 transition group-hover:translate-x-0.5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M3 10a.75.75 0 0 1 .75-.75h10.69L11.22 6.03a.75.75 0 1 1 1.06-1.06l4.5 4.5c.3.3.3.77 0 1.06l-4.5 4.5a.75.75 0 1 1-1.06-1.06l3.22-3.22H3.75A.75.75 0 0 1 3 10Z" clip-rule="evenodd"/>
            </svg>
        </button>
    </form>
</x-guest-layout>
