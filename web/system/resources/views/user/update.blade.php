@extends('layouts.app')
@section('title') Update Users | @endsection
@section('content')

<div class="row">
    <div class="col-lg-8">
        <div class="panel panel-danger">
            <div class="panel-heading">
                Update User
            </div>
            <div class="panel-body">
                {{ Form::open(['url' => url('user/update'),'method'=>'POST','id'=>'frmUserAdd','class'=>'form-horizontal']) }}
                    {{ Form::hidden('id',$user->id) }}
                    @if(count($errors) > 0)
                        <div id="error" class="alert alert-danger">
                            @foreach($errors->all() as $error)
                                <p><strong>{{ $error }}</strong></p>
                            @endforeach
                            <p><i>Click to close the alert.</i></p>
                        </div>
                    @endif
                    <div class="form-group">
                        {{ Form::label('username','Username',['class'=>'col-sm-3 control-label']) }}
                        <div class="col-sm-9">
                            {{ Form::text('username',$user->username,['class'=>'form-control','placeholder'=>'Insert Username ...']) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('name','Name',['class'=>'col-sm-3 control-label']) }}
                        <div class="col-sm-9">
                            {{ Form::text('name',$user->name,['class'=>'form-control','placeholder'=>'Insert Name ...']) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('position','Position',['class'=>'col-sm-3 control-label']) }}
                        <div class="col-sm-9">
                            {{ Form::select('position',['Project Admin'=>'Project Admin','Project Coordinator'=>'Project Coordinator','Management'=>'Management','Stakeholder'=>'Stakeholder'],$user->position,['class'=>'form-control','placeholder'=>'Select Position ...']) }}
                        </div>
                    </div>
                    <div class="col-sm-offset-3 col-sm-2">
                        {{ Form::submit('Save',['class'=>'btn btn-danger btn-block','id'=>'btnSave']) }}
                    </div>
                    <div class="col-sm-2">
                        <a href="{{ url('user') }}" class="btn btn-info btn-block">Cancel</a>
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>

<script>
    $("#error").click(function(){
        $(this).hide('slow');
    });
</script>
@endsection
