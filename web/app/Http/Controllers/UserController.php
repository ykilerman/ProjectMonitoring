<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\User;
use Auth;
use Input;
use Redirect;
use Session;

class UserController extends Controller
{
    public function getIndex()
    {
//        return (User::where('username',123)->first()) ? 'true' : 'false';
        if(Auth::user()->position == 'Project Admin')
        {
            return view('user.read');
        }
        else
        {
            return Redirect::to('')->with('message','Anda tidak memiliki hak akses');
        }
    }
    public function getList()
    {
        Session::put('user_search', Input::has('ok') ? Input::get('search') : (Session::has('user_search') ? Session::get('user_search') : ''));
        Session::put('user_field', Input::has('field') ? Input::get('field') : (Session::has('user_field') ? Session::get('user_field') : 'name'));
        Session::put('user_sort', Input::has('sort') ? Input::get('sort') : (Session::has('user_sort') ? Session::get('user_sort') : 'asc'));
        $users = User::where('name', 'like', '%' . Session::get('user_search') . '%')
            ->orderBy(Session::get('user_field'), Session::get('user_sort'))
            ->paginate(6);
        $total = User::where('name', 'like', '%' . Session::get('user_search') . '%')
            ->count();
        return view('user.list')
            ->with('users',$users)
            ->with('total',$total);
    }
    public function getUserlistselect()
    {
        $users = User::orderBy('name','asc')->get();
        return view('user.userListSelect')
            ->with('users',$users);
    }
    public function validasi()
    {
        $id = Input::get('id');
        $value = Input::get('value');
        if($id == 'username')
        {
            if ($value == '')
            {
                return response()->json(['valid' => 'false','message' => 'Username cannot empty.']);
            }
            else if (User::where($id,$value)->first())
            {
                return response()->json(['valid' => 'false','message' => 'Username already taken.']);
            }
        }
        else if($id == 'password')
        {
            if ($value == '')
            {
                return response()->json(['valid' => 'false','message' => 'Password cannot empty.']);
            }
        }
        else if($id == 'name')
        {
            if ($value == '')
            {
                return response()->json(['valid' => 'false','message' => 'Name cannot empty.']);
            }
        }
        else if($id == 'position')
        {
            if ($value == '')
            {
                return response()->json(['valid' => 'false','message' => 'Select the position.']);
            }
        }
        return response()->json(['valid' => 'true']);
    }
    public function getCreate()
    {
        return view('user.tambah');
    }
    public function postCreate(UserCreateRequest $valid)
    {
        if ($valid)
        {
            User::create([
                'username' => Input::get('username'),
                'password' => bcrypt(Input::get('password')),
                'name' => Input::get('name'),
                'position' => Input::get('position'),
            ]);
            return Redirect::to('user')->with('message', "New user is created.");
        }
    }
    public function getUpdate()
    {
        $user = User::find(Input::get('id'));
        return view('user.update')->with('user',$user);
    }
    public function postUpdate(UserUpdateRequest $valid)
    {
        if($valid)
        {
            $user = User::find(Input::get('id'));
            $user->name = Input::get('name');
            $user->username = Input::get('username');
            $user->position = Input::get('position');
            $user->save();
            return Redirect::to('user')->with('message','The user is updated.');
        }
    }
    public function getDelete()
    {
        $user = User::find(Input::get('id'));
        return view('user.delete')->with('user',$user);
    }
    public function getCreateajax()
    {
        return view('user.create');
    }
    public function postCreateajax()
    {
        User::create([
            'name' => Input::get('name'),
            'username' => Input::get('username'),
            'password' => bcrypt(Input::get('password')),
            'position' => Input::get('position'),
        ]);
        return "Create user " . Input::get('name') . " is success.";
    }
}
