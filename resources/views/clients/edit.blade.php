@extends('layouts.layout-deafault')

@section('title', 'Chỉnh sửa khách hàng')
@section('page_title', 'Chỉnh sửa khách hàng')
@section('page_desc', 'Cập nhật thông tin khách hàng')

@section('page_actions')
<a href="{{ route('clients.index') }}"
    class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700 shadow-sm hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-indigo-600/20">
    Quay lại
</a>
@endsection

@section('content')
<form action="{{ route('clients.update', $client) }}" method="POST" class="space-y-6">
    @csrf
    @method('PUT')

    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
        <div>
            <label class="text-sm font-semibold text-slate-700">Tên khách hàng</label>
            <input name="customer_name" type="text" value="{{ old('customer_name', $client->customer_name) }}"
                class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm outline-none focus:border-indigo-300 focus:ring-2 focus:ring-indigo-600/20">
            @error('customer_name')
            <div class="text-red-500 text-sm">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label class="text-sm font-semibold text-slate-700">Email khách hàng</label>
            <input name="customer_email" type="email" value="{{ old('customer_email', $client->customer_email) }}"
                class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm outline-none focus:border-indigo-300 focus:ring-2 focus:ring-indigo-600/20">
            @error('customer_email')
            <div class="text-red-500 text-sm">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label class="text-sm font-semibold text-slate-700">Số điện thoại khách hàng</label>
            <input name="customer_phone" type="tel" value="{{ old('customer_phone', $client->customer_phone) }}" 
                class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm outline-none focus:border-indigo-300 focus:ring-2 focus:ring-indigo-600/20">
            @error('customer_phone')
            <div class="text-red-500 text-sm">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label class="text-sm font-semibold text-slate-700">Tên công ty</label>
            <input name="company_name" type="text" value="{{ old('company_name', $client->company_name) }}"
                class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm outline-none focus:border-indigo-300 focus:ring-2 focus:ring-indigo-600/20">
            @error('company_name')
            <div class="text-red-500 text-sm">{{ $message }}</div>
            @enderror
        </div>

        <div class="sm:col-span-2">
            <label class="text-sm font-semibold text-slate-700">Địa chỉ</label>
            <input name="address" type="text" value="{{ old('address', $client->address) }}"
                class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm outline-none focus:border-indigo-300 focus:ring-2 focus:ring-indigo-600/20">
            @error('address')
            <div class="text-red-500 text-sm">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label class="text-sm font-semibold text-slate-700">Tỉnh/ Thành phố</label>
            <input name="city" type="text" value="{{ old('city', $client->city) }}"
                class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm outline-none focus:border-indigo-300 focus:ring-2 focus:ring-indigo-600/20">
            @error('city')
            <div class="text-red-500 text-sm">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label class="text-sm font-semibold text-slate-700">Mã bưu điện</label>
            <input name="postal_code" type="text" value="{{ old('postal_code', $client->postal_code) }}"
                class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm outline-none focus:border-indigo-300 focus:ring-2 focus:ring-indigo-600/20">
            @error('postal_code')
            <div class="text-red-500 text-sm">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label class="text-sm font-semibold text-slate-700">Mã số thuế</label>
            <input name="tax_code" type="text" value="{{ old('tax_code', $client->tax_code) }}"
                class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm outline-none focus:border-indigo-300 focus:ring-2 focus:ring-indigo-600/20">
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
            Lưu thay đổi
        </button>
    </div>
</form>
@endsection