@extends('layouts.app')

@section('content')
    <div class="row-fluid justify-content-center w-100">
        <div class="col-md-12 my-md-2">
            <div class="card">
                <div class="card-header">
                    {{ $category['name'] }}
                </div>
                <div class="card-body row justify-content-evenly align-items-center">
                    @foreach ($products as $product)
                        <div class="col-md-2 mx-md-1 my-md-1">
                            <div class="card">
                                @if (str_contains($product['imagePath'], 'dummy') || str_contains($product['imagePath'], 'storage'))
                                    <img src="{{ url($product['imagePath']) }}" alt="image" class="card-img-top"
                                        style="max-height: 20vh">
                                @else
                                    <img src="{{ url('storage/' . $product['imagePath']) }}" alt="image"
                                        class="card-img-top" style="max-height: 20vh">
                                @endif
                                <div class="card-body">
                                    <div class="" style="min-height: 10vh">
                                        <p class="fs-5">{{ $product['name'] }}</p>
                                    </div>
                                    <p class="fw-bold">IDR {{ $product['price'] }}</p>
                                </div>
                                <a href="/products/{{ $product['name'] }}" class="stretched-link"></a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="my-md-3">
        {{ $products->links() }}
    </div>
@endsection
