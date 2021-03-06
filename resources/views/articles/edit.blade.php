@extends('app')
@section('content')
<div class="container">
<h1>Edit Article</h1><hr>
{!! Form::model($article, ['action' => ['ArticlesController@update', $article->slug], 'method' => 'PATCH']) !!}
@include('errors.list')
@include('partials.form', ['defaultSlug' => true, 'submitText' => 'Update Article'])
{!! Form::close() !!}

</div>
@stop