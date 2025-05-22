@extends('layouts.BackendLayout')
@section('title', 'Add New Banner')
@section('backend')
<div class="container">
    <div class="row mb-3">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h4>Add New Banner</h4>
            <a href="{{ route('banner.index') }}" class="btn btn-secondary">← Back to List</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 offset-md-2">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card shadow-sm">
                <div class="card-body">
                    <form action="{{ route('banner.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- Title --}}
                        <div class="mb-3">
                            <label for="title" class="form-label">Banner Title <span class="text-danger">*</span></label>
                            <input
                                type="text"
                                name="title"
                                id="title"
                                class="form-control @error('title') is-invalid @enderror"
                                value="{{ old('title') }}"
                                required
                            >
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Image Upload --}}
                        <div class="mb-3">
                            <label for="image" class="form-label">Banner Image</label>
                            <input
                                type="file"
                                name="image"
                                id="image"
                                class="form-control @error('image') is-invalid @enderror"
                                accept="image/*"
                                onchange="previewImage(event)"
                            >
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="mt-3">
                                <img id="imagePreview" src="#" alt="Image Preview" class="img-fluid rounded shadow-sm d-none" style="max-height: 250px;">
                            </div>
                        </div>

                        {{-- Text Color --}}
                        <div class="mb-3">
                            <label for="text_color" class="form-label">Text Color</label>
                            <input
                                type="color"
                                name="text_color"
                                id="text_color"
                                class="form-control form-control-color @error('text_color') is-invalid @enderror"
                                value="{{ old('text_color', '#000000') }}"
                                title="Choose text color"
                            >
                            @error('text_color')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Status --}}
                        <div class="form-check form-switch mb-4">
                            <input
                                class="form-check-input"
                                type="checkbox"
                                id="status"
                                name="status"
                                value="1"
                                {{ old('status', 1) ? 'checked' : '' }}
                            >
                            <label class="form-check-label" for="status">Active</label>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{ route('banner.index') }}" class="btn btn-outline-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Image Preview Script --}}
@push('scripts')
<script>
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function(){
            const output = document.getElementById('imagePreview');
            output.src = reader.result;
            output.classList.remove('d-none');
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endpush

@endsection
