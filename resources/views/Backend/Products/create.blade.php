@extends('layouts.BackendLayout')
@section('title', 'Dashboard')
@section('backend')
@push('styles')
<link rel="stylesheet" href="{{ asset('backend/assets/css/rte_theme_default.css') }}">
<link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
<link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet" />
<style>
    .filepond--list {
        display: flex !important;
        gap: 20px;
        flex-wrap: wrap;
    }

    .filepond--item {
        position: relative !important;
        width: 150px;
        transform: translate3d(0px, 0px, 0px) scale3d(1, 1, 1) !important;
    }
</style>
@endpush

<div class="card">
    <div class="card-header">
        Add Product
    </div>
    <div class="card-body">
        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <input class="form-control" name="title" type="text" placeholder="Enter your product name">

                    </div>
                    @error('title')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-lg-6">
                    <div class="form-group"><input class="form-control" name="slug" type="text"
                            placeholder="Product url"></div>
                    @error('slug')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="row my-2">
                <div class="col-lg-3">
                    <div class="form-group"><input class="form-control" name="price" type="number"
                            placeholder="Product Price"></div>
                    @error('price')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-lg-3">
                    <div class="form-group"><input class="form-control" name="selling_price" type="number"
                            placeholder="Product Discount Price"></div>
                    @error('selling_price')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-lg-3">
                    <div class="form-group"><input class="form-control" name="qty" type="number"
                            placeholder="Product Quantity"></div>
                    @error('qty')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-lg-3">
                    <div class="form-group"><input class="form-control" name="alert_qty" type="number"
                            placeholder="Product Alert Quantity"></div>
                    @error('alert_qty')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="row">

                <div class="col-lg-6">
                    <label for="">Select Category</label>
                    <select name="category" class="select-category">

                    </select>
                </div>
                <div class="col-lg-6">
                    <label for="">Select Brand</label>
                    <select name="brand" class="select-brand">
                        @foreach ($brands as $brand)
                        <option value="{{ $brand->id }}">{{ $brand->title }}</option>
                        @endforeach

                    </select>
                </div>


            </div>


            <div class="row my-3">
                <div class="col-lg-12">
                    <label for="short_details">Short Details</label>
                    <textarea id="short_details" name="short_detail" class="form-control"></textarea>
                </div>
                <div class="col-lg-12 my-3">
                    <label for="short_details">Long Details</label>
                    <textarea id="long_details" name="long_detail" class="form-control"></textarea>
                </div>
            </div>

            <div class="row my-3">
                <div class="col-lg-6">
                    <label for="">Featured Image</label>
                    <input id="featuredImage" name="featuredImage" class="form-control" type="file">
                    @error('featuredImage')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-lg-6">
                    <label for="">Gallery Images</label>
                    <input id="galleryImages" name="galleryImages[]" class="form-control" type="file" multiple>
                </div>
            </div>


            <div class="row">
                <div class="col-lg-6">
                    <input type="text" name="sku" class="form-control" placeholder="Product SKU">
                </div>
                <div class="col-lg-6">
                    <input type="text" name="video_url" class="form-control" placeholder="Video URL">
                </div>


                <div class="col-lg-12 my-3">
                    <textarea name="additional_info" class="form-control"
                        placeholder="Additional Information"></textarea>
                </div>
            </div>

            <button class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>

@push('scripts')
<script src="{{ asset('backend/assets/js/rte.js') }}"></script>
<script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>

<script src="https://unpkg.com/filepond/dist/filepond.min.js"></script>
<script src="https://unpkg.com/jquery-filepond/filepond.jquery.js"></script>
<script src="{{ asset('backend/assets/js/all_plugins.js') }}"></script>
<script>
    let editor1 = new RichTextEditor("#short_details");
    let editor2 = new RichTextEditor("#long_details");
    FilePond.registerPlugin(FilePondPluginImagePreview);
    $(document).ready(function() {
        $('.select-category').select2({
            placeholder: "Select Category",
            ajax: {
                
            url: `{{ route('products.live.category') }}`,
            dataType: 'json',
            method: 'post',
            data: function (params) {
                var query = {
                "_token": "{{ csrf_token() }}",
                search: params.term,
                }
                return query;
            },
            processResults: function (data) {
            return {
            results: data
            };
            }
            }
        });
        $('.select-brand').select2();

       
       $('#featuredImage').filepond({
        allowImagePreview: true,
        allowReorder:true,
        storeAsFile: true,
        });
        
        $('#galleryImages').filepond({
        allowImagePreview: true,
        allowMultipleImages: true,
        allowReorder:true,
        storeAsFile: true,
        });

        $('input[name="title"]').keyup(function(){
            let title = $(this).val().replaceAll(' ', '-').toLowerCase();
            $('input[name="slug"]').val(title)
        })

    });
</script>
@endpush

@endsection