<x-app-layout>
    <div class="container mt-5">
        <h1 class="page-title mb-4">Edit Post</h1>

        <form id="postForm" action="{{ route('posts.update', $post) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" id="title" name="title" class="form-control" value="{{ old('title', $post->title) }}" required>
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea id="content" name="content" class="form-control" rows="5" required>{{ old('content', $post->content) }}</textarea>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" id="image" name="image" class="form-control">
                
                @if ($post->image)
                    <img id="oldImagePreview" src="{{ asset('storage/' . $post->image) }}" alt="Post Image" class="img-fluid mt-2" style="max-height: 200px; object-fit: cover;">
                @endif

                <img id="imagePreview" src="#" alt="Image Preview" class="img-fluid mt-2" style="display: none; max-height: 200px; object-fit: cover;">
            </div>

            <button type="submit" class="btn btn-primary">Update Post</button>
        </form>
    </div>

    {{-- Include post-form.js for image preview functionality --}}
    <script src="{{ mix('js/post-form.js') }}"></script>
</x-app-layout>
