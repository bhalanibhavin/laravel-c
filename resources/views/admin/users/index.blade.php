<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-flash />

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 border-b border-gray-200">
                    <form method="GET" action="{{ route('admin.users.index') }}" class="flex items-end gap-3">
                        <div class="flex-1">
                            <label for="search" class="block text-sm font-medium text-gray-700">
                                {{ __('Search') }}
                            </label>
                            <input
                                id="search"
                                name="search"
                                type="text"
                                value="{{ $search }}"
                                placeholder="{{ __('Name or email') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                            />
                        </div>

                        <button
                            type="submit"
                            class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white hover:bg-indigo-700 active:bg-indigo-800 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        >
                            {{ __('Filter') }}
                        </button>
                    </form>
                </div>

                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('Name') }}
                                    </th>
                                    <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('Email') }}
                                    </th>
                                    <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('Role') }}
                                    </th>
                                    <th scope="col" class="px-3 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('Actions') }}
                                    </th>
                                </tr>
                            </thead>

                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($users as $user)
                                    <tr>
                                        <td class="px-3 py-3 whitespace-nowrap text-sm text-gray-900">
                                            {{ $user->name }}
                                        </td>
                                        <td class="px-3 py-3 whitespace-nowrap text-sm text-gray-700">
                                            {{ $user->email }}
                                        </td>
                                        <td class="px-3 py-3 whitespace-nowrap text-sm text-gray-700">
                                            {{ $user->role?->name ?? 'Unassigned' }}
                                        </td>
                                        <td class="px-3 py-3 whitespace-nowrap text-right text-sm">
                                            <a
                                                href="{{ route('admin.users.edit', $user) }}"
                                                class="inline-flex items-center px-3 py-1.5 border border-indigo-200 text-indigo-700 rounded-md hover:bg-indigo-50"
                                            >
                                                {{ __('Edit role') }}
                                            </a>

                                            <form
                                                method="POST"
                                                action="{{ route('admin.users.destroy', $user) }}"
                                                class="inline-block ml-2"
                                                onsubmit="return confirm('Delete this user?')"
                                            >
                                                @csrf
                                                @method('DELETE')
                                                <button
                                                    type="submit"
                                                    class="inline-flex items-center px-3 py-1.5 border border-red-200 text-red-700 rounded-md hover:bg-red-50"
                                                >
                                                    {{ __('Delete') }}
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-3 py-6 text-center text-sm text-gray-500">
                                            {{ __('No users found.') }}
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

