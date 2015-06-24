@extends('app')
@section('content')
<div class="container">
    <h1>{{$article->title}}</h1>
    {{--Display the poster and the time posted--}}
    <i>Posted by {{ \App\Article::where('id', '=', $article->id)->first()->user->capitalName }} on {{$article->created_at->format('M d, Y')}}</i>
    {{--If user is an admin, provide a link to the edit page--}}
    @if(checkAdminOwner())
    <br><a href="{{$article->slug}}/edit">Edit Article</a> | <a href="#" onclick="confirmDelete()">Delete Article</a><br><br>
    {{--Only shown if user tries to delete article--}}
    <div id="warningBox" class="alert alert-danger" role="alert" hidden="true">
        <strong>Wait!</strong> Are you sure you want to delete this article? It can be restored later if needed.<br><br>
        {!! Form::open(['action' => ['ArticlesController@destroy', $article->slug], 'method' => 'DELETE']) !!}
        {!! Form::submit('Yes, delete this article',['id' => 'submitButton', 'class' => 'btn btn-large btn-danger form-control']) !!}
        {!!Form::close()!!}
    </div>

    @endif
    <hr>
    {!!$article->markdownBody!!}
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
        Also need an admin page to assign roles!
        TODO: Either finish the preview mode or delelte it entirely
    </p>

    {{--Only show comments page if logged in--}}
    @if(Auth::guest())
        @include('partials.commentform',['enableForm' => false])
    @else
        @include('partials.commentform',['enableForm' => true])
    @endif

    {{--Display Comments--}}
    <div class="col-sm-12"><br>
    @if($comments->isEmpty() == true)
        <i>Nobody has commented yet. Be the first!</i>
    @else
        @foreach($comments as $comment)
            <div class="well" id="comment{{$comment->id}}">
                <a href="#"></a>
                <b><a href="/users/{{$comment->user->name}}">{{$comment->user->capitalName}}</a>:</b> {{$comment->body}}
                @if(checkAdminOwner())
                    <a href="#"><p style="color: red">TODO: Delete Post</p></a>
                @endif
            </div>
        @endforeach
    @endif
    </div>


</div>
@stop

@section('footer')
    <script src="{{asset('components/scripts/articleShowPage.js')}}"></script>
@stop

