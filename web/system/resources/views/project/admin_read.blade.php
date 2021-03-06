@extends('layouts.app')
@section('title') Project | @endsection
@section('content')

<h2>
    Project List
</h2>
<hr>
<div class="row">
    <div class="col-lg-4 form-group">
        <div class="input-group">
            <input class="form-control" id="search" value="{{ Session::get('project_search') }}"
                   onkeyup="if ((event.keyCode >= 48 && event.keyCode <= 90) || event.keyCode == 13 || event.keyCode == 8 || event.keyCode == 46) ajaxLoad('{{url('project/'.$list)}}?ok=1&search='+this.value,'data')"
                   placeholder="Find name ..."
                   type="text"
                   autofocus>
            <div class="input-group-btn">
                <button type="button" class="btn btn-default"
                        onclick="ajaxLoad('{{url('project/'.$list)}}?ok=1&search='+$('#search').val())"><i
                            class="glyphicon glyphicon-search"></i>
                </button>
            </div>
        </div>
    </div>
</div>
@if(Session::has('message'))
    <div id="message" class="alert alert-success">
        {{ Session::get('message') }}
    </div>
@endif
<div id="data"></div>

<script>
    $(document).ready(function(){
        ajaxLoad("{{ url('project/'.$list) }}",'data');

        $("#message").click(function(){
            $(this).hide('slow');
        });
    });
</script>

@endsection
