@extends('layouts.app')
@section('title') Inbox | @endsection
@section('content')

<h2>
    Inbox
    <div class="pull-right">
        <a href="{{ url('message/create') }}" class="btn btn-lg btn-primary"><i class="glyphicon glyphicon-plus-sign"></i> New</a>
    </div>
</h2>
<hr>
<div class="row">
    <div class="col-lg-4 form-group">
        <div class="input-group">
            <input class="form-control" id="search" value="{{ Session::get('project_search') }}"
                   onkeyup="if ((event.keyCode >= 48 && event.keyCode <= 90) || event.keyCode == 13 || event.keyCode == 8 || event.keyCode == 46) ajaxLoad('{{url('message.listinbox')}}?ok=1&search='+this.value,'data')"
                   placeholder="Find name ..."
                   type="text"
                   autofocus>
            <div class="input-group-btn">
                <button type="button" class="btn btn-default"
                        onclick="ajaxLoad('{{url('message.listinbox')}}?ok=1&search='+$('#search').val())"><i
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
        ajaxLoad("{{ url('message/listinbox') }}",'data');

        $("#message").click(function(){
            $(this).hide('slow');
        });
    });
</script>

@endsection