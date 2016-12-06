@extends('layouts.app')
@section('title') Quarterly Report | @endsection
@section('content')
<?php
    $now = date('Y');
?>
<h2>
    Quarterly Report
</h2>
<hr>
<div class="row form-group">
    {{ Form::label('month','Select Quarter',['class' => 'control-label col-lg-2']) }}
    <div class="col-lg-3">
        {{ Form::select('quarter', ['January - March', 'April - June', 'July - September', 'October - December'],Session::get('report_quarter'),['class' => 'form-control', 'id' => 'selectQuarter']) }}
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
        ajaxLoad("{{ url('report/listquarterly') }}",'data');

        $("#message").click(function(){
            $(this).hide('slow');
        });
        $("#selectQuarter").change(function(){
            ajaxLoad("{{ url('report/listquarterly?quarter=') }}" + $(this).val(), 'data');
        });
        $("#selectYear").change(function(){
            ajaxLoad("{{ url('report/listquarterly?year=') }}" + $(this).val(), 'data');
        });
    });
</script>

@endsection
