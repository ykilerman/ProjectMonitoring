@foreach($notifications as $notification)
    @if($notification->table == 'projects')
        <li><a href="{{ url('project/detail?id='.$notification->table_id) }}">On Going Project</a></li>
    @elseif($notification->table == 'reports')
        <li><a href="{{ url('project/detail?id='.$notification->table_id) }}">On Going Project</a></li>
    @elseif($notification->table == 'questions')
        <li><a href="{{ url('project/detail?id='.$notification->table_id) }}">On Going Project</a></li>
    @elseif($notification->table == 'answers')
        <li><a href="{{ url('project/detail?id='.$notification->table_id) }}">On Going Project</a></li>
    @endif
@endforeach