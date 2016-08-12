<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use Input;
use Redirect;

class HomeController extends Controller
{
    public function getIndex()
    {
        if (Auth::user())
        {
            return Redirect::to('project');
        }
        return Redirect::to('login');
    }
    public function getLogin()
    {
        return view('home.login');
    }
    public function postLogin()
    {
        if (Auth::attempt(['username' => Input::get('username'), 'password' => Input::get('password')],Input::get('remember'))) {
			return Redirect::to('project');
		}
		else {
			return Redirect::to('login')->with('message','salah username atau salah password')->with('type','label-danger');
		}
    }
    public function getLogout()
    {
        Auth::logout();
        return Redirect::to('login')->with('message','berhasil logout')->with('type','label-success');
    }
}
