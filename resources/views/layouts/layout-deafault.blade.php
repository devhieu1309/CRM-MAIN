<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', config('app.name', 'Laravel'))</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="min-h-screen bg-slate-50 text-slate-900 antialiased">
        <div class="min-h-screen">
            <header class="sticky top-0 z-30 border-b border-slate-200/70 bg-white/80 backdrop-blur">
                <div class="mx-auto flex h-14 max-w-screen-2xl items-center gap-3 px-4">
                    <a href="{{ url('/') }}" class="flex items-center gap-2">
                        <span class="inline-flex h-9 w-9 items-center justify-center rounded-xl bg-indigo-600 text-sm font-semibold text-white shadow-sm shadow-indigo-500/30">
                            CRM
                        </span>
                        <span class="hidden text-sm font-semibold text-slate-900 sm:inline">@yield('brand', 'Admin')</span>
                    </a>

                    <div class="flex-1">
                        <div class="relative mx-auto max-w-md">
                            <div class="pointer-events-none absolute inset-y-0 left-3 flex items-center">
                                <svg class="h-4 w-4 text-slate-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 1 0 0 11 5.5 5.5 0 0 0 0-11ZM2 9a7 7 0 1 1 12.06 4.31l2.82 2.82a.75.75 0 1 1-1.06 1.06l-2.82-2.82A7 7 0 0 1 2 9Z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input type="text" placeholder="Tìm kiếm..." class="w-full rounded-xl border border-slate-200 bg-white py-2 pl-9 pr-3 text-sm shadow-sm outline-none ring-0 placeholder:text-slate-400 focus:border-indigo-300 focus:ring-2 focus:ring-indigo-600/20">
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <div class="hidden text-right sm:block">
                            <div class="text-sm font-medium text-slate-900">{{ auth()->user()->name ?? 'Người dùng' }}</div>
                            <div class="text-xs text-slate-500">{{ auth()->user()->email ?? '' }}</div>
                        </div>

                        <form method="POST" action="{{ route('logout') }}" class="shrink-0">
                            @csrf
                            <button type="submit" class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm font-semibold text-slate-700 shadow-sm hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-indigo-600/20">
                                Đăng xuất
                            </button>
                        </form>
                    </div>
                </div>
            </header>

            <div class="mx-auto flex w-full max-w-screen-2xl gap-4 px-4 py-6">
                <aside class="w-64 shrink-0">
                    <div class="rounded-2xl border border-slate-200 bg-white p-3 shadow-sm">
                        <div class="px-2 pb-2 text-xs font-semibold uppercase tracking-wider text-slate-500">Menu</div>

                        @php
                            $navDashboard = request()->routeIs('dashboard');
                            $navClients = request()->routeIs('clients.*');
                            $navProjects = request()->routeIs('projects.*');
                            $navTasks = request()->routeIs('tasks.*');
                            $navUsers = request()->routeIs('users.*');
                        @endphp

                        <nav class="space-y-1">
                            <a href="{{ route('dashboard') }}"
                                @class([
                                    'group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold',
                                    'bg-indigo-50 text-indigo-900 ring-1 ring-indigo-100' => $navDashboard,
                                    'text-slate-700 hover:bg-slate-50 hover:text-slate-900' => ! $navDashboard,
                                ])>
                                <span @class([
                                    'inline-flex h-9 w-9 items-center justify-center rounded-xl',
                                    'bg-indigo-600 text-white shadow-sm shadow-indigo-500/30' => $navDashboard,
                                    'bg-indigo-50 text-indigo-700 group-hover:bg-indigo-100' => ! $navDashboard,
                                ])>
                                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path d="M10.75 2.5a.75.75 0 0 0-1.5 0v1.58a6.25 6.25 0 0 0-5.42 5.42H2.25a.75.75 0 0 0 0 1.5h1.58a6.25 6.25 0 0 0 5.42 5.42v1.58a.75.75 0 0 0 1.5 0v-1.58a6.25 6.25 0 0 0 5.42-5.42h1.58a.75.75 0 0 0 0-1.5h-1.58a6.25 6.25 0 0 0-5.42-5.42V2.5Z" />
                                        <path d="M10 7.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5Z" />
                                    </svg>
                                </span>
                                <span class="flex-1">Dashboard</span>
                            </a>

                            @role('admin')
                                <a href="{{ route('users.index') }}"
                                    @class([
                                        'group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold',
                                        'bg-indigo-50 text-indigo-900 ring-1 ring-indigo-100' => $navUsers,
                                        'text-slate-700 hover:bg-slate-50 hover:text-slate-900' => ! $navUsers,
                                    ])>
                                    <span @class([
                                        'inline-flex h-9 w-9 items-center justify-center rounded-xl',
                                        'bg-indigo-600 text-white shadow-sm shadow-indigo-500/30' => $navUsers,
                                        'bg-indigo-50 text-indigo-700 group-hover:bg-indigo-100' => ! $navUsers,
                                    ])>
                                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path d="M10 10a4 4 0 1 0 0-8 4 4 0 0 0 0 8Z" />
                                            <path fill-rule="evenodd" d="M.458 16.668A8.5 8.5 0 0 1 10 11.5c3.57 0 6.635 2.2 7.958 5.168A1 1 0 0 1 17.04 18H1.376a1 1 0 0 1-.918-1.332Z" clip-rule="evenodd" />
                                        </svg>
                                    </span>
                                    <span class="flex-1">Quản lý người dùng</span>
                                </a>
                            @endrole

                            <a href="{{ route('clients.index') }}"
                                @class([
                                    'group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold',
                                    'bg-indigo-50 text-indigo-900 ring-1 ring-indigo-100' => $navClients,
                                    'text-slate-700 hover:bg-slate-50 hover:text-slate-900' => ! $navClients,
                                ])>
                                <span @class([
                                    'inline-flex h-9 w-9 items-center justify-center rounded-xl',
                                    'bg-indigo-600 text-white shadow-sm shadow-indigo-500/30' => $navClients,
                                    'bg-indigo-50 text-indigo-700 group-hover:bg-indigo-100' => ! $navClients,
                                ])>
                                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M2 6.75A2.75 2.75 0 0 1 4.75 4h10.5A2.75 2.75 0 0 1 18 6.75v9.5A2.75 2.75 0 0 1 15.25 19H4.75A2.75 2.75 0 0 1 2 16.25v-9.5ZM4.75 5.5c-.69 0-1.25.56-1.25 1.25v9.5c0 .69.56 1.25 1.25 1.25h10.5c.69 0 1.25-.56 1.25-1.25v-9.5c0-.69-.56-1.25-1.25-1.25H4.75Z" clip-rule="evenodd" />
                                        <path d="M6.5 8.25c0-.414.336-.75.75-.75h5.5a.75.75 0 0 1 0 1.5h-5.5a.75.75 0 0 1-.75-.75ZM6.5 11c0-.414.336-.75.75-.75h5.5a.75.75 0 0 1 0 1.5h-5.5A.75.75 0 0 1 6.5 11ZM6.5 13.75c0-.414.336-.75.75-.75h3.25a.75.75 0 0 1 0 1.5H7.25a.75.75 0 0 1-.75-.75Z" />
                                    </svg>
                                </span>
                                <span class="flex-1">Quản lý khách hàng</span>
                            </a>

                            <a href="{{ route('projects.index') }}"
                                @class([
                                    'group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold',
                                    'bg-indigo-50 text-indigo-900 ring-1 ring-indigo-100' => $navProjects,
                                    'text-slate-700 hover:bg-slate-50 hover:text-slate-900' => ! $navProjects,
                                ])>
                                <span @class([
                                    'inline-flex h-9 w-9 items-center justify-center rounded-xl',
                                    'bg-indigo-600 text-white shadow-sm shadow-indigo-500/30' => $navProjects,
                                    'bg-indigo-50 text-indigo-700 group-hover:bg-indigo-100' => ! $navProjects,
                                ])>
                                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M6 3.25A2.75 2.75 0 0 1 8.75.5h2.5A2.75 2.75 0 0 1 14 3.25V4h1.25A2.75 2.75 0 0 1 18 6.75v9.5A2.75 2.75 0 0 1 15.25 19H4.75A2.75 2.75 0 0 1 2 16.25v-9.5A2.75 2.75 0 0 1 4.75 4H6v-.75ZM7.5 4h5v-.75c0-.69-.56-1.25-1.25-1.25h-2.5C8.06 2 7.5 2.56 7.5 3.25V4Z" clip-rule="evenodd" />
                                        <path d="M4.5 8.25c0-.414.336-.75.75-.75h9.5a.75.75 0 0 1 0 1.5h-9.5a.75.75 0 0 1-.75-.75ZM4.5 11c0-.414.336-.75.75-.75h6.5a.75.75 0 0 1 0 1.5h-6.5A.75.75 0 0 1 4.5 11ZM4.5 13.75c0-.414.336-.75.75-.75h7.5a.75.75 0 0 1 0 1.5h-7.5a.75.75 0 0 1-.75-.75Z" />
                                    </svg>
                                </span>
                                <span class="flex-1">Quản lý dự án</span>
                            </a>

                            <a href="{{ route('tasks.index') }}"
                                @class([
                                    'group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold',
                                    'bg-indigo-50 text-indigo-900 ring-1 ring-indigo-100' => $navTasks,
                                    'text-slate-700 hover:bg-slate-50 hover:text-slate-900' => ! $navTasks,
                                ])>
                                <span @class([
                                    'inline-flex h-9 w-9 items-center justify-center rounded-xl',
                                    'bg-indigo-600 text-white shadow-sm shadow-indigo-500/30' => $navTasks,
                                    'bg-indigo-50 text-indigo-700 group-hover:bg-indigo-100' => ! $navTasks,
                                ])>
                                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M4.75 2A2.75 2.75 0 0 0 2 4.75v10.5A2.75 2.75 0 0 0 4.75 18h10.5A2.75 2.75 0 0 0 18 15.25V4.75A2.75 2.75 0 0 0 15.25 2H4.75ZM6.5 6.75c0-.414.336-.75.75-.75h5.5a.75.75 0 0 1 0 1.5h-5.5a.75.75 0 0 1-.75-.75Zm0 3.25c0-.414.336-.75.75-.75h5.5a.75.75 0 0 1 0 1.5h-5.5a.75.75 0 0 1-.75-.75Zm0 3.25c0-.414.336-.75.75-.75h3.5a.75.75 0 0 1 0 1.5h-3.5a.75.75 0 0 1-.75-.75Z" clip-rule="evenodd" />
                                    </svg>
                                </span>
                                <span class="flex-1">Quản lý task</span>
                            </a>
                        </nav>
                    </div>
                </aside>

                <main class="min-w-0 flex-1">
                    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                        <div class="mb-6 flex flex-wrap items-start justify-between gap-3">
                            <div class="min-w-0">
                                <h1 class="truncate text-lg font-semibold text-slate-900">@yield('page_title', 'Trang quản trị')</h1>
                                <p class="mt-1 text-sm text-slate-600">@yield('page_desc', '')</p>
                            </div>

                            <div class="flex shrink-0 items-center gap-2">
                                @yield('page_actions')
                            </div>
                        </div>

                        @yield('content')
                    </div>
                </main>
            </div>
        </div>
    </body>
</html>
