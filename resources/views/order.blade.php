@extends('adminViews/home')

@section('content')

    <head>
        <link href={{ asset('../../public/css/stylesHall.css') }} rel="stylesheet">
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>

    <div class="container">
        <div class="row">

            <h4>Заказ создан!</h4>
            <b>Стол № {{ $table->id }}</b>
            <b>Заказ № {{ $order->id }}</b>
            <form action="{{ url('/waiter/table/'.$table->id.'/order/'.$order->id) }}">
                <button type="submit" class="btn btn-success">Далее</button>
            </form>
            <form action="{{ url('/waiter/table/'.$table->id.'/delete_order/'.$order->id) }}">
                <button type="submit" class="btn btn-warning">Отменить заказ</button>
            </form>
        </div>
    </div>

@endsection