@extends('welcome')

@section('content')

    <div class="panel-body">
        <!-- Отображение ошибок проверки ввода -->
    @include('common.errors')

    <!-- Форма новой категории -->
        <form action="{{ url('category') }}" method="POST" class="form-horizontal">
            {{ csrf_field() }}

            <h5>Добавление категории</h5>
            <!-- Имя категории -->
            <div class="form-group">
                <label for="role" class="col-sm-3 control-label"></label>
                <div class="col-sm-6">
                    <input type="text" name="name" id="category-name" class="form-control"
                           placeholder="категория">
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
            <div class="panel-body">
                <table class="table table-striped task-table">
                    <!-- Заголовок таблицы -->
                    <thead>
                    <th>ID</th>
                    <th>Категория</th>
                    </thead>
                    <!-- Тело таблицы -->
                    @foreach ($categories as $category)
                        <tr>
                            <!-- ID категории -->
                            <td class="table-text">
                                {{ $category->id }}
                            </td>
                            <!-- Имя категории -->
                            <td class="table-text">
                                {{ $category->name }}
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
                                    <button type="submit" class="btn btn-default">Изменить</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    @endif
@endsection