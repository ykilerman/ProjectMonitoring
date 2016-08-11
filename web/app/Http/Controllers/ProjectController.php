<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Project;
use Auth;
use Input;
use Redirect;
use Session;

class ProjectController extends Controller
{
    public function getIndex()
    {
        if(Auth::user()->position == 'Project Admin' || Auth::user()->position == 'Project Coordinator')
        {
            return view('project.admin_read');
        }
        else
        {
            return view('project.stakeholder_read');
        }
    }
    public function getList()
    {
        Session::put('project_search', Input::has('ok') ? Input::get('search') : (Session::has('project_search') ? Session::get('project_search') : ''));
        Session::put('project_field', Input::has('field') ? Input::get('field') : (Session::has('project_field') ? Session::get('project_field') : 'name'));
        Session::put('project_sort', Input::has('sort') ? Input::get('sort') : (Session::has('project_sort') ? Session::get('project_sort') : 'asc'));
        $projects = Project::where('name', 'like', '%' . Session::get('project_search') . '%')
            ->orderBy(Session::get('project_field'), Session::get('project_sort'))
            ->paginate(6);
        $total = Project::where('name', 'like', '%' . Session::get('project_search') . '%')
            ->count();
        return view('project.admin_list')
            ->with('projects',$projects)
            ->with('total',$total);
    }
}
