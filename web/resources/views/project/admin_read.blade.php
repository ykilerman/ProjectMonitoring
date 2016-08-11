@extends('layouts.app')

@section('title') Projects | @endsection

@section('content')

<div class="container">
    <h2>
        Project List
        <div class="pull-right">
            <button id="btnAdd" class="btn btn-lg btn-primary"><i class="glyphicon glyphicon-plus-sign"></i> New</button>
        </div>
    </h2>
    <hr>
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
</div>

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="labelModalTambah" aria-hidden="true" id="modalTambah">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                <h4 class="modal-title" id="labelModalTambah">Tambah Data</h4>
            </div>
            <div class="modal-body">
                {{ Form::open(['method'=>'POST','id'=>'frmProject','class'=>'form-horizontal','novalidate'=>""]) }}
                    <div class="form-group">
                        {{ Form::label('name','Project Name',['class'=>'col-sm-4 control-label']) }}
                        <div class="col-sm-8">
                            {{ Form::text('name',old('name'),['class'=>'form-control','placeholder'=>'Insert Project Name ...','required']) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('description','Description',['class'=>'col-sm-4 control-label']) }}
                        <div class="col-sm-8">
                            {{ Form::text('description',old('description'),['class'=>'form-control','placeholder'=>'Insert Description ...','required']) }}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-4">
                            {{ Form::button('Save',['class'=>'btn btn-primary btn-block','id'=>'btnSave']) }}
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<meta name="_token" content="{!! csrf_token() !!}" />

<script>
$(document).ready(function(){
    ajaxLoad("{{ url('project/list') }}",'data');

    $("#btnAdd").click(function(){
        $("#frmProject").trigger('reset');
        $("#modalTambah").modal("show");
    });
});
</script>

@endsection
