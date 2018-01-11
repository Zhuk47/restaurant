@extends('adminViews/home')
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
@section('content')

    <div class="container">

    echo "Echo";


    </div>
    <script>
        var url =  '{{ url('/home') }}';
        //var htmlOut = "";
        $.ajax({
            url: url,
            type: 'post',
            data: {"_method": 'POST', '_token':'{{ $csrf_token }}', 'foo':'bar'},
            success: function(response)
            {
                console.log(response);
                //htmlOut ="<p>"+response+"</p>";
                //document.write(htmlOut);
            }
        });
    </script>

@endsection