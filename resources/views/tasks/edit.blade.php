@extends('layouts.layout-deafault')

@section('title', 'Chỉnh sửa công việc')
@section('page_title', 'Chỉnh sửa công việc')
@section('page_desc', 'Cập nhật thông tin công việc')

@section('page_actions')
    <a href="{{ route('tasks.index') }}"
        class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700 shadow-sm hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-indigo-600/20">
        Quay lại
    </a>
@endsection

@section('content')
    <form action="{{ route('tasks.update', $task) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <div class="sm:col-span-2">
                <label class="text-sm font-semibold text-slate-700">Tiêu đề</label>
                <input name="title" type="text" value="{{ old('title', $task->title) }}"
                    class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm outline-none focus:border-indigo-300 focus:ring-2 focus:ring-indigo-600/20">
                @error('title')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div class="sm:col-span-2">
                <label class="text-sm font-semibold text-slate-700">Mô tả</label>
                <textarea name="description" rows="4"
                    class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm outline-none focus:border-indigo-300 focus:ring-2 focus:ring-indigo-600/20">{{ old('description', $task->description) }}</textarea>
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
                        <option {{ old('client_id', $task->client_id == $client->id ? "selected" : "") }}
                            value="{{ $client->id}}">{{ $client->customer_name }}</option>
                    @endforeach
                </select>
                @error('client_id')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="text-sm font-semibold text-slate-700">Dự án</label>
                <select name="project_id"
                    class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm outline-none focus:border-indigo-300 focus:ring-2 focus:ring-indigo-600/20">
                    <option value="">Chọn dự án</option>
                    @foreach($projects as $project)
                        <option {{ old('project_id', $task->project ? "selected" : "") }} value="{{ $project->id }}">
                            {{ $project->title }}
                        </option>
                    @endforeach
                </select>
                @error('project_id')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="text-sm font-semibold text-slate-700">Người phụ trách</label>
                <select name="user_id"
                    class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm outline-none focus:border-indigo-300 focus:ring-2 focus:ring-indigo-600/20">
                    <option value="">Chọn người phụ trách</option>
                    @foreach($users as $user)
                        <option {{ old('user_id', $task->user_id) == $user->id ? "selected" : "" }} value="{{ $user->id }}">
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
                @error('user_id')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="text-sm font-semibold text-slate-700">Thời hạn</label>
                <input type="text" name="deadline" value="{{ old('deadline', $task->deadline->format('m/d/Y')) }}"
                    placeholder="mm/dd/yyyy"
                    class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm outline-none focus:border-indigo-300 focus:ring-2 focus:ring-indigo-600/20">
            </div>

            <div class="sm:col-span-2">
                <label class="text-sm font-semibold text-slate-700">Status</label>
                <select name="status"
                    class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm outline-none focus:border-indigo-300 focus:ring-2 focus:ring-indigo-600/20">
                    <option value="">Chọn trạng thái công việc</option>
                    @foreach($statuses as $status)
                        <option {{ old('status', $task->status->value == $status->value ? "selected" : "") }}
                            value="{{ $status->value }}">{{ $status->label() }}</option>
                    @endforeach
                </select>
                @error('status')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="flex flex-wrap items-center justify-end gap-2 border-t border-slate-200 pt-4">
            <a href="{{ route('tasks.index') }}"
                class="rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700 shadow-sm hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-indigo-600/20">
                Hủy
            </a>

            <button type="submit"
                class="rounded-xl bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm shadow-indigo-500/30 hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-600/20">
                Lưu thay đổi
            </button>
        </div>
    </form>

    <section class="mt-8 rounded-2xl border border-slate-200 bg-slate-50/50 shadow-sm">
        @if (session('status'))
            <div role="alert"
                class="mx-4 mt-4 flex items-start gap-3 rounded-xl border border-emerald-300 bg-emerald-50 px-4 py-3 shadow-md shadow-emerald-500/10 ring-2 ring-emerald-100 sm:mx-6">
                <span
                    class="inline-flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-emerald-500 text-white shadow-sm">
                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm3.857-9.809a.75.75 0 0 0-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 1 0-1.06 1.061l2.5 2.5a.75.75 0 0 0 1.137-.089l4-5.5Z"
                            clip-rule="evenodd" />
                    </svg>
                </span>
                <p class="pt-1 text-sm font-semibold leading-snug text-emerald-900">
                    {{ session('status') }}
                </p>
            </div>
        @endif
        <div class="border-b border-slate-200 px-6 py-4">
            <h2 class="text-base font-semibold text-slate-900">Files</h2>
        </div>

        <div class="space-y-6 bg-white px-6 py-5">
            <form action="{{ route('media.upload', ['model' => 'Task', 'id' => $task->id]) }}" method="POST"
                enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div>
                    <label for="task-file" class="text-sm font-semibold text-slate-700">File</label>
                    <input id="task-file" type="file" name="file"
                        class="mt-2 block w-full cursor-pointer rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm text-slate-600 shadow-sm file:mr-4 file:rounded-lg file:border-0 file:bg-indigo-50 file:px-3 file:py-1.5 file:text-sm file:font-semibold file:text-indigo-700 hover:file:bg-indigo-100 focus:border-indigo-300 focus:outline-none focus:ring-2 focus:ring-indigo-600/20">
                </div>

                <div>
                    <button type="submit"
                        class="rounded-xl bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm shadow-indigo-500/30 hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-600/20">
                        Upload
                    </button>
                </div>
            </form>

            <div class="border-t border-slate-100 pt-4">
                {{-- Khi chưa có file: hiển thị <p>, ẩn bảng. Khi có file: ngược lại, lặp <tr> trong tbody --}}
                        <p
                            class="hidden rounded-xl border border-dashed border-slate-200 bg-slate-50/80 py-10 text-center text-sm text-slate-500">
                            No files uploaded yet.
                        </p>

                        <div class="overflow-hidden rounded-xl border border-slate-200 shadow-sm">
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-slate-200">
                                    <thead class="bg-slate-50/90">
                                        <tr>
                                            <th scope="col"
                                                class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                                                Tên tệp
                                            </th>
                                            <th scope="col"
                                                class="whitespace-nowrap px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                                                Ngày tải lên
                                            </th>
                                            <th scope="col"
                                                class="whitespace-nowrap px-4 py-3 text-right text-xs font-semibold uppercase tracking-wider text-slate-500">
                                                Thao tác
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-200 bg-white">
                                        @foreach($task->media as $media)
                                            <tr class="transition-colors hover:bg-slate-50/80">
                                                <td class="px-4 py-3">
                                                    <div class="flex min-w-0 items-center gap-3">
                                                        <span
                                                            class="inline-flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-indigo-50 text-indigo-600">
                                                            <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor"
                                                                aria-hidden="true">
                                                                <path fill-rule="evenodd"
                                                                    d="M4 4a2 2 0 0 1 2-2h4.586A2 2 0 0 1 12 2.586L15.414 6A2 2 0 0 1 16 7.414V16a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V4Zm8.5 1.5L13.5 3.5V6h-1a1 1 0 0 1-1-1V4.5H6v11h8V7.5h-1.5Z"
                                                                    clip-rule="evenodd" />
                                                            </svg>
                                                        </span>
                                                        <span
                                                            class="truncate text-sm font-medium text-slate-900">{{ $media->file_name }}</span>
                                                    </div>
                                                </td>
                                                <td class="whitespace-nowrap px-4 py-3 text-sm text-slate-600">
                                                    <time
                                                        datetime="2026-05-23T09:15:00">{{ $media->created_at->format('d/m/y H:i') }}</time>
                                                </td>
                                                <td class="whitespace-nowrap px-4 py-3 text-right">
                                                    <div class="inline-flex items-center justify-end gap-2">
                                                        <a href="{{ route('media.download', $media) }}"
                                                            class="rounded-xl border border-slate-200 bg-white px-3 py-1.5 text-sm font-semibold text-indigo-600 shadow-sm hover:bg-indigo-50 focus:outline-none focus:ring-2 focus:ring-indigo-600/20">
                                                            Tải xuống
                                                        </a>
                                                        <form
                                                            action="{{ route('media.delete', ['model' => 'Task', 'id' => $task->id, 'media' => $media]) }}"
                                                            method="POST" class="inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button
                                                                onclick="return confirm('Bạn có chắc muốn xóa file này không?')"
                                                                type="submit"
                                                                class="rounded-xl border border-rose-200 bg-white px-3 py-1.5 text-sm font-semibold text-rose-600 shadow-sm hover:bg-rose-50 focus:outline-none focus:ring-2 focus:ring-rose-600/20">
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
            </div>
        </div>
    </section>
@endsection