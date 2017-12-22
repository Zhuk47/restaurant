<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.4/css/bootstrap.min.css"/>

<style>
    .form-width {
        max-width: 25rem;
    }

    .has-float-label {
        position: relative;
    }

    .has-float-label label {
        position: absolute;
        left: 0;
        top: 0;
        cursor: text;
        font-size: 75%;
        opacity: 1;
        -webkit-transition: all .2s;
        transition: all .2s;
        top: -.5em;
        left: 0.75rem;
        z-index: 3;
        line-height: 1;
        padding: 0 1px;
    }

    .has-float-label label::after {
        content: " ";
        display: block;
        position: absolute;
        background: white;
        height: 2px;
        top: 50%;
        left: -.2em;
        right: -.2em;
        z-index: -1;
    }

    .has-float-label .form-control::-webkit-input-placeholder {
        opacity: 1;
        -webkit-transition: all .2s;
        transition: all .2s;
    }

    .has-float-label .form-control:placeholder-shown:not(:focus)::-webkit-input-placeholder {
        opacity: 0;
    }

    .has-float-label .form-control:placeholder-shown:not(:focus) + label {
        font-size: 150%;
        opacity: .5;
        top: .3em;
    }

    .input-group .has-float-label {
        display: table-cell;
    }

    .input-group .has-float-label .form-control {
        border-radius: 0.25rem;
    }

    .input-group .has-float-label:not(:last-child) .form-control {
        border-bottom-right-radius: 0;
        border-top-right-radius: 0;
    }

    .input-group .has-float-label:not(:first-child) .form-control {
        border-bottom-left-radius: 0;
        border-top-left-radius: 0;
        margin-left: -1px;
    }
</style>

<div class="p-x-1 p-y-3">

        <form class="card card-block m-x-auto bg-faded form-width" action="{{ url('addclient') }}" method="POST" class="form-horizontal">
            {{ csrf_field() }}
            <legend class="m-b-1 text-xs-center">Регистрация</legend>
            <div class="form-group input-group">
 <span class="has-float-label">
 <input class="form-control" id="first" name="name" type="text" placeholder="Имя"/>
 <label for="first">Имя</label>
 </span>
                <span class="has-float-label">
 <input class="form-control" id="last" name="surname" type="text" placeholder="Фамилия"/>
 <label for="last">Фамилия</label>
 </span>
            </div>
            <div class="form-group input-group">
                <span class="input-group-addon">@</span>
                <span class="has-float-label">
 <input class="form-control" id="email" name="email" type="email" placeholder="name@example.com"/>
 <label for="email">E-mail</label>
 </span>
            </div>
            <div class="text-xs-center">
                <button class="btn btn-block btn-primary" type="submit">Регистрация</button>
            </div>
        </form>
</div>