<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
      integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

@extends('adminViews/home')

@section('content')
    <div class="container">

        <form class="form-order" method="get" action="{{url ('/')}}">
            <h2 class="form-order-heading">Управление базой сотрудников</h2>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>ФИО</th>
                    <th>Должность</th>
                    <th>Просмотр информации</th>
                    <th>Удалить</th>
                </tr>
                </thead>
                <tbody>
                @foreach(\App\User::all() as $user)
                    <tr>
                        <td>{{ $user->surname }} {{$user->name}} {{$user->midname}}</td>
                        @if($user->role_id == 1)
                            <td>Администратор</td>
                        @elseif($user->role_id == 2)
                            <td>Оффициант</td>
                        @elseif($user->role_id == 3)
                            <td>Повар</td>
                        @endif

                        <td>
                            <a href="info/{{$user->id}}" class="btn btn-warning">
                                <i class="glyphicon glyphicon-eye-open"></i>
                            </a>
                        </td>

                        <td>
                            <a href="/delete/{{$user->id}}" class="btn btn-warning">
                                <i class="glyphicon glyphicon-trash"></i>
                            </a>

                        </td>

                    </tr>
                @endforeach
                <br><br>
                </tbody>
            </table>
            <button onclick="goBack()" class="btn btn-lg btn-primary btn-block">
                Назад
            </button>
            <script>
                function goBack() {
                    window.history.back();
                }
            </script>
        </form>

    </div>

@endsection