@extends('layouts.app')
@section('title') New Users | @endsection
@section('content')

<div class="row">
    <div class="col-lg-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                New User
            </div>
            <div class="panel-body">
                {{ Form::open(['url' => url('user/tambah'),'method'=>'POST','id'=>'frmUserAdd','class'=>'form-horizontal']) }}
                    @if(count($errors) > 0)
                        <div id="error" class="alert alert-danger">
                            @foreach($errors as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif
                    <div class="form-group">
                        {{ Form::label('username','Username',['class'=>'col-sm-3 control-label']) }}
                        <div class="col-sm-9">
                            {{ Form::text('username',old('username'),['class'=>'form-control','placeholder'=>'Insert Username ...']) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('password','Password',['class'=>'col-sm-3 control-label']) }}
                        <div class="col-sm-9">
                            {{ Form::password('password',['class'=>'form-control']) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('name','Name',['class'=>'col-sm-3 control-label']) }}
                        <div class="col-sm-9">
                            {{ Form::text('name',old('name'),['class'=>'form-control','placeholder'=>'Insert Name ...']) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('position','Position',['class'=>'col-sm-3 control-label']) }}
                        <div class="col-sm-9">
                            {{ Form::select('position',['Project Admin'=>'Project Admin','Project Coordinator'=>'Project Coordinator','Management'=>'Management','Stakeholder'=>'Stakeholder'],old('position'),['class'=>'form-control','placeholder'=>'Select Position ...']) }}
                        </div>
                    </div>
                    <div class="col-sm-offset-3 col-sm-2">
                        {{ Form::button('Save',['class'=>'btn btn-primary btn-block','id'=>'btnSave']) }}
                    </div>
                    <div class="col-sm-2">
                        {{ Form::button('Cancel',['class'=>'btn btn-info btn-block','id'=>'btnCancel'])}}
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>

@endsection
