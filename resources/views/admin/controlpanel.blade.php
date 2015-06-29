@extends('app')

@section('header')
    <link rel="stylesheet" href="{{asset('components/select2/css/select2.min.css')}}" />
    <link rel="stylesheet" href="{{asset('components/css/adminstyles.css')}}" />
@stop

@section('content')
<div class="container">
    <h1>Admin Page</h1>
    @if(checkSingleRole('Owner') == true)
    Permission Level: <b>Owner</b>
    @elseif(checkSingleRole('Admin') == true)
    Permission Level: <b>Admin</b>
    @endif
    <hr>
    {{--List of articles which have been deleted--}}
    <div class="well">
        <h2>Restore Deleted Articles</h2>Any deleted articles can be restored here. To delete an existing article, visit that article's page.<hr>
        @if($deletedArticlesList->isEmpty())
        <i>No deleted articles</i>
        @else
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Article Title</th>
                    <th>Article Slug</th>
                    <th>Deleted On</th>
                    <th>Restore Article</th>
                </tr>
                </thead>
                <tbody>
                @foreach($deletedArticlesList as $article)
                    <tr>
                        <td>{{$article->title}}</td>
                        <td>{{$article->slug}}</td>
                        <td>{{$article->deleted_at->format('M d, Y')}}</td>
                        <td>
                            {{--Form to restore the article--}}
                            {!! Form::open(['action' => ['ArticlesController@restoreArticle', $article->slug], 'method' => 'PATCH']) !!}
                            {!! Form::submit('Restore',['class' => 'btn btn-warning form-control']) !!}
                            {!!Form::close()!!}

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>



        @endif


    </div>

    {{--List of users which have been banned--}}
    <div class="well">
        <h2>Banned Users</h2>Any users who have been banned are  listed here. To ban a user or see their posting history, visit that users profile page.<hr>
        @if($bannedUsersList->isEmpty())
            <i>No banned users</i>
        @else
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Member Since</th>
                    <th>User Page</th>
                    <th>Unban User</th>
                </tr>
                </thead>
                <tbody>
                @foreach($bannedUsersList as $user)
                    <tr>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->created_at->format('M d, Y')}}</td>
                        <td><a href="/users/{{$user->name}}">Visit page</a></td>
                        <td>
                            {{--Form to unban the user--}}

                            {!! Form::open(['action' => ['UsersController@unbanUser', $user->name], 'method' => 'PATCH']) !!}
                            {!! Form::submit('Unban User',['class' => 'btn btn-warning form-control']) !!}
                            {!!Form::close()!!}

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>



        @endif


    </div>


    </div>
</div>
@stop

{{--Javascript for select2, to make the tags look nice--}}
@section('footer')
    <script src="{{asset('components/scripts/openUserPage.js')}}"></script>
    <script src="{{asset('components/select2/js/select2.min.js')}}"></script>
    <script>
        $('#user_list').select2({
            placeholder: 'Choose a user',
            tags: false
        });
    </script>
@stop
