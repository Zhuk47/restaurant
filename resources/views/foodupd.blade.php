@extends('adminViews/home')

@section('content')

    <div class="container">
        <!-- Отображение ошибок проверки ввода -->
    @include('common.errors')

    <!-- Форма изменения блюда -->
        <form action="{{ url('foodupd/'.$food->id) }}" method="POST" class="form-horizontal">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}
            <h5>Изменить блюдо</h5>
            <!-- Данные блюда -->
            <div class="form-group">
                <div class="col-sm-6">
                    <input type="text" name="name" id="food-name" class="form-control" placeholder="{{ $food->name }}">
                    <select name="category_id" id="category-id" class="form-control">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
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