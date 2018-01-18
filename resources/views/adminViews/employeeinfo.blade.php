@extends('adminViews/home')

@section('content')

    <div class="container">

        <form class="form-order" method="get" action="{{url('/base-employee')}}">
            <h2 class="form-order-heading">Управление базой сотрудников</h2>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>ФИО</th>
                    <th>Должность</th>
                    <th>Дата рождения</th>
                    <th>Адрес электронной почты</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>{{ \App\User::find($id)->surname }} {{\App\User::find($id)->name}} {{\App\User::find($id)->midname}}</td>
                    @if(\App\User::find($id)->role_id == 1)
                        <td>Администратор</td>
                    @elseif(\App\User::find($id)->role_id == 2)
                        <td>Оффициант</td>
                    @elseif(\App\User::find($id)->role_id == 3)
                        <td>Повар</td>
                    @endif
                    <td>{{\App\User::find($id)->dateBirth}}</td>
                    <td>{{\App\User::find($id)->email}}</td>
                </tr>
                <br><br>
                </tbody>
            </table>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Назад</button>
        </form>

    </div>
@endsection