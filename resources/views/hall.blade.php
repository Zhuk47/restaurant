@extends('adminViews/home')

@section('content')

    <head>
        <link href={{ asset('../../public/css/stylesHall.css') }} rel="stylesheet">
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    @if (Auth::user()->role->name == 'admin')
        <div class="container">
            <div class="row">
            </div>
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
                        @if($table->isFree == 0 )
                            <a href='table/{{$table->id}}'>
                                <div class="col-md-2 btn-success "
                                     style="height: 150px; margin: 10px; text-align: center;">
                                    Номер стола: {{$table->id}}
                                </div>
                            </a>
                        @else
                            <a href='table/{{$table->id}}'>
                                <div class="col-md-2 btn-danger"
                                     style="height: 150px; margin: 10px; text-align: center;">
                                    Номер стола: {{$table->id}}
                                </div>
                            </a>
                        @endif
                    @endforeach
                    @endif
                </div>

@endsection