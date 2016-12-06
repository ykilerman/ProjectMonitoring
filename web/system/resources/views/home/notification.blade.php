@extends('layouts.app')
@section('title') Notification | @endsection
@section('content')
<?php
    use App\Report;
    use App\Project;
    use App\Answer;
    use App\Question;
?>
<style>
    tbody tr:hover {
        cursor: pointer;
    }
</style>
<h2>
    Notification
</h2>
<hr>
@if(Session::has('message'))
    <div id="message" class="alert alert-success">
        {{ Session::get('message') }}
    </div>
@endif
<table class="table table-hover table-striped table-bordered">
    <thead>
        <td>Time</td>
        <td>Notification</td>
    </thead>
    <tbody>
        @foreach($notifications as $notification)
            @if($notification->table == 'reports')
                <?php
                    $data = Report::find($notification->table_id);
                ?>
                <tr onclick="javascript: window.location.href = '{{ url('report/detail?id='.$data->id) }}';">
                    <td>{{ $data->created_at }}</td>
                    <td>New report for project <b>{{ $data->project->name }}</b></td>
                </tr>
            @elseif($notification->table == 'projects')
                <?php
                    $data = Project::find($notification->table_id);
                ?>
                <tr onclick="javascript: window.location.href = '{{ url('project/detail?id='.$data->id) }}';">
                    <td>{{ $data->created_at }}</td>
                    <td>New project is created: <b>{{ $data->name }}</b></td>
                </tr>
            @elseif($notification->table == 'questions')
                <?php
                    $data = Question::find($notification->table_id);
                ?>
                <tr onclick="javascript: window.location.href = '{{ url('project/detail?id='.$data->project_id) }}';">
                    <td>{{ $data->created_at }}</td>
                    <td>New question for project <b>{{ $data->project->name }}</b>: {{ $data->text }}</td>
                </tr>
            @elseif($notification->table == 'answers')
                <?php
                    $data = Answer::find($notification->table_id);
                ?>
                <tr onclick="javascript: window.location.href = '{{ url('project/detail?id='.$data->question->project_id) }}';">
                    <td>{{ $data->created_at }}</td>
                    <td>New question for project <b>{{ $data->question->project->name }}</b>: {{ $data->text }}</td>
                </tr>
            @endif
        @endforeach
    </tbody>
</table>
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