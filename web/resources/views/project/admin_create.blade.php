<div class="row">
    <div class="col-lg-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                New Project
            </div>
            <div class="panel-body">
                {{ Form::open(['method'=>'POST','id'=>'frmProjectAdd','class'=>'form-horizontal','novalidate'=>"",'files'=>'true']) }}
                    <div class="form-group">
                        {{ Form::label('name','Project Name',['class'=>'col-sm-3 control-label']) }}
                        <div class="col-sm-9">
                            {{ Form::text('name',old('name'),['class'=>'form-control','placeholder'=>'Insert Project Name ...']) }}
                        </div>
                        @if($errors->has())
                            <span class="label label-danger">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                    <div id="selectUser"></div>
                    <div class="form-group">
                        {{ Form::label('description','Description',['class'=>'col-sm-3 control-label']) }}
                        <div class="col-sm-9">
                            {{ Form::text('description',old('description'),['class'=>'form-control','placeholder'=>'Insert Description ...']) }}
                        </div>
                        @if($errors->has())
                            <span class="label label-danger">{{ $errors->first('description') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        {{ Form::label('icon_path','Icon Project',['class'=>'col-sm-3 control-label']) }}
                        <div class="col-sm-9">
                            {{ Form::file('icon_path') }}
                        </div>
                        @if($errors->has())
                            <span class="label label-danger">{{ $errors->first('icon_path') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        {{ Form::label('client_name','Client Name',['class'=>'col-sm-3 control-label']) }}
                        <div class="col-sm-9">
                            {{ Form::text('client_name',old('client_name'),['class'=>'form-control','placeholder'=>'Insert Client Name ...']) }}
                        </div>
                        @if($errors->has())
                            <span class="label label-danger">{{ $errors->first('client_name') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        {{ Form::label('value','Project Cost',['class'=>'col-sm-3 control-label']) }}
                        <div class="col-sm-9">
                            {{ Form::number('value',old('value'),['class'=>'form-control','placeholder'=>'Insert Project Cost ...','min'=>'0','max'=>'99999999999']) }}
                        </div>
                        @if($errors->has())
                            <span class="label label-danger">{{ $errors->first('value') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        {{ Form::label('update_schedule','Notification Schedule',['class'=>'col-sm-3 control-label']) }}
                        <div class="col-sm-9">
                            {{ Form::number('update_schedule',old('update_schedule'),['class'=>'form-control','min'=>'0','max'=>'999','placeholder' => 'Insert Notification Schedule ...']) }}
                        </div>
                        @if($errors->has())
                            <span class="label label-danger">{{ $errors->first('update_schedule') }}</span>
                        @endif
                    </div>
                    <div class="col-sm-offset-3 col-sm-2">
                        {{ Form::button('Save',['class'=>'btn btn-primary btn-block','id'=>'btnSave']) }}
                    </div>
                    <div class="col-sm-2">
                        {{ Form::button('Cancel',['class'=>'btn btn-info btn-block','id'=>'btnCancel'])}}
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
<script>
ajaxLoad('{{ url('project/userlistselect') }}','selectUser');
$("#btnCancel").click(function(e){
    $("#new").fadeOut('slow');
});
$(document).ready(function(){
    $("#btnSave").click(function(e){
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        })
        $(".loading").show();
        var formdata = {
            name: $("#name").val(),
            user_id: $("#user_id").val(),
            description: $("#description").val(),
            icon_path: $("#icon_path").val(),
            client_name: $("#client_name").val(),
            value: $("#value").val(),
            update_schedule: $("#update_schedule").val()
        };

        console.log(formdata);

        $.ajax({
            type: "post",
            url: "{{ url('project/create') }}",
            data: formdata,
            success: function(data){
                $("#modalTambah").modal('hide');
                ajaxLoad("{{ url('project/list') }}",'data');
            },
            error: function(data){
                $(".loading").hide();
                console.log("Error: "+data);
            }
        });
    });
});
</script>
<hr>
