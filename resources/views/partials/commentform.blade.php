{{--A small form for posting comments--}}
@include('errors.list')
<div class="col-sm-12">


    {{--Form for posting comments--}}
    @if($enableForm == true)
    {{--We need to pass in the slug so it can appear in the route as a wildcard--}}
    {!! Form::open(['action' => ['CommentsController@storeComment', $article->slug], 'method' => 'POST']) !!}
    <div class="input-group ">
        {!! Form::label('body','Post a comment!')!!}
        {!! Form::textarea('body',null,['class' => 'form-control', 'placeholder' => 'Enter a comment'])!!}
        <br>
        {!! Form::submit('Post Comment',['id' => 'submitButton', 'class' => 'btn btn-primary form-control']) !!}
    </div>
    {!! Form::close()!!}
    @else
        {{--This form is disabled, just have disabled input without action--}}

        <div class="input-group">
            {!! Form::label('body','You must be logged in to comment!')!!}
            {!! Form::textarea('body',null,['class' => 'form-control','disabled', 'placeholder' => 'You must be logged in'])!!}
            <br>
            {!! Form::submit('Post Comment',['class' => 'btn btn-default form-control disabled']) !!}
        </div>


    @endif

</div>
