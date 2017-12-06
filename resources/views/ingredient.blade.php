@extends('welcome')

@section('content')

    <div class="panel-body">
        <!-- Отображение ошибок проверки ввода -->
        @include('common.errors')
    </div>
    <!-- Форма нового ингредиента -->
        <form action="{{ url('ingredient') }}" method="POST" class="form-horizontal">
        {{ csrf_field() }}
            <h5>Добавление ингредиента</h5>
        <!-- Имя ингредиента -->
            <div class="form-group">
                {{--<label for="role" class="col-sm-3 control-label"></label>--}}
                <div class="col-sm-6">
                    <input type="text" name="name" id="ingredient-name" class="form-control" placeholder="ингредиент">
                </div>
                {{--<div class="col-sm-6">--}}
                    {{--<input type="text" name="price" id="ingredient-price" class="form-control" placeholder="Стоимость">--}}
                {{--</div>--}}
            </div>
            <!-- Кнопка добавления ингредиента -->
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-plus"></i> Добавить
                    </button>
                </div>
            </div>
        </form>

    <!-- Текущие ингредиенты -->
    @if (count($ingredients) > 0)
        <div class="panel panel-default">
            <div class="panel-heading">
                <br>
            </div>

            <div class="panel-body">
                <table class="table table-striped task-table">

                    <!-- Заголовок таблицы -->
                    <thead>
                    <th>ID</th>
                    <th>Ингредиент</th>
                    <th>Стоимость за 100г</th>
                    </thead>

                    <!-- Тело таблицы -->
                    <tbody>
                    @foreach ($ingredients as $ingredient)
                        <tr>
                            <!-- Имя ингредиента -->
                            <td class="table-text">
                                <div>{{ $ingredient->id }}</div>
                            </td>
                            <td class="table-text">
                                <div>{{ $ingredient->name }}</div>
                            </td>
                            <!-- Стоимость категории -->
                            <td class="table-text">
                                <div>{{ $ingredient->prices->sortByDesc('dateTime')->first()->price }}</div>
                            </td>
                            <!-- Кнопка Удалить -->
                            <td>
                                <form action="{{ url('ingredient/'.$ingredient->id) }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}

                                    <button type="submit" class="btn btn-danger">
                                        <i class="fa fa-trash"></i> Удалить
                                    </button>
                                </form>
                            </td>
                            <td>
                                <form action="{{ url('ingredientupd/'.$ingredient->id) }}">
                                    <button type="submit" class="btn btn-default">Изменить</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
@endsection