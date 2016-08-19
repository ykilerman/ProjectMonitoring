<div class="table-responsive">
    <table class="table table-bordered table-striped table-hover text-center">
        <thead>
            <td>
                #
            </td>
            <td>
                <a onclick="javascript:ajaxLoad('user/list?field=name&sort={{Session::get("user_sort")=="asc"?"desc":"asc"}}','data')" href="#">
                    Name
                </a>
                <i style="font-size: 12px"
                   class="glyphicon {{ Session::get('user_field')=='name'?(Session::get('user_sort')=='asc'?'glyphicon-sort-by-alphabet':'glyphicon-sort-by-alphabet-alt'):'' }}">
                </i>
            </td>
            <td>
                <a onclick="javascript:ajaxLoad('user/list?field=username&sort={{Session::get("user_sort")=="asc"?"desc":"asc"}}','data')" href="#">
                    Username
                </a>
                <i style="font-size: 12px"
                   class="glyphicon {{ Session::get('user_field')=='username'?(Session::get('user_sort')=='asc'?'glyphicon-sort-by-alphabet':'glyphicon-sort-by-alphabet-alt'):'' }}">
                </i>
            </td>
            <td>
                <a onclick="javascript:ajaxLoad('user/list?field=position&sort={{Session::get("user_sort")=="asc"?"desc":"asc"}}','data')" href="#">
                    Position
                </a>
                <i style="font-size: 12px"
                   class="glyphicon {{ Session::get('user_field')=='position'?(Session::get('user_sort')=='asc'?'glyphicon-sort-by-alphabet':'glyphicon-sort-by-alphabet-alt'):'' }}">
                </i>
            </td>
            <td>
                Action
            </td>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            @foreach($users as $user)
                @if((Auth::user()->position == 'Project Coordinator' && $user->user_id == Auth::user()->id) || Auth::user()->position != 'Project Coordinator')
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td class="text-left">{{ $user->name }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->position }}</td>
                        <td>
                            <a href="{{ url('user/update?id='.$user->id) }}" title="Update" class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-edit"></i> Update</a>
                            <a href="{{ url('user/delete?id='.$user->id) }}" title="Delete" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Delete</button>
                        </td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
    <p>
        Total Data : {{ $total }}
        <div class="pull-right">{!! str_replace('/?','?',$users->render()) !!}</div>
    </p>
</div>
<script>
    $('.pagination a').on('click', function (event) {
        event.preventDefault();
        ajaxLoad($(this).attr('href'),'data');
    });
</script>
