@extends('adminViews/home')

<script src="http://code.jquery.com/ui/1.11.2/jquery-ui.js"></script>

@section('content')

    <head>
        <link href={{ asset('../../public/css/stylesHall.css') }} rel="stylesheet">
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        {{--<meta http-equiv="refresh" content="5">--}}
    </head>

    <div class="container">
        <div class="row">
            <center><b><h4>Стол № {{ $table->id }} Заказ № {{ $order->id }}</h4></b></center>
            <div class="col-md-6">
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
            <div class="col-md-6">
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
                {{--<div id="res" style="font-weight:bold">1</div>--}}
                <center>
                    <form action="{{ url('/waiter/table/'.$table->id.'/order/'.$order->id) }}" method="POST">
                        {{ csrf_field() }}
                        <button class="btn btn-success col-md-8" style="margin: 10px;">Confirm</button>
                    </form>
                    <form action="{{ url('/waiter/table/'.$table->id.'/order/'.$order->id) }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button class="btn btn-warning col-md-8" style="margin: 10px;">Закрыть заказ</button>
                    </form>
                </center>
                @if(Session::has('alert'))
                    <script type="text/javascript">
                        setTimeout(function () {
                            $('.alert').fadeOut('slow');
                        }, 2000);
                    </script>
                    <div class="alert alert-danger">
                        {{ session()->get('alert') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection