@extends('app')
@section('content')
<div class="container">
<h1>Create new Article</h1><hr>
{!! Form::open(['action' => 'ArticlesController@store', 'method' => 'POST']) !!}
@include('errors.list')
@include('partials.form',['defaultSlug' => false, 'submitText' => 'Post Article'])
{!! Form::close() !!}
<a href="/previewArticle">Preview Article...</a>
</div>
@stop