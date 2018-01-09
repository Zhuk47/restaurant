@extends('adminViews/home')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
{{--<script type="text/javascript" src="wickedpicker.js"></script>--}}

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

    <div class="container">
        <form action="{{ url('/ingredient/'.$ingredient->id.'/history') }}" method="POST" class="form-horizontal">
            {{ csrf_field() }}
            <h5>Поиск цены по дате</h5>
            <div class="form-group">
                <div class="col-sm-6">
                    <input type="text" name="date" id="date" class="form" placeholder="Дата">
                    <input type="text" name="time" id="time" class="time" placeholder="Время">
                </div>
                <button type="submit" class="btn btn-default">
                    <i class="fa fa-plus"></i> Поиск
                </button>
            </div>
        </form>
    </div>

    <script type="text/javascript">
        $(function () {
            $("#date").datepicker({
                changeMonth: true,
                changeYear: true,
                dateFormat: 'yy-mm-dd',
                monthNamesShort: ['Янв', 'Фев', 'Март', 'Апр', 'Май', 'Июнь',
                    'Июль', 'Авг', 'Сен', 'Окт', 'Ноя', 'Дек'],
                dayNamesMin: ['Вс', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб'],
                closeText: 'Закрыть',
                prevText: '&#x3c;Пред',
                nextText: 'След&#x3e;',
                currentText: 'Сегодня',
                yearRange: '2017:2018'
            });
            $("#format").change(function () {
                $("#date").datepicker("option", "dateFormat", $(this).val());
            });
        });
    </script>
    {{--<script type="text/javascript">--}}
        {{--$(function () {--}}
            {{--$("#time").wickedpicker({--}}
                {{--now: "12:35", //hh:mm 24 hour format only, defaults to current time--}}
                {{--twentyFour: true,  //Display 24 hour format, defaults to false--}}
                {{--upArrow: 'wickedpicker__controls__control-up',  //The up arrow class selector to use, for custom CSS--}}
                {{--downArrow: 'wickedpicker__controls__control-down', //The down arrow class selector to use, for custom CSS--}}
                {{--close: 'wickedpicker__close', //The close class selector to use, for custom CSS--}}
                {{--hoverState: 'hover-state', //The hover state class to use, for custom CSS--}}
                {{--title: 'Timepicker', //The Wickedpicker's title,--}}
                {{--showSeconds: false, //Whether or not to show seconds,--}}
                {{--timeSeparator: ' : ', // The string to put in between hours and minutes (and seconds)--}}
                {{--secondsInterval: 1, //Change interval for seconds, defaults to 1,--}}
                {{--minutesInterval: 1, //Change interval for minutes, defaults to 1--}}
                {{--beforeShow: null, //A function to be called before the Wickedpicker is shown--}}
                {{--afterShow: null, //A function to be called after the Wickedpicker is closed/hidden--}}
                {{--show: null, //A function to be called when the Wickedpicker is shown--}}
                {{--clearable: false //Make the picker's input clearable (has clickable "x")--}}
            {{--});--}}
        {{--});--}}
    {{--</script>--}}
@endsection