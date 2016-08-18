<p></p>
<div class="row">
    <div class="col-lg-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                New User
            </div>
            <div class="panel-body">
                {{ Form::open(['method'=>'POST','id'=>'frmUserAdd','class'=>'form-horizontal']) }}
                    <div id="error" class="alert alert-danger"></div>
                    <div class="form-group">
                        {{ Form::label('username','Username',['class'=>'col-sm-3 control-label']) }}
                        <div class="col-sm-9">
                            {{ Form::text('username',old('username'),['class'=>'form-control','placeholder'=>'Insert Username ...']) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('password','Password',['class'=>'col-sm-3 control-label']) }}
                        <div class="col-sm-9">
                            {{ Form::password('password',['class'=>'form-control']) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('name','Name',['class'=>'col-sm-3 control-label']) }}
                        <div class="col-sm-9">
                            {{ Form::text('name',old('name'),['class'=>'form-control','placeholder'=>'Insert Name ...']) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('position','Position',['class'=>'col-sm-3 control-label']) }}
                        <div class="col-sm-9">
                            {{ Form::select('position',['Project Admin'=>'Project Admin','Project Coordinator'=>'Project Coordinator','Management'=>'Management','Stakeholder'=>'Stakeholder'],old('position'),['class'=>'form-control','placeholder'=>'Select Position ...']) }}
                        </div>
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
    $("#error").hide();
    $("#btnCancel").click(function(e){
        $("#new").fadeOut('slow');
    });
    $("#error").click(function(){
        $(this).hide('slow');
    });
    function validate(id) {
        console.log(id + ", " + $("#" + id).val());
        return $.get("{{ url('user/validate') }}",['id'=>id, 'value'=>$("#"+id).val()]);
    }
    $(document).ready(function(){
        $("#btnSave").click(function(e){
            validUser = validate('username');
            console.log(validUser);
            if (!validUser.valid){
                $("#error").html(validUser.message);
                $("#error").show('slow');
            }
            else {
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                })
                $(".loading").show();
                var formdata = {
                    username: $("#username").val(),
                    password: $("#password").val(),
                    name: $("#name").val(),
                    position: $("#position").val()
                };

                console.log(formdata);

                $.ajax({
                    type: "post",
                    url: "{{ url('user/create') }}",
                    data: formdata,
                    success: function(data){
                        $("#new").fadeOut('slow');
                        ajaxLoad("{{ url('user/list') }}",'data');
                    },
                    error: function(data){
                        $(".loading").hide();
                        console.log("Error: "+data);
                    }
                });
            }
        });
    });
</script>
