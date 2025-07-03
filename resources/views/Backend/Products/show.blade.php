@extends('layouts.BackendLayout')
@section('title', 'Manage Brand')
@section('backend')
<div class="container">
    <div class="card shadow">
        <div class="card-header">View All Products</div>
        <div class="card-body">
            <table id="dataTable" class="table table-responsive table-striped table-bordered">
                <thead>
                    <tr class="text-center">
                        <th>Sl.</th>
                        <th>Image</th>
                        <th class="text-start">Product Name</th>
                        <th>Category Name</th>
                        <th>Brand Name</th>
                        <th>Price</th>
                        <th>Selling Price</th>
                        <th>Quantity</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>

            </table>

        </div>
    </div>
    @push('scripts')
    <script>
        let table = new DataTable('#dataTable',{
            serverSide: true,
            processing: true,
            responsive: true,
            ajax: {
                url: `{{ route('products.index') }}`
            },
            columns: [
                {data: 'DT_RowIndex',sortable: false,searchable:false},
                {data: 'featured_image',sortable: false,searchable:false},
                {data: 'title'},
                {data: 'category.title'},
                {data: 'brand.title'},
                {data: 'price'},
                {data: 'selling_price'},
                {data: 'qty'},
                {data: 'status'},
                {data: 'action'},
            ]
        });
    </script>
    @endpush
    @endsection