{{--Message box which will display any flash messages--}}
<div class="container">
    @if(Session::has('flash_message'))
        <div class="alert alert-success">
            {{--<button type="button" class="close" data-dissmiss="alert" aria-hidden="true">&times; </button>--}}
            {{Session::get('flash_message')}}
        </div>
    @endif
</div>
@section('footer')
<script>
    $('div.alert').delay(5000).slideUp(300);
</script>
@stop