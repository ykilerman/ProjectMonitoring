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
            $data = [[
                'uid' => '',
                'username' => '',
                'name' => 'erroruser',
                'position' => '',
            ]];
        }
        else
        {
            if(!Hash::check(Input::get('password'), $user->password))
            {
                $data = [[
                    'uid' => '',
                    'username' => '',
                    'name' => 'errorpass',
                    'position' => '',
                ]];
            }
            else
            {
                $data = [[
                    'uid' => $user->id,
                    'username' => $user->username,
                    'name' => $user->username,
                    'position' => $user->position,
                ]];
            }
        }
        return $data;
    }
    public function postLogin()
    {
        $user = User::where('username','=',Input::get('username'))->first();

        if(!$user)
        {
            $data = [[
                'uid' => '',
                'username' => '',
                'name' => 'erroruser',
                'position' => '',
            ]];
        }
        else
        {
            if(!Hash::check(Input::get('password'), $user->password))
            {
                $data = [[
                    'uid' => '',
                    'username' => '',
                    'name' => 'errorpass',
                    'position' => '',
                ]];
            }
            else
            {
                $data = [[
                    'uid' => $user->id,
                    'username' => $user->username,
                    'name' => $user->username,
                    'position' => $user->position,
                ]];
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
    public function postAddproject()
    {
        if(Input::has('image'))
        {
            $now = new \DateTime();
            $now->createFromFormat('U.u',microtime(true));
            $name = $now->format('YmdHisu');
            
            $path = "Image/$name.jpg";
            $image = Input::get('image');
            $type = Input::get('type');
            $title = Input::get('title');
            $desc = Input::get('description');
            $client_name = Input::get('client_name');
            $value = Input::get('value');
            $update_schedule = Input::get('update_schedule');
            $userid = Input::get('userid');
            
            $data = new Project;
            $data->name = $title;
            $data->description = $desc;
            $data->client_name = $client_name;
            $data->value = $value;
            $data->update_schedule = $update_schedule;
            $data->user_id = $userid;
            $data->icon_path = 'images/icon/project'.$name.'.jpg';
            $data->type = $type;

            if($data->save())
            {
                $data->icon_path = $_SERVER['SERVER_NAME'] . '/pm/storage/app/images/icon/project' . $data->id . '-' . $name . '.jpg';
                $data->save();
                
                Storage::put(
                    $data->icon_path,
                    base64_decode($image)
                );
                return "Success";
            }
            else
            {
                return "Failed";
            }
        }
        else
        {
            return "no image selected";
        }
    }
    public function postSelectproject()
    {
        sleep(2);
        $position = Input::get('position');
        $status = Input::get('status');
        $uid = Input::get('uid');
        $offset = Input::get('offset');

        switch ($position) 
        {
            case 'Project Coordinator':
                $query = Project::where([
                    ['user_id','=',$uid],
                    ['status','=',$status],
                                       ])
                                    ->orderBy('id','DESC')
                                    ->offset($offset)
                                    ->limit(10)
                                    ->get();
                break;
            default:
                $query = Project::where('status','=',$status)
                                    ->orderBy('id','DESC')
                                    ->offset($offset)
                                    ->limit(10)
                                    ->get();
                break;
        }
        $count = count($query);
        
        $json_kosong = 0;
        
        if($count==0)
        {
            $json_kosong = 1;
        }
        else
        {

            $num = $offset;
            $json = '[';

            foreach($query as $row)
            {
                $num++;
                $tgl = date("d M Y", strtotime($row->created_at));
                $string = substr(strip_tags($row->description), 0, 200);
                $json .= '{
                "no": '.$num.',
                "id": "'.$row->id.'", 
                "judul": "'.$row->name.'",
                "tgl": "'.$tgl.'", 
                "isi": "'.$string." ...".'",
                "gambar": "'.$row->icon_path.'"},';
            }
        }
        
        $json = substr($json,0,strlen($json)-1);

        if($json_kosong==1)
        {
            $json = '[{ "no": "", "id": "", "judul": "", "tgl": "", "isi": "", "gambar": ""}]';
        }
        else
        {
            $json .= ']';
        }
        return $json;
    }
    public function postSelectprojectreport()
    {
        sleep(2);
        $offset = Input::get('offset');

        $query = Project::orderBy('id','DESC')
                            ->offset($offset)
                            ->limit(10)
                            ->get();

        $count = count($query);
        $json_kosong = 0;

        if($count==0)
        {
            $json_kosong = 1;
        }
        else
        {
            $num = $offset;
            $json = '[';

            foreach($query as $row)
            {
                $num++;
                $tgl = date("d M Y", strtotime($row->created_at));
                $string = substr(strip_tags($row->description), 0, 200);
                $json .= '{
                "no": '.$num.',
                "id": "'.$row->id.'", 
                "judul": "'.$row->name.'",
                "tgl": "'.$tgl.'", 
                "isi": "'.$string." ...".'",
                "gambar": "'.$row->icon_path.'"},';
            }
        }
        
        $json = substr($json,0,strlen($json)-1);
        
        if($json_kosong==1)
        {
            $json = '[{ "no": "", "id": "", "judul": "", "tgl": "", "isi": "", "gambar": ""}]';
        }
        else
        {
            $json .= ']';
        }
        return $json;
    }
}
