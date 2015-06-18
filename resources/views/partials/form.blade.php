{{--Include extra css for select2--}}
@section('header')
<link rel="stylesheet" href="{{asset('components/select2/css/select2.min.css')}}" />
@stop

{!! Form::label('title','Title:')!!}
{!! Form::text('title',null,['class' => 'form-control', 'placeholder' => 'The title which the public will see'])!!}
<br>
{!! Form::label('slug','Url Slug:')!!}
{!! Form::text('slug',null,['class' => 'form-control', 'placeholder' => 'Slug will appear in url bar in the browser'])!!}
<br>
{!! Form::label('body','Body:')!!}
{!! Form::textarea('body',null,['class' => 'form-control', 'placeholder' => 'The content of the article'])!!}
<br>
{!! Form::label('tag_list','Tags:')!!}
{!! Form::select('tag_list[]',['placeholder_tags', 'need_to_pass_in_var_with_all_tags'], null,['id' => 'tag_list', 'class' => 'form-control', 'multiple'])!!}
<br><br><br><br>
{!! Form::submit('Create Article',['class' => 'btn btn-primary form-control']) !!}

{{--Javascript for select2, to make the tags look nice--}}
@section('footer')
<script src="{{asset('components/select2/js/select2.min.js')}}"></script>
<script>
    $('#tag_list').select2({
        placeholder: 'Choose tags',
        tags: true,
        tokenSeparators: [',', ' ']
    });
</script>
@stop