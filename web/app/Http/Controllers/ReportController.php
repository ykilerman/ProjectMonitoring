<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\ReportCreateRequest;
use App\Http\Requests\ReportEditRequest;
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
        Session::put('report_month', Input::has('month') ? count(Input::get('month')) == '1' ? '0'.Input::get('month') : Input::get('month') : (Session::has('report_month') ? Session::get('report_month') : date('m')));
        Session::put('report_year', Input::has('year') ? Input::get('year') : (Session::has('report_year') ? Session::get('report_year') : date('Y')));
        Session::put('report_field', Input::has('field') ? Input::get('field') : (Session::has('report_field') ? Session::get('report_field') : 'id'));
        Session::put('report_sort', Input::has('sort') ? Input::get('sort') : (Session::has('report_sort') ? Session::get('report_sort') : 'desc'));
        $reports = Report::where('updated_at','like',Session::get('report_year').'-'.Session::get('report_month').'-%')
            ->orderBy(Session::get('report_field'), Session::get('report_sort'))
            ->paginate(6);
        $total = Report::where('updated_at','like',Session::get('report_year').'-'.Session::get('report_month').'-%')
            ->count();
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
    public function getListquarterly()
    {
        Session::put('report_quarter', Input::has('quarter') ? Input::get('quarter') : (Session::has('report_quarter') ? Session::get('report_quarter') : date('m') == '01' || date('m') == '02' || date('m') == '03' ? '0' : date('m') == '04' || date('m') == '05' || date('m') == '06' ? '1' : date('m') == '07' || date('m') == '08' || date('m') == '09' ? '2' : '3'));
        Session::put('report_year', Input::has('year') ? Input::get('year') : (Session::has('report_year') ? Session::get('report_year') : date('Y')));
        Session::put('report_field', Input::has('field') ? Input::get('field') : (Session::has('report_field') ? Session::get('report_field') : 'id'));
        Session::put('report_sort', Input::has('sort') ? Input::get('sort') : (Session::has('report_sort') ? Session::get('report_sort') : 'desc'));
        if (Session::get('report_quarter') == '0')
        {
            $reports = Report::where('updated_at','like',Session::get('report_year').'-01-%')
                ->orWhere('updated_at','like',Session::get('report_year').'-02-%')
                ->orWhere('updated_at','like',Session::get('report_year').'-03-%')
                ->orderBy(Session::get('report_field'), Session::get('report_sort'))
                ->paginate(6);
            $total = Report::where('updated_at','like',Session::get('report_year').'-01-%')
                ->orWhere('updated_at','like',Session::get('report_year').'-02-%')
                ->orWhere('updated_at','like',Session::get('report_year').'-03-%')
                ->count();
            return view('report.listquarterly')
                ->with('reports',$reports)
                ->with('total',$total);
        }
        else if (Session::get('report_quarter') == '1')
        {
            $reports = Report::where('updated_at','like',Session::get('report_year').'-04-%')
                ->orWhere('updated_at','like',Session::get('report_year').'-05-%')
                ->orWhere('updated_at','like',Session::get('report_year').'-06-%')
                ->orderBy(Session::get('report_field'), Session::get('report_sort'))
                ->paginate(6);
            $total = Report::where('updated_at','like',Session::get('report_year').'-04-%')
                ->orWhere('updated_at','like',Session::get('report_year').'-05-%')
                ->orWhere('updated_at','like',Session::get('report_year').'-06-%')
                ->count();
            return view('report.listquarterly')
                ->with('reports',$reports)
                ->with('total',$total);
        }
        else if (Session::get('report_quarter') == '2')
        {
            $reports = Report::where('updated_at','like',Session::get('report_year').'-07-%')
                ->orWhere('updated_at','like',Session::get('report_year').'-08-%')
                ->orWhere('updated_at','like',Session::get('report_year').'-09-%')
                ->orderBy(Session::get('report_field'), Session::get('report_sort'))
                ->paginate(6);
            $total = Report::where('updated_at','like',Session::get('report_year').'-07-%')
                ->orWhere('updated_at','like',Session::get('report_year').'-08-%')
                ->orWhere('updated_at','like',Session::get('report_year').'-09-%')
                ->count();
            return view('report.listquarterly')
                ->with('reports',$reports)
                ->with('total',$total);
        }
        else if (Session::get('report_quarter') == '3')
        {
            $reports = Report::where('updated_at','like',Session::get('report_year').'-10-%')
                ->orWhere('updated_at','like',Session::get('report_year').'-11-%')
                ->orWhere('updated_at','like',Session::get('report_year').'-12-%')
                ->orderBy(Session::get('report_field'), Session::get('report_sort'))
                ->paginate(6);
            $total = Report::where('updated_at','like',Session::get('report_year').'-10-%')
                ->orWhere('updated_at','like',Session::get('report_year').'-11-%')
                ->orWhere('updated_at','like',Session::get('report_year').'-12-%')
                ->count();
            return view('report.listquarterly')
                ->with('reports',$reports)
                ->with('total',$total);
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
    public function getListannual()
    {
        Session::put('report_year', Input::has('year') ? Input::get('year') : (Session::has('report_year') ? Session::get('report_year') : date('Y')));
        Session::put('report_field', Input::has('field') ? Input::get('field') : (Session::has('report_field') ? Session::get('report_field') : 'id'));
        Session::put('report_sort', Input::has('sort') ? Input::get('sort') : (Session::has('report_sort') ? Session::get('report_sort') : 'desc'));
        $reports = Report::where('updated_at','like',Session::get('report_year').'-%')
            ->orderBy(Session::get('report_field'), Session::get('report_sort'))
            ->paginate(6);
        $total = Report::where('updated_at','like',Session::get('report_year').'-%')
            ->count();
        return view('report.listmonth')
            ->with('reports',$reports)
            ->with('total',$total);
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
    public function postCreate(Request $request, ReportCreateRequest $valid)
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
