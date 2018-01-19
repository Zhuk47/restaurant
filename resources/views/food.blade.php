@extends('adminViews/home')

@section('content')

    <style>
        .layer {
            overflow: auto; /* Добавляем полосы прокрутки */
            width: 100%; /* Ширина блока */
            height: 500px; /* Высота блока */
        }
    </style>

    <div class="container">
        <!-- Отображение ошибок проверки ввода -->
    @include('common.errors')

    <!-- Форма нового блюда -->
        <form action="{{ url('food') }}" method="POST" class="form-horizontal">
        {{ csrf_field() }}
        <!-- Данные блюда -->
            <div class="form-group">
                <div class="col-md-6">
                    <input type="text" name="name" id="food-name" class="form-control" placeholder="Название блюда">
                    <select name="category_id" id="category-id" class="form-control">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    {{--<input type="text" name="price" id="food-price" class="form-control" placeholder="Стоимость блюда">--}}
                </div>
                <div class="col-md-5 pull-right">
                    {{--@if(Session::has('alert'))--}}
                        {{--<script type="text/javascript">--}}
                            {{--setTimeout(function () {--}}
                                {{--$('.alert').fadeOut('slow');--}}
                            {{--}, 2000);--}}
                        {{--</script>--}}
                        {{--<div class="alert alert-success">--}}
                            {{--{{ session()->get('alert') }}--}}
                        {{--</div>--}}
                    {{--@elseif(Session::has('delAlert'))--}}
                        {{--<script type="text/javascript">--}}
                            {{--setTimeout(function () {--}}
                                {{--$('.alert').fadeOut('slow');--}}
                            {{--}, 2000);--}}
                        {{--</script>--}}
                        {{--<div class="alert alert-danger">--}}
                            {{--{{ session()->get('delAlert') }}--}}
                        {{--</div>--}}
                    {{--@endif--}}
                </div>
                <button type="submit" class="btn btn-default">
                    <i class="fa fa-plus"></i> Добавить
                </button>
            </div>
        </form>
    </div>

    <!-- Текущие блюда -->
    @if (count($foods) > 0)
        <div class="container layer">
            <div class="panel-body">
                <table class="table table-striped task-table">
                    <!-- Заголовок таблицы -->
                    <thead class="head">
                    <th>ID</th>
                    <th>Блюдо</th>
                    <th>Категория</th>
                    <th>Выход, г.</th>
                    <th>Себестоимость</th>
                    <th>Стоимость</th>
                    </thead>
                    <!-- Тело таблицы -->
                    <tbody>
                    @foreach ($foods as $food)
                        <tr>
                            <!-- ID блюда -->
                            <td class="table-text">
                                <div>{{ $food->id }}</div>
                            </td>
                            <!-- Имя блюда -->
                            <td class="table-text">
                                <div>{{ $food->name }}</div>
                            </td>
                            <!-- Категория блюда -->
                            <td class="table-text">
                                <div>{{ $food->category->name }}</div>
                            </td>
                            <!-- Выход блюда в г. -->
                            <td class="table-text">
                                <div>{{ $food->mass }}</div>
                            </td>
                        @foreach($food->foodPrice as $price)
                            <!-- Себестоимость блюда -->
                                <td class="table-text">
                                    <div>{{ $price->netCost }}</div>
                                </td>
                                <!-- Стоимость блюда -->
                                <td class="table-text">
                                    <div>{{ $price->price }}</div>
                                </td>
                            @endforeach
                            <td>
                                <form action="{{ url('food/'.$food->id.'/content') }}">
                                    <button type="submit" class="btn btn-default">Состав</button>
                                </form>
                            </td>
                            <td>
                                <form action="{{ url('foodupd/'.$food->id) }}">
                                    <button type="submit" class="btn btn-default">Изменить</button>
                                </form>
                            </td>
                            <td>
                                <form action="{{ url('food/'.$food->id.'/history') }}">
                                    <button type="submit" class="btn btn-default">История</button>
                                </form>
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
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
@endsection