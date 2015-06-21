{{--A small form for posting comments--}}
@include('errors.list')
<div class="col-sm-12">
    {{--We need to pass in the slug so it can appear in the route as a wildcard--}}
    {!! Form::open(['action' => ['CommentsController@storeComment', $article->slug], 'method' => 'POST']) !!}

    {{--Form for posting comments--}}
    <div class="input-group ">
        {!! Form::label('body','Post a comment!')!!}
        {!! Form::textarea('body',null,['class' => 'form-control', 'placeholder' => 'This blog is so cool!'])!!}
        <br>
        {!! Form::submit('Post Comment',['class' => 'btn btn-primary form-control']) !!}
    </div>
    {!! Form::close()!!}
</div>