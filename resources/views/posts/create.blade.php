<x-app-layout>
    <div class="container mt-5">
        <h1 class="page-title mb-4">Create a New Post</h1>

        {{-- Form to create a new post --}}
        <form id="postForm" action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf  {{-- CSRF protection --}}
            
            <div class="mb-3">
                <label for="title" class="form-label">Post Title <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
                @error('title')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">Post Content <span class="text-danger">*</span></label>
                <textarea class="form-control" id="content" name="content" rows="5" required>{{ old('content') }}</textarea>
                @error('content')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Post Image (Optional) <span class="text-muted">(Acceptable types: jpeg, png, jpg)</span></label>
                
                {{-- File input for new image --}}
                <input type="file" class="form-control" id="image" name="image">
                @error('image')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Create Post</button>
        </form>

        {{-- Image Preview --}}
        <div class="mt-4">
            <img id="imagePreview" src="#" alt="Image Preview" style="display: none; width: 300px; height: 200px; object-fit: cover; margin-top: 10px;">
            @if(isset($post) && $post->image)
                <img id="oldImagePreview" src="{{ asset('storage/' . $post->image) }}" alt="Old Image Preview" style="width: 300px; height: 200px; object-fit: cover; margin-top: 10px;">
            @endif
        </div>
    </div>

    {{-- Include post-form.js --}}
    <script src="{{ mix('js/post-form.js') }}"></script>
</x-app-layout>
