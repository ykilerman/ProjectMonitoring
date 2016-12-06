@extends('layouts.app')
@section('title') Month Report | @endsection
@section('content')
<?php
$now = date('Y');
?>
<h2>
    Month Report
</h2>
<hr>
<div class="row form-group">
    {{ Form::label('month','Select Month',['class' => 'control-label col-lg-2']) }}
    <div class="col-lg-2">
        {{ Form::selectMonth('month',Session::get('report_month'),['class' => 'form-control', 'id' => 'selectMonth']) }}
    </div>
    <div class="col-lg-2">
        {{ Form::selectRange('year', $now, $now-15, Session::get('report_year'), ['class' => 'form-control', 'id' => 'selectYear']) }}
    </div>
</div>
@if(Session::has('message'))
    <div id="message" class="alert alert-success">
        {{ Session::get('message') }}
    </div>
@endif
<div id="data"></div>

<script>
    $(document).ready(function(){
        ajaxLoad("{{ url('report/listmonth') }}",'data');

        $("#message").click(function(){
            $(this).hide('slow');
        });
        $("#selectMonth").change(function(){
            ajaxLoad("{{ url('report/listmonth?month=') }}" + $(this).val(), 'data');
        });
        $("#selectYear").change(function(){
            ajaxLoad("{{ url('report/listmonth?year=') }}" + $(this).val(), 'data');
        });
    });
</script>

@endsection
