@extends('layouts.BackendLayout')
@section('title', 'Manage Brand')
@section('backend')
    <div class="container">
        <div class="card shadow">
                    <div class="card-header">View All Products</div>
                    <div class="card-body">
                        <table class="table table-responsive table-striped table-bordered">
                            <thead>
                                <tr class="text-center">
                                    <th>Sl.</th>
                                    <th class="text-start">Product Name</th>
                                    <th>Category Name</th>
                                    <th>Brand Name</th>
                                    <th>Price</th>
                                    <th>Selling Price</th>
                                    <th>Quantity</th>
                                    <th>Product Image</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $key=>$product)


                                    <tr class="text-center">
                                        <td>{{ ++$key }}</td>
                                        <td class="text-start">{{ $product->title}}</td>
                                        <td>{{$product->category->title}}</td>
                                        <td>{{$product->brand->title}}</td>
                                        <td>{{$product->price}}</td>
                                        <td>{{$product->selling_price}}</td>
                                        <td>{{$product->qty}}</td>
                                        <td><img class="img-fluid" style="height:70px;width:70px" src="{{ asset('storage/' . $product->featured_image) }}" alt=""></td>

                                        <td>
                                            {!! general_status($product->status) !!}
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{ route('products.edit', $product->id) }}"
                                                    class="btn  btn-primary"><i class='bx bx-pencil'></i></a>
                                                <a href="#" class="btn  btn-danger btnDelete"><i
                                                        class='bx bx-trash-alt'></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                        <div style="margin-top: 20px;">
                                    {{ $products->links() }}
                        </div>
                    </div>
                </div>
@endsection
