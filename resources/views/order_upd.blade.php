@extends('adminViews/home')

@section('content')

    <head>
        <link href={{ asset('../../public/css/stylesHall.css') }} rel="stylesheet">
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
                <table class="table">
                    <thead>
                    <tr>
                        <th>Блюдо</th>
                        <th>Цена</th>
                        <th>Удалить</th>
                    </tr>
                    </thead>
                    @foreach($order->foods as $food)
                        @foreach($food->foodPrice as $price)
                            <tr>
                                <td>{{ $food->name }}</td>
                                <td>{{ $price->price }}</td>
                                <td>
                                    @if($food->pivot->confirmed === 1)
                                        <div><b>Confirmed!</b></div>
                                    @elseif($food->pivot->confirmed === 0)
                                        <form action="{{ url('/waiter/table/'.$table->id.'/order/'.$order->id.'/food/'.$food->id) }}"
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
                <form action="{{ url('/waiter/table/'.$table->id.'/order/'.$order->id) }}" method="POST">
                    {{ csrf_field() }}
                    <button class="btn btn-success">Confirm</button>
                </form>
            </div>
        </div>

@endsection