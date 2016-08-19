@extends('layouts.app')
@section('title') Change Password | @endsection
@section('content')

<h2>
    Change Password
</h2>
<hr>
@if(Session::has('message'))
    <div id="message" class="alert alert-success">
        {{ Session::get('message') }}
    </div>
@endif
{{ Form::open(['url' => url('changepassword'),'method'=>'POST','class'=>'form-horizontal']) }}
    @if(count($errors) > 0)
        <div id="error" class="alert alert-danger">
            @foreach($errors->all() as $error)
                <p><strong>{{ $error }}</strong></p>
            @endforeach
            <p><i>Click to close the alert.</i></p>
        </div>
    @endif
    <div class="form-group">
        {{ Form::label('oldpass','Old Password',['class'=>'col-lg-2 control-label']) }}
        <div class="col-lg-4">
            {{ Form::password('oldpass',['class'=>'form-control']) }}
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('newpass','New Password',['class'=>'col-lg-2 control-label']) }}
        <div class="col-lg-4">
            {{ Form::password('newpass',['class'=>'form-control']) }}
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('renewpass','Re-New Password',['class'=>'col-lg-2 control-label']) }}
        <div class="col-lg-4">
            {{ Form::password('renewpass',['class'=>'form-control']) }}
        </div>
    </div>
    <div class="col-lg-offset-2 col-lg-2">
        {{ Form::submit('Change',['class'=>'btn btn-primary btn-block','id'=>'btnSave']) }}
    </div>
{{ Form::close() }}

<script>
    $(document).ready(function(){
        $("#message").click(function(){
            $(this).hide('slow');
        });
        $("#error").click(function(){
            $(this).hide('slow');
        });
    });
</script>

@endsection
