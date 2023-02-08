@extends('layouts.app')

@section('content')

    @if (session()->has('created'))
        <div class="row justify-content-center">
            <div class="alert alert-success alert-dismissible col-md-6" role="alert">
                {{ session('created') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif

    @if (session()->has('updated'))
        <div class="row justify-content-center">
            <div class="alert alert-warning alert-dismissible col-md-6" role="alert">
                {{ session('updated') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif

    @if (session()->has('deleted'))
        <div class="row justify-content-center">
            <div class="alert alert-danger alert-dismissible col-md-6" role="alert">
                {{ session('deleted') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="navbar navbar-expand-lg navbar m-md-2">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <form action="{{ route('products.index') }}">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search.." name="search"
                                    value="{{ request('search') }}">
                                <button class="btn btn-primary" type="submit"><i class="bi bi-search"></i>
                                </button>
                            </div>
                        </form>
                    </li>
                </ul>

                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="btn btn-primary" href="/products/create">
                            Add Product <i class="bi bi-plus-lg"></i>
                        </a>
                    </li>
                </ul>
            </div>
            <div>
                <div class="row justify-content-center align-items-start m-md-3 border border-black h-100">
                    @if (count($products))
                        @foreach ($products as $product)
                            <div class="col-md-4 mr-md-1 d-flex align-items-stretch justify-content-center">
                                @if (str_contains($product['imagePath'], 'dummy') || str_contains($product['imagePath'], 'storage'))
                                    <img src="{{ url($product['imagePath']) }}" alt="image" class="card-img-top m-md-3"
                                        style="max-height: 20vh">
                                @else
                                    <img src="{{ url('storage/' . $product['imagePath']) }}" alt="image"
                                        class="card-img-top m-md-3" style="max-height: 20vh">
                                @endif
                            </div>
                            <div class="col-md-6">
                                <p class="my-md-2 fs-2 fw-bold">{{ $product['name'] }}</p>
                            </div>
                            <div class="col-md-2 d-flex justify-content-evenly">
                                <div class="my-md-2">
                                    <a class="btn btn-outline-warning" href="/products/{{ $product['slug'] }}/edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('products.destroy', $product['slug']) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-outline-danger" onclick="return confirm('Are you Sure ?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="col-md-12 m-md-5 text-center">
                            <p class="fs-2">No Result Founded</p>
                        </div>
                    @endif

                    <div class="my-md-3 pagination justify-content-center">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
