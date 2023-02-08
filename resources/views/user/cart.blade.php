@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="row justify-content-center align-items-start m-md-3 h-100">
                @if (count($cartItems))
                    @php($totalPrice = 0)
                    @foreach ($cartItems as $cartItem)
                        @php($totalPrice += $cartItem['price'])
                        <div class="d-flex flex-row border border-dark my-md-2">
                            <div class="col-md-4 mr-md-1 d-flex align-items-stretch justify-content-center">
                                @if (str_contains($cartItem['imagePath'], 'dummy') || str_contains($cartItem['imagePath'], 'storage'))
                                    <img src="{{ url($cartItem['imagePath']) }}" alt="image" class="card-img-top m-md-3"
                                        style="max-height: 20vh">
                                @else
                                    <img src="{{ url('storage/' . $cartItem['imagePath']) }}" alt="image"
                                        class="card-img-top m-md-3" style="max-height: 20vh">
                                @endif
                            </div>
                            <div class="col-md-6">
                                <p class="my-md-2 fs-2 fw-bold">{{ $cartItem['name'] }}</p>

                                <p>Quantity : {{ $cartItem->pivot->quantity }}</p>
                                <p>Total Price : IDR {{ $cartItem->pivot->quantity * $cartItem['price'] }}</p>
                            </div>
                            <div class="col-md-2 d-flex">
                                <div class="my-md-2 ms-auto">
                                    <form action="#" method="POST" class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-outline-danger" onclick="return confirm('Are you Sure ?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <div class="col-md-6  m-md-5 text-center border border-dark border-5">
                        <form action="{{ route('cart.update', $carts->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="my-3 d-flex justify-content-evenly align-items-center">
                                <span>Total Price : IDR {{ $totalPrice }}</span>
                                <button type="submit" class="btn btn-outline-primary"
                                    onclick="return confirm('Are you Sure ?')">
                                    Purchase
                                </button>
                            </div>
                        </form>
                    </div>
                @else
                    <div class="col-md-12 m-md-5 text-center">
                        <p class="fs-2">No Item in the Cart</p>
                    </div>
                @endif

            </div>
        </div>
    </div>
@endsection
