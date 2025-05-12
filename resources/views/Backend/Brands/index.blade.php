@extends('layouts.BackendLayout')
@section('title', 'Manage Brand')
@section('backend')
<div class="container">
    <div class="row">

        <div class="col-lg-4">
            <div class="card shadow">
                <div class="card-header">{{ $editedBrand ? 'Update' : 'Add' }} Brand</div>
                <div class="card-body">
                    <form enctype="multipart/form-data" action="{{ route('brand.store', $editedBrand?->id) }}" method="POST">
                        @csrf
                        <div class="form-group my-2">
                            <label for="">Brand Title <b class="text-danger">*</b></label>
                            <input value="{{ $editedBrand->title ?? null }}" type="text" name="title"
                                class="form-control">
                            @error('title')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group my-2">
                            @if (isset($editedBrand->icon))
                            <img src="{{ asset('storage/'. $editedBrand->icon) }}" alt="" class="w-50">
                            @endif
                            <label for="">Brand Icon</label>
                            <input type="file" name="icon"  class="form-control">
                            @error('icon')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        @if ($editedBrand)
                        <div class="form-check form-switch mb-2">
                            <input value="{{ true }}" name="status" class="form-check-input" type="checkbox"
                                id="flexSwitchCheckDefault" {{ $editedBrand?->status ? 'checked' : '' }}>
                            <label class="form-check-label" for="flexSwitchCheckDefault">Status</label>
                        </div>
                        @endif
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-header">All Brands</div>
                <div class="card-body">
                    <table class="table table-responsive table-striped table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th>Sl.</th>
                                <th class="text-start">Brand Name</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($brands as $key=>$brand)
                            <tr class="text-center">
                                <td>{{ ++$key }}</td>
                                <td class="text-start">{{ str()->headline($brand->title) }}</td>
                                <td>
                                    {!! general_status($brand->status) !!}
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('brand.index',$brand->id ) }}"
                                            class="btn  btn-primary"><i class='bx bx-pencil'></i></a>
                                        <a href="{{ route('brand.delete', $brand->id) }}" class="btn  btn-danger btnDelete"><i
                                                class='bx bx-trash-alt'></i></a>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4">No Brand has been found!</td>
                            </tr>

                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


    </div>
</div>

@push('scripts')
    @include('backend.brands.scripts')
@endpush
@endsection