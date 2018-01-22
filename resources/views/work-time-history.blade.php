<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
      integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

@extends('adminViews/home')

@section('content')
    <div class="container">

        <form class="form-order" method="get" action="{{url ('/')}}">
            <h2 class="form-order-heading">История посещения работы сотрудниками</h2>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>ФИО</th>
                    <th>Должность</th>
                    <th>Пришел</th>
                    <th>Ушел</th>
                </tr>
                </thead>
                <tbody>
                @foreach(\App\Visit::all() as $user)
                    <tr>
                        <td>{{ $user->surname }} {{$user->name}} {{$user->midname}}</td>
                        @if($user->role_id == 1)
                            <td>Администратор</td>
                        @elseif($user->role_id == 2)
                            <td>Оффициант</td>
                        @elseif($user->role_id == 3)
                            <td>Повар</td>
                        @endif
                        <td>{{$user->entered}}</td>
                        <td>{{$user->goneaway}}</td>
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