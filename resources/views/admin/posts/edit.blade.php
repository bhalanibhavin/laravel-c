<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Post</h2>
    </x-slot>

    <div class="py-8 max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white shadow rounded p-6">
            <form action="{{ route('admin.posts.update', $post) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf @method('PUT')

                <div>
                    <label class="block text-sm font-medium text-gray-700">Title <span class="text-red-500">*</span></label>
                    <input type="text" name="title" value="{{ old('title', $post->title) }}"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    @error('title')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Slug</label>
                    <input type="text" value="{{ $post->slug }}" disabled
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm bg-gray-50 text-gray-500">
                    <p class="text-xs text-gray-400 mt-1">Auto-updated when title changes.</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Content <span class="text-red-500">*</span></label>
                    <textarea name="content" rows="6"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('content', $post->content) }}</textarea>
                    @error('content')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Image</label>
                    @if($post->image)
                        <img src="{{ Storage::url($post->image) }}" class="h-24 w-36 object-cover rounded mb-2">
                    @endif
                    <input type="file" name="image" accept="image/*"
                        class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:bg-blue-50 file:text-blue-700">
                    @error('image')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div class="flex items-center gap-3">
                    <input type="hidden" name="status" value="0">
                    <input type="checkbox" name="status" id="status" value="1" {{ old('status', $post->status) ? 'checked' : '' }}
                        class="rounded border-gray-300 text-blue-600">
                    <label for="status" class="text-sm font-medium text-gray-700">Active</label>
                </div>

                <div class="flex gap-3">
                    <button type="submit" class="bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700">Update Post</button>
                    <a href="{{ route('admin.posts.index') }}" class="px-5 py-2 rounded border hover:bg-gray-50">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
