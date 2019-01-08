@extends('layouts.mainlayout')

@section ('title')
    City Soup Kitchen
@endsection

@section('content')

    <div class="col-sm-10 col-md-12 col-lg-12">

        <div class="row justify-content-md-center">
            <div id="welcome1"><h2>City Soup Kitchen</h2></div>
        </div>

        <div class="row justify-content-md-center">
            <div id="welcome2"><h4>tasty homemade soup freshly prepared for collection or delivery to your home or
                    office</h4></div>
        </div>

        <div class="mt-3 mb-3 row justify-content-md-center">
            <div id="welcome3"><h5>Please choose your favourite lunch below:</h5></div>
        </div>

    </div>

    <div class="card-deck">
        <div class="row">
            @foreach ($products as $product)
                <div class="col-lg-4 col-md-6">
                    <div class="card mb-3">
                        <img class="card-img-top" src="{{$product->imagePath}}"
                             alt="{{$product->title}}" height="230px" width="100px">
                        <div class="card-body">
                            <h5 class="card-title text-center">{{$product->title}}</h5>
                            <p class="card-text text-center">{{$product->description}}</p>
                        </div>
                        <div class="text-center card-footer bg-white">
                            <p class="card-text"><strong>£{{$product->price}}</strong></p>
                            <a class="mb-5 btn btn-primary btn-sm"
                               href="/add-product/{{$product->id}}" id="selectProduct">Select</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
