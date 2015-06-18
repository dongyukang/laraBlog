@extends('app')
@section('content')
<div class="container">
    <h1>Articles Index Page</h1>
    @foreach($articles as $article)
    <li>
        {{$article->title}} (slug is: {{$article->slug}})
    </li>
    @endforeach
</div>
@stop