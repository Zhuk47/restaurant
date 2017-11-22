@extends('welcome')

@section('content')

    <div class="panel-body">
        <!-- Отображение ошибок проверки ввода -->
        @include('common.errors')

    <!-- Форма изменения категории -->
        <form action="{{ url('categoryupd/'.$category->id) }}" method="POST" class="form-horizontal">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}

        <!-- Имя категории -->
            <div class="form-group">
                <label for="role" class="col-sm-3 control-label">Изменить категорию</label>
                <div class="col-sm-6">
                    <input type="text" name="name" id="category-name" class="form-control" placeholder="{{ $category->name }}">
                </div>
            </div>
            <!-- Кнопка добавления задачи -->
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-plus"></i> Изменить
                    </button>
                </div>
            </div>
        </form>
    </div>

@endsection