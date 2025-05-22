@extends('layouts.BackendLayout')
@section('title', 'Manage Banners')
@section('backend')
<div class="container">
    <div class="row mb-3">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h4>Manage Banners</h4>
            <a href="{{ route('banner.create') }}" class="btn btn-primary">Add New Banner</a>
        </div>
    </div>

    <div class="row">
        @forelse($banners as $banner)
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm">
                @if($banner->image)
                <img src="{{ asset($banner->image) }}" class="card-img-top" alt="{{ $banner->title }}" style="height: 200px; object-fit: cover;">
                @else
                <div class="bg-secondary text-white d-flex align-items-center justify-content-center" style="height: 200px;">
                    No Image
                </div>
                @endif
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">{{ $banner->title }}</h5>
                    <p>
                        Text Color: 
                        <span style="color: {{ $banner->text_color }}">{{ $banner->text_color }}</span>
                    </p>
                    <p>
                        Status: 
                        @if($banner->status)
                        <span class="badge bg-success">Active</span>
                        @else
                        <span class="badge bg-danger">Inactive</span>
                        @endif
                    </p>
                    <div class="mt-auto">
                        <a href="{{ route('banner.edit', $banner->id) }}" class="btn btn-sm btn-warning me-2">Edit</a>
                        <a href="{{ route('banner.delete', $banner->id) }}" onclick="return confirm('Are you sure to delete this banner?')" class="btn btn-sm btn-danger">Delete</a>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="alert alert-info text-center">No banners found.</div>
        </div>
        @endforelse
    </div>
</div>

@push('scripts')
@endpush
@endsection
