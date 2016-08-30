@extends('layouts.app')
@section('title') Projects | @endsection
@section('content')

<meta name="_token" content="{!! csrf_token() !!}" />
<h2>
    Project List
    <div class="pull-right">
        <button id="btnAdd" class="btn btn-lg btn-primary"><i class="glyphicon glyphicon-plus-sign"></i> New</button>
    </div>
</h2>
<hr>
<div id="new"></div>
<div class="row">
    <div class="col-lg-4 form-group">
        <div class="input-group">
            <input class="form-control" id="search" value="{{ Session::get('project_search') }}"
                   onkeyup="if ((event.keyCode >= 65 && event.keyCode <= 90) || event.keyCode == 13 || event.keyCode == 8 || event.keyCode == 46) ajaxLoad('{{url('project/list')}}?ok=1&search='+this.value,'data')"
                   placeholder="Find name ..."
                   type="text"
                   autofocus>
            <div class="input-group-btn">
                <button type="button" class="btn btn-default"
                        onclick="ajaxLoad('{{url('project/list')}}?ok=1&search='+$('#search').val())"><i
                            class="glyphicon glyphicon-search"></i>
                </button>
            </div>
        </div>
    </div>
</div>
<div id="data"></div>
<hr>

<script>
$("#new").hide();
$(document).ready(function(){
    ajaxLoad("{{ url('project/list') }}",'data');
    $("#btnAdd").click(function(e){
        e.preventDefault();
        $(".loading").show();
        $("#new").load('{{ url('project/create') }}',function(){
            $(".loading").hide();
            $("#new").fadeIn('slow');
        });
    });
});
</script>

@endsection
