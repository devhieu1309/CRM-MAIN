@extends('layouts.layout-deafault')

@section('title', 'Quản lý dự án')
@section('page_title', 'Quản lý dự án')
@section('page_desc', 'Danh sách dự án trong hệ thống')

@section('page_actions')
<a href="{{ route('projects.create') }}"
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
                        class="sticky left-0 z-20 min-w-[240px] whitespace-nowrap border-r border-slate-200 bg-slate-50 px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                        Tiêu đề
                    </th>
                    <th class="min-w-[320px] px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                        Mô tả
                    </th>
                    <th class="whitespace-nowrap px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                        Khách hàng
                    </th>
                    <th class="whitespace-nowrap px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                        Người phụ trách
                    </th>
                    <th class="whitespace-nowrap px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                        Trạng thái
                    </th>
                    <th class="whitespace-nowrap px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                        Thời hạn
                    </th>
                    <th class="whitespace-nowrap px-4 py-3 text-right text-xs font-semibold uppercase tracking-wider text-slate-500">
                        Hành động
                    </th>
                </tr>
            </thead>

            <tbody class="divide-y divide-slate-200 bg-white">
                @foreach($projects as $project)
                <tr class="group hover:bg-slate-50">
                    <td
                        class="sticky left-0 z-10 min-w-[240px] whitespace-nowrap border-r border-slate-200 bg-white px-4 py-3 text-sm font-semibold text-slate-900 group-hover:bg-slate-50">
                        <a href="{{ route('projects.show', $project) }}">{{ $project->title }}</a>
                    </td>
                    <td class="min-w-[320px] px-4 py-3 text-sm text-slate-600">
                        {{ $project->description }}
                    </td>
                    <td class="whitespace-nowrap px-4 py-3 text-sm text-slate-600">{{ $project->client->customer_name }}</td>
                    <td class="whitespace-nowrap px-4 py-3 text-sm text-slate-600">{{ $project->user->name }}</td>
                    <td class="whitespace-nowrap px-4 py-3">
                        <span class="inline-flex items-center rounded-full bg-amber-50 px-2.5 py-1 text-xs font-semibold text-amber-700">
                            {{ $project->status->label() }}
                        </span>
                    </td>
                    <td class="whitespace-nowrap px-4 py-3 text-sm text-slate-600">{{ $project->deadline->format('d-m-Y') }}</td>
                    <td class="whitespace-nowrap px-4 py-3">
                        <div class="flex justify-end gap-2">
                            <a href="{{ route('projects.edit', $project) }}"
                                class="rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm font-semibold text-slate-700 shadow-sm hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-indigo-600/20">
                                Sửa
                            </a>

                            <form action="{{ route('projects.destroy', $project) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Bạn có chắc muốn xóa dự án này không?')"
                                    class="rounded-xl border border-red-200 bg-white px-3 py-2 text-sm font-semibold text-red-700 shadow-sm hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-red-600/20">
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
    @if($projects->total() > 0)
    <div class="text-sm text-slate-600">Hiển thị {{ $projects->firstItem() }}-{{ $projects->lastItem() }} / {{ $projects->total() }}</div>
    @else
    <div class="text-sm text-slate-600">Không có dữ liệu</div>
    @endif

    <nav class="inline-flex items-center gap-1">
        @if(!$projects->onFirstPage())
        <a href="{{ $projects->url(1) }}"
            class="rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm font-semibold text-slate-700 shadow-sm hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-indigo-600/20">
            Đầu
        </a>
        @endif

        @if($projects->currentPage() > 1)
        <a href="{{ $projects->url($projects->currentPage() - 1) }}"
            class="rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm font-semibold text-slate-700 shadow-sm hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-indigo-600/20">...</a>
        @endif

        @php
        $start = max(1, $projects->currentPage() - 1);
        $end = min($projects->lastPage(), $projects->currentPage() + 1);
        @endphp

        <!-- <a href="#" class="rounded-xl bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm shadow-indigo-500/30 focus:outline-none focus:ring-2 focus:ring-indigo-600/20">1</a> -->
        @for($i = $start; $i <= $end; $i++)
            <a href="{{ $projects->url($i) }}"
            class="{{ $projects->currentPage() == $i ? "bg-indigo-600 text-white" : ""}} rounded-xl border border-slate-200 px-3 py-2 text-sm font-semibold text-slate-700 shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-600/20">{{ $i }}</a>
            @endfor
            <!-- <a href="#"
            class="rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm font-semibold text-slate-700 shadow-sm hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-indigo-600/20">3</a> -->

            @if($projects->currentPage() < $projects->lastPage())
                <a href="{{ $projects->url($projects->currentPage() + 1) }}"
                    class="rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm font-semibold text-slate-700 shadow-sm hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-indigo-600/20">...</a>
                @endif

                @if(!$projects->onLastPage())
                <a href="{{ $projects->url($projects->lastPage()) }}"
                    class="rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm font-semibold text-slate-700 shadow-sm hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-indigo-600/20">
                    Cuối
                </a>
                @endif
    </nav>
</div>
@endsection