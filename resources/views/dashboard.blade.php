<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-2xl text-gray-900 dark:text-gray-100 leading-tight">
                {{ __('Dashboard') }}
            </h2>
            <div class="text-sm text-gray-500 dark:text-gray-400">
                {{ now()->format('l, d F Y') }}
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            {{-- Hero Profile Card --}}
            <div
                class="relative bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-500 overflow-hidden shadow-2xl rounded-2xl">
                <div class="absolute inset-0 bg-black opacity-10"></div>
                <div
                    class="absolute top-0 right-0 w-96 h-96 bg-white opacity-5 rounded-full -translate-y-48 translate-x-48">
                </div>
                <div
                    class="absolute bottom-0 left-0 w-72 h-72 bg-white opacity-5 rounded-full translate-y-36 -translate-x-36">
                </div>

                <div class="relative p-8 sm:p-12">
                    <div class="flex flex-col sm:flex-row items-center justify-between">
                        <div class="flex flex-col sm:flex-row items-center mb-6 sm:mb-0">
                            <div class="relative group">
                                <div
                                    class="absolute -inset-1 bg-gradient-to-r from-pink-300 to-purple-300 rounded-full blur opacity-75 group-hover:opacity-100 transition duration-300">
                                </div>
                                <img src="https://www.jktliving.com/blog/wp-content/uploads/2024/04/Foto-Animasi-Cowok-Keren-300x300.jpg"
                                    alt="Profile Photo"
                                    class="relative h-32 w-32 rounded-full border-4 border-white/20 backdrop-blur-sm shadow-2xl object-cover transition-transform duration-300 group-hover:scale-105">
                                <div
                                    class="absolute bottom-2 right-2 h-6 w-6 rounded-full bg-emerald-400 border-3 border-white shadow-lg animate-pulse">
                                </div>
                            </div>
                            <div class="mt-6 sm:mt-0 sm:ml-8 text-center sm:text-left">
                                <h1 class="text-3xl sm:text-4xl font-bold text-white mb-2 tracking-tight">
                                    {{ Auth::user()->name }}
                                </h1>
                                <p class="text-white/90 text-lg mb-1">{{ Auth::user()->email }}</p>
                                <div class="flex items-center justify-center sm:justify-start text-white/80 text-sm">
                                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Member sejak {{ Auth::user()->created_at->format('d M Y') }}
                                </div>
                            </div>
                        </div>

                        <a href="{{ route('profile.edit') }}"
                            class="group inline-flex items-center px-6 py-3 bg-white/20 backdrop-blur-sm border border-white/30 rounded-xl font-semibold text-white hover:bg-white/30 hover:scale-105 transition-all duration-300 shadow-lg">
                            <svg class="w-5 h-5 mr-2 transition-transform group-hover:rotate-12" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            Edit Profil
                        </a>
                    </div>
                </div>
            </div>

            {{-- Enhanced Stats Cards --}}
            @php
            $total = App\Models\Todo::where('user_id', Auth::id())->count();
            $completed = App\Models\Todo::where('user_id', Auth::id())->where('is_done', true)->count();
            $ongoing = App\Models\Todo::where('user_id', Auth::id())->where('is_done', false)->count();
            $rate = $total > 0 ? round(($completed / $total) * 100) : 0;
            @endphp

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                {{-- Total Tasks Card --}}
                <div
                    class="group bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100 dark:border-gray-700 hover:border-blue-200 dark:hover:border-blue-600">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide">
                                Total Tugas</h3>
                            <p class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">{{ $total }}</p>
                        </div>
                        <div
                            class="p-3 bg-blue-50 dark:bg-blue-900/20 rounded-lg group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v11a2 2 0 002 2h2m0-13a2 2 0 012-2h2a2 2 0 012 2v11a2 2 0 01-2 2h-2m-4-4v-4m0 0V9m0 2h4" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center">
                        <div class="flex-1 bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                            <div class="bg-blue-600 h-2 rounded-full" style="width: {{ $total > 0 ? 100 : 0 }}%"></div>
                        </div>
                    </div>
                </div>

                {{-- Completed Tasks Card --}}
                <div
                    class="group bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100 dark:border-gray-700 hover:border-green-200 dark:hover:border-green-600">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide">
                                Tugas Selesai</h3>
                            <p class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">{{ $completed }}</p>
                        </div>
                        <div
                            class="p-3 bg-green-50 dark:bg-green-900/20 rounded-lg group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center">
                        <div class="flex-1 bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                            <div class="bg-green-600 h-2 rounded-full transition-all duration-500"
                                style="width: {{ $rate }}%"></div>
                        </div>
                        <span class="ml-2 text-sm font-medium text-green-600 dark:text-green-400">{{ $rate }}%</span>
                    </div>
                </div>

                {{-- Ongoing Tasks Card --}}
                <div
                    class="group bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100 dark:border-gray-700 hover:border-yellow-200 dark:hover:border-yellow-600">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide">
                                Tugas Berlangsung</h3>
                            <p class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">{{ $ongoing }}</p>
                        </div>
                        <div
                            class="p-3 bg-yellow-50 dark:bg-yellow-900/20 rounded-lg group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-6 h-6 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center">
                        <div class="flex-1 bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                            <div class="bg-yellow-600 h-2 rounded-full"
                                style="width: {{ $total > 0 ? ($ongoing / $total) * 100 : 0 }}%"></div>
                        </div>
                    </div>
                </div>

                {{-- Completion Rate Card --}}
                <div
                    class="group bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100 dark:border-gray-700 hover:border-purple-200 dark:hover:border-purple-600">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide">
                                Tingkat Penyelesaian</h3>
                            <p class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">{{ $rate }}%</p>
                        </div>
                        <div
                            class="p-3 bg-purple-50 dark:bg-purple-900/20 rounded-lg group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="relative pt-1">
                            <div class="flex mb-2 items-center justify-between">
                                <div class="text-right">
                                    <span
                                        class="text-xs font-semibold inline-block text-purple-600 dark:text-purple-400">
                                        {{ $rate >= 75 ? 'Excellent' : ($rate >= 50 ? 'Good' : 'Keep Going') }}
                                    </span>
                                </div>
                            </div>
                            <div
                                class="overflow-hidden h-2 text-xs flex rounded-full bg-purple-200 dark:bg-purple-900/30">
                                <div style="width:{{ $rate }}%"
                                    class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-gradient-to-r from-purple-500 to-purple-600 transition-all duration-1000">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Enhanced Quick Actions & Recent Tasks --}}
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                {{-- Quick Actions --}}
                <div class="lg:col-span-4">
                    <div
                        class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-100 dark:border-gray-700 overflow-hidden">
                        <div class="p-6 border-b border-gray-100 dark:border-gray-700">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center">
                                <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                                Aksi Cepat
                            </h3>
                        </div>
                        <div class="p-6 space-y-4">
                            <a href="{{ route('todo.create') }}"
                                class="group flex items-center w-full px-4 py-3 bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20 text-blue-800 dark:text-blue-300 rounded-lg hover:from-blue-100 hover:to-indigo-100 dark:hover:from-blue-900/30 dark:hover:to-indigo-900/30 transition-all duration-300 border border-blue-200 dark:border-blue-700 hover:border-blue-300 dark:hover:border-blue-600">
                                <div
                                    class="p-2 bg-blue-100 dark:bg-blue-800 rounded-lg mr-3 group-hover:scale-110 transition-transform duration-300">
                                    <svg class="w-5 h-5 text-blue-600 dark:text-blue-300" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-semibold">Tambah Tugas Baru</div>
                                    <div class="text-sm opacity-75">Buat tugas baru untuk dikerjakan</div>
                                </div>
                            </a>

                            <a href="{{ route('todo.index') }}"
                                class="group flex items-center w-full px-4 py-3 bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/20 text-green-800 dark:text-green-300 rounded-lg hover:from-green-100 hover:to-emerald-100 dark:hover:from-green-900/30 dark:hover:to-emerald-900/30 transition-all duration-300 border border-green-200 dark:border-green-700 hover:border-green-300 dark:hover:border-green-600">
                                <div
                                    class="p-2 bg-green-100 dark:bg-green-800 rounded-lg mr-3 group-hover:scale-110 transition-transform duration-300">
                                    <svg class="w-5 h-5 text-green-600 dark:text-green-300" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5H7a2 2 0 00-2 2v11a2 2 0 002 2h2m0-13a2 2 0 012-2h2a2 2 0 012 2v11a2 2 0 01-2 2h-2m-4-4v-4m0 0V9m0 2h4" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-semibold">Lihat Semua Tugas</div>
                                    <div class="text-sm opacity-75">Kelola dan pantau semua tugas</div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Recent Tasks --}}
                <div class="lg:col-span-8">
                    <div
                        class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-100 dark:border-gray-700 overflow-hidden">
                        <div class="p-6 border-b border-gray-100 dark:border-gray-700">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Tugas Terbaru
                                </h3>
                                <a href="{{ route('todo.index') }}"
                                    class="text-sm text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300 font-medium">
                                    Lihat Semua →
                                </a>
                            </div>
                        </div>
                        <div class="p-6">
                            @php
                            $recentTodos = App\Models\Todo::where('user_id', Auth::id())->latest()->take(5)->get();
                            @endphp

                            @if($recentTodos->count() > 0)
                            <div class="space-y-4">
                                @foreach($recentTodos as $todo)
                                <div
                                    class="group flex items-center justify-between p-4 bg-gray-50 dark:bg-gray-700/50 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-all duration-300 border border-transparent hover:border-gray-200 dark:hover:border-gray-600">
                                    <div class="flex items-center space-x-4">
                                        <div class="flex-shrink-0">
                                            @if($todo->is_done)
                                            <div class="w-3 h-3 bg-green-500 rounded-full animate-pulse"></div>
                                            @else
                                            <div class="w-3 h-3 bg-yellow-500 rounded-full animate-pulse"></div>
                                            @endif
                                        </div>
                                        <div>
                                            <p
                                                class="text-base font-medium text-gray-900 dark:text-white group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">
                                                {{ Str::limit($todo->title, 50) }}
                                            </p>
                                            <div
                                                class="flex items-center space-x-2 text-sm text-gray-500 dark:text-gray-400">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                                <span>{{ $todo->created_at->format('d M Y') }}</span>
                                                <span>•</span>
                                                <span>{{ $todo->created_at->diffForHumans() }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex items-center space-x-3">
                                        <span class="px-3 py-1 text-xs font-medium rounded-full transition-all duration-300 {{ 
                                                $todo->is_done 
                                                    ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-300' 
                                                    : 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-300' 
                                            }}">
                                            {{ $todo->is_done ? 'Selesai' : 'Berlangsung' }}
                                        </span>
                                        <svg class="w-5 h-5 text-gray-400 group-hover:text-gray-600 dark:group-hover:text-gray-300 transition-colors opacity-0 group-hover:opacity-100"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5l7 7-7 7" />
                                        </svg>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            @else
                            <div class="text-center py-12">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v11a2 2 0 002 2h2m0-13a2 2 0 012-2h2a2 2 0 012 2v11a2 2 0 01-2 2h-2m-4-4v-4m0 0V9m0 2h4" />
                                </svg>
                                <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">Belum ada tugas</h3>
                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Mulai dengan membuat tugas
                                    pertama Anda.</p>
                                <div class="mt-6">
                                    <a href="{{ route('todo.create') }}"
                                        class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition-colors">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                        </svg>
                                        Tambah Tugas
                                    </a>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>