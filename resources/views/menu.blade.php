@extends('adminViews.home')


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
        <center><h1>Меню</h1></center>
        @foreach($categories as $category)
            <center>
                <table>
                    <tr id="category">
                        <td colspan="3">
                            <center><h4>{{ $category->name }}</h4></center>
                        </td>
                    </tr>
                    @foreach($category->foods as $food)
                        @foreach($food->foodPrice as $price)
                            <tr>
                                <td width="500"><b>{{ $food->name }}</b></td>
                                <td width="100">/{{ $food->mass }} г./</td>
                                <td width="100">{{ $price->price }} грн.</td>
                            </tr>
                            <tr id="ingredients">
                                <td colspan="3">(
                                    @foreach($food->ingredients as $ingredient)
                                        | {{$ingredient->name}} |
                                    @endforeach
                                )</td>
                            </tr>
                        @endforeach
                    @endforeach
                    @endforeach
                </table>
            </center>
    </div>

@endsection