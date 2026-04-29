@extends('layouts.layout-deafault')

@section('title', 'Quản lý người dùng')
@section('page_title', 'Quản lý người dùng')
@section('page_desc', 'Danh sách người dùng trong hệ thống')

@section('page_actions')
    <a href="{{ url('/users/create') }}" class="inline-flex items-center justify-center gap-2 rounded-xl bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm shadow-indigo-500/30 hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-600/20">
        Thêm mới
    </a>
@endsection

@section('content')
    <div class="flex flex-wrap items-center justify-between gap-3">
        <div class="relative w-full max-w-sm">
            <div class="pointer-events-none absolute inset-y-0 left-3 flex items-center">
                <svg class="h-4 w-4 text-slate-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 1 0 0 11 5.5 5.5 0 0 0 0-11ZM2 9a7 7 0 1 1 12.06 4.31l2.82 2.82a.75.75 0 1 1-1.06 1.06l-2.82-2.82A7 7 0 0 1 2 9Z" clip-rule="evenodd" />
                </svg>
            </div>
            <input type="text" placeholder="Tìm theo tên/email..." class="w-full rounded-xl border border-slate-200 bg-white py-2 pl-9 pr-3 text-sm shadow-sm outline-none focus:border-indigo-300 focus:ring-2 focus:ring-indigo-600/20">
        </div>

        <div class="flex items-center gap-2">
            <button type="button" class="rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm font-semibold text-slate-700 shadow-sm hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-indigo-600/20">
                Xóa đã chọn
            </button>
        </div>
    </div>

    <div class="mt-4 overflow-hidden rounded-2xl border border-slate-200">
        <table class="min-w-full divide-y divide-slate-200">
            <thead class="bg-slate-50">
                <tr>
                    <th class="w-12 px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                        <input type="checkbox" class="h-4 w-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-600">
                    </th>
                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Tên</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Email</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Vai trò</th>
                    <th class="px-4 py-3 text-right text-xs font-semibold uppercase tracking-wider text-slate-500">Hành động</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-slate-200 bg-white">
                <tr class="hover:bg-slate-50">
                    <td class="px-4 py-3">
                        <input type="checkbox" class="h-4 w-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-600">
                    </td>
                    <td class="px-4 py-3 text-sm font-semibold text-slate-900">Nguyễn Văn A</td>
                    <td class="px-4 py-3 text-sm text-slate-600">a@example.com</td>
                    <td class="px-4 py-3">
                        <span class="inline-flex items-center rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-semibold text-emerald-700">Admin</span>
                    </td>
                    <td class="px-4 py-3">
                        <div class="flex justify-end gap-2">
                            <a href="{{ url('/users/1/edit') }}" class="rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm font-semibold text-slate-700 shadow-sm hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-indigo-600/20">
                                Sửa
                            </a>

                            <form action="{{ url('/users/1') }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="rounded-xl border border-red-200 bg-white px-3 py-2 text-sm font-semibold text-red-700 shadow-sm hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-red-600/20">
                                    Xóa
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>

                <tr class="hover:bg-slate-50">
                    <td class="px-4 py-3">
                        <input type="checkbox" class="h-4 w-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-600">
                    </td>
                    <td class="px-4 py-3 text-sm font-semibold text-slate-900">Trần Thị B</td>
                    <td class="px-4 py-3 text-sm text-slate-600">b@example.com</td>
                    <td class="px-4 py-3">
                        <span class="inline-flex items-center rounded-full bg-slate-100 px-2.5 py-1 text-xs font-semibold text-slate-700">User</span>
                    </td>
                    <td class="px-4 py-3">
                        <div class="flex justify-end gap-2">
                            <a href="{{ url('/users/2/edit') }}" class="rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm font-semibold text-slate-700 shadow-sm hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-indigo-600/20">
                                Sửa
                            </a>

                            <form action="{{ url('/users/2') }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="rounded-xl border border-red-200 bg-white px-3 py-2 text-sm font-semibold text-red-700 shadow-sm hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-red-600/20">
                                    Xóa
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="mt-4 flex flex-wrap items-center justify-between gap-3">
        <div class="text-sm text-slate-600">Hiển thị 1–10 / 120</div>

        <nav class="inline-flex items-center gap-1">
            <button type="button" class="rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm font-semibold text-slate-700 shadow-sm hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-indigo-600/20">
                Trước
            </button>
            <button type="button" class="rounded-xl bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm shadow-indigo-500/30 focus:outline-none focus:ring-2 focus:ring-indigo-600/20">
                1
            </button>
            <button type="button" class="rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm font-semibold text-slate-700 shadow-sm hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-indigo-600/20">
                2
            </button>
            <button type="button" class="rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm font-semibold text-slate-700 shadow-sm hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-indigo-600/20">
                3
            </button>
            <button type="button" class="rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm font-semibold text-slate-700 shadow-sm hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-indigo-600/20">
                Sau
            </button>
        </nav>
    </div>
@endsection
