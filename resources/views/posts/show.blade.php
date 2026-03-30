<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $post->title }} - {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 font-sans antialiased">

    <header class="bg-white shadow-sm">
        <div class="max-w-6xl mx-auto px-4 py-4 flex justify-between items-center">
            <a href="/" class="text-xl font-bold text-gray-800">{{ config('app.name') }}</a>
            <a href="{{ route('posts.index') }}" class="text-blue-600 hover:underline">← Back to Posts</a>
        </div>
    </header>

    <main class="max-w-3xl mx-auto px-4 py-10">
        <article class="bg-white rounded-lg shadow overflow-hidden">
            @if($post->image)
                <img src="{{ Storage::url($post->image) }}" alt="{{ $post->title }}" class="w-full h-72 object-cover">
            @endif
            <div class="p-6 sm:p-8">
                <h1 class="text-3xl font-bold text-gray-900">{{ $post->title }}</h1>
                <p class="text-sm text-gray-400 mt-2">{{ $post->created_at->format('F d, Y') }}</p>
                <div class="mt-6 prose max-w-none text-gray-700 leading-relaxed">
                    {!! nl2br(e($post->content)) !!}
                </div>
            </div>
        </article>

        <div class="mt-6">
            <a href="{{ route('posts.index') }}" class="text-blue-600 hover:underline text-sm">← All Posts</a>
        </div>
    </main>

</body>
</html>
