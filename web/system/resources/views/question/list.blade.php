<style>
    h4.question {
        border-bottom: 1px solid silver;
        display: inline;
    }
</style>
@foreach($questions as $question)
    <a name="question{{ $question->id }}"><h4 class="question"><b><?= $question->text ?> </b><small> - {{ $question->user->name }}, {{ date_format($question->created_at,'d/m/y H:i') }}</small></h4></a>
    <div id="answer{{ $question->id }}"></div>
    <script>
        ajaxLoad("{{ url('answer/list?question_id='.$question->id) }}",'answer{{ $question->id }}');
    </script>
@endforeach