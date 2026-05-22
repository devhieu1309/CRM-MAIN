@extends('layouts.layout-deafault')

@section('title', 'Thông báo')
@section('page_title', 'Thông báo')
@section('page_desc', 'Danh sách thông báo chưa đọc của bạn')

@section('content')
    <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">
        <div class="border-b border-slate-200 bg-slate-50/70 px-4 py-3">
            <div class="flex flex-wrap items-center justify-between gap-3">
                <p class="text-sm font-semibold text-slate-700">Thông báo chưa đọc</p>

                <form action="{{ route('notifications.destroy') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="rounded-xl bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm shadow-indigo-500/30 hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-600/20">
                        Đánh dấu tất cả đã đọc
                    </button>
                </form>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Tiêu đề
                        </th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Loại
                        </th>
                        <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Gửi lúc
                        </th>
                        <th class="px-4 py-3 text-right text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Hành động
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 bg-white">
                    @forelse($notifications as $notification)
                    <tr class="hover:bg-slate-50">
                        <td class="whitespace-nowrap px-4 py-3 text-sm font-medium text-slate-900">
                            {{ $notification->data['project_title'] }}
                        </td>
                        <td class="whitespace-nowrap px-4 py-3 text-sm text-slate-600">
                            {{ $notification->data['type'] }}
                        </td>
                        <td class="whitespace-nowrap px-4 py-3 text-sm text-slate-600">
                            {{ $notification->created_at->diffForHumans() }}
                        </td>
                        <td class="whitespace-nowrap px-4 py-3 text-right">
                            <form action="{{ route('notifications.update', $notification) }}" method="POST"
                                onsubmit="return confirm('Bạn có chắc muốn đánh dấu thông báo này là đã đọc?')">
                                @csrf
                                @method('PUT')
                                <button type="submit"
                                    class="rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm font-semibold text-slate-700 shadow-sm hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-indigo-600/20">
                                    Đánh dấu đã đọc
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-4 py-8 text-center text-sm text-slate-500">
                            Không có thông báo chưa đọc
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
