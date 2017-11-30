@extends('welcome')

@section('content')

    <div class="panel-body">
        <!-- Отображение ошибок проверки ввода -->
    @include('common.errors')

    <!-- Форма изменения категории -->
        <div>
            ID ингредиента: {{ $ingredient->id }}
        </div>
        <div>
            Ингредиент: {{ $ingredient->name }}
        </div>
        <form action="{{ url('/ingredient/'.$ingredient->id.'/price') }}" method="POST" class="form-horizontal">
            {{ csrf_field() }}
            <h6>Добавить стоимость ингредиента за 100 г.</h6>
            <!-- Имя категории -->
            <div class="form-group">
                <div class="col-sm-6">
                    <input type="text" name="price" id="ingredient-price" class="form-control"
                           placeholder="Стоимость за 100 г.">
                </div>
            </div>
            <!-- Кнопка добавления задачи -->
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-plus"></i> Добавить
                    </button>
                </div>
            </div>
        </form>
    </div>

@endsection