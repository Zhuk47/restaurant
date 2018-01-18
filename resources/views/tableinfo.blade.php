<style>
    .panel-body {
        overflow: auto; /* Добавляем полосы прокрутки */
        width: 100%; /* Ширина блока */
        height: 550px; /* Высота блока */
    }

    .orderContainer {
        margin-top: 25px;
    }
</style>
<head>
    <link href={{ asset('../../public/css/stylesHall.css') }} rel="stylesheet">
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    {{--<meta http-equiv="refresh" content="5">--}}
</head>
@extends('adminViews/home')

@section('content')

    <div class="container">
        <!-- Отображение ошибок проверки ввода -->
        @include('common.errors')

        <div class="panel-body">
            <!-- Заголовок таблицы -->
            <div id="table">Стол № {{ $table->id }}</div>
            @foreach($table->orders as $order)
                <div class="orderContainer">
                    <div id="order">Заказ № {{ $order->id }}</div>
                    <div id="waiter">Официант: {{ $order->user->name }} {{ $order->user->surname }}</div>
                    <div id="waiter">Время создания: {{ $order->created_at}}</div>
                    <table class="table" id="ordertbl">
                        <thead>
                        <tr>
                            <th>Блюдо</th>
                            <th>Цена</th>
                            <th>Добавлено</th>
                            <th>Состояние</th>
                        </tr>
                        </thead>
                        @foreach($order->foods as $food)
                            @foreach($food->foodPrice as $price)
                                <tr>
                                    <td>{{ $food->name }}</td>
                                    <td>{{ $price->price }} грн.</td>
                                    <td>{{ $food->pivot->dateTimeInCook }}</td>
                                    <td>
                                        @if($food->pivot->deleted_at)
                                            <button class="btn btn-success">
                                                <span class="glyphicon glyphicon-ok"></span>
                                            </button>
                                        @elseif($food->pivot->confirmed === 1)
                                            {{--<button class="btn btn-primary">--}}
                                                <div>
                                                    <img src="http://icons.iconarchive.com/icons/icons8/android/512/Household-Kitchen-icon.png">
                                                </div>
                                            {{--</button>--}}
                                        @elseif($food->pivot->confirmed === 0)
                                            <button type="submit" class="btn btn-danger">
                                                <span class="glyphicon glyphicon-remove"></span>
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                    </table>
                    @endforeach
                    <div id="total"><h1>Общая стоимость заказа: {{ $order->price }} грн.</h1></div>
                </div>
        </div>
    </div>
@endsection