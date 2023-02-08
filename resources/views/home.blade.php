@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">

        @if (session()->has('registered'))
            <div class="row justify-content-center">
                <div class="notification alert alert-success alert-dismissible col-md-4" role="alert">
                    {!! session('registered') !!}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif

        @if (session()->has('purchased'))
            <div class="row justify-content-center">
                <div class="notification alert alert-success alert-dismissible col-md-6" role="alert">
                    {!! session('purchased') !!}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif

        <form action="/">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Search.." name="search"
                    value="{{ request('search') }}">
                <button class="btn btn-primary" type="submit"><i class="bi bi-search"></i>
                </button>
            </div>
        </form>

        @if (request('search'))
            <div class="col-md-12 my-md-2">
                <div class="card">
                    <div class="card-header">
                        Search Result
                    </div>
                    @if ($count > 0)
                        <div class="card-body row">
                            @foreach ($categories as $category)
                                @foreach ($category->products as $product)
                                    <div class="col-md-3 my-md-1">
                                        <div class="card h-100">
                                            @if (str_contains($product['imagePath'], 'dummy') || str_contains($product['imagePath'], 'storage'))
                                                <img src="{{ url($product['imagePath']) }}" alt="image"
                                                    class="card-img-top" style="max-height: 20vh">
                                            @else
                                                <img src="{{ url('storage/' . $product['imagePath']) }}" alt="image"
                                                    class="card-img-top" style="max-height: 20vh">
                                            @endif
                                            <div class="card-body">
                                                <p class="fs-3">{{ $product['name'] }}</p>
                                                <p class="fw-bold">IDR {{ $product['price'] }}</p>
                                            </div>
                                            <a href="/products/{{ $product['slug'] }}"class="stretched-link"></a>
                                        </div>
                                    </div>
                                @endforeach
                            @endforeach
                        </div>
                    @else
                        <div class="col-md-12 m-md-5 text-center">
                            <p class="fs-2">No Result Founded</p>
                        </div>
                    @endif
                </div>
            </div>
        @else
            @foreach ($categories as $category)
                <div class="col-md-12 my-md-2">
                    <div class="card">
                        <div class="card-header">
                            {{ $category['name'] }} <a href="/category/{{ $category['name'] }}" class="text-primary">
                                View All
                            </a>
                        </div>
                        <div class="card-body row">
                            @foreach ($category->products->take(4) as $product)
                                <div class="col-md-3 my-md-1">
                                    <div class="card h-100">
                                        @if (str_contains($product['imagePath'], 'dummy'))
                                            <img src="{{ url($product['imagePath']) }}" alt="image" class="card-img-top"
                                                style="max-height: 20vh">
                                        @else
                                            <img src="{{ url('storage/' . $product['imagePath']) }}" alt="image"
                                                class="card-img-top" style="max-height: 20vh">
                                        @endif
                                        <div class="card-body">
                                            <p class="fs-3">{{ $product['name'] }}</p>
                                            <p class="fw-bold">IDR {{ $product['price'] }}</p>
                                        </div>
                                        <a href="/products/{{ $product['slug'] }}"class="stretched-link"></a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
@endsection
