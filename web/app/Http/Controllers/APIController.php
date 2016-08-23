<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Project;
use App\Http\Requests;
use Input;
use Hash;
use Storage;

class APIController extends Controller
{
    public function getLogin()
    {
        $user = User::where('username','=',Input::get('username'))->first();

        if(!$user)
        {
            $data = [
                'uid' => '',
                'username' => '',
                'name' => 'erroruser',
                'position' => '',
            ];
        }
        else
        {
            if(!Hash::check(Input::get('password'), $user->password))
            {
                $data = [
                    'uid' => '',
                    'username' => '',
                    'name' => 'errorpass',
                    'position' => '',
                ];
            }
            else
            {
                $data = [
                    'uid' => $user->id,
                    'username' => $user->username,
                    'name' => $user->username,
                    'position' => $user->position,
                ];
            }
        }
        return $data;
    }
    public function postLogin()
    {
        $user = User::where('username','=',Input::get('username'))->first();

        if(!$user)
        {
            $data = [
                'uid' => '',
                'username' => '',
                'name' => 'erroruser',
                'position' => '',
            ];
        }
        else
        {
            if(!Hash::check(Input::get('password'), $user->password))
            {
                $data = [
                    'uid' => '',
                    'username' => '',
                    'name' => 'errorpass',
                    'position' => '',
                ];
            }
            else
            {
                $data = [
                    'uid' => $user->id,
                    'username' => $user->username,
                    'name' => $user->username,
                    'position' => $user->position,
                ];
            }
        }
        return $data;
    }
    public function postCreateuser()
    {
        $user = User::create([
            'username' => Input::get('username'),
            'password' => bcrypt(Input::get('password')),
            'name' => Input::get('name'),
            'position' => Input::get('position'),
        ]);
        $data = [
            'uid' => $user->id,
            'username' => $user->username,
            'name' => $user->username,
            'position' => $user->position,
        ];
        return $data;
    }
    public function getCreateproject()
    {
        $title = Input::get('title');
        $image = Input::get('image');
        $description = Input::get('description');
        $client_name = Input::get('client_name');
        $user_id = Input::get('user_id');
        $value = Input::get('value');
        $update_schedule = Input::get('update_schedule');

        $now = new \DateTime();
        $now->createFromFormat('U.u',microtime(true));
        $name = $now->format('YmdHisu');

        $data = new Project;
        $data->name = $title;
        $data->description = $description;
        $data->client_name = $client_name;
        $data->value = $value;
        $data->update_schedule = $update_schedule;
        $data->user_id = $user_id;
        $data->icon_path = 'images/evidence/'.$name.'.jpg';

        if($data->save())
        {
            Storage::put(
                $data->icon_path,
                base64_decode($image)
            );
            $data->icon_path = $_SERVER['SERVER_NAME'] . "/pm/storage/app/" . $data->icon_path;
            $data->save();
            return "Success";
        }
        else
        {
            return "Failed";
        }
    }
    public function postCreateproject()
    {
        $title = Input::get('title');
        $image = Input::get('image');
        $description = Input::get('description');
        $client_name = Input::get('client_name');
        $user_id = Input::get('user_id');
        $value = Input::get('value');
        $update_schedule = Input::get('update_schedule');

        $now = new \DateTime();
        $now->createFromFormat('U.u',microtime(true));
        $name = $now->format('YmdHisu');

        $data = new Project;
        $data->name = $title;
        $data->description = $description;
        $data->client_name = $client_name;
        $data->value = $value;
        $data->update_schedule = $update_schedule;
        $data->user_id = $user_id;
        $data->icon_path = 'images/evidence/'.$name.'.jpg';

        if($data->save())
        {
            Storage::put(
                $data->icon_path,
                base64_decode($image)
            );
            $data->icon_path = $_SERVER['SERVER_NAME'] . "/pm/storage/app/" . $data->icon_path;
            $data->save();
            return "Success";
        }
        else
        {
            return "Failed";
        }
    }
    public function getEncode()
    {
        return base64_encode('F:\Library\Pictures\pic_200x300.jpg');
    }
    public function getDecode()
    {
        return "<form action='".url('api/decode')."' method='post'><input type='hidden' name='_token' value='". csrf_token() ."'>
<textarea name='image'></textarea><input type='submit'></form>";
    }
    public function postDecode()
    {
        $image = Input::get('image');
        if(Storage::put(
            'tes.jpg',
            base64_decode($image)
        ))
            return "sukses";
        else return "gagl";
    }
}
