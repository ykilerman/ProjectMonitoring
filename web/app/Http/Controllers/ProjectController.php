<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\ProjectCreateRequest;
use App\Http\Requests\ProjectEditRequest;
use App\Project;
use App\User;
use Auth;
use Input;
use Redirect;
use Storage;
use Session;

class ProjectController extends Controller
{
    public function getIndex()
    {
        if (Auth::user())
        {
            $list = 'list';
            if(Auth::user()->position == 'Project Admin' || Auth::user()->position == 'Project Coordinator')
            {
                return view('project.admin_read')->with('list',$list);
            }
            else
            {
                return view('project.stakeholder_read')->with('list',$list);
            }
        }
        else
        {
            return Redirect::to('login');
        }
    }
    public function getClosed()
    {
        if (Auth::user())
        {
            $list = 'listclosed';
            if(Auth::user()->position == 'Project Admin' || Auth::user()->position == 'Project Coordinator')
            {
                return view('project.admin_read')->with('list',$list);
            }
            else
            {
                return view('project.stakeholder_read')->with('list',$list);
            }
        }
        else
        {
            return Redirect::to('login');
        }
    }
    public function getArchived()
    {
        if (Auth::user())
        {
            $list = 'listarchived';
            if(Auth::user()->position == 'Project Admin' || Auth::user()->position == 'Project Coordinator')
            {
                return view('project.admin_read')->with('list',$list);
            }
            else
            {
                return view('project.stakeholder_read')->with('list',$list);
            }
        }
        else
        {
            return Redirect::to('login');
        }
    }
    public function getDeleted()
    {
        if (Auth::user())
        {
            $list = 'listdeleted';
            if(Auth::user()->position == 'Project Admin' || Auth::user()->position == 'Project Coordinator')
            {
                return view('project.admin_read')->with('list',$list);
            }
            else
            {
                return view('project.stakeholder_read')->with('list',$list);
            }
        }
        else
        {
            return Redirect::to('login');
        }
    }
    public function getList()
    {
        Session::put('project_search', Input::has('ok') ? Input::get('search') : (Session::has('project_search') ? Session::get('project_search') : ''));
        Session::put('project_field', Input::has('field') ? Input::get('field') : (Session::has('project_field') ? Session::get('project_field') : 'name'));
        Session::put('project_sort', Input::has('sort') ? Input::get('sort') : (Session::has('project_sort') ? Session::get('project_sort') : 'asc'));
        $projects = Project::where('name', 'like', '%' . Session::get('project_search') . '%')
            ->where('status','On Going')
            ->orderBy(Session::get('project_field'), Session::get('project_sort'))
            ->paginate(6);
        $total = Project::where('name', 'like', '%' . Session::get('project_search') . '%')
            ->where('status','On Going')
            ->count();
        return view('project.admin_list')
            ->with('projects',$projects)
            ->with('total',$total);
    }
    public function getListclosed()
    {
        Session::put('project_search', Input::has('ok') ? Input::get('search') : (Session::has('project_search') ? Session::get('project_search') : ''));
        Session::put('project_field', Input::has('field') ? Input::get('field') : (Session::has('project_field') ? Session::get('project_field') : 'name'));
        Session::put('project_sort', Input::has('sort') ? Input::get('sort') : (Session::has('project_sort') ? Session::get('project_sort') : 'asc'));
        $projects = Project::where('name', 'like', '%' . Session::get('project_search') . '%')
            ->where('status','Closed')
            ->orderBy(Session::get('project_field'), Session::get('project_sort'))
            ->paginate(6);
        $total = Project::where('name', 'like', '%' . Session::get('project_search') . '%')
            ->where('status','Closed')
            ->count();
        return view('project.admin_list')
            ->with('projects',$projects)
            ->with('total',$total);
    }
    public function getListarchived()
    {
        Session::put('project_search', Input::has('ok') ? Input::get('search') : (Session::has('project_search') ? Session::get('project_search') : ''));
        Session::put('project_field', Input::has('field') ? Input::get('field') : (Session::has('project_field') ? Session::get('project_field') : 'name'));
        Session::put('project_sort', Input::has('sort') ? Input::get('sort') : (Session::has('project_sort') ? Session::get('project_sort') : 'asc'));
        $projects = Project::where('name', 'like', '%' . Session::get('project_search') . '%')
            ->where('status','Archived')
            ->orderBy(Session::get('project_field'), Session::get('project_sort'))
            ->paginate(6);
        $total = Project::where('name', 'like', '%' . Session::get('project_search') . '%')
            ->where('status','Archived')
            ->count();
        return view('project.admin_list')
            ->with('projects',$projects)
            ->with('total',$total);
    }
    public function getListdeleted()
    {
        Session::put('project_search', Input::has('ok') ? Input::get('search') : (Session::has('project_search') ? Session::get('project_search') : ''));
        Session::put('project_field', Input::has('field') ? Input::get('field') : (Session::has('project_field') ? Session::get('project_field') : 'name'));
        Session::put('project_sort', Input::has('sort') ? Input::get('sort') : (Session::has('project_sort') ? Session::get('project_sort') : 'asc'));
        $projects = Project::where('name', 'like', '%' . Session::get('project_search') . '%')
            ->where('status','Deleted')
            ->orderBy(Session::get('project_field'), Session::get('project_sort'))
            ->paginate(6);
        $total = Project::where('name', 'like', '%' . Session::get('project_search') . '%')
            ->where('status','Deleted')
            ->count();
        return view('project.admin_list')
            ->with('projects',$projects)
            ->with('total',$total);
    }
    public function getCreate()
    {
        $users = User::where('position','=','Project Coordinator')
            ->orderBy('name','asc')->get();
        return view('project.admin_create')->with('users',$users);
    }
    public function postCreate(Request $request, ProjectCreateRequest $valid)
    {
        if($valid)
        {
            if($request->hasFile('icon_path') && $request->file('icon_path')->isValid())
            {
                $now = new \DateTime();
                $now->createFromFormat('U.u',microtime(true));
                $name = $now->format('YmdHisu');

                $project = Project::create([
                    'name' => Input::get('name'),
                    'user_id' => Input::get('user_id'),
                    'icon_path' => 'images/evidence/'.$name.'.jpg',
                    'description' => Input::get('description'),
                    'client_name' => Input::get('client_name'),
                    'value' => Input::get('value'),
                    'update_schedule' => Input::get('update_schedule'),
                ]);
                if ($project)
                {
                    Storage::put(
                        $project->icon_path,
                        file_get_contents($request->file('icon_path')->getRealPath())
                    );
                    $project->icon_path = ($_SERVER['SERVER_NAME'] == 'localhost') ? "http://".$_SERVER['SERVER_NAME'] . "/projectmonitoring/web/storage/app/" . $project->icon_path : "http://".$_SERVER['SERVER_NAME'] . "/pm/storage/app/" . $project->icon_path;
                    $project->save();
                    return Redirect::to('project')->with('message',"Project " . Input::get('name') . " is created.");
                }
            }
        }
        return Redirect::to('project')->with('message','Creating project is failed.');
    }
    public function getUserlistselect()
    {
        $users = User::orderBy('name','asc')->get();
        return view('project.userListSelect')
            ->with('users',$users);
    }
    public function getDetail()
    {
        $project = Project::find(Input::get('id'));

        return view('project.admin_detail')->with('project',$project);
    }
    public function getEdit()
    {
        $project = Project::find(Input::get('id'));
        $users = User::where('position','=','Project Coordinator')
            ->orderBy('name','asc')->get();

        return view('project.admin_edit')->with('project',$project)->with('users',$users);
    }
    public function postEdit(Request $request, ProjectEditRequest $valid)
    {
        if($valid)
        {
            if($request->hasFile('icon_path') && $request->file('icon_path')->isValid())
            {
                $now = new \DateTime();
                $now->createFromFormat('U');
                $name = $now->format('YmdHis');

                $project = Project::find(Input::get('id'));

                $temp_icon_path = $project->icon_path;

                $project->name = Input::get('name');
                $project->user_id = Input::get('user_id');
                $project->icon_path = 'images/icon/project'.$project->id.'-'.$name.'.jpg';
                $project->description = Input::get('description');
                $project->client_name = Input::get('client_name');
                $project->value = Input::get('value');
                $project->update_schedule = Input::get('update_schedule');

                if ($project->save())
                {
                    Storage::put(
                        $project->icon_path,
                        file_get_contents($request->file('icon_path')->getRealPath())
                    );
                    $project->icon_path = ($_SERVER['SERVER_NAME'] == 'localhost') ? "http://".$_SERVER['SERVER_NAME'] . "/projectmonitoring/web/storage/app/" . $project->icon_path : "http://".$_SERVER['SERVER_NAME'] . "/pm/storage/app/" . $project->icon_path;
                    $project->save();
                    return Redirect::to('project')->with('message',"Project " . Input::get('name') . " is edited.");
                }
            }
            else
            {
                $project = Project::find(Input::get('id'));
                $project->name = Input::get('name');
                $project->user_id = Input::get('user_id');
                $project->description = Input::get('description');
                $project->client_name = Input::get('client_name');
                $project->value = Input::get('value');
                $project->update_schedule = Input::get('update_schedule');
                $project->save();
                return Redirect::to('project/detail?id='.$project->id)->with('project',$project)->with('message',"Project " . Input::get('name') . " is edited.");
            }
        }
        return Redirect::to('project')->with('message','Editing project is failed.');
    }
}
