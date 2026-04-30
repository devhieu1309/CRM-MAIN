@extends('layouts.layout-deafault')

@section('title', 'Quản lý người dùng')
@section('page_title', 'Quản lý người dùng')
@section('page_desc', 'Danh sách người dùng trong hệ thống')

@section('page_actions')
<a href="{{ route('users.create') }}"
    class="inline-flex items-center justify-center gap-2 rounded-xl bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm shadow-indigo-500/30 hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-600/20">
    Thêm mới
</a>
@endsection

@section('content')

<div class="flex flex-wrap items-center justify-end gap-2">
    @if($withDeleted)
    <a href="{{ route('users.index') }}"
        class="rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm font-semibold text-slate-700 shadow-sm hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-indigo-600/20">
        Hiển thị danh sách người dùng
    </a>
    @else
    <a href="{{ route('users.index', ['deleted' => 'true']) }}"
        class="rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm font-semibold text-slate-700 shadow-sm hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-indigo-600/20">
        Hiển thị người dùng đã bị xóa
    </a>
    @endif
</div>

<style>
    .no-scrollbar {
        scrollbar-width: none;
        -ms-overflow-style: none;
    }

    .no-scrollbar::-webkit-scrollbar {
        display: none;
    }
</style>

@if(session('status'))
<div class="bg-emerald-50 text-emerald-700 px-4 py-2 rounded-md">
    {{ session('status') }}
</div>
@endif
<div class="mt-4 rounded-2xl border border-slate-200">
    <div class="overflow-x-auto no-scrollbar scroll-smooth">
        <table class="min-w-max w-full divide-y divide-slate-200">
            <thead class="bg-slate-50">
                <tr>
                    <th
                        class="sticky left-0 z-20 min-w-[220px] whitespace-nowrap border-r border-slate-200 bg-slate-50 px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                        Tên</th>
                    <th
                        class="whitespace-nowrap px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                        Email</th>
                    <th
                        class="whitespace-nowrap px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                        Vai trò</th>
                    <th
                        class="whitespace-nowrap px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                        Địa chỉ</th>
                    <th
                        class="whitespace-nowrap px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                        Điện thoại</th>
                    <th
                        class="whitespace-nowrap px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                        Điều khoản</th>
                    <th
                        class="whitespace-nowrap px-4 py-3 text-right text-xs font-semibold uppercase tracking-wider text-slate-500">
                        Hành động</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-slate-200 bg-white">
                @foreach($users as $user)
                <tr class="group hover:bg-slate-50">
                    <td
                        class="sticky left-0 z-10 min-w-[220px] whitespace-nowrap border-r border-slate-200 bg-white px-4 py-3 text-sm font-semibold text-slate-900 group-hover:bg-slate-50">
                        {{ $user->name}}
                    </td>
                    <td class="whitespace-nowrap px-4 py-3 text-sm text-slate-600">{{ $user->email}}</td>
                    <td class="whitespace-nowrap px-4 py-3">
                        <span class="inline-flex items-center rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-semibold text-emerald-700">{{ $user->roles->pluck('name')->implode(', ') }}</span>
                    </td>
                    <td class="whitespace-nowrap px-4 py-3 text-sm text-slate-600">{{ $user->address}}</td>
                    <td class="whitespace-nowrap px-4 py-3 text-sm text-slate-600">{{ $user->phone_number}}</td>
                    <td class="whitespace-nowrap px-4 py-3">
                        <span class="inline-flex items-center rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-semibold {{ $user->terms_accepted_at ? 'text-emerald-700' : 'text-red-700'}}">{{ $user->terms_accepted_at ? 'Đã chấp nhận' : 'Chưa chấp nhận'}}</span>
                    </td>
                    @if($withDeleted)
                    <td class="whitespace-nowrap px-4 py-3">
                        <div class="flex justify-end gap-2">
                            <form action="{{ route('users.restore', $user) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit"
                                    class="rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm font-semibold text-slate-700 shadow-sm hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-indigo-600/20">
                                     Khôi phục
                                </button>
                            </form>

                            <form action="{{ route('users.forceDelete', $user) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Bạn có chắc muốn xóa người dùng?')" type="submit"
                                    class="rounded-xl border border-red-200 bg-white px-3 py-2 text-sm font-semibold text-red-700 shadow-sm hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-red-600/20">
                                    Xóa vĩnh viễn
                                </button>
                            </form>
                        </div>
                    </td>
                    @else
                    <td class="whitespace-nowrap px-4 py-3">
                        <div class="flex justify-end gap-2">
                            <a href="{{ route('users.edit', $user) }}"
                                class="rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm font-semibold text-slate-700 shadow-sm hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-indigo-600/20">
                                Sửa
                            </a>

                            <form action="{{ route('users.destroy', $user) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Bạn có chắc muốn xóa người dùng?')" type="submit"
                                    class="rounded-xl border border-red-200 bg-white px-3 py-2 text-sm font-semibold text-red-700 shadow-sm hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-red-600/20">
                                    Xóa
                                </button>
                            </form>
                        </div>
                    </td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="mt-4 flex flex-wrap items-center justify-between gap-3">
    @if($users->total() > 0)
    <div class="text-sm text-slate-600">Hiển thị {{ $users->firstItem() }}-{{ $users->lastItem() }} / {{ $users->total() }}</div>
    @else
    <div class="text-sm text-slate-600">Không có dữ liệu</div>
    @endif

    <nav class="inline-flex items-center gap-1">
        @if(!$users->onFirstPage())
        <a href="{{ $users->url(1) }}"
            class="rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm font-semibold text-slate-700 shadow-sm hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-indigo-600/20">
            Đầu
        </a>
        @endif

        @if($users->currentPage() > 1)
        <a href="{{ $users->url($users->currentPage() - 1) }}"
            class="rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm font-semibold text-slate-700 shadow-sm hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-indigo-600/20">...</a>
        @endif

        @php
        $start = max(1, $users->currentPage() - 1);
        $end = min($users->lastPage(), $users->currentPage() + 1);
        @endphp

        <!-- <a href="#" class="rounded-xl bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm shadow-indigo-500/30 focus:outline-none focus:ring-2 focus:ring-indigo-600/20">1</a> -->
        @for($i = $start; $i <= $end; $i++)
            <a href="{{ $users->url($i) }}"
            class="{{ $users->currentPage() == $i ? "bg-indigo-600 text-white" : ""}} rounded-xl border border-slate-200 px-3 py-2 text-sm font-semibold text-slate-700 shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-600/20">{{ $i }}</a>
            @endfor
            <!-- <a href="#"
            class="rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm font-semibold text-slate-700 shadow-sm hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-indigo-600/20">3</a> -->

            @if($users->currentPage() < $users->lastPage())
                <a href="{{ $users->url($users->currentPage() + 1) }}"
                    class="rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm font-semibold text-slate-700 shadow-sm hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-indigo-600/20">...</a>
                @endif

                @if(!$users->onLastPage())
                <a href="{{ $users->url($users->lastPage()) }}"
                    class="rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm font-semibold text-slate-700 shadow-sm hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-indigo-600/20">
                    Cuối
                </a>
                @endif
    </nav>
</div>
@endsection