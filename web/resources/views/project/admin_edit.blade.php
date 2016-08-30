@extends('layouts.app')
@section('title') Edit Project | @endsection
@section('content')

<?php
$user = [];
foreach($users as $data)
{
    $user += [$data->id => $data->name];
}
?>
<div class="row">
    <div class="col-lg-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                Edit Project
            </div>
            <div class="panel-body">
                {{ Form::open(['url'=>url('project/edit'),'method'=>'POST','id'=>'frmProject','class'=>'form-horizontal','files'=>'true']) }}
                    {{ Form::hidden('id',$project->id) }}
                    @if(count($errors)>0)
                        <div id="error" class="alert alert-danger">
                            @foreach($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif
                    <div class="form-group">
                        {{ Form::label('name','Project Name',['class'=>'col-sm-3 control-label']) }}
                        <div class="col-sm-9">
                            {{ Form::text('name',$project->name,['class'=>'form-control','placeholder'=>'Insert Project Name ...','required']) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('user_id','Project Coordinator',['class'=>'col-sm-3 control-label']) }}
                        <div class="col-sm-9">
                            {{ Form::select('user_id',$user,$project->user_id,['class'=>'form-control','placeholder' => 'Select Project Coordinator ...']) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('description','Description',['class'=>'col-sm-3 control-label']) }}
                        <div class="col-sm-9">
                            {{ Form::textarea('description',$project->description,['class'=>'form-control','placeholder'=>'Insert Description ...','required']) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('icon_path','Icon Project',['class'=>'col-sm-3 control-label']) }}
                        <div class="col-sm-9">
                            {{ Form::file('icon_path') }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('client_name','Client Name',['class'=>'col-sm-3 control-label']) }}
                        <div class="col-sm-9">
                            {{ Form::text('client_name',$project->client_name,['class'=>'form-control','placeholder'=>'Insert Client Name ...','required']) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('value','Project Cost',['class'=>'col-sm-3 control-label']) }}
                        <div class="col-sm-9">
                            {{ Form::number('value',$project->value,['class'=>'form-control','placeholder'=>'Insert Project Cost ...','min'=>'0','max'=>'99999999999','required']) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('update_schedule','Notification Schedule',['class'=>'col-sm-3 control-label']) }}
                        <div class="col-sm-9">
                            {{ Form::number('update_schedule',$project->update_schedule,['class'=>'form-control','min'=>'0','max'=>'999','placeholder' => 'Insert Notification Schedule ...','required']) }}
                        </div>
                    </div>
                    <div class="col-sm-offset-3 col-sm-2">
                        {{ Form::submit('Save',['class'=>'btn btn-primary btn-block','id'=>'btnSave']) }}
                    </div>
                    <div class="col-sm-2">
                        <button id="btnBack" class="btn btn-info btn-block">Back</a>
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $("#error").click(function(){
            $(this).hide('slow');
        });
        $("#btnBack").click(function(){
            history.back();
        });
    });
</script>
<hr>

@endsection
