@extends('layouts.app')
@section('title') New Answer | @endsection
@section('content')

<div class="row">
    <div class="col-lg-8">
        <div class="panel panel-danger">
            <div class="panel-heading">
                New Answer
            </div>
            <div class="panel-body">
                {{ Form::open(['url'=>url('answer/new'),'method'=>'POST','id'=>'frmReport','class'=>'form-horizontal']) }}
                    {{ Form::hidden('question_id',$question->id) }}
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
                        {{ Form::label('Question','Question',['class'=>'col-sm-3 control-label']) }}
                        <div class="col-sm-9">
                            {{ Form::textarea('Question',$question->text,['class'=>'form-control','readonly']) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('text','Answer',['class'=>'col-sm-3 control-label']) }}
                        <div class="col-sm-9">
                            {{ Form::textarea('text','',['class'=>'form-control','required']) }}
                        </div>
                    </div>
                    <div class="col-sm-offset-3 col-sm-2">
                        {{ Form::submit('Send',['class'=>'btn btn-primary btn-block','id'=>'btnSave']) }}
                    </div>
                    <div class="col-sm-2">
                        <button onclick="javascript:history.back()" class="btn btn-danger btn-block">Back</button>
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
