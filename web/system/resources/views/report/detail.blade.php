@extends('layouts.app')
@section('title') Detail Report | @endsection
@section('content')

@if(Session::has('message'))
    <div id="error" class="alert alert-success">
        <p>{{ Session::get('message') }}</p>
        <p><i>Click to hide this message.</i></p>
    </div>
@endif
<div class="row">
    <div class="col-lg-3">
        <figure>
            <img class="img-responsive" src="http://localhost/ProjectMonitoring/web/system/storage/app/public/images/icon/{{ $report->project->icon_path }}">
        </figure>
    </div>
    <div class="col-lg-9">
        <p>Project Name : <a href="{{ url('project/detail?id='.$report->project_id) }}"><strong><big>{{ $report->project->name }}</big></strong></a></p>
        <p>Project Time : {{ date_format($report->project->created_at,'d M Y - H:i:s') }}</p>
        <p>Project Cost : Rp{{ number_format($report->project->value,0,',','.') }}</p>
        <p>Project Coordinator : {{ $report->project->user->name }}</p>
        <p>Client Name : {{ $report->project->client_name }}</p>
        <p>Project Type : {{ $report->project->type }}</p>
    </div>
</div>
<h3>Report {{ date_format($report->created_at,'d M Y - H:i:s') }}</h3>
<div class="row">
    <div class="col-lg-12">
        <h3>Highlight:</h3>
        <p>{{ $report->highlight }}</p>
    </div>
    <div class="col-lg-4">
        <h3>Activity:</h3>
        <p><?= $report->activity ?></p>
        <h4>Evidence:</h4>
        <figure>
            <img src="http://localhost/ProjectMonitoring/web/system/storage/app/public/images/evidence/{{ $report->activity_path }}" class="img-responsive">
        </figure>
    </div>
    <div class="col-lg-4">
        <h3>Income:</h3>
        <p><?= $report->income ?></p>
        <h4>Evidence:</h4>
        <figure>
            <img src="http://localhost/ProjectMonitoring/web/system/storage/app/public/images/evidence/{{ $report->income_path }}" class="img-responsive">
        </figure>
    </div>
    <div class="col-lg-4">
        <h3>Expense:</h3>
        <p><?= $report->expense ?></p>
        <h4>Evidence:</h4>
        <figure>
            <img src="http://localhost/ProjectMonitoring/web/system/storage/app/public/images/evidence/{{ $report->expense_path }}" class="img-responsive">
        </figure>
    </div>
</div>
<p>
    <button onclick="javascript:history.back()" class="btn btn-lg btn-info">Back</button>
</p>

<script>
    $(document).ready(function(){
        $("#error").click(function(){
            $(this).hide('slow');
        });
    });
</script>

@endsection
