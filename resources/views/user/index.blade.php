<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('User') }}
        </h2>
    </x-slot>

    {{-- Search & Alert Section --}}
    <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
        <div class="px-6 pt-6 mb-5 md:w-1/2 2xl:w-1/3">
            @if (request('search'))
            <h2 class="pb-3 text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                Search results for : {{ request('search') }}
            </h2>
            @endif

            <form class="flex items-center gap-2">
                <x-text-input id="search" name="search" type="text" class="w-full"
                    placeholder="Search by name or email ..." value="{{ request('search') }}" autofocus />
                <x-primary-button type="submit">
                    {{ __('Search') }}
                </x-primary-button>
            </form>
        </div>

        <div class="px-6 text-xl text-gray-900 dark:text-gray-100">
            <div class="flex items-center justify-between">
                <div></div>
                <div>
                    @if (session('success'))
                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 5000)"
                        class="pb-3 text-sm text-green-600 dark:text-green-400">{{ session('success') }}
                    </p>
                    @endif

                    @if (session('danger'))
                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 5000)"
                        class="pb-3 text-sm text-red-600 dark:text-red-400">{{ session('danger') }}
                    </p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- User Table --}}
    <div class="overflow-x-auto shadow-md sm:rounded-lg mt-6 mx-4">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">ID</th>
                    <th scope="col" class="px-6 py-3">Name</th>
                    <th scope="col" class="px-6 py-3">Email</th>
                    <th scope="col" class="px-6 py-3">Todos</th>
                    <th scope="col" class="px-6 py-3">Status</th>
                    <th scope="col" class="px-6 py-3">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <td class="px-6 py-4">{{ $user->id }}</td>
                    <td class="px-6 py-4">{{ $user->name }}</td>
                    <td class="px-6 py-4">{{ $user->email }}</td>
                    <td class="px-6 py-4">
                        @if ($user->todos->isNotEmpty())
                        <ul class="list-disc list-inside space-y-1">
                            @foreach ($user->todos as $todo)
                            <li>
                                {{ $todo->title }}
                                @if ($todo->is_done)
                                <span class="text-green-500 text-xs">(done)</span>
                                @else
                                <span class="text-yellow-500 text-xs">(pending)</span>
                                @endif
                            </li>
                            @endforeach
                        </ul>
                        @else
                        <span class="italic text-gray-400 text-sm">No todos</span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        @if ($user->is_active)
                        Active
                        @else
                        Inactive
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        {{-- Link to User Show --}}
                        <a href="{{ route('users.show', $user->id) }}"
                            class="text-blue-500 hover:underline mr-2">Show</a>

                        {{-- Admin Buttons --}}
                        <div class="flex space-x-3 mt-2">
                            @if ($user->is_admin)
                            <form action="{{ route('user.removeadmin', $user) }}" method="Post">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="text-blue-600 dark:text-blue-400 whitespace-nowrap">
                                    Remove Admin
                                </button>
                            </form>
                            @else
                            <form action="{{ route('user.makeadmin', $user) }}" method="Post">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="text-red-600 dark:text-red-400 whitespace-nowrap">
                                    Make Admin
                                </button>
                            </form>
                            @endif
                        </div>

                        {{-- Delete User Button --}}
                        <div class="mt-2">
                            <form action="{{ route('user.destroy', $user) }}" method="Post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="text-red-600 dark:text-red-400 whitespace-nowrap">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        @if ($users->isEmpty())
        <div class="px-6 py-4 text-sm text-gray-500 dark:text-white">
            Empty
        </div>
        @endif
    </div>

    {{-- Pagination --}}
    <div class="mt-4 px-6">
        {{ $users->links() }}
    </div>
</x-app-layout>