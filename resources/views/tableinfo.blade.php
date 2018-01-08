@extends('adminViews/home')

@section('content')

    <div class="container">
        <!-- Отображение ошибок проверки ввода -->
        @include('common.errors')

        <div class="panel-body">
            <!-- Заголовок таблицы -->
            <div id="table">Стол № {{ $table->id }}</div>
            @foreach($table->orders as $order)
                <div id="order">Заказ № {{ $order->id }}</div>
                <div id="waiter">Официант: {{ $order->user->name }} {{ $order->user->surname }}</div>
                <table id="dishes">
                    <caption>Блюда в заказе:</caption>
                    @foreach($order->foods as $food)
                        @foreach($food->foodPrice as $price)
                            <tr>
                                <td>{{ $food->name }} - {{ $price->price }} грн.</td>
                            </tr>
                </table>
            @endforeach
            @endforeach
            @endforeach
            <div id="total">Общая стоимость заказа {{ $order->price }} грн.</div>
        </div>
    </div>
@endsection