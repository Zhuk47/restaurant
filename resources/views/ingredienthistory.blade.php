@extends('adminViews/home')

@section('content')

    <div class="container">
        <!-- Отображение ошибок проверки ввода -->
    @include('common.errors')
    </div>

    @if (count($prices) > 0)
        <div class="container">
            <div class="panel-body">
                <table class="table table-striped task-table">
                    <!-- Заголовок таблицы -->
                    <thead>
                    <th>Начало действия</th>
                    <th>Окончание действия</th>
                    <th>Стоимость ингредиента за 100 г.</th>
                    </thead>
                    <!-- Тело таблицы -->
                    @foreach ($prices as $price)
                        <tr>
                            <td class="table-text">
                                {{ $price->created_at }}
                            </td>
                            <td class="table-text">
                                {{ $price->deleted_at }}
                            </td>
                            <td class="table-text">
                                {{ $price->price }}
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    @endif
@endsection