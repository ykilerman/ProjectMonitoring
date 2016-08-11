@extends('layouts.app')

@section('title') Login | @endsection

@section('content')

<div class="row">
    <div class="col-lg-4 col-lg-offset-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="glyphicon glyphicon-user"></i> Login
                @if(Session::has('message'))
                    <span class="label {{ Session::get('type') }}">{{ Session::get('message') }}</span>
                @endif
            </div>
            <div class="panel-body">
                {{ Form::open(['url' => url('login'),'method'=>'POST','role'=>'form','class'=>'form-horizontal']) }}
                <div class="form-group">
                    {{ Form::label('username','Username',['class'=>'control-label col-lg-3']) }}
                    <div class="col-lg-9">
                        {{ Form::text('username',old('username'),['class'=>'form-control','autofocus']) }}
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('password','Password',['class'=>'control-label col-lg-3']) }}
                    <div class="col-lg-9">
                        {{ Form::password('password',['class'=>'form-control']) }}
                    </div>
                </div>
                <div class="col-lg-offset-3 col-lg-4">
                    {{ Form::submit('Login',['class' => 'btn btn-primary']) }}
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>

@endsection
