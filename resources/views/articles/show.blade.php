@extends('app')
@section('content')
<div class="container">
    <h1>{{$article->title}}</h1>
    {{$article->body}}


</div>
@stop