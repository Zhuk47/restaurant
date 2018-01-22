@extends('adminViews/home')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">

@section('content')

    <style>
        .layer {
            overflow: auto; /* Добавляем полосы прокрутки */
            width: 100%; /* Ширина блока */
            height: 500px; /* Высота блока */
        }
    </style>

    <div class="container">
        <!-- Отображение ошибок проверки ввода -->
        @include('common.errors')
    </div>

    <div class="container col-md-11">
        <div class="col-md-2">
            <form action="{{ url('/orders/week') }}">
                {{ csrf_field() }}
                <button class="btn btn-default">
                    История за неделю
                </button>
            </form>
        </div>
        <div class="col-md-2">
            <form action="{{ url('/orders/all') }}">
                {{ csrf_field() }}
                <button class="btn btn-default">
                    История за всё время
                </button>
            </form>
        </div>
        <div class="col-md-8">
            <form action="{{ url('/orders/date') }}" method="POST">
                {{ csrf_field() }}
                <div class="col-md-3">
                    <input type="date" name="date" class="form-control">
                </div>
                <button class="btn btn-default">
                    Поиск по дате
                </button>
            </form>
        </div>

    </div>

    @if (count($orders) > 0)
        {{--<center><h4><b>История заказов</b></h4></center>--}}
        <b>
            <div class="prices">
                <div class="col-md-1"></div>
                <div class="container col-md-3">Общая сумма: {{$total}} грн.</div>
                <div class="container col-md-3">Общая себестоимость: {{$netTotal}} грн.</div>
                <div class="container col-md-3">Чистая прибыль: {{$clean}} грн.</div>
                <div class="col-md-2"></div>
            </div>
        </b>
        <div class="container layer">
            <div class="panel-body">
                <table class="table table-striped task-table">
                    <!-- Заголовок таблицы -->
                    <thead>
                    <th>ID</th>
                    <th>Официант</th>
                    <th>Открытие</th>
                    <th>Закрытие</th>
                    <th>Ингредиенты</th>
                    <th>Стоимость</th>
                    <th>Блюда</th>
                    </thead>
                    <!-- Тело таблицы -->
                    @foreach ($orders as $order)
                        <tr>
                            <td class="table-text">
                                {{ $order->id }}
                            </td>
                            <td class="table-text">
                                {{ $order->user->name }} {{ $order->user->surname }}
                            </td>
                            <td class="table-text">
                                {{ $order->created_at }}
                            </td>
                            @if($order->deleted_at == null)
                                <td class="table-text">
                                    Заказ в работе
                                </td>
                            @elseif($order->deleted_at)
                                <td class="table-text">
                                    {{ $order->deleted_at }}
                                </td>
                            @endif
                            <td class="table-text">
                                {{ $order->netPrice }}
                            </td>
                            <td class="table-text">
                                {{ $order->price }}
                            </td>
                            <td class="dropdown">
                                <button class="btn dropdown-toggle" data-toggle="dropdown">
                                    <span class="glyphicon glyphicon-list"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-left">
                                    @foreach($order->foods as $food)
                                        <div>{{ $food->name }}</div>
                                    @endforeach
                                </ul>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    @endif

@endsection