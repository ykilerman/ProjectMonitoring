<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\ChangePassRequest;
use Auth;
use Input;
use Redirect;
use Hash;
use App\User;

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
    public function getChangepassword()
    {
        return view('home.ch_pass');
    }
    public function postChangepassword(ChangePassRequest $valid)
    {
        if ($valid)
        {
            $user = User::find(Auth::user()->id);

            if(!Hash::check(Input::get('oldpass'), $user->password))
            {
                return Redirect::to('changepassword')->with('message','Your Old Password is wrong.');
            }
            else
            {
                if(Input::get('newpass') != Input::get('renewpass'))
                {
                    return Redirect::to('changepassword')->with('message','Your Re-New Password is different with New Password.');
                }
            }

            $user->password = Hash::make(Input::get('newpass'));
            $user->save();

            return Redirect::to('changepassword')->with('message','Your Password is changed.');
        }
    }
}
