<x-app-layout>
    <div class="container mt-5">
        <div class="card mb-4">
            @if($post->image)
                <img src="{{ asset('storage/'.$post->image) }}" alt="Post Image" class="card-img-top" style="height: 300px; object-fit: cover;">
            @endif
            <div class="card-body">
                <h5 class="card-title">{{ $post->title }}</h5>
                <p class="card-text">{{ $post->content }}</p>
                <div class="card-footer text-muted">
                    By {{ $post->user->name }} on {{ $post->created_at->format('M d, Y') }}
                </div>
            </div>
        </div>

        <h3>Comments</h3>
        @if($post->comments->isEmpty())
            <p>No Comments Yet</p>
        @else
            <div class="list-group">
                @foreach($post->comments as $comment)
                    <div class="list-group-item">
                        <p>{{ $comment->content }}</p>
                        <small>
                            By <strong>{{ $comment->user->name }}</strong> on {{ $comment->created_at->format('M d, Y') }}
                            @if(auth()->check() && auth()->id() === $comment->user_id)
                                <form action="{{ route('comments.destroy', $comment) }}" method="POST" class="d-inline-block float-end ms-2">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            @endif
                        </small>
                    </div>
                @endforeach
            </div>
        @endif

        @auth
            <div class="mt-4">
                <h4>Add a Comment</h4>
                <form action="{{ route('comments.store', $post) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <textarea name="content" class="form-control" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary mt-2">Submit</button>
                </form>
            </div>
        @endauth
    </div>
</x-app-layout>
