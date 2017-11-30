@extends('welcome')

@section('content')

    <div class="panel-body">
        <!-- Отображение ошибок проверки ввода -->
        @include('common.errors')

    <!-- Форма изменения ингредиента -->
        <form action="{{ url('ingredientupd/'.$ingredient->id) }}" method="POST" class="form-horizontal">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}
            <h5>Изменить ингредиент</h5>
        <!-- Имя ингредиента -->
            <div class="form-group">
                <div class="col-sm-6">
                    <input type="text" name="name" id="ingredient-name" class="form-control" placeholder="{{$ingredient->name}}">
                </div>
                <div class="col-sm-6">
                    <input type="text" name="price" id="ingredient-price" class="form-control" placeholder="{{$ingredient->prices->sortByDesc('dateTime')->first()->price}}">
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