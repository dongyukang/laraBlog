@extends('app')
@section('content')
<div class="container">
    <h1>{{$article->title}}</h1>
    {{--Display the poster and the time posted--}}
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
        TODO: Make this form not ugly.
        NOTE TO SELF: Use a nested resource to put comments under articles.
    </p>

    {{--Only show comments page if logged in--}}
    @if(Auth::guest())
        Not logged in bro
    @else
        @include('partials.commentform')
    @endif

    {{--Display Comments--}}
    <div class="col-sm-12"><br>
    @foreach($comments as $comment)
            <div class="well">
                <b>{{$comment->user->name}}:</b> {{$comment->body}}
            </div>
    @endforeach

    </div>


</div>
@stop