@extends('layouts.layout-deafault')

@section('title', 'Thêm người dùng')
@section('page_title', 'Thêm người dùng')
@section('page_desc', 'Tạo mới một tài khoản người dùng')

@section('page_actions')
<a href="{{ route('users.index') }}" class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700 shadow-sm hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-indigo-600/20">
    Quay lại
</a>
@endsection

@section('content')
<form action="{{ route('users.store') }}" method="POST" class="space-y-6">
    @csrf
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
        <div>
            <label class="text-sm font-semibold text-slate-700">Họ và tên</label>
            <input name="name" type="text" placeholder="Họ và tên" value="{{ old('name') }}" class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm outline-none focus:border-indigo-300 focus:ring-2 focus:ring-indigo-600/20">
            @error('name')
            <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="text-sm font-semibold text-slate-700">Email</label>
            <input name="email" type="text" placeholder="Nhập email" value="{{ old('email') }}" class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm outline-none focus:border-indigo-300 focus:ring-2 focus:ring-indigo-600/20">
            @error('email')
            <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="text-sm font-semibold text-slate-700">Mật khẩu</label>
            <input name="password" type="password" placeholder="Nhập mật khẩu" class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm outline-none focus:border-indigo-300 focus:ring-2 focus:ring-indigo-600/20">
            @error('password')
            <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="text-sm font-semibold text-slate-700">Địa chỉ</label>
            <input name="address" type="text" placeholder="Nhập địa chỉ" value="{{ old('address') }}" class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm outline-none focus:border-indigo-300 focus:ring-2 focus:ring-indigo-600/20">
            @error('address')
            <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="text-sm font-semibold text-slate-700">Điện thoại</label>
            <input name="phone_number" type="text" placeholder="Nhập điện thoại" value="{{ old('phone_number') }}" class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm outline-none focus:border-indigo-300 focus:ring-2 focus:ring-indigo-600/20">
            @error('phone_number')
            <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="text-sm font-semibold text-slate-700">Role</label>
            <select name="role" class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm outline-none focus:border-indigo-300 focus:ring-2 focus:ring-indigo-600/20">
                @foreach($roles as $role)
                <option {{ old('role') == $role->name ? 'selected' : '' }} value="{{ $role->name }}">{{ $role->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="items-center">
            <label class="mt-6 inline-flex items-center gap-2 text-sm font-semibold text-slate-700">
                <input name="terms_accepted" type="checkbox" value="1" class="h-4 w-4 rounded border-slate-300 text-indigo-600 focus:ring-2 focus:ring-indigo-600/20">
                <span>Chấp nhận điều khoản</span>
            </label>
             @error('terms_accepted')
            <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="flex flex-wrap items-center justify-end gap-2 border-t border-slate-200 pt-4">
        <a href="{{ route('users.index') }}" class="rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700 shadow-sm hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-indigo-600/20">
            Hủy
        </a>

        <button type="submit" class="rounded-xl bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm shadow-indigo-500/30 hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-600/20">
            Tạo người dùng
        </button>
    </div>
</form>
@endsection