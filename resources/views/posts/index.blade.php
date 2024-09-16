<x-app-layout>
    <div class="container mt-5">
        <h1 class="page-title mb-4">All Posts</h1>

        <!-- Search Form -->
        <form method="GET" action="{{ route('posts.index') }}" class="mb-4">
            <div class="input-group">
                <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Search posts by title...">
                <button class="btn btn-primary" type="submit">Search</button>
            </div>
        </form>

        @if($posts->isEmpty())
            <p>No posts available.</p>
        @else
            <div class="row">
                @foreach($posts as $post)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <!-- Image or default container -->
                            @if($post->image)
                                <img src="{{ asset('storage/'.$post->image) }}" alt="Post Image" class="card-img-top img-fluid" style="height: 200px; object-fit: cover;">
                            @else
                                <div class="card-img-top bg-secondary d-flex align-items-center justify-content-center" style="height: 200px;">
                                    <span class="text-white">No Image</span>
                                </div>
                            @endif

                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">
                                    {{ Str::limit($post->title, 50) }} <!-- Limit title length to 50 characters -->
                                </h5>
                                <p class="card-text">
                                    {{ Str::limit($post->content, 70) }} <!-- Limit content length to 70 characters -->
                                </p>
                                <a href="{{ route('posts.show', $post) }}" class="btn btn-primary mt-2">Show More</a>
                            
                                @if(auth()->user()->isAdmin())
                                    <div class="mt-3">
                                        <a href="{{ route('posts.edit', $post) }}" class="btn btn-info me-2">Edit Post</a>
                                        <form action="{{ route('posts.destroy', $post) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this post?')">Delete Post</button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                            
                            <div class="card-footer text-muted">
                                By {{ $post->user->name }} on {{ $post->created_at->format('M d, Y') }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination Links -->
            <div class="d-flex justify-content-center mt-4">
                <nav aria-label="Page navigation">
                    {{ $posts->appends(['search' => request('search')])->links('pagination::bootstrap-5') }}
                </nav>
            </div>
        @endif
    </div>
</x-app-layout>
