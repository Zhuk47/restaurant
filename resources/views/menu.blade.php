@extends('home')



@section('content')

    <div class="container">
        <!-- Отображение ошибок проверки ввода -->
        @include('common.errors')
    </div>

    <div class="container">
        <center><h1>Меню</h1></center>
        @foreach($categories as $category)
            <table>
                <tr id="category"><div><h3>{{ $category->name }}</h3></div></tr>
                @foreach($category->foods as $food)
                    @foreach($food->foodPrice as $price)
                        <div><b>{{ $food->name }}</b>
                        /{{ $food->mass }}г./ {{ $price->price }}грн.
                        @foreach($food->ingredients as $ingredient)
                            <tr id="ingredients">{{ $ingredient->name }} /</tr>
                        </div>
                        @endforeach
                    @endforeach
                @endforeach
                @endforeach
            </table>
    </div>

@endsection