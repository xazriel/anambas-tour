<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Anambas - Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-slate-50 font-sans text-slate-900" x-data="{ sidebarOpen: true }">

    <aside :class="sidebarOpen ? 'w-64' : 'w-20'" class="fixed left-0 top-0 h-screen bg-white border-r border-slate-200 transition-all duration-300 z-50">
        <div class="p-6 flex items-center justify-between">
            <h1 x-show="sidebarOpen" class="font-bold text-xl tracking-tight text-indigo-600">ANAMBAS</h1>
            <button @click="sidebarOpen = !sidebarOpen" class="p-2 hover:bg-slate-100 rounded-lg">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                </svg>
            </button>
        </div>

        <nav class="mt-6 px-4 space-y-2">
            <a href="{{ route('admin.dashboard') }}" 
               class="flex items-center p-3 {{ request()->routeIs('admin.dashboard') ? 'text-indigo-600 bg-indigo-50' : 'text-slate-600 hover:bg-slate-50' }} rounded-xl transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                <span class="ml-3" x-show="sidebarOpen">Destinasi</span>
            </a>
            
            <a href="{{ route('admin.culinaries') }}" 
                class="flex items-center p-3 text-slate-600 hover:bg-slate-50 rounded-xl transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                <span class="ml-3" x-show="sidebarOpen">Kuliner</span>
            </a>

            <a href="{{ route('admin.cultures') }}" 
                class="flex items-center p-3 text-slate-600 hover:bg-slate-50 rounded-xl transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9"></path></svg>
                <span class="ml-3" x-show="sidebarOpen">Kebudayaan</span>
            </a>

            <a href="{{ route('admin.events') }}" 
                class="flex items-center p-3 text-slate-600 hover:bg-slate-50 rounded-xl transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                <span class="ml-3" x-show="sidebarOpen">Event</span>
            </a>
        </nav>
    </aside>

    <main :class="sidebarOpen ? 'ml-64' : 'ml-20'" class="transition-all duration-300 min-h-screen">
        <header class="bg-white/80 backdrop-blur-md sticky top-0 z-40 border-b border-slate-200 p-6 flex justify-between items-center">
            <h2 class="text-xl font-semibold text-slate-800">Administrator</h2>
            <div class="flex items-center gap-4">
                <div class="text-right">
                    <p class="text-sm font-bold text-slate-900">Kiel</p>
                    <p class="text-xs text-slate-500">Developer</p>
                </div>
                <div class="h-10 w-10 rounded-full bg-indigo-600 flex items-center justify-center text-white font-bold">K</div>
            </div>
        </header>

        <div class="p-8">
            @yield('content')
        </div>
    </main>

    @livewireScripts
</body>
</html>