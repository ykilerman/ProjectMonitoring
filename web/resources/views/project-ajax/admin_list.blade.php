<div class="table-responsive">
    <table class="table table-bordered table-striped table-hover text-center">
        <thead>
            <td>
                #
            </td>
            <td>
                <a onclick="javascript:ajaxLoad('project/list?field=name&sort={{Session::get("project_sort")=="asc"?"desc":"asc"}}','data')" href="#">
                    Project Name
                </a>
                <i style="font-size: 12px"
                   class="glyphicon {{ Session::get('project_field')=='name'?(Session::get('project_sort')=='asc'?'glyphicon-sort-by-alphabet':'glyphicon-sort-by-alphabet-alt'):'' }}">
                </i>
            </td>
            <td>
                <a onclick="javascript:ajaxLoad('project/list?field=client_name&sort={{Session::get("project_sort")=="asc"?"desc":"asc"}}','data')" href="#">
                    Client Name
                </a>
                <i style="font-size: 12px"
                   class="glyphicon {{ Session::get('project_field')=='client_name'?(Session::get('project_sort')=='asc'?'glyphicon-sort-by-alphabet':'glyphicon-sort-by-alphabet-alt'):'' }}">
                </i>
            </td>
            <td>
                <a onclick="javascript:ajaxLoad('project/list?field=value&sort={{Session::get("project_sort")=="asc"?"desc":"asc"}}','data')" href="#">
                    Project Cost
                </a>
                <i style="font-size: 12px"
                   class="glyphicon {{ Session::get('project_field')=='value'?(Session::get('project_sort')=='asc'?'glyphicon-sort-by-alphabet':'glyphicon-sort-by-alphabet-alt'):'' }}">
                </i>
            </td>
            <td>
                <a onclick="javascript:ajaxLoad('project/list?field=status&sort={{Session::get("project_sort")=="asc"?"desc":"asc"}}','data')" href="#">
                    Status
                </a>
                <i style="font-size: 12px"
                   class="glyphicon {{ Session::get('project_field')=='status'?(Session::get('project_sort')=='asc'?'glyphicon-sort-by-alphabet':'glyphicon-sort-by-alphabet-alt'):'' }}">
                </i>
            </td>
            <td>Aksi</td>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            @foreach($projects as $project)
                @if((Auth::user()->position == 'Project Coordinator' && $project->user_id == Auth::user()->id) || Auth::user()->position != 'Project Coordinator')
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td class="text-left">{{ $project->name }}</td>
                        <td>{{ $project->client_name }}</td>
                        <td>Rp{{ number_format($project->value,2,',','.') }}</td>
                        <td>{{ $project->status }}</td>
                        <td>
                            <button title="Ubah Data" class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-edit"></i> Update</button>
                            <button title="Hapus Data" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Delete</button>
                        </td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
    <p>
        Total Data : {{ $total }}
        <div class="pull-right">{{ $projects->render() }}</div>
    </p>
</div>
