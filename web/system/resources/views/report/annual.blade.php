@extends('layouts.app')
@section('title') Annual Report | @endsection
@section('content')
<?php
    $now = date('Y');
?>
<h2>
    Annual Report
</h2>
<hr>
<div class="row form-group">
    {{ Form::label('year','Select Year',['class' => 'control-label col-lg-2']) }}
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
        ajaxLoad("{{ url('report/listannual') }}",'data');

        $("#message").click(function(){
            $(this).hide('slow');
        });
        $("#selectYear").change(function(){
            ajaxLoad("{{ url('report/listannual?year=') }}" + $(this).val(), 'data');
        });
    });
</script>

@endsection
