<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
          integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
            integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
            crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title>Making order</title>

    <!-- Fonts -->

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }

        .btn-block{
            width: 200px;
        }
    </style>
</head>
<body>
<div class="container">

    <form class="form-order" method="get" action="{{url ('/home')}}">
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
        <button class="btn btn-lg btn-primary btn-block"  type="submit">Назад</button>
    </form>

</div> <!-- /container -->
</body>
</html>
