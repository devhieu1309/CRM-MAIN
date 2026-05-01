@extends('layouts.layout-deafault')

@section('title', 'Quản lý khách hàng')
@section('page_title', 'Quản lý khách hàng')
@section('page_desc', 'Danh sách khách hàng trong hệ thống')

@section('page_actions')
<a href="{{ route('clients.create') }}"
    class="inline-flex items-center justify-center gap-2 rounded-xl bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm shadow-indigo-500/30 hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-600/20">
    Thêm mới
</a>
@endsection

@section('content')

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
                        Tên khách hàng
                    </th>
                    <th
                        class="whitespace-nowrap px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                        Email
                    </th>
                    <th
                        class="whitespace-nowrap px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                        Số điện thoại
                    </th>
                    <th
                        class="whitespace-nowrap px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                        Tên công ty
                    </th>
                    <th
                        class="whitespace-nowrap px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                        Địa chỉ
                    </th>
                    <th
                        class="whitespace-nowrap px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                        Tỉnh/ Thành phố
                    </th>
                    <th
                        class="whitespace-nowrap px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                        Mã bưu điện
                    </th>
                    <th
                        class="whitespace-nowrap px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                        Mã số thuế
                    </th>
                    <th
                        class="whitespace-nowrap px-4 py-3 text-right text-xs font-semibold uppercase tracking-wider text-slate-500">
                        Hành động
                    </th>
                </tr>
            </thead>

            <tbody class="divide-y divide-slate-200 bg-white">
                @foreach($clients as $client)
                <tr class="group hover:bg-slate-50">
                    <td
                        class="sticky left-0 z-10 min-w-[220px] whitespace-nowrap border-r border-slate-200 bg-white px-4 py-3 text-sm font-semibold text-slate-900 group-hover:bg-slate-50">
                        {{ $client->customer_name }}
                    </td>
                    <td class="whitespace-nowrap px-4 py-3 text-sm text-slate-600">{{ $client->customer_email }}</td>
                    <td class="whitespace-nowrap px-4 py-3 text-sm text-slate-600">{{ $client->customer_phone }}</td>
                    <td class="whitespace-nowrap px-4 py-3 text-sm text-slate-600">{{ $client->company_name }}</td>
                    <td class="whitespace-nowrap px-4 py-3 text-sm text-slate-600">{{ $client->address }}</td>
                    <td class="whitespace-nowrap px-4 py-3 text-sm text-slate-600">{{ $client->city }}</td>
                    <td class="whitespace-nowrap px-4 py-3 text-sm text-slate-600">{{ $client->postal_code }}</td>
                    <td class="whitespace-nowrap px-4 py-3 text-sm text-slate-600">{{ $client->tax_code }}</td>
                    <td class="whitespace-nowrap px-4 py-3">
                        <div class="flex justify-end gap-2">
                            <a href="{{ route('clients.edit', $client) }}"
                                class="rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm font-semibold text-slate-700 shadow-sm hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-indigo-600/20">
                                Sửa
                            </a>

                            <form action="{{ route('clients.destroy', $client) }}" method="POST" class="inline-block">
                                @method('DELETE')
                                @csrf
                                <button onclick="return confirm('Bạn có chắc muốn xóa khách hàng không?')" type="submit" class="rounded-xl border border-red-200 bg-white px-3 py-2 text-sm font-semibold text-red-700 shadow-sm hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-red-600/20">
                                Xóa
                            </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="mt-4 flex flex-wrap items-center justify-between gap-3">
    @if($clients->total() > 0)
    <div class="text-sm text-slate-600">Hiển thị {{ $clients->firstItem() }}-{{ $clients->lastItem() }} / {{ $clients->total() }}</div>
    @else
    <div class="text-sm text-slate-600">Không có dữ liệu</div>
    @endif

    <nav class="inline-flex items-center gap-1">
        @if(!$clients->onFirstPage())
        <a href="{{ $clients->url(1) }}"
            class="rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm font-semibold text-slate-700 shadow-sm hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-indigo-600/20">
            Đầu
        </a>
        @endif

        @if($clients->currentPage() > 1)
        <a href="{{ $clients->url($clients->currentPage() - 1) }}"
            class="rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm font-semibold text-slate-700 shadow-sm hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-indigo-600/20">...</a>
        @endif

        @php
        $start = max(1, $clients->currentPage() - 1);
        $end = min($clients->lastPage(), $clients->currentPage() + 1);
        @endphp

        @for($i = $start; $i <= $end; $i++)
            <a href="{{ $clients->url($i) }}"
            class="{{ $clients->currentPage() == $i ? "bg-indigo-600 text-white" : ""}} rounded-xl border border-slate-200 px-3 py-2 text-sm font-semibold text-slate-700 shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-600/20">{{ $i }}</a>
            @endfor

            @if($clients->currentPage() < $clients->lastPage())
                <a href="{{ $clients->url($clients->currentPage() + 1) }}"
                    class="rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm font-semibold text-slate-700 shadow-sm hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-indigo-600/20">...</a>
                @endif

                @if(!$clients->onLastPage())
                <a href="{{ $clients->url($clients->lastPage()) }}"
                    class="rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm font-semibold text-slate-700 shadow-sm hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-indigo-600/20">
                    Cuối
                </a>
                @endif
    </nav>
</div>
@endsection
