@extends('adminViews/home')
{{--<script src="http://code.jquery.com/ui/1.11.2/jquery-ui.js"></script>--}}
@section('content')
    <style>
        .layer {
            overflow: auto; /* Добавляем полосы прокрутки */
            width: 100%; /* Ширина блока */
            height: 550px; /* Высота блока */
        }

        #print_frame {
            display: none;
        }

        .alert {
            margin-top: 100px;
        }
    </style>
    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link href={{ asset('../../public/css/stylesHall.css') }} rel="stylesheet">
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        {{--<meta http-equiv="refresh" content="5">--}}
    </head>

    <div class="container">
        @if(Session::has('order_error'))
            <script type="text/javascript">
                setTimeout(function () {
                    $('.alert').fadeOut('slow');
                }, 3000);
            </script>
            <div class="alert alert-danger">
                {{ session()->get('order_error') }}
            </div>
        @endif
        <div class="row">
            <center><b><h4>Стол № {{ $table->id }} Заказ № {{ $order->id }}</h4></b></center>
            <div class="col-md-6 layer">
                <center><h3>Меню</h3></center>
                @foreach($categories as $category)
                    <div><h4>{{ $category->name }}</h4></div>
                    @foreach($category->foods as $food)
                        @foreach($food->foodPrice as $price)
                            <form action="{{ url('/waiter/table/'.$table->id.'/order/'.$order->id.'/food/'.$food->id) }}"
                                  method="POST">
                                {{ csrf_field() }}
                                <button class="submit btn btn-default" value="{{$food->id}}">
                                    {{ $food->name }} - {{ $food->mass }} г. - {{ $price->price }}
                                </button>
                            </form>
                        @endforeach
                    @endforeach
                @endforeach
            </div>
            <div id="to_print" class="col-md-6 layer">
                <center><h3>Заказ</h3></center>
                <table class="table" id="ordertbl">
                    <thead>
                    <tr>
                        <th>Блюдо</th>
                        <th>Цена</th>
                        <th>Состояние</th>
                    </tr>
                    </thead>
                    @foreach($order->foods as $food)
                        @foreach($food->foodPrice as $price)
                            <tr>
                                <td>{{ $food->name }}</td>
                                <td id="price">{{ $price->price }}</td>
                                <td>
                                    @if($food->pivot->deleted_at)
                                        <button class="btn btn-success">
                                            <span class="glyphicon glyphicon-ok"></span>
                                        </button>
                                    @elseif($food->pivot->confirmed === 1)
                                        <button class="btn btn-primary">
                                            <span class="glyphicon glyphicon-hourglass"></span>
                                        </button>
                                    @elseif($food->pivot->confirmed === 0)
                                        <form action="{{ url('/waiter/table/'.$table->id.'/order/'.$order->id.'/food/'.$food->id. '/' . $food->pivot->created_at) }}"
                                              method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <button type="submit" class="btn btn-danger">
                                                <span class="glyphicon glyphicon-remove"></span>
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                </table>
                <div>Общая стоимость заказа: {{ $order->totalPrice() }}</div>
                <div>
                    <form action="{{ url('/waiter/table/'.$table->id.'/order/'.$order->id) }}" method="POST">
                        {{ csrf_field() }}
                        <button class="btn btn-success col-md-8" style="margin: 10px;">Confirm</button>
                    </form>
                    <form action="{{ url('/waiter/table/'.$table->id.'/order/'.$order->id) }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button id="print" class="btn btn-warning col-md-8" style="margin: 10px;">Закрыть заказ</button>
                    </form>
                </div>
                @if(Session::has('alert'))
                    <script type="text/javascript">
                        setTimeout(function () {
                            $('.alert').fadeOut('slow');
                        }, 3000);
                    </script>
                    <div class="alert alert-danger">
                        {{ session()->get('alert') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <script>
                $(function () {
                    $('#print').click(function () {
                        var printing_css = '<style media=print>tr:nth-child(even) td{background: #f0f0f0;}</style>';
                        var html_to_print = printing_css + $('#to_print').html();
                        var iframe = $('<iframe id="print_frame">');
                        $('body').append(iframe);
                        var doc = $('#print_frame')[0].contentDocument || $('#print_frame')[0].contentWindow.document;
                        var win = $('#print_frame')[0].contentWindow || $('#print_frame')[0];
                        doc.getElementsByTagName('body')[0].innerHTML = html_to_print;
                        win.print();
                        $('iframe').remove();
                    });
                });
    </script>
@endsection