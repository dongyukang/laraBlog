@extends('app')
@section('content')
<div class="container">
    <h1>{{$article->title}}</h1>
    {{--Display the poster and the time difference--}}
    <i>Posted by {{ \App\Article::where('id', '=', $article->id)->first()->user->name }} on {{$article->created_at->format('M d, Y')}}</i><br/><br/>


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
    <br><br><br>
    <p style="color: red">
        TODO: Add comments section & roles to allow posting
    </p>

</div>
@stop