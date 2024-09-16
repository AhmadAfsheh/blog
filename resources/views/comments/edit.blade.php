<x-app-layout>
    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Edit Comment</h5>

                <form method="POST" action="{{ route('comments.update', $comment) }}">
                    @csrf
                    @method('PATCH')

                    <div class="form-group">
                        <label for="content">Comment Content</label>
                        <textarea id="content" name="content" class="form-control" rows="3" required>{{ old('content', $comment->content) }}</textarea>
                        @error('content')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">Update Comment</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
