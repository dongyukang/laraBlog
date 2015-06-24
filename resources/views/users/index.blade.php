@extends('app')

@section('header')
    <link rel="stylesheet" href="{{asset('components/select2/css/select2.min.css')}}" />
    <link rel="stylesheet" href="{{asset('components/css/userstyles.css')}}" />
@stop

@section('content')
    <div class="container">
        <h1>Member Lookup</h1><hr>
        Enter the name of a member and hit search to find their user page.

        <div class="form-group">
            {!! Form::label('user_list','Select User:')!!}
            {!! Form::select('user_list[]',$userList, null,['id' => 'user_list', 'class' => 'form-control form-inline', ])!!}
        </div>
        {!! Form::button('Lookup User',['id' => 'confirmButton', 'class' => 'btn btn-primary form-control form-inline', 'onclick' => 'openPage()']) !!}

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
