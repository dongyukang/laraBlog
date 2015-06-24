@extends('app')

@section('header')
    <link rel="stylesheet" href="{{asset('components/select2/css/select2.min.css')}}" />
@stop

@section('content')
    <div class="container">
        <h1>{{$user->CapitalName}}</h1>
        @if(checkUserRole($user->id,'Admin'))
            <b>Admin</b>
        @endif
        <hr>

        {{--Show about me--}}
        <div class="row">
            <div class="col-sm-10">
                <ul class="list-group">
                    <li class="list-group-item active">About me</li>
                        <li class="list-group-item">
                           {{$user->about}}
                            {{--Allow user to edit their bio if they want--}}<br>
                            @if(Auth::user()->name == $user->name)
                                <a href="/users/{{$user->name}}/edit">Edit Your Bio</a>
                            @endif
                        </li>
                </ul>
            </div>

        </div>
        {{--Show articles if any--}}
        @if($user->articles->isEmpty() == false)
            <div class="row">
                <div class="col-sm-10">
                    <ul class="list-group">
                        <li class="list-group-item active">Recent Articles</li>
                        @foreach($user->articles()->latest()->take(20)->get() as $article)
                            <li class="list-group-item">
                                <a href="/articles/{{$article->slug}}"> {{$article->title}} </a> <br>
                                {{$article->created_at->diffForHumans()}}
                            </li>
                        @endforeach
                    </ul>
                </div>

            </div>
        @endif

        {{--Show users comment history--}}
        @if($user->comments->isEmpty())
            <i>No comments</i>
        @else
            <div class="row">
                <div class="col-sm-10">
                    <ul class="list-group">
                        <li class="list-group-item active">Recent Comments</li>
                        @foreach($user->comments()->latest()->take(20)->get() as $comment)
                            <li class="list-group-item">
                                {{$comment->body}} <br>
                               Posted on <a href="/articles/{{$comment->article->slug}}#comment{{$comment->id}}"> {{$comment->article->title}} </a>
                                {{$comment->created_at->diffForHumans()}}
                            </li>
                        @endforeach
                    </ul>
                </div>

            </div>
        @endif
   </div>
@stop
