@extends('adminViews/home')

@section('content')

    <head>
        <link href={{ asset('../../public/css/stylesHall.css') }} rel="stylesheet">
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    @if (Auth::user()->role->name == 'admin')
        <div class="container">
            @foreach($tables as $table)
                @if($table->isFree == 0 )
                    <a>
                        <div class="col-md-2 btn-success " style="height: 150px; margin: 10px; text-align: center;">
                            Admin Номер стола: {{$table->id}}
                        </div>
                    </a>
                @else
                    <a href='hall/table/{{$table->id}}'>
                        <div class="col-md-2 btn-danger" style="height: 150px; margin: 10px; text-align: center;">
                            Admin Номер стола: {{$table->id}}
                        </div>
                    </a>
                @endif
            @endforeach
            @elseif(Auth::user()->role->name == 'waiter')
                <div class="container">
                    <div class="row">
                    </div>
                    @foreach($tables as $table)
                        <div id="tbl{{$table->id}}" class="col-md-2"
                             style="height: 150px; margin: 10px; text-align: center;">
                            <a href='table/{{$table->id}}/new_order'>
                                Номер стола: {{$table->id}}
                            </a>
                        </div>
                    @endforeach
                    @endif
                </div>
        </div>
        <script>
            function getIsFree() {
                var url = '{{url('/waiter/hall/ajax')}}'
                $.getJSON(url, {}, function (data) {
                    console.log(data);
                    for (let key in data) {
                        $('#tbl' + key).addClass(!data[key] ? 'col-md-2 btn-success' : 'col-md-2 btn-danger')
                    }
                });
                setTimeout(getIsFree, 5000)
            }

            getIsFree();
        </script>
@endsection