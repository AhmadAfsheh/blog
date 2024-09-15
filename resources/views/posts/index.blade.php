<x-app-layout>
    <div class="container mt-5">
        <h1 class="page-title mb-4">All Posts</h1>

   

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
                                    <div class="mt-3"> <!-- Add margin-top to the container holding the buttons -->
                                        <a href="{{ route('posts.edit', $post) }}" class="btn btn-info me-2">Edit Post</a> <!-- Add margin-end to the first button -->
                                        <a href="{{ route('posts.destroy', $post) }}" class="btn btn-danger">Delete Post</a> <!-- Note: Ensure the delete route is correct -->
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
                    {{ $posts->links('pagination::bootstrap-5') }}
                </nav>
            </div>
        @endif
    </div>
</x-app-layout>
