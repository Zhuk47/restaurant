@extends('adminViews/home')

@section('content')

    <div class="container">
        <!-- Отображение ошибок проверки ввода -->
    @include('common.errors')

    <!-- Форма изменения категории -->
        <form action="{{ url('categoryupd/'.$category->id) }}" method="POST" class="form-horizontal">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}
            <h5>Изменить категорию</h5>
            <!-- Имя категории -->
            <div class="form-group">
                <div class="col-sm-6">
                    <input type="text" name="name" id="category-name" class="form-control"
                           placeholder="{{ $category->name }}">
                </div>
                <button type="submit" class="btn btn-default">
                    <i class="fa fa-plus"></i> Изменить
                </button>
            </div>
        </form>
    </div>

@endsection