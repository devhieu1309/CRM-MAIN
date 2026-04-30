@extends('layouts.layout-deafault')

@section('title', 'Chỉnh sửa người dùng')
@section('page_title', 'Chỉnh sửa người dùng')
@section('page_desc', 'Cập nhật thông tin tài khoản')

@section('page_actions')
<a href="{{ route('users.index') }}" class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700 shadow-sm hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-indigo-600/20">
    Quay lại
</a>
@endsection

@section('content')
<form action="{{ route('users.update', $user) }}" method="POST" class="space-y-6">
    @csrf
    @method('PUT')
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
        <div>
            <label class="text-sm font-semibold text-slate-700">Họ và tên</label>
            <input name="name" type="text" value="{{ old('name', $user->name) }}" class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm outline-none focus:border-indigo-300 focus:ring-2 focus:ring-indigo-600/20">
            @error('name')
            <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="text-sm font-semibold text-slate-700">Email</label>
            <input name="email" type="text" value="{{ old('email', $user->email) }}" class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm outline-none focus:border-indigo-300 focus:ring-2 focus:ring-indigo-600/20">
            @error('email')
            <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="text-sm font-semibold text-slate-700">Đặt lại mật khẩu</label>
            <input name="password" type="password" placeholder="Nhập mật khẩu mới" value="" class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm outline-none focus:border-indigo-300 focus:ring-2 focus:ring-indigo-600/20">
            @error('password')
            <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="text-sm font-semibold text-slate-700">Địa chỉ</label>
            <input name="address" type="text" value="{{ old('address', $user->address) }}" class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm outline-none focus:border-indigo-300 focus:ring-2 focus:ring-indigo-600/20">
            @error('address')
            <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="text-sm font-semibold text-slate-700">Điện thoại</label>
            <input name="phone_number" type="text" value="{{ old('phone_number', $user->phone_number) }}" class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm outline-none focus:border-indigo-300 focus:ring-2 focus:ring-indigo-600/20">
            @error('phone_number')
            <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="text-sm font-semibold text-slate-700">Role</label>
            <select name="role" class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm outline-none focus:border-indigo-300 focus:ring-2 focus:ring-indigo-600/20">
                @foreach($roles as $role)
                <option {{ $user->roles->pluck('name')->contains($role->name) ? 'selected' : '' }} value="{{ $role->name }}">{{ $role->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="items-center">
            <label class="mt-6 inline-flex items-center gap-2 text-sm font-semibold text-slate-700">
                <input {{ $user->terms_accepted_at ? 'checked' : '' }} name="terms_accepted" type="checkbox" value="1" class="h-4 w-4 rounded border-slate-300 text-indigo-600 focus:ring-2 focus:ring-indigo-600/20" checked>
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
            Lưu thay đổi
        </button>
    </div>
</form>
@endsection