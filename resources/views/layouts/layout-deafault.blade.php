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

                        <nav class="space-y-1">
                            <a href="{{ url('/users') }}" class="group flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-50 hover:text-slate-900">
                                <span class="inline-flex h-9 w-9 items-center justify-center rounded-xl bg-indigo-50 text-indigo-700 group-hover:bg-indigo-100">
                                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path d="M10 10a4 4 0 1 0 0-8 4 4 0 0 0 0 8Z" />
                                        <path fill-rule="evenodd" d="M.458 16.668A8.5 8.5 0 0 1 10 11.5c3.57 0 6.635 2.2 7.958 5.168A1 1 0 0 1 17.04 18H1.376a1 1 0 0 1-.918-1.332Z" clip-rule="evenodd" />
                                    </svg>
                                </span>
                                <span class="flex-1">Quản lý người dùng</span>
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
