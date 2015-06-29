@extends('app')

@section('header')
    <link rel="stylesheet" href="{{asset('components/select2/css/select2.min.css')}}" />
@stop

@section('content')
    <div class="container">
        <h1>Edit Bio</h1>
        @include('errors.list')
        {!! Form::model($user, ['action' => ['UsersController@update', $user->name], 'method' => 'PATCH']) !!}

        {!! Form::label('about','About Me:')!!}
        {!! Form::textarea('about',null,['class' => 'form-control', 'placeholder' => 'Enter a unique bio here'])!!}
        <br><br>
        {!! Form::submit('Update Bio',['class' => 'btn btn-primary form-control']) !!}

        {!!Form::close()!!}
        <br><br>
   </div>
@stop
