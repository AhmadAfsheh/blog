<x-app-layout>
    <div class="container mt-5">
        <h1 class="page-title mb-4">All Posts</h1>

        @if($posts->isEmpty())
            <p>No posts available.</p>
        @else
            <div class="list-group">
                @foreach($posts as $post)
                
                    <div class="container mt-5">
                        <h1 class="page-title mb-4">{{ $post->title }}</h1>
                
                        @if($post->image)
                            <img src="{{ asset('storage/'.$post->image) }}" alt="Post Image" class="img-fluid mb-4">
                        @endif
                
                        <p>{{ $post->content }}</p>
                        <small>By {{ $post->user->name }} on {{ $post->created_at->format('M d, Y') }}</small>
                    </div>
                
                
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>
