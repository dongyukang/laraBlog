@extends('app')
@section('content')
<div class="container">

{!! Form::open(['action' => 'ArticlesController@store', 'method' => 'POST']) !!}
@include('errors.list')
@include('partials.form',['defaultSlug' => false, 'submitText' => 'Post Article'])
{!! Form::close() !!}

</div>
@stop