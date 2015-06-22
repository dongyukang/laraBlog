@extends('app')
@section('content')
<div class="container">
    <h1>{{$article->title}}</h1>
    {{--Display the poster and the time posted--}}
    <i>Posted by {{ \App\Article::where('id', '=', $article->id)->first()->user->name }} on {{$article->created_at->format('M d, Y')}}</i>
    {{--If user is an admin, provide a link to the edit page--}}
    @if(checkAdminOwner())
    <br><a href="{{$article->slug}}/edit">Edit Article</a>
    @endif
    <hr>
    {{--TODO: Truncate articles with Str::words() but dont truncate in between markdown tags--}}
    {!!Markdown::parse($article->body)!!}

    {{--Only run if there are tags--}}
    @unless($article->tags->isEmpty())
        <h5>Tags:<i>

            @foreach($article->tags as $tag)
                {{$tag->name}}
            @endforeach
        </i></h5>
    @endunless
    <br><br><br>
    <p style="color: red">
        TODO: Make this form not ugly.
        Add banning (maybe), add draft-mode for articles (?)
        TODO IMPORTANT: On index page, you can cut off in between markdown which will leave the charactors not converted
        Also need an admin page to assign roles
    </p>

    {{--Only show comments page if logged in--}}
    @if(Auth::guest())
        @include('partials.commentform',['enableForm' => false])
    @else
        @include('partials.commentform',['enableForm' => true])
    @endif

    {{--Display Comments--}}
    <div class="col-sm-12"><br>
    @foreach($comments as $comment)
            <div class="well">
                <b>{{$comment->user->name}}:</b> {{$comment->body}}
                @if(checkAdminOwner())
                    <a href="#"><p style="color: red">TODO: Delete Post</p></a>
                @endif
            </div>
    @endforeach

    </div>


</div>
@stop