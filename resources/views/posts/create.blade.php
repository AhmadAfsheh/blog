<x-app-layout>
    <div class="container mt-5">
        <h1 class="page-title mb-4">Create a New Post</h1>

        {{-- Form to create a new post --}}
        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf  {{-- CSRF protection --}}
            
            <div class="mb-3">
                <label for="title" class="form-label">Post Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
                @error('title')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">Post Content</label>
                <textarea class="form-control" id="content" name="content" rows="5" required>{{ old('content') }}</textarea>
                @error('content')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Post Image (Optional)</label>
                <input type="file" class="form-control" id="image" name="image">
                @error('image')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Create Post</button>
        </form>
    </div>
</x-app-layout>
