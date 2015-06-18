@extends('app')
@section('content')
<div class="container">

{!! Form::open(['action' => 'ArticlesController@store', 'method' => 'POST']) !!}
@include('partials.form')
{!! Form::close() !!}
@include('errors.list')
</div>
@stop