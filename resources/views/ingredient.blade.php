@extends('welcome')

@section('content')

    <div class="panel-body">
        <!-- Отображение ошибок проверки ввода -->
        @include('common.errors')

    <!-- Форма нового ингредиента -->
        <form action="{{ url('ingredient') }}" method="POST" class="form-horizontal">
        {{ csrf_field() }}

        <!-- Имя ингредиента -->
            <div class="form-group">
                <label for="role" class="col-sm-3 control-label">Добавление ингредиента</label>
                <div class="col-sm-6">
                    <input type="text" name="name" id="ingredient-name" class="form-control" placeholder="Ингредиент">
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
    </div>

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
                    <th>Ингредиенты</th>
                    <th>&nbsp;</th>
                    </thead>

                    <!-- Тело таблицы -->
                    <tbody>
                    @foreach ($ingredients as $ingredient)
                        <tr>
                            <!-- Имя ингредиента -->
                            <td class="table-text">
                                <div>{{ $ingredient->name }}</div>
                            </td>
                            {{--<!-- Стоимость категории -->--}}
                            {{--<td class="table-text">--}}
                                {{--<div>{{ $ingredient->price->value }}</div>--}}
                            {{--</td>--}}
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
                                    <button type="submit">Изменить</button>
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