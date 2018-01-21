@extends('adminViews/home')

{{--<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>--}}

@section('content')

    <style>
        .layer {
            overflow: auto; /* Добавляем полосы прокрутки */
            width: 100%; /* Ширина блока */
            height: 520px; /* Высота блока */
        }
    </style>

    <head>
        <link href={{ asset('../../public/css/stylesHall.css') }} rel="stylesheet">
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="{{ asset('js/app.js') }}"></script>
    </head>

    <div class="container">

        <div class="col-md-12">
            <center><h3>Доска Повара</h3></center>
            <div class="layer">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Добавлено</th>
                        <th>Подтверждено</th>
                        <th>Заказ</th>
                        <th>Блюдо</th>
                        <th>Комментарий к заказу</th>
                        <th>Состояние</th>
                    </tr>
                    </thead>
                    @foreach($orders as $order)
                        @foreach($order->foods as $food)
                            @if(!$food->pivot->deleted_at && $food->pivot->dateTimeInCook )
                                <tr>
                                    <td>{{ $food->pivot->created_at }}</td>
                                    <td>{{ $food->pivot->dateTimeInCook }}</td>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $food->name }}</td>
                                    <td>{{ $order->comment }}</td>
                                    <td>
                                        <form action="{{ url('/cookboard/order/'.$order->id.'/food/'.$food->id.'/'. $food->pivot->created_at) }}"
                                              method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <button type="submit" class="btn btn-success">
                                                Готово
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    @endforeach
                </table>
            </div>
        </div>
    </div>

@endsection




{{--@section('content')--}}

{{--<div class="container">--}}

{{--echo "Echo";--}}


{{--</div>--}}
{{--<script>--}}
{{--var url =  '{{ url('/home') }}';--}}
{{--//var htmlOut = "";--}}
{{--$.ajax({--}}
{{--url: url,--}}
{{--type: 'post',--}}
{{--data: {"_method": 'POST', '_token':'{{ $csrf_token }}', 'foo':'bar'},--}}
{{--success: function(response)--}}
{{--{--}}
{{--console.log(response);--}}
{{--//htmlOut ="<p>"+response+"</p>";--}}
{{--//document.write(htmlOut);--}}
{{--}--}}
{{--});--}}
{{--</script>--}}

{{--@endsection--}}