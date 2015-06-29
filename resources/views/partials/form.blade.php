{{--Form for posting articles--}}

{{--Include extra css for select2--}}
@section('header')
<link rel="stylesheet" href="{{asset('components/select2/css/select2.min.css')}}" />
@stop

{!! Form::label('title','Title:')!!}
{!! Form::text('title',null,['id' => 'input_title', 'class' => 'form-control', 'placeholder' => 'The title which the public will see'])!!}
<br>
{!! Form::label('slug','Url Slug:')!!}
{!! Form::text('slug',null,['id' => 'input_slug', 'class' => 'form-control', 'placeholder' => 'Slug will appear in url bar in the browser'])!!}
<br>
{!! Form::label('body','Body:')!!}
{!! Form::textarea('body',null,['id' => 'bodyInput', 'class' => 'form-control', 'oninput' => 'this.editor.update()', 'placeholder' => 'The content of the article. You can use any markdown formatting!'])!!}
<br>
{!! Form::label('tag_list','Tags:')!!}
{!! Form::select('tag_list[]',$tags, null,['id' => 'tag_list', 'class' => 'form-control', 'multiple'])!!}
<br><br><br><br>
<a href="#" onclick="togglePreview()">Toggle Preview</a>
<div id="previewField" class="well" > </div>

<br><br><br><br>
{!! Form::submit($submitText,['class' => 'btn btn-primary form-control']) !!}


{{--Javascript for select2, to make the tags look nice--}}
@section('footer')
<script src="{{asset('components/select2/js/select2.min.js')}}"></script>
<!-- Generate the slug automatically unless otherwise specified-->
@if($defaultSlug == false)
<script src="{{asset('components/scripts/matchSlug.js')}}"></script>
@endif
<!--Markdown js parser -->
<script src="{{asset('components/markdown-js-0.5.0/lib/markdown.js')}}"></script>
<script>
    //Handle the tags for select2
    $('#tag_list').select2({
        placeholder: 'Choose a tag or create your own',
        tags: true,
        tokenSeparators: [',', ' ']
    });

    //Editor object prototype
    function Editor(input, preview) {
        this.update = function() {
            console.log('updating');
            preview.innerHTML = markdown.toHTML(input.value);

        };
        input.editor = this;
        this.update();
    }

    //Initiate makdown parser
    new Editor(document.getElementById('bodyInput'),document.getElementById('previewField'));

    //Allow preview field to toggle
    function togglePreview() {
        $('#previewField').slideToggle("slow");
    }
</script>
@stop