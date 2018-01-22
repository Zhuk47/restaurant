<!DOCTYPE html>

<html lang="{{ app()->getLocale() }}">
<head>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body>

<div id="app">

    <nav class="navbar navbar-default navbar-static-top">

        <div class="container">

            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#app-navbar-collapse" aria-expanded="false">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="/">
                    {{ config('app.name') }}
                </a>
                <ul class="nav navbar-nav">
                    @if(!Auth::user())
                        <li><a>Login</a></li>
                    @elseif (Auth::user()->role->name == 'admin')
                        <li class="dropdown">
                            <a class="btn dropdown-toggle" data-toggle="dropdown">
                                Сотрудники
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="{{ url('/register-new-employee') }}">Регистрация</a></li>
                                <li><a href="{{ url('/base-employee') }}">Обзор</a></li>
                                <li><a href="{{ url('/work-time') }}">На работе</a></li>
                                <li><a href="{{ url('/work-history') }}">История прихода на работу</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a class="btn dropdown-toggle" data-toggle="dropdown">
                                Управление меню
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="{{ url('/ingredient') }}">Ингредиенты</a></li>
                                <li><a href="{{ url('/food') }}">Блюда</a></li>
                                <li><a href="{{ url('/category') }}">Категории</a></li>
                            </ul>
                        </li>
                        <li><a href="{{ url('/tables') }}">Столы</a></li>
                        <li><a href="{{ url('/hall') }}">Зал</a></li>
                        <li><a href="{{ url('/articles') }}">Новости</a></li>
                    @elseif(Auth::user()->role->name == 'waiter')
                        <li><a href="/waiter/hall" class="btn btn-outline-dark">Зал</a></li>
                    @elseif(Auth::user()->role->name == 'cook')
                        <li><a href="/cookboard" class="btn btn-outline-dark">ПоварZONE</a></li>
                    @endif
                </ul>

            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    &nbsp;
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @guest
                    <li><a href="{{ route('login') }}">Login</a></li>
                    <li><a href="{{ route('register') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-expanded="false" aria-haspopup="true">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu">
                                <li>
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                          style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                        @endguest
                </ul>
            </div>
        </div>
    </nav>
    @if(Session::has('message'))
        <script type="text/javascript">
            setTimeout(function () {
                $('#successMessage').fadeOut('fast');
            }, 2000); // <-- time in milliseconds
        </script>
        <div style="text-align: center" id="successMessage" class="alert alert-success">
            Новый сотрудник успешно зарегистрирован!
        </div>
    @endif
</div>

@yield('content')

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
</body>

</html>
