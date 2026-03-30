<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <x-flash />

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @if ($errors->any())
                        <div class="mb-4 rounded-md border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                            <ul class="list-disc pl-5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.users.update', $user) }}" class="space-y-5">
                        @csrf
                        @method('PUT')

                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">
                                {{ __('Name') }}
                            </label>
                            <input
                                id="name"
                                name="name"
                                type="text"
                                value="{{ old('name', $user->name) }}"
                                class="mt-1 block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                            />
                            @error('name')
                                <p class="mt-2 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">
                                {{ __('Email') }}
                            </label>
                            <input
                                id="email"
                                name="email"
                                type="email"
                                value="{{ old('email', $user->email) }}"
                                class="mt-1 block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                            />
                            @error('email')
                                <p class="mt-2 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="role_id" class="block text-sm font-medium text-gray-700">
                                {{ __('Role') }}
                            </label>
                            <select
                                id="role_id"
                                name="role_id"
                                class="mt-1 block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                            >
                                @foreach ($roles as $role)
                                    <option
                                        value="{{ $role->id }}"
                                        @selected((string) old('role_id', $user->role_id) === (string) $role->id)
                                    >
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('role_id')
                                <p class="mt-2 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-between gap-4 pt-2">
                            <a
                                href="{{ route('admin.users.index') }}"
                                class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md text-sm font-semibold text-gray-700 hover:bg-gray-50"
                            >
                                {{ __('Back') }}
                            </a>

                            <button
                                type="submit"
                                class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-sm text-white hover:bg-indigo-700 active:bg-indigo-800 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                            >
                                {{ __('Save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

