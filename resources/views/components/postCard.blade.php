@props(['post'])

<div class="card">
    {{-- title --}}
    <h2 class="font-bold text-xl">{{ $post->title }}</h2>

    {{-- author and date --}}
    <div class="text-xs">
        <span>Posted {{ $post->created_at->diffForHumans() }} by</span>
        <a href="{{ route('posts.user', $post->user) }}" class="text-blue-500 font-medium">
            {{ $post->user->username }}
        </a>
    </div>

    {{-- body --}}
    <div class="text-sm">
        <p>{{ Str::words($post->body, 15) }}</p>
    </div>
</div>
