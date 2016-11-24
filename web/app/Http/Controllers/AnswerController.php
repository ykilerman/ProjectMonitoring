<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Project;
use App\Question;
use App\Answer;
use Input;
use Auth;
use Redirect;

class AnswerController extends Controller
{
    public function getIndex()
    {
        $answers = Question::where('project_id',Input::get('id'))
            ->orderBy('created_at','desc')
            ->get();
        return view('answer.index')->with('answers',$answers);
    }
    public function getNew()
    {
        $question = Question::find(Input::get('id'));
        return view('answer.newAnswer')->with('question',$question);
    }
    public function postNew()
    {
        $answer = Answer::create([
            'user_id' => Auth::user()->id, 
            'question_id' => Input::get('question_id'), 
            'text' => Input::get('text'),
        ]);
        if ($answer)
        {
            return Redirect::to('project/detail?id='.$answer->question->project->id)->with('message','Answer is created.');
        }
        else
        {
            return Redirect::to('answer/new')->with('message','Creating answer is failed.');
        }
    }
    public function getList()
    {
        $answers = Answer::where('question_id',Input::get('question_id'))
            ->orderBy('created_at','DESC')
            ->get();
        return view('answer.list')->with('answers',$answers)
            ->with('question_id',Input::get('question_id'));
    }
    public function getListnoedit()
    {
        $answers = Answer::where('question_id',Input::get('question_id'))
            ->orderBy('created_at','DESC')
            ->get();
        return view('answer.listNoEdit')->with('answers',$answers)
            ->with('question_id',Input::get('question_id'));
    }
}
