@extends('app')
@section('content')
<div class="container">
    <h1>Articles</h1><hr>

    @foreach($articles as $article)
    <h2> <a href="/articles/{{$article->slug}}"> {{$article->title}} </a></h2>

    {{--Only display the first 100 words of the article--}}
    {{--TODO: This can sometimes cut off mardown elements and must be resolved--}}
    {{--{!! Markdown::parse(Illuminate\Support\Str::words($article->body, 100)) !!}--}}
    {!!  strip_tags(Illuminate\Support\Str::words($article->markdownBody,100) ) !!}
    {{--Display the poster and the time difference--}}
    <br/><br/><i>Posted by {{ \App\Article::where('id', '=', $article->id)->first()->user->name }} {{Carbon\Carbon::parse($article->created_at)->diffForHumans()}}</i>

    {{--Display a link to the article--}}
    <br/><a href="/articles/{{$article->slug}}">Read full article</a>
    @endforeach
    <br/>

    {{--Display the next/prev page bar--}}
    {!! $articles->render() !!}
</div>
@stop

