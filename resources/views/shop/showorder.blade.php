@extends('layouts.mainlayout')

@section ('title')
    Your order no {{$order->id}}
@endsection

@section('content')

    <div class="text-center">
        <h5>Your Order no {{$order->id}} - {{ $orderStatus }}</h5>
    </div>
    <div class="text-center mb-3">{{$message}}</div>

    <table class="table table-bordered text-center table-responsive-sm">
        <thead class="table-info">
        <tr>
            <th scope="col">Product title</th>
            <th scope="col">Product description</th>
            <th scope="col">Quantity</th>
            <th scope="col">Product price</th>
        </tr>
        </thead>

        <tbody>
        @foreach ($orderItems as $orderItem)
            <tr>
                <td>{{$orderItem->title}}</td>
                <td>{{$orderItem->description}}</td>
                <td>{{$orderItem->productQuantity}}</td>
                <td>{{$orderItem->price}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="text-right mr-4 mb-3"><strong>Total price: {{$orderTotalPrice}}</strong></div>
    <div id="deletedOrder">
        <form action="/delete/{{$order->id}}" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            @if ($order->status == 'completed')
                <button class="btn btn-danger btn-sm float-right mr-5">Delete order</button>
            @endif
        </form>
    </div>

    <a class="btn btn-outline-primary mb-3 mt-3" href="/" role="button" id="shopButton">Go Shopping</a>

@endsection