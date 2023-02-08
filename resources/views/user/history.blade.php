@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-8">
            @foreach ($transactions as $transaction)
                <div class="dropdown my-md-1">
                    <button class="btn btn-outline-primary dropdown col-12 text-start" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <div class="d-flex justify-content-between">
                            <span>Transaction Date {{ $transaction['updated_at'] }}</span> <i class="bi bi-chevron-down"></i>
                        </div>
                    </button>
                    <ul class="dropdown-menu col-12">
                        <li class="dropdown-item">
                            <div class="row my-md-1 fw-bold fs-4 border-bottom border-dark border-1">
                                <div class="col-6">
                                    Name
                                </div>
                                <div class="col-3">
                                    Quantity
                                </div>
                                <div class="col-3">
                                    Sub Price
                                </div>
                            </div>
                            @php($totalPrice = 0)
                            @foreach ($transaction->products as $product)
                                @php($totalPrice += $product['price'])
                                <div class="row my-md-1">
                                    <div class="col-6">
                                        {{ $product['name'] }}
                                    </div>
                                    <div class="col-3">
                                        {{ $product->pivot['quantity'] }}
                                    </div>
                                    <div class="col-3">
                                        IDR {{ $product['price'] }}
                                    </div>
                                </div>
                            @endforeach
                            <div class="row my-md-1 fw-bold fs-4 border-top border-dark border-1">
                                <div class="col-6">
                                    Total
                                </div>
                                <div class="col-3">
                                    {{ $transaction->products->count() }} item(s)
                                </div>
                                <div class="col-3">
                                    IDR {{ $totalPrice }}
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            @endforeach

        </div>
    </div>
@endsection
