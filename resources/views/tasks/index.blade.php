@extends('layouts.layout-deafault')

@section('title', 'Quản lý công việc')
@section('page_title', 'Quản lý công việc')
@section('page_desc', 'Danh sách công việc trong hệ thống')

@section('page_actions')
    <a href="{{ route('tasks.create') }}"
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
                            Tiêu đề
                        </th>
                        <th
                            class="min-w-[320px] px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Mô tả
                        </th>
                        <th
                            class="whitespace-nowrap px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Khách hàng
                        </th>
                        <th
                            class="whitespace-nowrap px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Dự án
                        </th>
                        <th
                            class="whitespace-nowrap px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Người phụ trách
                        </th>
                        <th
                            class="whitespace-nowrap px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Thời hạn
                        </th>
                        <th
                            class="whitespace-nowrap px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Trạng thái
                        </th>
                        <th
                            class="whitespace-nowrap px-4 py-3 text-right text-xs font-semibold uppercase tracking-wider text-slate-500">
                            Hành động
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-200 bg-white">
                    @foreach($tasks as $task)
                        <tr class="group hover:bg-slate-50">
                            <td
                                class="sticky left-0 z-10 min-w-[220px] whitespace-nowrap border-r border-slate-200 bg-white px-4 py-3 text-sm font-semibold text-slate-900 group-hover:bg-slate-50">
                                <a class="hover:underline" href="{{ route('tasks.show', $task) }}">{{ $task->title }}</a>
                            </td>
                            <td class="min-w-[320px] px-4 py-3 text-sm text-slate-600">
                                {{  $task->description }}
                            </td>
                            <td class="whitespace-nowrap px-4 py-3 text-sm text-slate-600">{{ $task->client->customer_name }}
                            </td>
                            <td class="whitespace-nowrap px-4 py-3 text-sm text-slate-600">{{ $task->project->title }}</td>
                            <td class="whitespace-nowrap px-4 py-3 text-sm text-slate-600">{{ $task->user->name }}</td>
                            <td class="whitespace-nowrap px-4 py-3 text-sm text-slate-600">
                                {{ $task->deadline->format('d-m-Y') }}
                            </td>
                            <td class="whitespace-nowrap px-4 py-3">
                                <span
                                    class="inline-flex items-center rounded-full bg-amber-50 px-2.5 py-1 text-xs font-semibold text-amber-700">
                                    {{ $task->status->label() }}
                                </span>
                            </td>
                            <td class="whitespace-nowrap px-4 py-3">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('tasks.edit', $task) }}"
                                        class="rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm font-semibold text-slate-700 shadow-sm hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-indigo-600/20">
                                        Sửa
                                    </a>
                                    <form action="{{ route('tasks.destroy', $task) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="return confirm('Bạn có chắc muốn xóa công việc không?')" type="submit"
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
        @if($tasks->total() > 0)
            <div class="text-sm text-slate-600">Hiển thị {{ $tasks->firstItem() }}-{{ $tasks->lastItem() }} /
                {{ $tasks->total() }}
            </div>
        @else
            <div class="text-sm text-slate-600">Không có dữ liệu</div>
        @endif

        <nav class="inline-flex items-center gap-1">
            @if(!$tasks->onFirstPage())
                <a href="{{ $tasks->url(1) }}"
                    class="rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm font-semibold text-slate-700 shadow-sm hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-indigo-600/20">
                    Đầu
                </a>
            @endif

            @if($tasks->currentPage() > 1)
                <a href="{{ $tasks->url($tasks->currentPage() - 1) }}"
                    class="rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm font-semibold text-slate-700 shadow-sm hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-indigo-600/20">...</a>
            @endif

            @php
                $start = max(1, $tasks->currentPage() - 1);
                $end = min($tasks->lastPage(), $tasks->currentPage() + 1);
            @endphp

            <!-- <a href="#" class="rounded-xl bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm shadow-indigo-500/30 focus:outline-none focus:ring-2 focus:ring-indigo-600/20">1</a> -->
            @for($i = $start; $i <= $end; $i++)
                <a href="{{ $tasks->url($i) }}"
                    class="{{ $tasks->currentPage() == $i ? "bg-indigo-600 text-white" : ""}} rounded-xl border border-slate-200 px-3 py-2 text-sm font-semibold text-slate-700 shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-600/20">{{ $i }}</a>
            @endfor
            <!-- <a href="#"
                        class="rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm font-semibold text-slate-700 shadow-sm hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-indigo-600/20">3</a> -->

            @if($tasks->currentPage() < $tasks->lastPage())
                <a href="{{ $tasks->url($tasks->currentPage() + 1) }}"
                    class="rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm font-semibold text-slate-700 shadow-sm hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-indigo-600/20">...</a>
            @endif

            @if(!$tasks->onLastPage())
                <a href="{{ $tasks->url($tasks->lastPage()) }}"
                    class="rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm font-semibold text-slate-700 shadow-sm hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-indigo-600/20">
                    Cuối
                </a>
            @endif
        </nav>
    </div>
@endsection