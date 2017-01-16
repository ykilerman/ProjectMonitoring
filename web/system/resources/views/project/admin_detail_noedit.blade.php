@extends('layouts.app')
@section('title') Detail Project | @endsection
@section('content')

<h2>Project Detail</h2>
@if(Session::has('message'))
    <div id="error" class="alert alert-success">
        <p>{{ Session::get('message') }}</p>
        <p><i>Click to hide this message.</i></p>
    </div>
@endif
<div class="row">
    <div class="col-lg-3">
        <figure >
            <img class="img-responsive" src="http://localhost/ProjectMonitoring/web/system/storage/app/public/images/icon/{{ $project->icon_path }}">
        </figure>
    </div>
    <div class="col-lg-9">
        <p>Project Name : <strong><big>{{ $project->name }}</big></strong></p>
        <p>Project Time : {{ date_format($project->created_at,'d M Y - H:i') }}</p>
        <p>Project Cost : Rp{{ number_format($project->value,0,',','.') }}</p>
        <p>Project Coordinator : {{ $project->user->name }}</p>
        <p>Client Name : {{ $project->client_name }}</p>
        <p>Project Type : {{ $project->type }}</p>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <p>Project Description : </p>
        <?= $project->description ?>
    </div>
</div>
<hr>
<button class="btn btn-danger" id="btnBack">Back</button>
<hr>
<h3>Report</h3>
<p><a href="{{ url('report?id='.$project->id) }}" class="link">View <strong>{{ $project->name }}</strong>'s reports here</a></p>
<hr>
<h3>Question & Answer</h3>
<div id="question"></div>

<script>
    $(document).ready(function(){
        ajaxLoad("{{ url('question/listnoedit?project_id='.$project->id) }}",'question');
        $("#btnBack").click(function(){
            history.back();
        });
        $("#btnEdit").click(function(){
            window.location.href = '{{ url('project/edit?id='.$project->id) }}';
        });
        $("#error").click(function(){
            $(this).hide('slow');
        });
    });
</script>

@endsection
