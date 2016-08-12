<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\ValidateProjectAdd;
use App\Project;
use App\User;
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
    public function getCreate()
    {
        return view('project.admin_create');
    }
    public function postCreate(ValidateProjectAdd $validasi)
    {
        Project::create([
            'name' => Input::get('name'),
            'user_id' => Input::get('user_id'),
            'icon_path' => Input::get('icon_path'),
            'description' => Input::get('description'),
            'client_name' => Input::get('client_name'),
            'value' => Input::get('value'),
            'update_schedule' => Input::get('update_schedule'),
        ]);
        return "Create project " . Input::get('name') . " is success.";
    }
    public function getUserlistselect()
    {
        $users = User::orderBy('name','asc')->get();
        return view('project.userListSelect')
            ->with('users',$users);
    }
}
