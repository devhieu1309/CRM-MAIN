@extends('layouts.layout-deafault')

@section('title', 'Thêm dự án')
@section('page_title', 'Thêm dự án')
@section('page_desc', 'Tạo mới một dự án')

@section('page_actions')
<a href="{{ route('projects.index') }}"
    class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700 shadow-sm hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-indigo-600/20">
    Quay lại
</a>
@endsection

@section('content')
<form action="{{ route('projects.store') }}" method="POST" class="space-y-6">
    @csrf
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
        <div class="sm:col-span-2">
            <label class="text-sm font-semibold text-slate-700">Tiêu đề</label>
            <input name="title" value="{{ old('title') }}" type="text" placeholder="Nhập tiêu đề dự án"
                class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm outline-none focus:border-indigo-300 focus:ring-2 focus:ring-indigo-600/20">
            @error('title')
            <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div class="sm:col-span-2">
            <label class="text-sm font-semibold text-slate-700">Mô tả</label>
            <textarea name="description" rows="4" placeholder="Nhập mô tả dự án"
                class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm outline-none focus:border-indigo-300 focus:ring-2 focus:ring-indigo-600/20">{{ old('description') }}</textarea>
            @error('description')
            <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="text-sm font-semibold text-slate-700">Khách hàng</label>
            <select name="client_id"
                class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm outline-none focus:border-indigo-300 focus:ring-2 focus:ring-indigo-600/20">
                <option value="">Chọn khách hàng</option>
                @foreach($clients as $client)
                <option {{ old('client_id') == $client->id ? 'selected' : '' }} value="{{ $client->id }}">{{ $client->customer_name }}</option>
                @endforeach
            </select>
            @error('client_id')
            <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="text-sm font-semibold text-slate-700">Người phụ trách</label>
            <select name="user_id"
                class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm outline-none focus:border-indigo-300 focus:ring-2 focus:ring-indigo-600/20">
                <option value="">Chọn người phụ trách</option>
                @foreach($users as $user)
                <option {{ old('user_id') == $user->id ? 'selected' : '' }} value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
            @error('user_id')
            <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="text-sm font-semibold text-slate-700">Trạng thái</label>
            <select name="status"
                class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm outline-none focus:border-indigo-300 focus:ring-2 focus:ring-indigo-600/20">
                @foreach($statuses as $status)
                <option {{ old('status') == $status->value ? 'selected' : '' }} value="{{ $status->value }}">{{ $status->label() }}</option>
                @endforeach
            </select>
            @error('status')
            <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="text-sm font-semibold text-slate-700">Thời hạn</label>
            <input type="text" name="deadline"
                value="{{ old('deadline') }}"
                placeholder="dd/mm/yyyy"
                class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm outline-none focus:border-indigo-300 focus:ring-2 focus:ring-indigo-600/20">
            @error('deadline')
            <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="flex flex-wrap items-center justify-end gap-2 border-t border-slate-200 pt-4">
        <a href="{{ route('projects.index') }}"
            class="rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700 shadow-sm hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-indigo-600/20">
            Hủy
        </a>

        <button type="submit"
            class="rounded-xl bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm shadow-indigo-500/30 hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-600/20">
            Tạo dự án
        </button>
    </div>
</form>
@endsection