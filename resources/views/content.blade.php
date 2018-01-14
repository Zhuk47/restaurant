@extends('adminViews.home')

@section('content')

    <style>
        .layer {
            overflow: auto; /* Добавляем полосы прокрутки */
            width: 50%; /* Ширина блока */
            height: 580px; /* Высота блока */
        }
    </style>

    <div class="container">
        <!-- Отображение ошибок проверки ввода -->
        @include('common.errors')
        <div class="col-md-6">
            <!-- Состав -->
            <div>
                @if(Session::has('alert'))
                    <script type="text/javascript">
                        setTimeout(function () {
                            $('.alert').fadeOut('slow');
                        }, 2000);
                    </script>
                    <div class="alert alert-success">
                        {{ session()->get('alert') }}
                    </div>
                @elseif(Session::has('delAlert'))
                    <script type="text/javascript">
                        setTimeout(function () {
                            $('.alert').fadeOut('slow');
                        }, 2000);
                    </script>
                    <div class="alert alert-danger">
                        {{ session()->get('delAlert') }}
                    </div>
                @endif
                <h5>{{ $food->name }} id:{{$food->id}}</h5>
            </div>
            <table class="table table-striped task-table">
                <thead>
                <th>Ингредиент</th>
                <th>Масса, г.</th>
                <th>Стоимость (за 100г)</th>
                </thead>
                <!-- Тело таблицы -->
                @foreach ($ingredients as $ingredient)
                    <tr>
                        <!-- Ингредиент -->
                        <td class="table-text">
                            <div>{{ $ingredient->name }}</div>
                        </td>
                        <!-- Масса -->
                        <td class="table-text">
                            <div>{{ $ingredient->pivot->mass }}</div>
                        </td>
                        <!-- Стоимость ингредиента -->
                        <td class="table-text">
                            <div>{{ $ingredient->prices->sortByDesc('dateTime')->first()->price }}</div>
                        </td>
                        <!-- Кнопка Удалить -->
                        <td>
                            <form action="{{ url('food/'.$food->id.'/content/'.$ingredient->id) }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}

                                <button type="submit" class="btn btn-danger">
                                    <i class="fa fa-trash"></i> Удалить
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
            <div>Выход: <b>{{ $food->currentTotalWeight() }} г.</b></div>
            <div>Себестоимость ингредиентов в блюде составляет <b>{{ $food->currentNetCost() }} грн.</b></div>
            @foreach($food->foodPrice as $price)
                <div>Стоимость блюда составляет <b>{{ $price->price }} грн.</b></div>
            @endforeach

            <form action="{{ url('food/'.$food->id.'/content/') }}" method="POST" class="form-horizontal">
                {{ csrf_field() }}

                <h5><b>Стоимость блюда</b></h5>
                <!-- Данные блюда -->
                <div class="form-group">
                    <div class="col-sm-6">
                        @foreach($food->foodPrice as $price)
                            <input type="text" name="price" id="food-price" class="form-control"
                                   placeholder="Стоимость блюда" value="{{ $price->price }}">
                        @endforeach
                    </div>
                </div>
                <!-- Кнопка добавления стоимости -->
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6">
                        <button type="submit" class="btn btn-default">
                            <i class="fa fa-plus"></i> Добавить
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-6 layer">
            <table class="table table-striped task-table">
                <!-- Заголовок таблицы -->
                <thead>
                <th>ID</th>
                <th>Ингредиент</th>
                </thead>
                <!-- Тело таблицы -->
                @foreach ($allIngredients as $oneIngredient)
                    <form action="{{ url('food/'.$food->id.'/content/'.$oneIngredient->id) }}" method="POST"
                          class="form-horizontal">
                        {{ csrf_field() }}
                        <tr>
                            <!-- ID ингредиента -->
                            <td class="table-text">
                                <div>{{ $oneIngredient->id }} </div>
                            </td>
                            <!-- Ингредиент -->
                            <td class="table-text">
                                <div>{{ $oneIngredient->name }}</div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <label for="role" class="col-sm-3 control-label"></label>
                                    <div class="col-sm-6">
                                        <input type="text" name="mass" id="ingredient-mass" class="form-control"
                                               placeholder="Масса г.">
                                    </div>
                                </div>
                            </td>
                            <!-- Кнопка Добавить -->
                            <td class="form-group">
                                <button type="submit" class="btn btn-default">
                                    <i class="fa fa-plus"></i>Добавить
                                </button>
                            </td>
                        </tr>
                    </form>
                @endforeach
            </table>
        </div>
    </div>
@endsection