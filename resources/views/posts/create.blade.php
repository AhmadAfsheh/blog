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
                <label for="image" class="form-label">Post Image (Optional) <span class="text-muted">(Acceptable types: jpeg, png, jpg, gif)</span></label>
                <input type="file" class="form-control" id="image" name="image">
                @error('image')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
                <img id="imagePreview" src="#" alt="Image Preview" style="display: none; max-width: 100%; margin-top: 10px;">
            </div>

            <button type="submit" class="btn btn-primary">Create Post</button>
        </form>
    </div>

    <!-- jQuery and jQuery Validation Plugin -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.19.3/jquery.validate.min.js"></script>

    <!-- Include the custom JavaScript file -->
    <script src="{{ asset('js/post-form.js') }}"></script>
</x-app-layout>
