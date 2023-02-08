@extends('layouts.app')

@section('content')
    <div class="row justify-content-center align-items-start m-md-5 border border-black">
        <div class="col-md-4">
            <img src="{{ url($product['imagePath']) }}" alt="" class="card-img-top m-md-3">
        </div>
        <div class="col-md-1">

        </div>
        <div class="col-md-7">
            <p class="my-md-3 fs-2 fw-bold">{{ $product['name'] }}</p>
            <div class="row mb-md-3">
                <div class="col-3">
                    Detail
                </div>
                <div class="col-1">
                    :
                </div>
                <div class="col-8">
                    {{ $product['description'] }}
                </div>
            </div>

            <div class="row mb-md-3">
                <div class="col-3">
                    Price
                </div>
                <div class="col-1">
                    :
                </div>
                <div class="col-8">
                    {{ $product['price'] }}
                </div>
            </div>
            @can('customer')
                <form action="{{ route('cart.store') }}" method="POST">
                    @csrf
                    <div class="row mb-md-3">
                        <div class="col-3">
                            Qty
                        </div>
                        <div class="col-1">
                            :
                        </div>
                        <div class="col-8">
                            <input type="hidden" class="form-control" name="product_id" value="{{ $product['id'] }}">

                            <input id="quantity" type="number"
                                class="form-control form-control-sm @error('quantity') is-invalid @enderror" name="quantity"
                                value="{{ old('quantity') }}" required autocomplete="price" autofocus
                                placeholder="Enter Product Quantity">

                            @error('quantity')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>
                    </div>

                    <div class="row mb-md-3">
                        <div class="col-3">
                            <button class="btn btn-outline-primary">Purchase</button>
                        </div>
                    </div>
                </form>
            @endcan
        </div>
    </div>
@endsection
