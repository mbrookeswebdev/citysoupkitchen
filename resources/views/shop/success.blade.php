@extends('layouts.mainlayout')

@section('title')
    Success!
@endsection

@section('content')

    <div class="text-center mb-5 mt-4"><h4>Thank you for your order!</h4></div>

    <div class="text-center mb-3"><h5>{{$status}}</h5></div>

    <div class="row justify-content-center">
        <a class="btn btn-outline-primary mt-2" href="/" role="button" id="shopButton">Shop Again</a>
    </div>

@endsection