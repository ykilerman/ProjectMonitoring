<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\ProjectCreateRequest;
use App\Http\Requests\ProjectEditRequest;
use App\Project;
use App\User;
use App\Report;
use Auth;
use Input;
use Redirect;
use Storage;
use Session;

class ReportController extends Controller
{
    public function getIndex()
    {
        if (Auth::user())
        {
            if (Input::has('id'))
            {
                $project = Project::find(Input::get('id'));
                return view('report.project')->with('project',$project);
            }
            else
            {
                return view('report.projects');
            }
        }
        else
        {
            return Redirect::to('login');
        }
    }
    public function getListproject()
    {
        Session::put('project_search', Input::has('ok') ? Input::get('search') : (Session::has('project_search') ? Session::get('project_search') : ''));
        Session::put('project_field', Input::has('field') ? Input::get('field') : (Session::has('project_field') ? Session::get('project_field') : 'name'));
        Session::put('project_sort', Input::has('sort') ? Input::get('sort') : (Session::has('project_sort') ? Session::get('project_sort') : 'asc'));
        $projects = Project::where('name', 'like', '%' . Session::get('project_search') . '%')
            ->orderBy(Session::get('project_field'), Session::get('project_sort'))
            ->paginate(6);
        $total = Project::where('name', 'like', '%' . Session::get('project_search') . '%')
            ->count();
        return view('report.listproject')
            ->with('projects',$projects)
            ->with('total',$total);
    }
    public function getListreport()
    {
        Session::put('report_search', Input::has('ok') ? Input::get('search') : (Session::has('report_search') ? Session::get('report_search') : ''));
        Session::put('report_field', Input::has('field') ? Input::get('field') : (Session::has('report_field') ? Session::get('report_field') : 'id'));
        Session::put('report_sort', Input::has('sort') ? Input::get('sort') : (Session::has('report_sort') ? Session::get('report_sort') : 'desc'));
        $reports = Report::where('project_id', Input::get('id'))
            ->orderBy(Session::get('report_field'), Session::get('report_sort'))
            ->paginate(6);
        $total = Report::where('project_id', Input::get('id'))
            ->count();
        return view('report.listreport')
            ->with('project_id',Input::get('id'))
            ->with('reports',$reports)
            ->with('total',$total);
    }
    public function getMonth()
    {
        if (Auth::user())
        {
            return view('report.month');
        }
        else
        {
            return Redirect::to('login');
        }
    }
    public function getListmonth()
    {
        Session::put('report_field','id');
        Session::put('report_field', Input::has('field') ? Input::get('field') : (Session::has('report_field') ? Session::get('report_field') : 'id'));
        Session::put('report_sort', Input::has('sort') ? Input::get('sort') : (Session::has('report_sort') ? Session::get('report_sort') : 'desc'));
        $reports = Report::orderBy(Session::get('report_field'), Session::get('report_sort'))
            ->paginate(6);
        $total = Report::count();
        return view('report.listmonth')
            ->with('reports',$reports)
            ->with('total',$total);
    }
    public function getQuarterly()
    {
        if (Auth::user())
        {
            return view('report.quarterly');
        }
        else
        {
            return Redirect::to('login');
        }
    }
    public function getAnnual()
    {
        if (Auth::user())
        {
            return view('report.annual');
        }
        else
        {
            return Redirect::to('login');
        }
    }
    public function getProject()
    {
        $project = Project::find(Input::get('id'));
        return view('report.project')->with('project',$project);
    }
    public function getDetail()
    {
        $report = Report::find(Input::get('id'));
        return view('report.detail')->with('report',$report);
    }
    public function getCreate()
    {
        $project = Project::find(Input::get('id'));
        return view('report.create')->with('project',$project);
    }
    public function postCreate(Request $request, ProjectCreateRequest $valid)
    {

    }
    public function getEdit()
    {
        $report = Report::find(Input::get('id'));
        return view('report.edit')->with('report',$report);
    }
    public function postEdit()
    {

    }
}
