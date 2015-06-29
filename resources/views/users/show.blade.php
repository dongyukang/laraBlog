@extends('app')

@section('header')
    <link rel="stylesheet" href="{{asset('components/select2/css/select2.min.css')}}" />
@stop

@section('content')
    <div class="container">
        <h1>{{$user->CapitalName}}</h1>
        @if(checkUserRole($user->id,'owner'))
            <strong>Owner</strong>
        @elseif(checkUserRole($user->id,'admin'))
            <strong>Admin</strong>
        @elseif(checkUserRole($user->id,'banned'))
            <strong style="color: red">BANNED</strong>
        @endif
        <hr>
        {{--Do not show admin/owner controls on your own profile page--}}
        @if(checkSameUser($user->id) == false)
            {{--Show owner controls if needed--}}
            @if(checkSingleRole('owner'))
                <div class="row">
                    <div class="col-sm-10">
                        <ul class="list-group">
                            <li class="list-group-item active">Owner Actions</li>
                            <li class="list-group-item">
                                {{--Allow user to be promoted or demoted--}}
                                @if(checkUserRole($user->id,'owner') == true)
                                    <i>This user is already an owner. You may not promote/demote them.</i>
                                @elseif(checkUserRole($user->id,'admin') == false)
                                    As an owner, you can promote this user to grant them Admin status. This will allow them to post, edit, and delete articles.
                                    Admins are also able to ban and unban regular users. Be careful!<br><br>

                                    {!! Form::model($user, ['action' => ['UsersController@promoteUser', $user->name], 'method' => 'PATCH', 'class' => 'form-inline']) !!}
                                    {!! Form::label('confirmBox','Confirm:')!!}
                                    {!! Form::checkbox('confirm',null, false, ['onchange' => '$("#adminButton").toggleClass("disabled")']) !!} <br><br>
                                    {!! Form::submit('Promote User',['id' => 'adminButton', 'class' => 'btn btn-danger  disabled form-control']) !!}
                                    {!! Form::close() !!}
                                @else
                                    {{--User is an admin, allow them to be demoted--}}
                                    <strong>This user is currently an admin</strong><br>

                                    As an owner, you can demote this user to remote admin status. This will not delete any of their posts. <br><br>

                                    {!! Form::model($user, ['action' => ['UsersController@demoteUser', $user->name], 'method' => 'PATCH', 'class' => 'form-inline']) !!}
                                    {!! Form::label('confirmBox','Confirm:')!!}
                                    {!! Form::checkbox('confirm',null, false, ['onchange' => '$("#adminButton").toggleClass("disabled")']) !!} <br><br>
                                    {!! Form::submit('Demote User',['id' => 'adminButton', 'class' => 'btn btn-danger  disabled form-control']) !!}
                                    {!! Form::close() !!}
                                @endif
                            </li>
                        </ul>
                    </div>

                </div>
            @endif

            {{--Show admin controls if needed--}}
            @if(checkAdminOwner())
                <div class="row">
                    <div class="col-sm-10">
                        <ul class="list-group">
                            <li class="list-group-item active">Admin Actions</li>
                            <li class="list-group-item">
                                {{--Allow user to be banned or unbanned if they are not an owner--}}
                                @if(checkUserRole($user->id,'owner') == true && checkSingleRole('admin') == true)
                                    <i>As an admin, you can not ban an owner</i>
                                @elseif(checkUserRole($user->id,'banned') == false)

                                    As an admin, you can ban this user. This will hide all of their comments and prevent them from posting in the future. <br>
                                    You can ban this user by checking the box below and pressing the ban button. Be careful!<br><br>

                                    {!! Form::model($user, ['action' => ['UsersController@banUser', $user->name], 'method' => 'PATCH', 'class' => 'form-inline']) !!}
                                    {!! Form::label('confirmBox','Confirm:')!!}
                                    {!! Form::checkbox('confirm',null, false, ['onchange' => '$("#banButton").toggleClass("disabled")']) !!} <br><br>
                                    {!! Form::submit('Ban User',['id' => 'banButton', 'class' => 'btn btn-danger  disabled form-control']) !!}
                                    {!! Form::close() !!}
                                @else
                                    {{--User is banned, allow them to be unbanned--}}
                                    <strong>This user has been banned</strong><br>

                                    As an admin, you can unban this user. This will restore all of their past comments and allow them to post again.
                                    You can unban this user by checking the box below and pressing the ban button. Be careful!<br><br>

                                    {!! Form::model($user, ['action' => ['UsersController@unbanUser', $user->name], 'method' => 'PATCH', 'class' => 'form-inline']) !!}
                                    {!! Form::label('confirmBox','Confirm:')!!}
                                    {!! Form::checkbox('confirm',null, false, ['onchange' => '$("#banButton").toggleClass("disabled")']) !!} <br><br>
                                    {!! Form::submit('Unban User',['id' => 'banButton', 'class' => 'btn btn-danger  disabled form-control']) !!}
                                    {!! Form::close() !!}
                                @endif
                            </li>
                        </ul>
                    </div>

                </div>
            @endif
        @endif





        {{--Show about me--}}
        <div class="row">
            <div class="col-sm-10">
                <ul class="list-group">
                    <li class="list-group-item active">About me</li>
                        <li class="list-group-item">
                           {{$user->about}}
                            {{--Allow user to edit their bio if they want--}}<br>
                            @if(!Auth::guest())
                                @if(Auth::user()->name == $user->name)
                                    <a href="/users/{{$user->name}}/edit">Edit Your Bio</a>
                                @endif
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
        @elseif(checkUserRole($user->id,'banned'))
            <div class="row">
                <div class="col-sm-10">
                    <ul class="list-group">
                        <li class="list-group-item active">Recent Comments</li>
                        <li class="list-group-item"><i>This user was banned, and thier comments have been removed</i></li>
                    </ul>
                </div>

            </div>
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
