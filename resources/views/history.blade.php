@extends('adminViews/home')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

@section('content')

    <div class="container">
        <!-- Отображение ошибок проверки ввода -->
        @include('common.errors')
    </div>

    @if (count($prices) > 0)
        <div class="container">
            <div class="panel-body">
                <table class="table table-striped task-table">
                    <caption><h4><b>{{$food->name}}</b></h4></caption>
                    <thead>
                    <th>Начало действия</th>
                    <th>Окончание действия</th>
                    <th>Стоимость ингредиентов</th>
                    <th>Стоимость</th>
                    </thead>
                    <!-- Тело таблицы -->
                    @foreach ($prices as $price)
                        <tr>
                            <td class="table-text">
                                {{ date('d-m-Y H:i', strtotime($price->created_at.' + 1 min')) }}
                            </td>
                            <td class="table-text">
                                @if($price->deleted_at)
                                    {{ date('d-m-Y H:i', strtotime($price->deleted_at)) }}
                                @elseif($price->deleted_at == null)
                                    Действующая стоимость
                                @endif
                            </td>
                            <td class="table-text">
                                {{ $price->netCost }}
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

    <div class="container">
        <form action="{{ url('/food/'.$food->id.'/history') }}" method="POST" class="form-horizontal">
            {{ csrf_field() }}
            <h5><b>Поиск цены по дате</b></h5>
            <div class="form-group">
                <div class="col-sm-6">
                    <input type="datetime-local" min="{{$min}}" name="date" id="date" class="form" placeholder="Дата и время">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-plus"></i> Поиск
                    </button>
                </div>
            </div>
        </form>
    </div>

    <div class="container">
        @if(Session::has('history_message'))
            <b>{{Session::get('history_message')}}</b>
        @endif
    </div>

@endsection