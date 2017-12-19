@extends('adminViews.home')

@section('content')
    <div class="container">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Статьи</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('articles.create') }}"> Создать новую статью</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="container">
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Название</th>
            <th>Текст</th>
            <th width="280px"></th>
        </tr>
        @foreach ($articles as $article)
            <tr>
                <td>{{ ++$i }}</td>
                <td style="word-break:break-all">{{ $article->title}}</td>
                <td style="word-break:break-all">{{ $article->text}}</td>
                <td>
                    <a class="btn btn-primary" href="{{ route('articles.edit',$article->id) }}">Изменить</a>
                    {!! Form::open(['method' => 'DELETE','route' => ['articles.destroy', $article->id],'style'=>'display:inline']) !!}
                    {!! Form::submit('Удалить', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
    </table>
    </div>

    {!! $articles->links() !!}
@endsection