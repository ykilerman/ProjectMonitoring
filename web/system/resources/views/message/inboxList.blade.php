<style>
    tbody tr:hover{
        cursor: pointer;
    }
</style>
<div class="table-responsive">
    <table class="table table-bordered table-striped table-hover text-center">
        <thead>
            <td>
                Time
            </td>
            <td>
                From
            </td>
            <td>
                Subject
            </td>
            <td>
                Action
            </td>
        </thead>
        <tbody>
            @foreach($messages as $message)
                <tr onclick="javascript:window.location.href='{{ url('message/detail?id='.$message->id) }}'">
                    <td>{{ $message->message->updated_at }}</td>
                    <td>{{ $message->message->user->name }}</td>
                    <td>{{ $message->message->subject }}</td>
                    <td><a href="{{ url('message/detail?id='.$message->id) }}">View Detail</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <p>
        Total Data : {{ $total }}
        <div class="pull-right">{!! str_replace('/?','?',$messages->render()) !!}</div>
    </p>
</div>
<script>
    $('.pagination a').on('click', function (event) {
        event.preventDefault();
        ajaxLoad($(this).attr('href'),'data');
    });
</script>
