<?php
$user = [];
foreach($users as $data)
{
    $user += [$data->id => $data->name];
}
?>
<div class="form-group">
    {{ Form::label('user_id','Project Coordinator',['class'=>'col-sm-3 control-label']) }}
    <div class="col-sm-9">
        @if(Auth::user()->position == 'Project Coordinator')
            {{ Form::select('user_id',$user,Auth::user()->id,['class'=>'form-control','placeholder' => 'Select Project Coordinator ...']) }}
        @else
            {{ Form::select('user_id',$user,old('update_schedule'),['class'=>'form-control','placeholder' => 'Select Project Coordinator ...']) }}
        @endif
    </div>
    @if($errors->has())
        <span class="label label-danger">{{ $errors->first('user_id') }}</span>
    @endif
</div>
