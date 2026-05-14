@extends('layouts.layout-deafault')

@section('title', 'Dashboard')
@section('page_title', 'Tổng quan')
@section('page_desc', $isAdmin ? 'Thống kê toàn hệ thống' : 'Thống kê công việc liên quan đến bạn')

@section('content')
    @php
        $statusBadge = function (\App\Enums\TaskStatus $status): string {
            return match ($status) {
                \App\Enums\TaskStatus::OPEN => 'bg-sky-50 text-sky-800 ring-sky-100',
                \App\Enums\TaskStatus::IN_PROGRESS => 'bg-indigo-50 text-indigo-800 ring-indigo-100',
                \App\Enums\TaskStatus::BLOCKED => 'bg-rose-50 text-rose-800 ring-rose-100',
                \App\Enums\TaskStatus::COMPLETED => 'bg-emerald-50 text-emerald-800 ring-emerald-100',
                \App\Enums\TaskStatus::CLOSED => 'bg-slate-100 text-slate-700 ring-slate-200',
                \App\Enums\TaskStatus::CANCELLED => 'bg-amber-50 text-amber-800 ring-amber-100',
            };
        };
    @endphp

    <div class="space-y-6">
        <div class="flex flex-wrap items-center justify-between gap-3 rounded-2xl border border-indigo-100 bg-gradient-to-r from-indigo-50 via-white to-slate-50 px-4 py-4 sm:px-5">
            <div>
                <p class="text-xs font-semibold uppercase tracking-wider text-indigo-600">Xin chào</p>
                <p class="mt-1 text-lg font-semibold text-slate-900">{{ auth()->user()->name }}</p>
                <p class="mt-0.5 text-sm text-slate-600">
                    @if ($isAdmin)
                        Bạn đang xem dữ liệu <span class="font-semibold text-slate-800">toàn hệ thống</span>.
                    @else
                        Bạn đang xem công việc <span class="font-semibold text-slate-800">được gán cho bạn</span> hoặc thuộc <span class="font-semibold text-slate-800">dự án của bạn</span>.
                    @endif
                </p>
            </div>
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('tasks.index') }}"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm shadow-indigo-500/30 hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-600/30">
                    Danh sách task
                </a>
                @if ($isAdmin)
                    <a href="{{ route('users.index') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700 shadow-sm hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-indigo-600/20">
                        Người dùng
                    </a>
                @endif
            </div>
        </div>

        <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-6">
            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Tổng task</p>
                <p class="mt-2 text-3xl font-bold tracking-tight text-slate-900">{{ number_format($counts['total']) }}</p>
                <p class="mt-1 text-xs text-slate-500">Trong phạm vi thống kê</p>
            </div>
            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Mở</p>
                <p class="mt-2 text-3xl font-bold tracking-tight text-sky-700">{{ number_format($counts['open']) }}</p>
                <p class="mt-1 text-xs text-slate-500">Chưa bắt đầu xử lý</p>
            </div>
            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Đang làm</p>
                <p class="mt-2 text-3xl font-bold tracking-tight text-indigo-700">{{ number_format($counts['in_progress']) }}</p>
                <p class="mt-1 text-xs text-slate-500">Đang tiến hành</p>
            </div>
            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Hoàn thành</p>
                <p class="mt-2 text-3xl font-bold tracking-tight text-emerald-700">{{ number_format($counts['completed']) }}</p>
                <p class="mt-1 text-xs text-slate-500">Trạng thái completed</p>
            </div>
            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Bị chặn</p>
                <p class="mt-2 text-3xl font-bold tracking-tight text-rose-700">{{ number_format($counts['blocked']) }}</p>
                <p class="mt-1 text-xs text-slate-500">Cần xử lý vướng</p>
            </div>
            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Đóng / Hủy</p>
                <p class="mt-2 text-3xl font-bold tracking-tight text-slate-700">{{ number_format($counts['closed_or_cancelled']) }}</p>
                <p class="mt-1 text-xs text-slate-500">Closed + cancelled</p>
            </div>
        </div>

        @if ($isAdmin && $totalUsers !== null)
            <div class="grid gap-4 lg:grid-cols-3">
                <div class="rounded-2xl border border-indigo-200 bg-indigo-600 p-5 text-white shadow-lg shadow-indigo-600/25 lg:col-span-1">
                    <p class="text-xs font-semibold uppercase tracking-wider text-indigo-100">Người dùng</p>
                    <p class="mt-2 text-4xl font-bold tracking-tight">{{ number_format($totalUsers) }}</p>
                    <p class="mt-2 text-sm text-indigo-100">Tổng tài khoản trong hệ thống.</p>
                    <a href="{{ route('users.index') }}" class="mt-4 inline-flex text-sm font-semibold text-white underline decoration-indigo-200 underline-offset-4 hover:decoration-white">
                        Quản lý người dùng →
                    </a>
                </div>
                <div class="rounded-2xl border border-dashed border-slate-200 bg-slate-50/80 p-5 lg:col-span-2">
                    <p class="text-sm font-semibold text-slate-800">Gợi ý vận hành</p>
                    <ul class="mt-3 list-inside list-disc space-y-2 text-sm text-slate-600">
                        <li>Theo dõi task bị chặn để ưu tiên gỡ vướng cho team.</li>
                        <li>Dùng danh sách bên dưới để xem các công việc cập nhật gần đây.</li>
                        <li>User thường chỉ thấy task được gán hoặc thuộc dự án họ sở hữu.</li>
                    </ul>
                </div>
            </div>
        @endif

        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="flex flex-wrap items-center justify-between gap-3 border-b border-slate-200 bg-slate-50/80 px-4 py-4 sm:px-5">
                <div>
                    <h2 class="text-base font-semibold text-slate-900">Task gần đây</h2>
                    <p class="text-sm text-slate-500">Sắp xếp theo cập nhật mới nhất (tối đa 10 dòng)</p>
                </div>
                <a href="{{ route('tasks.index') }}"
                    class="text-sm font-semibold text-indigo-600 hover:text-indigo-500">Xem tất cả</a>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200 text-left text-sm">
                    <thead class="bg-slate-50 text-xs font-semibold uppercase tracking-wider text-slate-500">
                        <tr>
                            <th class="whitespace-nowrap px-4 py-3">Tiêu đề</th>
                            <th class="whitespace-nowrap px-4 py-3">Dự án</th>
                            <th class="whitespace-nowrap px-4 py-3">Người nhận</th>
                            <th class="whitespace-nowrap px-4 py-3">Hạn</th>
                            <th class="whitespace-nowrap px-4 py-3">Trạng thái</th>
                            <th class="whitespace-nowrap px-4 py-3 text-right">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 bg-white">
                        @forelse ($recentTasks as $task)
                            <tr class="hover:bg-slate-50/60">
                                <td class="max-w-xs truncate px-4 py-3 font-medium text-slate-900" title="{{ $task->title }}">
                                    {{ $task->title }}
                                </td>
                                <td class="whitespace-nowrap px-4 py-3 text-slate-600">
                                    {{ $task->project?->title ?? '—' }}
                                </td>
                                <td class="whitespace-nowrap px-4 py-3 text-slate-600">
                                    {{ $task->user?->name ?? '—' }}
                                </td>
                                <td class="whitespace-nowrap px-4 py-3 text-slate-600">
                                    {{ $task->deadline?->format('d/m/Y H:i') ?? '—' }}
                                </td>
                                <td class="whitespace-nowrap px-4 py-3">
                                    <span
                                        class="inline-flex items-center rounded-full px-2.5 py-1 text-xs font-semibold ring-1 ring-inset {{ $statusBadge($task->status) }}">
                                        {{ $task->status->label() }}
                                    </span>
                                </td>
                                <td class="whitespace-nowrap px-4 py-3 text-right">
                                    <a href="{{ route('tasks.show', $task) }}"
                                        class="inline-flex rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-xs font-semibold text-slate-700 shadow-sm hover:bg-slate-50">
                                        Chi tiết
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-4 py-12 text-center text-sm text-slate-500">
                                    Chưa có task nào trong phạm vi thống kê.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
