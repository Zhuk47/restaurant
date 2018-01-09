@extends('adminViews/home')

@section('content')

    <head>
        <link href={{ asset('../../public/css/stylesHall.css') }} rel="stylesheet">
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>

    <div class="container">
        <div class="row">
            <b>Стол № {{ $table->id }}</b>
            <b>Заказ № {{ $order->id }}</b>
        <div class="col-md-6">
            <center><h3>Меню</h3></center>
            @foreach($categories as $category)
                <div><h2>{{ $category->name }}</h2></div>
                @foreach($category->foods as $food)
                    @foreach($food->foodPrice as $price)
                        <button>{{ $food->name }} - {{ $food->mass }} г. - {{ $price->price }}</button>
                    @endforeach
                @endforeach
            @endforeach
        </div>
        <div class="col-md-6">
            <center><h3>Заказ</h3></center>
        </div>
    </div>

@endsection