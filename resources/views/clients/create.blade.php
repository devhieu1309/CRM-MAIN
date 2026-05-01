@extends('layouts.layout-deafault')

@section('title', 'Thêm khách hàng')
@section('page_title', 'Thêm khách hàng')
@section('page_desc', 'Tạo mới một khách hàng')

@section('page_actions')
<a href="{{ route('clients.index') }}"
    class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700 shadow-sm hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-indigo-600/20">
    Quay lại
</a>
@endsection

@section('content')
<form action="{{ route('clients.store') }}" method="POST" class="space-y-6">
    @csrf

    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
        <div>
            <label class="text-sm font-semibold text-slate-700">Tên khách hàng</label>
            <input name="customer_name" type="text" placeholder="Nhập tên khách hàng"
                value="{{ old('customer_name') }}" class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm outline-none focus:border-indigo-300 focus:ring-2 focus:ring-indigo-600/20">
            @error('customer_name')
            <div class="text-red-500 text-sm">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label class="text-sm font-semibold text-slate-700">Email khách hàng</label>
            <input name="customer_email" type="email" placeholder="Nhập email"
                value="{{ old('customer_email') }}" class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm outline-none focus:border-indigo-300 focus:ring-2 focus:ring-indigo-600/20">
            @error('customer_email')
            <div class="text-red-500 text-sm">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label class="text-sm font-semibold text-slate-700">Số điện thoại khách hàng</label>
            <input name="customer_phone" type="tel" placeholder="Nhập số điện thoại"
                value="{{ old('customer_phone') }}" class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm outline-none focus:border-indigo-300 focus:ring-2 focus:ring-indigo-600/20">
            @error('customer_phone')
            <div class="text-red-500 text-sm">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label class="text-sm font-semibold text-slate-700">Tên công ty</label>
            <input name="company_name" type="text" placeholder="Nhập tên công ty"
                value="{{ old('company_name') }}" class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm outline-none focus:border-indigo-300 focus:ring-2 focus:ring-indigo-600/20">
            @error('company_name')
            <div class="text-red-500 text-sm">{{ $message }}</div>
            @enderror
        </div>

        <div class="sm:col-span-2">
            <label class="text-sm font-semibold text-slate-700">Địa chỉ</label>
            <input name="address" type="text" placeholder="Nhập địa chỉ"
                value="{{ old('address') }}" class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm outline-none focus:border-indigo-300 focus:ring-2 focus:ring-indigo-600/20">
            @error('address')
            <div class="text-red-500 text-sm">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label class="text-sm font-semibold text-slate-700">Tỉnh/ Thành phố</label>
            <input name="city" type="text" placeholder="Nhập tỉnh/ thành phố"
                value="{{ old('city') }}" class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm outline-none focus:border-indigo-300 focus:ring-2 focus:ring-indigo-600/20">
            @error('city')
            <div class="text-red-500 text-sm">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label class="text-sm font-semibold text-slate-700">Mã bưu điện</label>
            <input name="postal_code" type="text" placeholder="Nhập mã bưu điện"
                value="{{ old('postal_code') }}" class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm outline-none focus:border-indigo-300 focus:ring-2 focus:ring-indigo-600/20">
            @error('postal_code')
            <div class="text-red-500 text-sm">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label class="text-sm font-semibold text-slate-700">Mã số thuế</label>
            <input name="tax_code" type="text" placeholder="Nhập mã số thuế"
               value="{{ old('tax_code') }}" class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm outline-none focus:border-indigo-300 focus:ring-2 focus:ring-indigo-600/20">
            @error('tax_code')
            <div class="text-red-500 text-sm">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="flex flex-wrap items-center justify-end gap-2 border-t border-slate-200 pt-4">
        <a href="{{ route('clients.index') }}"
            class="rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700 shadow-sm hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-indigo-600/20">
            Hủy
        </a>

        <button type="submit"
            class="rounded-xl bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm shadow-indigo-500/30 hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-600/20">
            Tạo khách hàng
        </button>
    </div>
</form>
@endsection