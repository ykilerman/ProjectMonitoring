@extends('layouts.app')
@section('title') New Projects | @endsection
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
        <div class="panel panel-danger">
            <div class="panel-heading">
                New Project
            </div>
            <div class="panel-body">
                {{ Form::open(['url'=>url('project/create'),'method'=>'POST','id'=>'frmProjectAdd','class'=>'form-horizontal','files'=>'true']) }}
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
                            {{ Form::text('name',old('name'),['class'=>'form-control','placeholder'=>'Insert Project Name ...','required']) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('user_id','Project Coordinator',['class'=>'col-sm-3 control-label']) }}
                        <div class="col-sm-9">
                            @if(Auth::user()->position == 'Project Coordinator')
                                {{ Form::select('user_id',$user,Auth::user()->id,['class'=>'form-control','placeholder' => 'Select Project Coordinator ...']) }}
                            @else
                                {{ Form::select('user_id',$user,old('user_id'),['class'=>'form-control','placeholder' => 'Select Project Coordinator ...']) }}
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('description','Description',['class'=>'col-sm-3 control-label']) }}
                        <div class="col-sm-9">
                            {{ Form::textarea('description',old('description'),['class'=>'form-control','placeholder'=>'Insert Description ...','required']) }}
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
                            {{ Form::text('client_name',old('client_name'),['class'=>'form-control','placeholder'=>'Insert Client Name ...','required']) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('value','Project Cost',['class'=>'col-sm-3 control-label']) }}
                        <div class="col-sm-9">
                            {{ Form::number('value',old('value'),['class'=>'form-control','placeholder'=>'Insert Project Cost ...','min'=>'0','max'=>'99999999999','required']) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('update_schedule','Notification Schedule',['class'=>'col-sm-3 control-label']) }}
                        <div class="col-sm-9">
                            {{ Form::number('update_schedule',old('update_schedule'),['class'=>'form-control','min'=>'0','max'=>'999','placeholder' => 'Insert Notification Schedule ...','required']) }}
                        </div>
                    </div>
                    <div class="col-sm-offset-3 col-sm-2">
                        {{ Form::submit('Save',['class'=>'btn btn-danger btn-block','id'=>'btnSave']) }}
                    </div>
                    <div class="col-sm-2">
                        <a href="{{ url('project') }}" class="btn btn-info btn-block">Cancel</a>
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
    });
</script>
<hr>

@endsection
