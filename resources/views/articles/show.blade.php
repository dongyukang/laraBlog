@extends('app')
@section('content')
<div class="container">
    <h1>{{$article->title}}</h1>
    {{$article->body}}

    {{--Only run if there are tags--}}
    @unless($article->tags->isEmpty())
        <h5>Tags: </h5>
        <ul>
            @foreach($article->tags as $tag)
                <li>{{$tag->name}}</li>
            @endforeach
        </ul>
    @endunless
</div>
@stop