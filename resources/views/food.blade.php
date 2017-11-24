@extends('welcome')

@section('content')

    <div class="panel-body">
        <!-- Отображение ошибок проверки ввода -->
        @include('common.errors')

    <!-- Форма нового блюда -->
        <form action="{{ url('food') }}" method="POST" class="form-horizontal">
        {{ csrf_field() }}

        <!-- Данные блюда -->
            <div class="form-group">
                <label for="role" class="col-sm-3 control-label">Добавление блюда</label>
                <div class="col-sm-6">
                    <input type="text" name="name" id="food-name" class="form-control" placeholder="Название блюда">
                    <select name="category_id" id="category-id">
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <input type="text" name="price" id="food-price" class="form-control" placeholder="Стоимость блюда">
                </div>
            </div>
            <!-- Кнопка добавления блюда -->
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-plus"></i> Добавить
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Текущие блюда -->
    @if (count($foods) > 0)
        <div class="panel panel-default">
            <div class="panel-heading">
                <br>
            </div>

            <div class="panel-body">
                <table class="table table-striped task-table">

                    <!-- Заголовок таблицы -->
                    <thead>
                    <th>Блюда</th>
                    <th>&nbsp;</th>
                    </thead>

                    <!-- Тело таблицы -->
                    <tbody>
                    @foreach ($foods as $food)
                        <tr>
                            <!-- Имя блюда -->
                            <td class="table-text">
                                <div>{{ $food->name }}</div>
                            </td>
                            <!-- Категория блюда -->
                            <td class="table-text">
                                <div>{{ $food->category->name }}</div>
                            </td>
                            <!-- Стоимость блюда -->
                            <td class="table-text">
                                <div>{{ $food->price }}</div>
                            </td>
                            <!-- Кнопка Удалить -->
                            <td>
                                <form action="{{ url('food/'.$food->id) }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}

                                    <button type="submit" class="btn btn-danger">
                                        <i class="fa fa-trash"></i> Удалить
                                    </button>
                                </form>
                            </td>
                            <td>
                                <form action="{{ url('foodupd/'.$food->id) }}">
                                    <button type="submit">Изменить</button>
                                </form>
                            </td>
                            <td>
                                <form action="{{ url('food/'.$food->id.'/content') }}">
                                    <button type="submit">Состав</button>
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