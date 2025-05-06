<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Profile Card --}}
            <div class="mb-8 bg-gradient-to-r from-purple-500 to-blue-600 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-8 sm:flex items-center justify-between">
                    <div class="flex flex-col sm:flex-row items-center mb-6 sm:mb-0">
                        <div class="relative">
                            <img src="https://www.jktliving.com/blog/wp-content/uploads/2024/04/Foto-Animasi-Cowok-Keren-300x300.jpg"
                                alt="Profile Photo"
                                class="h-32 w-32 rounded-full border-4 border-white shadow-md object-cover">
                            <div
                                class="absolute bottom-0 right-0 h-5 w-5 rounded-full bg-green-500 border-2 border-white">
                            </div>
                        </div>
                        <div class="mt-4 sm:mt-0 sm:ml-6 text-center sm:text-left">
                            <h1 class="text-2xl font-bold text-white">{{ Auth::user()->name }}</h1>
                            <p class="text-white text-sm">{{ Auth::user()->email }}</p>
                            <p class="mt-2 text-white text-sm">
                                Member sejak {{ Auth::user()->created_at->format('d M Y') }}
                            </p>
                        </div>
                    </div>

                    <a href="{{ route('profile.edit') }}"
                        class="inline-flex items-center justify-center px-4 py-2 bg-white bg-opacity-20 border border-transparent rounded-md font-semibold text-white hover:bg-opacity-30 transition">
                        ✏️ Edit Profil
                    </a>
                </div>
            </div>

            {{-- Stats Cards --}}
            @php
            $total = App\Models\Todo::where('user_id', Auth::id())->count();
            $completed = App\Models\Todo::where('user_id', Auth::id())->where('is_done', true)->count();
            $ongoing = App\Models\Todo::where('user_id', Auth::id())->where('is_done', false)->count();
            $rate = $total > 0 ? round(($completed / $total) * 100) : 0;
            @endphp

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white">Total Tugas</h3>
                    <p class="mt-2 text-3xl font-bold text-blue-600 dark:text-blue-400">{{ $total }}</p>
                </div>

                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white">Tugas Selesai</h3>
                    <p class="mt-2 text-3xl font-bold text-green-600 dark:text-green-400">{{ $completed }}</p>
                </div>

                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white">Tugas Berlangsung</h3>
                    <p class="mt-2 text-3xl font-bold text-yellow-600 dark:text-yellow-400">{{ $ongoing }}</p>
                </div>

                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white">Tingkat Penyelesaian</h3>
                    <p class="mt-2 text-3xl font-bold text-purple-600 dark:text-purple-400">{{ $rate }}%</p>
                </div>
            </div>

            {{-- Quick Actions & Recent Tasks --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Aksi Cepat</h3>
                    <div class="space-y-3">
                        <a href="{{ route('todo.create') }}"
                            class="block px-4 py-2 bg-blue-100 text-blue-800 rounded hover:bg-blue-200">+ Tambah Tugas
                            Baru</a>
                        <a href="{{ route('todo.index') }}"
                            class="block px-4 py-2 bg-green-100 text-green-800 rounded hover:bg-green-200">📋 Lihat
                            Semua Tugas</a>
                    </div>
                </div>

                <div class="lg:col-span-2 bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Tugas Terbaru</h3>
                    <ul class="space-y-4">
                        @foreach(App\Models\Todo::where('user_id', Auth::id())->latest()->take(5)->get() as $todo)
                        <li class="flex justify-between items-center border-b pb-2">
                            <div>
                                <p class="text-base font-medium text-gray-800 dark:text-white">{{ $todo->title }}</p>
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    {{ $todo->created_at->format('d M Y') }}</p>
                            </div>
                            <span
                                class="text-sm px-2 py-1 rounded-full {{ $todo->is_done ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                {{ $todo->is_done ? 'Selesai' : 'Berlangsung' }}
                            </span>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>