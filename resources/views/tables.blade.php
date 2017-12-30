@extends('adminViews/home')

@section('content')

    <div class="container">
        <!-- Отображение ошибок проверки ввода -->
        @include('common.errors')

    <!-- Форма нового стола -->
        <form action="{{ url('tables') }}" method="POST" class="form-horizontal">
            {{ csrf_field() }}

            <h5>Добавление стола</h5>
            <!-- Серийный номер -->
            <div class="form-group">
                <div class="col-sm-6">
                    <input type="text" name="serial" id="table-serial" class="form-control"
                           placeholder="Серийный номер">
                </div>
                <button type="submit" class="btn btn-default">
                    <i class="fa fa-plus"></i>Добавить
                </button>
            </div>
        </form>
    </div>

    <!-- Текущие категории -->
    @if (count($tables) > 0)
        <div class="container">
            <div class="panel-body">
                <table class="table table-striped task-table">
                    <!-- Заголовок таблицы -->
                    <thead>
                    <th>ID</th>
                    <th>Серийный номер</th>
                    </thead>
                    <!-- Тело таблицы -->
                    @foreach ($tables as $table)
                        <tr>
                            <!-- ID -->
                            <td class="table-text">
                                {{ $table->id }}
                            </td>
                            <!-- Серийник -->
                            <td class="table-text">
                                {{ $table->serial }}
                            </td>
                            {{--<td>--}}
                                {{--<form action="{{ url('categoryupd/'.$category->id) }}">--}}
                                    {{--<button type="submit" class="btn btn-default">Изменить</button>--}}
                                {{--</form>--}}
                            {{--</td>--}}
                            <!-- Кнопка Удалить -->
                            <td>
                                <form action="{{ url('table/'.$table->id) }}" method="POST">
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
            </div>
        </div>
    @endif
@endsection