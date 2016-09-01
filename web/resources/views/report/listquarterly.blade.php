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
                <a onclick="javascript:ajaxLoad('report/listquarterly?field=updated_at&sort={{Session::get("report_sort")=="asc"?"desc":"asc"}}','data')" href="#">
                    Time
                </a>
                <i style="font-size: 12px"
                   class="glyphicon {{ Session::get('report_field')=='updated_at'?(Session::get('report_sort')=='asc'?'glyphicon-sort-by-alphabet':'glyphicon-sort-by-alphabet-alt'):'' }}">
                </i>
            </td>
            <td>
                <a onclick="javascript:ajaxLoad('report/listquarterly?field=name&sort={{Session::get("report_sort")=="asc"?"desc":"asc"}}','data')" href="#">
                    Project Name
                </a>
                <i style="font-size: 12px"
                   class="glyphicon {{ Session::get('report_field')=='updated_at'?(Session::get('report_sort')=='asc'?'glyphicon-sort-by-alphabet':'glyphicon-sort-by-alphabet-alt'):'' }}">
                </i>
            </td>
            <td>
                Highlight
            </td>
            <td>
                <a onclick="javascript:ajaxLoad('report/listquarterly?field=income&sort={{Session::get("report_sort")=="asc"?"desc":"asc"}}','data')" href="#">
                    Income
                </a>
                <i style="font-size: 12px"
                   class="glyphicon {{ Session::get('report_field')=='income'?(Session::get('report_sort')=='asc'?'glyphicon-sort-by-alphabet':'glyphicon-sort-by-alphabet-alt'):'' }}">
                </i>
            </td>
            <td>
                <a onclick="javascript:ajaxLoad('report/listquarterly?field=expense&sort={{Session::get("report_sort")=="asc"?"desc":"asc"}}','data')" href="#">
                    Expense
                </a>
                <i style="font-size: 12px"
                   class="glyphicon {{ Session::get('report_field')=='expense'?(Session::get('report_sort')=='asc'?'glyphicon-sort-by-alphabet':'glyphicon-sort-by-alphabet-alt'):'' }}">
                </i>
            </td>
            <td>
                Action
            </td>
        </thead>
        <tbody>
            <?php $i = 1 ?>
            @foreach($reports as $report)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $report->created_at }}</td>
                    <td>{{ $report->project->name }}</td>
                    <td>{{ $report->highlight }}</td>
                    <td>{{ $report->income }}</td>
                    <td>{{ $report->expense }}</td>
                    <td>
                        <button id="btnView" class="btn btn-sm btn-primary">View Detail</button>
                    </td>
                </tr>
            @endforeach
    </table>
    <p>
        Total Data : {{ $total }}
        <div class="pull-right">{!! str_replace('/?','?',$reports->render()) !!}</div>
    </p>
</div>
<script>
    $('.pagination a').on('click', function (event) {
        event.preventDefault();
        ajaxLoad($(this).attr('href'),'data');
    });
</script>
