@extends('layouts.app')
@section('title') Report List | @endsection
@section('content')

<div class="row">
    <div class="col-lg-2">
        <img class="img-responsive" src="{{ $project->icon_path }}" />
    </div>
    <div class="col-lg-10">
        <h2>{{ $project->name }}</h2>
    </div>
</div>
<h2>
    Report List
</h2>
@if(Session::has('message'))
    <div id="message" class="alert alert-success">
        {{ Session::get('message') }}
    </div>
@endif
<div id="data"></div>

<script>
    $(document).ready(function(){
        ajaxLoad("{{ url('report/listreport?id='.$project->id) }}",'data');

        $("#message").click(function(){
            $(this).hide('slow');
        });
    });
</script>

@endsection
