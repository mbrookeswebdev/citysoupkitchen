@extends('layouts.mainlayout')

@section ('title')
    Orders
@endsection

@section('content')

    <div class="text-center"><h5>Your Orders</h5></div>

    @if (session('status'))
        <div class="alert alert-info text-center">
            <h6>{{ session('status') }}</h6>
        </div>
    @endif

    <div class="text-center mt-3 mb-3">{{$message}}</div>

    @if (!empty($orders))

        <table class="table table-bordered text-center table-responsive-sm">
            <thead class="table-info">
            <tr>
                <th scope="col">Order date</th>
                <th scope="col">Order no</th>
                <th scope="col">Total price</th>
                <th scope="col">Status</th>
            </tr>
            </thead>
            @foreach ($orders as $order)
                <tbody>
                <tr>
                    <td>{{($order->created_at)->format('d-m-Y')}}</td>
                    <td><a href="{!! action('ShopController@showOrder', $order->id) !!}">{{$order->id}}</a></td>
                    <td>{{$order->totalPrice}}</td>
                    <td>{{$order->status}}</td>
                </tr>
                @endforeach
                </tbody>
        </table>
    @endif

    <div class="row justify-content-center">
        <a class="btn btn-outline-primary mt-2" href="/" role="button" id="shopButton">Go Shopping</a>
    </div>

@endsection











