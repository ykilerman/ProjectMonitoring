<ul>
@foreach($answers as $answer)
    <li><a name="answer{{ $answer->id }}"><h4><?= $answer->text ?> <small> - {{ $answer->user->name }}, {{ date_format($answer->created_at,'d/m/y H:i') }}</small></h4></a></li>
@endforeach
    <li><a href="{{ url('answer/new?id='.$question_id) }}">New Answer</a></li>
</ul>