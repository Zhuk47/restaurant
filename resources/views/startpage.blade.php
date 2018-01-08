<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Restaurant</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css"
          integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            height: 100%;
            width: auto;
            margin: 0 auto;
        }

        .row {
            height: 100%;
            margin: 0 auto;
        }

        .col-md-9 {
            border: 1px solid;
            background-image: url('http://st.depositphotos.com/1798837/3766/v/950/depositphotos_37663153-Retro-vintage-restaurant-menu.-Set-of-Calligraphic-titles-and-symbols-for-restaurant..jpg');
        }

        .col-md-3 {
            border: 1px solid;
            overflow: scroll;
            word-break: break-all;
        }

        .login {
            margin-top: 5%;
            margin-left: 85%;
        }


    </style>
    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif
</head>
<body>

<div class="row">
    <div class="col-md-9">
        <input class="btn btn-light login" type="button" value="Вход"
               onclick="javascript:window.location='{{ url('/home') }}'">
        <input class="btn btn-light login" type="button" value="Подписка"
               onclick="javascript:window.location='{{ route('clientreg') }}'">
        <input class="btn btn-light login" type="button" value="Меню"
               onclick="javascript:window.location='{{ route('menu') }}'">
    </div>

    <div class="col-md-3 bordered">

        @foreach($articles as $article)
            <h4>{{$article->title}}</h4>
            <p>{{$article->text}}</p>
            <p>{{$article->updated_at}}</p>
        @endforeach

    </div>

</div>
</body>
</html>