<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Project;
use App\Question;
use Input;
use Auth;
use Redirect;

class QuestionController extends Controller
{
    public function getIndex()
    {
        $questions = Question::where('project_id',Input::get('id'))
            ->orderBy('created_at','desc')
            ->get();
        return view('question.index')->with('questions',$questions);
    }
    public function getNew()
    {
        $project = Project::find(Input::get('id'));
        return view('question.newQuestion')->with('project',$project);
    }
    public function postNew()
    {
        $question = Question::create([
            'user_id' => Auth::user()->id, 
            'project_id' => Input::get('project_id'), 
            'text' => Input::get('text'),
        ]);
        if ($question)
        {
            return Redirect::to('project/detail?id='.$question->project_id)->with('message','Question is created.');
        }
        else
        {
            return Redirect::to('question/new')->with('message','Creating question is failed.');
        }
    }
    public function getList()
    {
        $questions = Question::where('project_id',Input::get('project_id'))
            ->orderBy('created_at','DESC')
            ->get();
        return view('question.list')->with('questions',$questions);
    }
    public function getListnoedit()
    {
        $questions = Question::where('project_id',Input::get('project_id'))
            ->orderBy('created_at','DESC')
            ->get();
        return view('question.listNoEdit')->with('questions',$questions);
    }
}
