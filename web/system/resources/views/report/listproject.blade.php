<style>
    tbody tr:hover{
        cursor: pointer;
    }
</style>
<div class="table-responsive">
    <table class="table table-bordered table-striped table-hover text-center">
        <thead>
            <td>
                #
            </td>
            <td>
                Icon
            </td>
            <td>
                <a onclick="javascript:ajaxLoad('report/listproject?field=name&sort={{Session::get("project_sort")=="asc"?"desc":"asc"}}','data')" href="#">
                    Project Name
                </a>
                <i style="font-size: 12px"
                   class="glyphicon {{ Session::get('project_field')=='name'?(Session::get('project_sort')=='asc'?'glyphicon-sort-by-alphabet':'glyphicon-sort-by-alphabet-alt'):'' }}">
                </i>
            </td>
            <td>
                <a onclick="javascript:ajaxLoad('report/listproject?field=updated_at&sort={{Session::get("project_sort")=="asc"?"desc":"asc"}}','data')" href="#">
                    Last Update
                </a>
                <i style="font-size: 12px"
                   class="glyphicon {{ Session::get('project_field')=='updated_at'?(Session::get('project_sort')=='asc'?'glyphicon-sort-by-alphabet':'glyphicon-sort-by-alphabet-alt'):'' }}">
                </i>
            </td>
            <td>
                <a onclick="javascript:ajaxLoad('report/listproject?field=status&sort={{Session::get("project_sort")=="asc"?"desc":"asc"}}','data')" href="#">
                    Status
                </a>
                <i style="font-size: 12px"
                   class="glyphicon {{ Session::get('project_field')=='status'?(Session::get('project_sort')=='asc'?'glyphicon-sort-by-alphabet':'glyphicon-sort-by-alphabet-alt'):'' }}">
                </i>
            </td>
            <td>
                Action
            </td>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            @foreach($projects as $project)
                @if((Auth::user()->position == 'Project Coordinator' && $project->user_id == Auth::user()->id) || Auth::user()->position != 'Project Coordinator')
                    <tr onclick="javascript:window.location.href='{{ url('report?id='.$project->id) }}'">
                        <td>{{ $i++ }}</td>
                        <td><img src='{{ $project->icon_path }}' width='90px' height="90px" class="img-responsive" alt="" /></td>
                        <td class="text-left">{{ $project->name }}</td>
                        <td>{{ $project->updated_at }}</td>
                        <td>{{ $project->status }}</td>
                        <td><a href="{{ url('report?id='.$project->id) }}">View Report</a></td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
    <p>
        Total Data : {{ $total }}
        <div class="pull-right">{!! str_replace('/?','?',$projects->render()) !!}</div>
    </p>
</div>
<script>
    $('.pagination a').on('click', function (event) {
        event.preventDefault();
        ajaxLoad($(this).attr('href'),'data');
    });
</script>
