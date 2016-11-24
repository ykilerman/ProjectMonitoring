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
            <?php 
                $i = 1;
                $income = 0;
                $expense = 0;
            ?>
            @foreach($reports as $report)
                <tr onclick="javascript:window.location.href='{{ url('report/detail?id='.$report->id) }}'">
                    <td>{{ $i++ }}</td>
                    <td>{{ $report->created_at }}</td>
                    <td>{{ $report->project->name }}</td>
                    <td>{{ $report->highlight }}</td>
                    <td>{{ $report->income }}</td>
                    <td>{{ $report->expense }}</td>
                    <td>
                        <a href="{{ url('report/detail?id='.$report->id) }}" class="btn btn-sm btn-danger">View Detail</a>
                    </td>
                </tr>
                <?php
                    $income += $report->income;
                    $expense += $report->expense;
                ?>
            @endforeach
        </tbody>
        <tfoot>
            <td colspan="4"><div class="pull-right">Total</div></td>
            <td>{{ $income }}</td>
            <td>{{ $expense }}</td>
            <td></td>
        </tfoot>
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
