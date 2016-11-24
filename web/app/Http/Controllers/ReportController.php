<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\ReportCreateRequest;
use App\Http\Requests\ReportUpdateRequest;
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
            Session::put('report_month', Input::has('month') ? count(Input::get('month')) == '1' ? '0'.Input::get('month') : Input::get('month') : (Session::has('report_month') ? Session::get('report_month') : date('m')));
            Session::put('report_year', Input::has('year') ? Input::get('year') : (Session::has('report_year') ? Session::get('report_year') : date('Y')));
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
            Session::put('report_quarter', Input::has('quarter') ? Input::get('quarter') : (Session::has('report_quarter') ? Session::get('report_quarter') : date('m') == '01' || date('m') == '02' || date('m') == '03' ? '0' : date('m') == '04' || date('m') == '05' || date('m') == '06' ? '1' : date('m') == '07' || date('m') == '08' || date('m') == '09' ? '2' : '3'));
            Session::put('report_year', Input::has('year') ? Input::get('year') : (Session::has('report_year') ? Session::get('report_year') : date('Y')));
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
            Session::put('report_year', Input::has('year') ? Input::get('year') : (Session::has('report_year') ? Session::get('report_year') : date('Y')));
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
        if($valid)
        {
            if($request->hasFile('activity_path') && $request->file('activity_path')->isValid())
            {
                if($request->hasFile('income_path') && $request->file('income_path')->isValid())
                {
                    if($request->hasFile('expense_path') && $request->file('expense_path')->isValid())
                    {
                        $now = new \DateTime();
                        $now->createFromFormat('U.u',microtime(true));
                        $name = $now->format('YmdHis');

                        $report = Report::create([
                            'project_id' => Input::get('project_id'), 
                            'highlight' => Input::get('highlight'), 
                            'activity' => Input::get('activity'), 
                            'activity_path' => 'images/evidence/activity'.$name.'.jpg', 
                            'income' => Input::get('income'), 
                            'income_path' => 'images/evidence/income'.$name.'.jpg', 
                            'expense' => Input::get('expense'), 
                            'expense_path' => 'images/evidence/expense'.$name.'.jpg', 
                        ]);
                        if ($report)
                        {
                            $report->activity_path = 'images/evidence/activity'.$report->id.'-'.$name.'.jpg';
                            Storage::put(
                                $report->activity_path,
                                file_get_contents($request->file('activity_path')->getRealPath())
                            );
                            $report->activity_path = ($_SERVER['SERVER_NAME'] == 'localhost') ? "http://".$_SERVER['SERVER_NAME'] . "/projectmonitoring/web/storage/app/" . $report->activity_path : "http://".$_SERVER['SERVER_NAME'] . "/pm/storage/app/" . $report->activity_path;
                            
                            $report->income_path = 'images/evidence/income'.$report->id.'-'.$name.'.jpg';
                            Storage::put(
                                $report->income_path,
                                file_get_contents($request->file('income_path')->getRealPath())
                            );
                            $report->income_path = ($_SERVER['SERVER_NAME'] == 'localhost') ? "http://".$_SERVER['SERVER_NAME'] . "/projectmonitoring/web/storage/app/" . $report->income_path : "http://".$_SERVER['SERVER_NAME'] . "/pm/storage/app/" . $report->income_path;
                            
                            $report->expense_path = 'images/evidence/expense'.$report->id.'-'.$name.'.jpg';
                            Storage::put(
                                $report->expense_path,
                                file_get_contents($request->file('expense_path')->getRealPath())
                            );
                            $report->expense_path = ($_SERVER['SERVER_NAME'] == 'localhost') ? "http://".$_SERVER['SERVER_NAME'] . "/projectmonitoring/web/storage/app/" . $report->expense_path : "http://".$_SERVER['SERVER_NAME'] . "/pm/storage/app/" . $report->expense_path;
                            
                            $report->save();
                            return Redirect::to('report?id='.Input::get('project_id'))->with('message',"The report is created.");
                        }
                        else
                            return Redirect::to('report/create?id='.Input::get('project_id'))->with('message','Creating report is failed.');
                    }
                    else if(!$request->hasFile('expense_path'))
                    {
                        $now = new \DateTime();
                        $now->createFromFormat('U.u',microtime(true));
                        $name = $now->format('YmdHis');

                        $report = Report::create([
                            'project_id' => Input::get('project_id'), 
                            'highlight' => Input::get('highlight'), 
                            'activity' => Input::get('activity'), 
                            'activity_path' => 'images/evidence/activity'.$name.'.jpg', 
                            'income' => Input::get('income'), 
                            'income_path' => 'images/evidence/income'.$name.'.jpg', 
                            'expense' => '0', 
                            'expense_path' => null, 
                        ]);
                        if ($report)
                        {
                            $report->activity_path = 'images/evidence/activity'.$report->id.'-'.$name.'.jpg';
                            Storage::put(
                                $report->activity_path,
                                file_get_contents($request->file('activity_path')->getRealPath())
                            );
                            $report->activity_path = ($_SERVER['SERVER_NAME'] == 'localhost') ? "http://".$_SERVER['SERVER_NAME'] . "/projectmonitoring/web/storage/app/" . $report->activity_path : "http://".$_SERVER['SERVER_NAME'] . "/pm/storage/app/" . $report->activity_path;
                            
                            $report->income_path = 'images/evidence/income'.$report->id.'-'.$name.'.jpg';
                            Storage::put(
                                $report->income_path,
                                file_get_contents($request->file('income_path')->getRealPath())
                            );
                            $report->income_path = ($_SERVER['SERVER_NAME'] == 'localhost') ? "http://".$_SERVER['SERVER_NAME'] . "/projectmonitoring/web/storage/app/" . $report->income_path : "http://".$_SERVER['SERVER_NAME'] . "/pm/storage/app/" . $report->income_path;
                            
                            $report->save();
                            return Redirect::to('report?id='.Input::get('project_id'))->with('message',"The report is created.");
                        }
                        else
                            return Redirect::to('report/create?id='.Input::get('project_id'))->with('message','Creating report is failed.');
                    }
                    else
                        return Redirect::to('report/create?id='.Input::get('project_id'))->with('message','Expense evidence is invalid.');
                }
                else if(!$request->hasFile('income_path'))
                {
                    if($request->hasFile('expense_path') && $request->file('expense_path')->isValid())
                    {
                        $now = new \DateTime();
                        $now->createFromFormat('U.u',microtime(true));
                        $name = $now->format('YmdHis');

                        $report = Report::create([
                            'project_id' => Input::get('project_id'), 
                            'highlight' => Input::get('highlight'), 
                            'activity' => Input::get('activity'), 
                            'activity_path' => 'images/evidence/activity'.$name.'.jpg', 
                            'income' => '0', 
                            'income_path' => null, 
                            'expense' => Input::get('expense'), 
                            'expense_path' => 'images/evidence/expense'.$name.'.jpg', 
                        ]);
                        if ($report)
                        {
                            $report->activity_path = 'images/evidence/activity'.$report->id.'-'.$name.'.jpg';
                            Storage::put(
                                $report->activity_path,
                                file_get_contents($request->file('activity_path')->getRealPath())
                            );
                            $report->activity_path = ($_SERVER['SERVER_NAME'] == 'localhost') ? "http://".$_SERVER['SERVER_NAME'] . "/projectmonitoring/web/storage/app/" . $report->activity_path : "http://".$_SERVER['SERVER_NAME'] . "/pm/storage/app/" . $report->activity_path;
                            
                            $report->expense_path = 'images/evidence/expense'.$report->id.'-'.$name.'.jpg';
                            Storage::put(
                                $report->expense_path,
                                file_get_contents($request->file('expense_path')->getRealPath())
                            );
                            $report->expense_path = ($_SERVER['SERVER_NAME'] == 'localhost') ? "http://".$_SERVER['SERVER_NAME'] . "/projectmonitoring/web/storage/app/" . $report->expense_path : "http://".$_SERVER['SERVER_NAME'] . "/pm/storage/app/" . $report->expense_path;
                            
                            $report->save();
                            return Redirect::to('report?id='.Input::get('project_id'))->with('message',"The report is created.");
                        }
                        else
                            return Redirect::to('report/create?id='.Input::get('project_id'))->with('message','Creating report is failed.');
                    }
                    else if(!$request->hasFile('expense_path'))
                    {
                        $now = new \DateTime();
                        $now->createFromFormat('U.u',microtime(true));
                        $name = $now->format('YmdHis');

                        $report = Report::create([
                            'project_id' => Input::get('project_id'), 
                            'highlight' => Input::get('highlight'), 
                            'activity' => Input::get('activity'), 
                            'activity_path' => 'images/evidence/activity'.$name.'.jpg', 
                            'income' => '0', 
                            'income_path' => null, 
                            'expense' => '0', 
                            'expense_path' => null, 
                        ]);
                        if ($report)
                        {
                            $report->activity_path = 'images/evidence/activity'.$report->id.'-'.$name.'.jpg';
                            Storage::put(
                                $report->activity_path,
                                file_get_contents($request->file('activity_path')->getRealPath())
                            );
                            $report->activity_path = ($_SERVER['SERVER_NAME'] == 'localhost') ? "http://".$_SERVER['SERVER_NAME'] . "/projectmonitoring/web/storage/app/" . $report->activity_path : "http://".$_SERVER['SERVER_NAME'] . "/pm/storage/app/" . $report->activity_path;
                            
                            $report->save();
                            return Redirect::to('report?id='.Input::get('project_id'))->with('message',"The report is created.");
                        }
                        else
                            return Redirect::to('report/create?id='.Input::get('project_id'))->with('message','Creating report is failed.');
                    }
                    else
                        return Redirect::to('report/create?id='.Input::get('project_id'))->with('message','Expense evidence is invalid.');
                }
                else
                    return Redirect::to('report/create?id='.Input::get('project_id'))->with('message','Income evidence is invalid.');
            }
            else
                return Redirect::to('report/create?id='.Input::get('project_id'))->with('message','Activity evidence is invalid.');
        }
        return Redirect::to('report/create?id='.Input::get('project_id'))->with('message','The information is invalid.');
    }
    public function getEdit()
    {
        $report = Report::find(Input::get('id'));
        return view('report.edit')->with('report',$report);
    }
    public function postEdit(Request $request, ReportUpdateRequest $valid)
    {
        if($valid)
        {
            $report = Report::find(Input::get('id'));
            
            $report->highlight = Input::get('highlight');
            $report->activity = Input::get('activity');
            $report->income = Input::get('income');
            $report->expense = Input::get('expense');
            
            if($request->hasFile('activity_path') && $request->file('activity_path')->isValid())
            {
                $now = new \DateTime();
                $now->createFromFormat('U.u',microtime(true));
                $name = $now->format('YmdHis');
                
                $report->activity_path = 'images/evidence/activity'.$report->id.'-'.$name.'.jpg';
                Storage::put(
                    $report->activity_path,
                    file_get_contents($request->file('activity_path')->getRealPath())
                );
                $report->activity_path = ($_SERVER['SERVER_NAME'] == 'localhost') ? "http://".$_SERVER['SERVER_NAME'] . "/projectmonitoring/web/storage/app/" . $report->activity_path : "http://".$_SERVER['SERVER_NAME'] . "/pm/storage/app/" . $report->activity_path;
                
                if($request->hasFile('income_path') && $request->file('income_path')->isValid())
                {
                    $report->income_path = 'images/evidence/income'.$report->id.'-'.$name.'.jpg';
                    Storage::put(
                        $report->income_path,
                        file_get_contents($request->file('income_path')->getRealPath())
                    );
                    $report->income_path = ($_SERVER['SERVER_NAME'] == 'localhost') ? "http://".$_SERVER['SERVER_NAME'] . "/projectmonitoring/web/storage/app/" . $report->income_path : "http://".$_SERVER['SERVER_NAME'] . "/pm/storage/app/" . $report->income_path;

                    if($request->hasFile('expense_path') && $request->file('expense_path')->isValid())
                    {
                        $report->expense_path = 'images/evidence/expense'.$report->id.'-'.$name.'.jpg';
                        Storage::put(
                            $report->expense_path,
                            file_get_contents($request->file('expense_path')->getRealPath())
                        );
                        $report->expense_path = ($_SERVER['SERVER_NAME'] == 'localhost') ? "http://".$_SERVER['SERVER_NAME'] . "/projectmonitoring/web/storage/app/" . $report->expense_path : "http://".$_SERVER['SERVER_NAME'] . "/pm/storage/app/" . $report->expense_path;

                        if($report->save())
                            return Redirect::to('report?id='.Input::get('project_id'))->with('message',"The report is edited.");
                        else
                            return Redirect::to('report/edit?id='.Input::get('project_id'))->with('message','Editing report is failed.');
                    }
                    else if(!$request->hasFile('expense_path'))
                    {
                        if($report->save())
                            return Redirect::to('report?id='.Input::get('project_id'))->with('message',"The report is edited.");
                        else
                            return Redirect::to('report/edit?id='.Input::get('project_id'))->with('message','Editing report is failed.');
                    }
                    else
                        return Redirect::to('report/edit?id='.Input::get('project_id'))->with('message','Expense evidence is invalid.');
                }
                else if(!$request->hasFile('income_path'))
                {
                    if($request->hasFile('expense_path') && $request->file('expense_path')->isValid())
                    {
                        $report->expense_path = 'images/evidence/expense'.$report->id.'-'.$name.'.jpg';
                        Storage::put(
                            $report->expense_path,
                            file_get_contents($request->file('expense_path')->getRealPath())
                        );
                        $report->expense_path = ($_SERVER['SERVER_NAME'] == 'localhost') ? "http://".$_SERVER['SERVER_NAME'] . "/projectmonitoring/web/storage/app/" . $report->expense_path : "http://".$_SERVER['SERVER_NAME'] . "/pm/storage/app/" . $report->expense_path;

                        if($report->save())
                            return Redirect::to('report?id='.Input::get('project_id'))->with('message',"The report is edited.");
                        else
                            return Redirect::to('report/edit?id='.Input::get('project_id'))->with('message','Editing report is failed.');
                    }
                    else if(!$request->hasFile('expense_path'))
                    {
                        if($report->save())
                            return Redirect::to('report?id='.Input::get('project_id'))->with('message',"The report is edited.");
                        else
                            return Redirect::to('report/edit?id='.Input::get('project_id'))->with('message','Editing report is failed.');
                    }
                    else
                        return Redirect::to('report/edit?id='.Input::get('project_id'))->with('message','Expense evidence is invalid.');
                }
                else
                    return Redirect::to('report/create?id='.Input::get('project_id'))->with('message','Income evidence is invalid.');
            }
            else if(!$request->hasFile('activity_path'))
            {
                if($request->hasFile('income_path') && $request->file('income_path')->isValid())
                {
                    $now = new \DateTime();
                    $now->createFromFormat('U.u',microtime(true));
                    $name = $now->format('YmdHis');

                    $report->income_path = 'images/evidence/income'.$report->id.'-'.$name.'.jpg';
                    Storage::put(
                        $report->income_path,
                        file_get_contents($request->file('income_path')->getRealPath())
                    );
                    $report->income_path = ($_SERVER['SERVER_NAME'] == 'localhost') ? "http://".$_SERVER['SERVER_NAME'] . "/projectmonitoring/web/storage/app/" . $report->income_path : "http://".$_SERVER['SERVER_NAME'] . "/pm/storage/app/" . $report->income_path;

                    if($request->hasFile('expense_path') && $request->file('expense_path')->isValid())
                    {
                        $report->expense_path = 'images/evidence/expense'.$report->id.'-'.$name.'.jpg';
                        Storage::put(
                            $report->expense_path,
                            file_get_contents($request->file('expense_path')->getRealPath())
                        );
                        $report->expense_path = ($_SERVER['SERVER_NAME'] == 'localhost') ? "http://".$_SERVER['SERVER_NAME'] . "/projectmonitoring/web/storage/app/" . $report->expense_path : "http://".$_SERVER['SERVER_NAME'] . "/pm/storage/app/" . $report->expense_path;

                        if($report->save())
                            return Redirect::to('report?id='.Input::get('project_id'))->with('message',"The report is edited.");
                        else
                            return Redirect::to('report/edit?id='.Input::get('project_id'))->with('message','Editing report is failed.');
                    }
                    else if(!$request->hasFile('expense_path'))
                    {
                        if($report->save())
                            return Redirect::to('report?id='.Input::get('project_id'))->with('message',"The report is edited.");
                        else
                            return Redirect::to('report/edit?id='.Input::get('project_id'))->with('message','Editing report is failed.');
                    }
                    else
                        return Redirect::to('report/edit?id='.Input::get('project_id'))->with('message','Expense evidence is invalid.');
                }
                else if(!$request->hasFile('income_path'))
                {
                    $now = new \DateTime();
                    $now->createFromFormat('U.u',microtime(true));
                    $name = $now->format('YmdHis');

                    if($request->hasFile('expense_path') && $request->file('expense_path')->isValid())
                    {
                        $report->expense_path = 'images/evidence/expense'.$report->id.'-'.$name.'.jpg';
                        Storage::put(
                            $report->expense_path,
                            file_get_contents($request->file('expense_path')->getRealPath())
                        );
                        $report->expense_path = ($_SERVER['SERVER_NAME'] == 'localhost') ? "http://".$_SERVER['SERVER_NAME'] . "/projectmonitoring/web/storage/app/" . $report->expense_path : "http://".$_SERVER['SERVER_NAME'] . "/pm/storage/app/" . $report->expense_path;

                        if($report->save())
                            return Redirect::to('report?id='.Input::get('project_id'))->with('message',"The report is edited.");
                        else
                            return Redirect::to('report/edit?id='.Input::get('project_id'))->with('message','Editing report is failed.');
                    }
                    else if(!$request->hasFile('expense_path'))
                    {
                        if($report->save())
                            return Redirect::to('report?id='.Input::get('project_id'))->with('message',"The report is edited.");
                        else
                            return Redirect::to('report/edit?id='.Input::get('project_id'))->with('message','Editing report is failed.');
                    }
                    else
                        return Redirect::to('report/edit?id='.Input::get('project_id'))->with('message','Expense evidence is invalid.');
                }
                else
                    return Redirect::to('report/create?id='.Input::get('project_id'))->with('message','Income evidence is invalid.');
            }
            else
                return Redirect::to('report/create?id='.Input::get('project_id'))->with('message','Activity evidence is invalid.');
        }
        return Redirect::to('report/create?id='.Input::get('project_id'))->with('message','The information is invalid.');
    }
}
