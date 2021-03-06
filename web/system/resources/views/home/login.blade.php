@extends('layouts.app')
@section('title') Login | @endsection
@section('content')
<style>
    .flex-center {
        align-items: center;
        display: flex;
        justify-content: center;
        position: relative;
        height: 100vh;
    }
</style>
<div class="row flex-center">
    <div class="col-lg-4">
        <div class="panel panel-danger">
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
                <div class="form-group">
                    <div class="col-lg-offset-3 col-lg-9">
                        {{ Form::checkbox('remember') }} Remember Me
                    </div>
                </div>
                <div class="col-lg-offset-3 col-lg-4">
                    {{ Form::submit('Login',['class' => 'btn btn-danger']) }}
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>

@endsection
