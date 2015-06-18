@extends('app')
@section('content')
<div class="container">

{!! Form::open(['action' => 'ArticlesController@store', 'method' => 'POST']) !!}
@include('errors.list')
@include('partials.form')
{!! Form::close() !!}

</div>
@stop