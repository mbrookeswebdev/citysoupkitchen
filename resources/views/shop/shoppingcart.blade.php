@extends('layouts.mainlayout')

@section ('title')
    Shopping Cart
@endsection

@section('content')

    <div class="text-center mb-3" id="shoppingCart"><h5>Shopping Cart</h5>

        @if (session()->has('shoppingCart'))

            @if (!empty($products))

                <table class="mt-3 table table-bordered text-center table-responsive-sm">
                    <thead class="table-info">
                    <tr>
                        <th scope="col">Product</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Price</th>
                    </tr>
                    </thead>
                    @foreach($products as $product)
                        <tbody>
                        <tr>
                            <td>{{$product['product']->title }}</td>
                            <td>
                                <div class="d-none d-sm-block d-sm-none d-md-block">
                                    <a class="mr-1 btn btn-primary btn-sm"
                                       href="/increase-quantity/{{$product['product']->id}}">+</a>
                                    {{$product['quantity']}}
                                    <a class="ml-1 btn btn-primary btn-sm"
                                       href="/decrease-quantity/{{$product['product']->id}}">-</a></div>
                                <div class="d-block d-sm-none"><a href="/decrease-quantity/{{$product['product']->id}}">
                                        <h6>
                                            -</h6></a><h6>{{$product['quantity']}}</h6>
                                    <a href="/increase-quantity/{{$product['product']->id}}"><h6>+</h6></a></div>
                            </td>
                            <td>£{{ $product['price'] }}</td>
                        </tr>
                        @endforeach
                        <td>

                        </td>

                        <td>
                            <div class="d-block d-sm-none mb-3"><a href="/"><h6>Continue Shopping</h6></a></div>
                            <a class="btn btn-outline-primary d-none d-sm-block mb-3 mt-3" href="/" role="button"
                               id="shopButton">Continue
                                Shopping</a>
                            <div class="d-block d-sm-none"><a href="remove-all"><h6>Empty the Basket</h6></a></div>
                            <a class="btn btn-outline-danger d-none d-sm-block" href="/remove-all" role="button"
                               id="emptyButton">Empty the Basket</a>
                        </td>
                        <td>
                            <form method="post" action="/re-calculate">
                                @csrf
                                <input type="checkbox" name="delivery"
                                       @if ($shoppingCart->getDelivery() == true) checked @endif> Add delivery (£2.99)
                                <p>
                                    <button type="submit" class="btn btn-warning mt-3" id="recalculateButton">
                                        Re-calculate
                                    </button>
                                </p>
                            </form>
                            <h6 class="mt-3 mb-3">Total: £{{$totalPrice}}</h6>
                            <div>
                                <form method="post" action="/pay">
                                    @csrf
                                    <button class="btn btn-success mb-3" role="button">Pay Now</button>
                                </form>
                            </div>
                        </td>
                        </tbody>
                </table>
            @else
                <div class="mt-5 mb-5">{{$message}}</div>
                <a class="btn btn-outline-primary" href="/" role="button" id="shopButton">Go Shopping</a>
            @endif
        @else
            <div class="mt-5 mb-5">{{$message}}</div>
            <a class="btn btn-outline-primary mx-auto" href="/" role="button" id="shopButton">Go Shopping</a>
        @endif
    </div>
@endsection