@extends('layouts.backendlayout')
@section('title', 'All Products')
@section('backend')
<div class="container">
    <div class="row">
        <table id="dataTable" class="table table-responsive">
            <thead>
                <tr class="text-center">
                    <th>Sl.</th>
                    <th>Product Name</th>
                    <th>Product Image</th>
                    <th>Product Price</th>
                    <th>Product SKU</th>
                    <th>Product Stock</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $index=>$product)
                <tr class="text-center">
                    <td>{{ ++$index }}</td>
                    <td>{{ $product->title }}</td>
                    <td><img width="80px" src="{{ asset('storage/' . $product->featured_image) }}" alt="{{ $product->title }}"></td>
                    <td>{{ $product->selling_price }} <span style="text-decoration: line-through;">{{ $product->price }}</span></td>
                    <td>{{ $product->sku }}</td>
                    <td>{{ $product->qty }}</td>
                    <td>{!!   general_status($product->status) !!}</td>
                    <td>
                        <a href="" class="btn btn-primary">Edit</a>
                    </td>
                </tr>
                @empty
                <tr class="text-center">
                    <td colspan="8">No Products Found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection

