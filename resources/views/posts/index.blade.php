<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Posts - {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 font-sans antialiased">

    <header class="bg-white shadow-sm">
        <div class="max-w-6xl mx-auto px-4 py-4 flex justify-between items-center">
            <a href="/" class="text-xl font-bold text-gray-800">{{ config('app.name') }}</a>
            <a href="{{ route('posts.index') }}" class="text-blue-600 hover:underline">Blog</a>
        </div>
    </header>

    <main class="max-w-6xl mx-auto px-4 py-10">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Latest Posts</h1>

        @if($posts->isEmpty())
            <p class="text-gray-500">No posts available.</p>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($posts as $post)
                    <a href="{{ route('posts.show', $post->slug) }}" class="bg-white rounded-lg shadow hover:shadow-md transition overflow-hidden group">
                        @if($post->image)
                            <img src="{{ Storage::url($post->image) }}" alt="{{ $post->title }}" class="w-full h-48 object-cover group-hover:opacity-90 transition">
                        @else
                            <div class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-400 text-sm">No Image</div>
                        @endif
                        <div class="p-4">
                            <h2 class="text-lg font-semibold text-gray-800 group-hover:text-blue-600 transition">{{ $post->title }}</h2>
                            <p class="text-sm text-gray-500 mt-1">{{ $post->created_at->format('M d, Y') }}</p>
                            <p class="text-gray-600 text-sm mt-2 line-clamp-3">{{ Str::limit(strip_tags($post->content), 120) }}</p>
                        </div>
                    </a>
                @endforeach
            </div>

            <div class="mt-8">{{ $posts->links() }}</div>
        @endif
    </main>

</body>
</html>
