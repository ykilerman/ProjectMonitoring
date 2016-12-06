@extends('layouts.app')
@section('title') New Report | @endsection
@section('content')

<div class="row">
    <div class="col-lg-8">
        <div class="panel panel-danger">
            <div class="panel-heading">
                New Report for <b>{{ $project->name }}</b>
            </div>
            <div class="panel-body">
                {{ Form::open(['url'=>url('report/create'),'method'=>'POST','id'=>'frmReportAdd','class'=>'form-horizontal','files'=>'true']) }}
                    {{ Form::hidden('project_id',$project->id) }}
                    @if(count($errors)>0)
                        <div id="error" class="alert alert-danger">
                            @foreach($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif
                    @if(Session::has('message'))
                        <div id="error" class="alert alert-danger">
                            <p>{{ Session::get('message') }}</p>
                        </div>
                    @endif
                    <div class="form-group">
                        {{ Form::label('highlight','Highlight',['class'=>'col-sm-3 control-label']) }}
                        <div class="col-sm-9">
                            {{ Form::text('highlight',old('highlight'),['class'=>'form-control','placeholder'=>'Insert Report Highlight ...','required']) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('activity','Activity',['class'=>'col-sm-3 control-label']) }}
                        <div class="col-sm-9">
                            {{ Form::textarea('activity',old('activity'),['class'=>'form-control','placeholder'=>'Insert Report Activity ...','required']) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('activity_path','Activity Evidence',['class'=>'col-sm-3 control-label']) }}
                        <div class="col-sm-9">
                            {{ Form::file('activity_path') }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('income','Income',['class'=>'col-sm-3 control-label']) }}
                        <div class="col-sm-9">
                            {{ Form::number('income',old('income'),['class'=>'form-control','placeholder'=>'0']) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('income_path','Income Evidence',['class'=>'col-sm-3 control-label']) }}
                        <div class="col-sm-9">
                            {{ Form::file('income_path') }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('expense','Expense',['class'=>'col-sm-3 control-label']) }}
                        <div class="col-sm-9">
                            {{ Form::number('expense',old('expense'),['class'=>'form-control','placeholder'=>'0']) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('expense_path','Expense Evidence',['class'=>'col-sm-3 control-label']) }}
                        <div class="col-sm-9">
                            {{ Form::file('expense_path') }}
                        </div>
                    </div>
                    <div class="col-sm-offset-3 col-sm-2">
                        {{ Form::submit('Save',['class'=>'btn btn-danger btn-block','id'=>'btnSave']) }}
                    </div>
                    <div class="col-sm-2">
                        <button onclick="javascript:history.back()" class="btn btn-info btn-block">Back</button>
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
