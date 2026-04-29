@extends('layouts.layout-deafault')

@section('title', 'Thêm người dùng')
@section('page_title', 'Thêm người dùng')
@section('page_desc', 'Tạo mới một tài khoản người dùng')

@section('page_actions')
    <a href="{{ url('/users') }}" class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700 shadow-sm hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-indigo-600/20">
        Quay lại
    </a>
@endsection

@section('content')
    <form action="{{ url('/users') }}" method="POST" class="space-y-6">
        @csrf

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <div>
                <label class="text-sm font-semibold text-slate-700">Họ và tên</label>
                <input name="name" type="text" placeholder="Nhập họ và tên" class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm outline-none focus:border-indigo-300 focus:ring-2 focus:ring-indigo-600/20">
            </div>

            <div>
                <label class="text-sm font-semibold text-slate-700">Email</label>
                <input name="email" type="email" placeholder="user@example.com" class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm outline-none focus:border-indigo-300 focus:ring-2 focus:ring-indigo-600/20">
            </div>

            <div>
                <label class="text-sm font-semibold text-slate-700">Mật khẩu</label>
                <input name="password" type="password" placeholder="••••••••" class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm outline-none focus:border-indigo-300 focus:ring-2 focus:ring-indigo-600/20">
            </div>

            <div>
                <label class="text-sm font-semibold text-slate-700">Vai trò</label>
                <select name="role" class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm outline-none focus:border-indigo-300 focus:ring-2 focus:ring-indigo-600/20">
                    <option>Admin</option>
                    <option>User</option>
                </select>
            </div>
        </div>

        <div class="flex flex-wrap items-center justify-end gap-2">
            <a href="{{ url('/users') }}" class="rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700 shadow-sm hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-indigo-600/20">
                Hủy
            </a>

            <button type="submit" class="rounded-xl bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm shadow-indigo-500/30 hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-600/20">
                Lưu
            </button>
        </div>
    </form>
@endsection
