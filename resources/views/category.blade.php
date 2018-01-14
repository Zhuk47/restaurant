@extends('adminViews/home')

@section('content')

    <style>
        .layer {
            overflow: auto; /* Добавляем полосы прокрутки */
            width: 90%; /* Ширина блока */
            height: 500px; /* Высота блока */
        }
    </style>

    <div class="container">
        <!-- Отображение ошибок проверки ввода -->
    @include('common.errors')

    <!-- Форма новой категории -->
        <form action="{{ url('category') }}" method="POST" class="form-horizontal">
            {{ csrf_field() }}

            <h5>Добавление категории</h5>
            <!-- Имя категории -->
            <div class="form-group">
                <div class="col-sm-6">
                    <input type="text" name="name" id="category-name" class="form-control"
                           placeholder="Категория">
                </div>
                <button type="submit" class="btn btn-default">
                    <i class="fa fa-plus"></i>Добавить
                </button>
            </div>
        </form>
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
    </div>
    <!-- Текущие категории -->
    @if (count($categories) > 0)
        <div class="container layer">
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
                            <td>
                                <form action="{{ url('categoryupd/'.$category->id) }}">
                                    <button type="submit" class="btn btn-default">Изменить</button>
                                </form>
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
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    @endif
@endsection