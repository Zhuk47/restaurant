@extends('welcome')

@section('content')

    <div class="panel-body">
        <!-- Отображение ошибок проверки ввода -->
        @include('common.errors')

    <!-- Форма новой категории -->
        <form action="{{ url('category') }}" method="POST" class="form-horizontal">
        {{ csrf_field() }}

        <!-- Имя категории -->
            <div class="form-group">
                <label for="role" class="col-sm-3 control-label">Добавление категории</label>
                <div class="col-sm-6">
                    <input type="text" name="name" id="category-name" class="form-control" placeholder="Название категории">
                </div>
            </div>
            <!-- Кнопка добавления категории -->
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-plus"></i> Добавить
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Текущие категории -->
    @if (count($categories) > 0)
        <div class="panel panel-default">
            <div class="panel-heading">
                <br>
            </div>

            <div class="panel-body">
                <table class="table table-striped task-table">

                    <!-- Заголовок таблицы -->
                    <thead>
                    <th>Категории</th>
                    <th>&nbsp;</th>
                    </thead>

                    <!-- Тело таблицы -->
                    <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <!-- ID категории -->
                            <td class="table-text">
                                <div>{{ $category->id }}</div>
                            </td>
                            <!-- Имя категории -->
                            <td class="table-text">
                                <div>{{ $category->name }}</div>
                            </td>
                            <!-- Кнопка Удалить -->
                            <td>
                                <form action="{{ url('category/'.$category->id) }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}

                                    <button type="submit" class="btn btn-danger">
                                        <i class="fa fa-trash"></i> Удалить
                                    </button>
                                </form>
                            </td>
                            <td>
                                <form action="{{ url('categoryupd/'.$category->id) }}">
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