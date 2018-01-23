@extends('adminViews/home')

@section('content')

    <head>
        <link href={{ asset('../../public/css/stylesHall.css') }} rel="stylesheet">
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="{{ asset('js/app.js') }}"></script>
    </head>
    @if (Auth::user()->role->name == 'admin')
        <div class="container">
            <div class="row">
            </div>
            @foreach($tables as $table)
                <a href='hall/table/{{$table->id}}'>
                    <div id="admintbl{{$table->id}}" class="col-md-2"
                         style="height: 150px; margin: 10px; text-align: center;">
                        Номер стола: {{$table->id}}
                    </div>
                </a>
            @endforeach
        </div>
        <script>
            function getIsFreeAdm() {
                var url = '{{url('/hall/ajax')}}';
                $.getJSON(url, {}, function (data) {
                    console.log(data);
                    for (let key in data) {
                        $('#admintbl' + key).removeClass();
                        $('#admintbl' + key).addClass(!data[key] ? 'col-md-2 btn-success' : 'col-md-2 btn-danger')
                    }
                });
                setTimeout(getIsFreeAdm, 5000)
            }
            getIsFreeAdm();
        </script>
    @elseif(Auth::user()->role->name == 'waiter')
        <div class="container">
            <div class="row">
            </div>
            @foreach($tables as $table)
                <a href='table/{{$table->id}}/new_order'>
                    <div id="tbl{{$table->id}}" class="col-md-2" style="height: 150px; margin: 10px; text-align: center;">
                        Номер стола: {{$table->id}}
                    </div>
                </a>
            @endforeach
        </div>
        <script>
            function getIsFree() {
                var url = '{{url('/waiter/hall/ajax')}}';
                $.getJSON(url, {}, function (data) {
                    console.log(data);
                    for (let key in data) {
                        $('#tbl' + key).removeClass();
                        $('#tbl' + key).addClass(!data[key] ? 'col-md-2 btn-success' : 'col-md-2 btn-danger')
                    }
                });
                setTimeout(getIsFree, 5000)
            }
            getIsFree();
        </script>
    @endif

@endsection