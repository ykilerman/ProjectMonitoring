<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Answer;
use App\Device;
use App\Message;
use App\MessageDetail;
use App\Notification;
use App\Project;
use App\Question;
use App\Report;
use App\UpdatingStatus;
use App\User;
use DB;
use Hash;
use Input;
use Storage;

class APIController extends Controller
{
    public function postLogin()
    {
        $username = Input::get('username');
        $password = Input::get('password');
        $deviceid = Input::get('deviceid');
        $data = [];
        
        $users = User::where([
            ['username',$username],
            ['password',$password],
        ])->get();
        
        $found = count($users);
        if($found > 0)
        {
            foreach($users as $user)
            {
                $uid = $user->id;
                $username = $user->username;
                $password = $user->password;
                $name = $user->name;
                $position = $user->position;
                $data[] = [
                    'uid' => $uid,
                    'username' => $username,
                    'password' => $password,
                    'name' => $name,
                    'position' => $position,
                ];
                Device::create([
                    'device_id'=>$deviceid,
                    'user_id'=>$uid,
                ]);
            }
        }
        else
        {
            $data[] = ['uid' =>"" ,'username' =>"" , 'name'=>"errorpass",'position'=>""];
        }
        return json_encode($data);
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
    public function postEdituser()
    {
        $id = Input::get('id');
        $username = Input::get('username');
        $password = Input::get('password');
        $nama = Input::get('name');
        $position = Input::get('position');
        $data = [];
        
        $user = User::find($id);
        
        $user->username = $username;
        $user->name = $nama;
        $user->position = $position;
        $sql = "UPDATE users SET username='$user',name='$nama',position='$position' WHERE id='$id'";
        
        if($password != "")
        {
            $user->password = bcrypt($password);
            $sql = "UPDATE users SET username='$user',name='$nama',password='$password',position='$position' WHERE id='$id'";
        }

        $status = ($user->save()) ? "success" : "error";
        $message = ($user->save()) ? "congrats ! account with ID : ".$id." has been change" : "Error: ".$sql;
        $data[] = ['status' => $status, 'message' => $message];
        return json_encode($data);
    }
    public function postSelectcoordinator()
    {
        $username = Input::get('username');
        $password = Input::get('password');
        
        $data = [];
        
        $users = Users::where('position','Project Coordinator')
            ->get();
        
        $found = count($users);
        if($found > 0)
        {
            foreach($users as $user)
            {
                $uid = $user->id;
                $name = $user->name;
                $data[] = ['uid' => $uid, 'name' => $name];
            }
            $dataCoordinator['coordinator'] = $data;
            return json_encode($dataCoordinator);
        }
        else
        {
            $data[] = ['name' => ''];
            return json_encode($data);
        }
    }
    public function postChangepassword()
    {
        $id = Input::get('uid');
        $password = Input::get('password');
        $data = [];
        
        $user = User::find($id);
        $user->password = bcrypt($password);
        $sql = "UPDATE users SET password = '$password' WHERE id = '$id'";
        
        $status = ($user->save()) ? "success" : "error";
        $message = ($user->save()) ? "congrats your password has been change" : "Error: ".$sql;
        $data[] = ['status' => $status, 'message' => $message];
        
        return json_encode($data);
    }
    public function postSelectuser()
    {
        sleep(2);

        $offset = Input::get('offset');
        $query = Users::orderBy('name','asc')->offset($offset)->limit(10)->get();
        $count = count($query);
        $json_kosong = 0;
        
        if($count == 0)
        {
            $json_kosong = 1;
        }
        else
        {
            $num = $offset;
            $json = '[';
            foreach($query as $user)
            {
                $num++;
                $char = '"';
                $json .= '{
                    "no": "'.$num.'",
                    "id": "'.$user->id.'",
                    "name": "'.$user->name.'",
                    "username": "'.$user->username.'",
                    "position": "'.$user->position.'"
                },';
            }
        }
        $json = substr($json,0,strlen($json)-1);

        if($json_kosong == 1)
        {
            $json = '[{ "no": "", "id": "", "name": "", "username": "", "position": ""}]';
        }
        else
        {
            $json .= ']';
        }
        return $json;
    }
    public function postSelectreport()
    {
        sleep(2);

        $id = Input::get('id');
        $offset = Input::get('offset');
        $query = Report::where('project_id',$id)->orderBy('created_at','desc')->offset($offset)->limit(10)->get();
        $count = count($query);
        $json_kosong = 0;
        
        if($count == 0)
        {
            $json_kosong = 1;
        }
        else
        {
            $num = $offset;
            $json = '[';
            foreach($query as $report)
            {
                $num++;
                $char = '"';
                $json .= '{
                    "no": "'.$num.'",
                    "id": "'.$report->id.'",
                    "hightlight": "'.$report->highlight.'",
                    "activity": "'.$user->activity.'",
                    "activity_path": "'.$user->activity_path.'",
                    "income": "'.$user->income.'",
                    "income_path": "'.$user->income_path.'",
                    "expense": "'.$user->expense.'",
                    "expense_path": "'.$user->expense_path.'"
                },';
            }
        }
        $json = substr($json,0,strlen($json)-1);

        if($json_kosong == 1)
        {
            $json = '[{ "no": "", "id": "", "name": "", "username": "", "position": ""}]';
        }
        else
        {
            $json .= ']';
        }
        return $json;
    }
    public function postUpdateProject()
    {
        $now = new \DateTime();
        $now->createFromFormat('U.u',microtime(true));
        $name = $now->format('YmdHisu');
        
        $highlight = Input::get('Highlight');
        $activity = Input::get('Activity');
        $income = Input::get('Income');
        $expense = Input::get('Expense');
        $id = Input::get('id');
        
        if(Input::has('imageActivity') && Input::has('imageIncome') && Input::has('imageExpense')){
            $imageActivity = Input::get('imageActivity');
            $imageIncome = Input::get('imageIncome');
            $imageExpense = Input::get('imageExpense');
            
            $data = new Report;
            $data->project_id = $id;
            $data->highlight = $highlight;
            $data->activity = activity;
            $data->activity_path = "";
            $data->income = $income;
            $data->income_path = "";
            $data->expense = $expense;
            $data->expense_path = "";
            if($data->save())
            {
                //activity
                $activity_path = "images/evidence/activity".$data->id."-".$name.".jpg";
                Storage::put(
                    $activity_path,
                    base64_decode($imageActivity)
                );
                $data->activity_path = $_SERVER['SERVER_NAME'] . "/pm/storage/app/" . $data->activity_path;
                $data->save();
                //income
                $income_path = "images/evidence/income".$data->id."-".$name.".jpg";
                Storage::put(
                    $income_path,
                    base64_decode($imageIncome)
                );
                $data->income_path = $_SERVER['SERVER_NAME'] . "/pm/storage/app/" . $data->income_path;
                $data->save();
                //expense
                $expense_path = "images/evidence/expense".$data->id."-".$name.".jpg";
                Storage::put(
                    $expense_path,
                    base64_decode($imageExpense)
                );
                $data->expense_path = $_SERVER['SERVER_NAME'] . "/pm/storage/app/" . $data->expense_path;
                $data->save();
                
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
    public function postEditproject()
    {
        $now = new \DateTime();
        $now->createFromFormat('U.u',microtime(true));
        $name = $now->format('YmdHisu');
        
        $path = "Image/$name.jpg";
        $idProject = Input::get('id');
        $image = Input::get('image');
        $title = Input::get('title');
        $type = Input::get('type');
        $desc = Input::get('description');
        $client_name = Input::get('client_name');
        $value = Input::get('value');
        $update_schedule = Input::get('update_schedule');
        $userid = Input::get('userid');
        
        $data = Project::find($idProject);
        $pathIconProject = ($data->icon_path != "") ? $data->icon_path : "";
        
        $data->user_id = $userid;
        $data->type = $type;
        $data->name = $title;
        $data->description = $desc;
        $data->client_name = $client_name;
        $data->value = $value;
        $data->update_schedule = $update_schedule;
        if(Input::has('photopath'))
        {
            $icon_path = "images/icon/project".$data->id."-".$name.".jpg";
            if($data->save())
            {
                Storage::put(
                    $activity_path,
                    base64_decode($imageActivity)
                );
                return "Success";
            }
            else
            {
                return "Failed";
            }
        }
        else if($data->save())
        {
            return "Success";
        }
        else
        {
            return "Failed";
        }
    }
    public function postDetailproject()
    {
        $id = Input::get('id');
        $datas = Project::find($id);
        
        $char = '"';
        $tgl = date("d M Y", strtotime($data->created_at));
        $string = $data->description;

        $json = '{
            "id": "'.$data->id.'",
            "judul": "'.$data->name.'",
            "tgl": "'.$tgl.'",
            "client": "'.$data->client_name.'",
            "type": "'.$data->type.'",
            "coordinator": "'.$data->user->name.'",
            "idcoor": "'.$data->user_id.'",
            "schedule": "'.$data->update_schedule.'",
            "cost": "'.$data->value.'",
            "isi": "'.$string.'",
            "complate": "'.$data->percent.'",
            "gambar": "'.$data->icon_path.'",
        }';
        
        return $json;
    }
    public function postDeletemessage()
    {
        $idroom = Input::get('idroom');
        
        $deletedRow = MessageDetail::where('room',$idroom)->delete();
        if($deletedRow)
        {
            $deletedRows = Message::where('room',$idroom)->delete();
            if($deletedRows)
            {
                return "success";
            }
            else
            {
                return "gagal";
            }
        }
        else
        {
            return "gagal delete detail messages";
        }
    }
    public function postCountprojectupdate()
    {
        $position = Input::get('position');
        $userid = Input:;get('userid');
        switch ($position)
        {
            case 'Stakeholder':
                $datas = Project::select(DB::raw('id,name,COUNT(*) as jumlah'))->whereRaw('status="On Going" and datediff(ADDDATE(last_notification,update_schedule),current_date()) < 0')->get();
                break;
            case 'Management':
                $datas = Project::select(DB::raw('id,name,COUNT(*) as jumlah'))->whereRaw('status="On Going" and datediff(ADDDATE(last_notification,update_schedule),current_date()) < 0')->get();
                break;
            case 'Project Coordinator':
                $datas = Project::select(DB::raw('id,name,COUNT(*) as jumlah'))->whereRaw('status="On Going" and datediff(ADDDATE(last_notification,update_schedule),current_date()) < 1 and user_id = "'.$userid.'"')->get();
                break;
            default:
                $datas = "";
                break;
        }
        if($datas)
        {
            foreach($datas as $data)
            {
                $id = $data->id;
                $name = $data->name;
                $jumlah = $data->jumlah;
                $dat[] = [
                    'id'=>$id,
                    'name'=>$name,
                    'jumlah'=>$jumlah,
                ];
            }
        }
        else
        {
            $dat[] = [
                'id'=>"",
                'name'=>"",
                'jumlah'=>"",
            ];
        }
        return json_encode($dat);
    }
    public function postChangestatus()
    {
        if(Input::has('idproject') && Input::has('highlight') && Input::has('status'))
        {
            $data = UpdatingStatus::create([
                'project_id' => Input::get('idproject'), 
                'highlight' => Input::get('highlight'), 
                'description' => Input::get('description'),
            ]);
            if($data)
            {
                $project = Project::find(Input::get('idproject'));
                $project->status = Input::get('status');
                if($project->save())
                {
                    $status = "success";
                }
            }
            else
            {
                $status = "error";
            }
            return $status;
        }
    }
    public function postSendnotif()
    {
        $message = Input::get('message');
        $receiver = Input::get('idreceiver');
        $title = Input::get('title');
        $pathFCM = "https://fcm.googleapis.com/fcm/send";
        $serverKey = "AIzaSyDPnGGCUpJmfjFFt4h9HYBZjNbC6ZVH-xQ";
        $datas = Device::where('user_id',$receiver)->get();
        if($datas)
        {
            $num = 0;
            foreach($datas as $data)
            {
                $num++;
                $token = $data->device_id;
                $dat[] = ['no'=>$num, 'token'=>$token];
                $headers = ['Authorization:key='.$serverKey,'Content-Type:application/json'];
                $fields = [
                    'to'=>$token,
                    'notification'=>[
                        'title'=>$title,
                        'body'=>$message,
                    ],
                ];
                $payload = json_encode($fields);
                $curl_session = curl_init();
                curl_setopt($curl_session, CURLOPT_URL, $pathFCM);
                curl_setopt($curl_session, CURLOPT_POST, true);
                curl_setopt($curl_session, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($curl_session, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl_session, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($curl_session, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
                curl_setopt($curl_session, CURLOPT_POSTFIELDS, $payload);
                $result = curl_exec($curl_session);
                if($result) 
                {
                    return $result;
                }
                else 
                {
                    return "Failed";
                }
                curl_close($curl_session);
            }
            return json_encode($dat);
        }
    }
    public function postSendnewmessage()
    {
        $sender = Input::get('sender');
        $room = Input::get('room');
        $subject = Input::get('subject');
        $message = Input::get('message');
        $receiver = Input::get('receiver');
        $data = [];
        
        $message = Message::create([
            'user_id'=>$sender, 
            'room'=>$room, 
            'subject'=>$subject, 
            'message'=>$message,
        ]);
        if($message)
        {
            $detailMessage = MessageDetail::create([
                'message_id'=>$message->id, 
                'room'=>$room, 
                'user_id'=>$receiver, 
            ]);
            if($detailMessage)
            {
                $status = "success";
                $message = "Your message has been sent, click ok to see your message";
            }
            else
            {
                $status = "error";
                $message = "gagal insert ke tabel detail ";
            }
        }
        else
        {
            $status = "error";
            $message = "Gagal insert ketabel messages";
        }
        $data[] = ['status'=>$status,'message'=>$message,];
        return json_encode($data) . $idMessage;
    }
    public function postSelectmessage()
    {
        $user = Input::get('login');
        $data = [];
        
        $messages = DB::table('messages')
            ->join('message_details','messages.id','=','message_details.message_id')
            ->where('messages.user_id',$user)
            ->orWhere('message_details.user_id',$user)
            ->select('messages.id as messages_id','messages.user_id as messages_user_id','messages.room as messages_room','messages.subject as messages_subject','messages.message as messages_message','messages.created_at as messages_created_at','messages.updated_at as messages_updated_at','message_details.user_id as mdu_id')
            ->groupBy('room')
            ->orderBy('updated_at','DESC')
            ->get();
        $num = 0;
        if($messages)
        {
            foreach($messages as $message)
            {
                $num++;
                $idmessage = $message->messages_id;
                $idSender = $message->messages_user_id;
                $room = $message->messages_room;
                $subject = $message->messages_subject;
                $pesan = $message->messages_message;
                $created_at = $message->messages_created_at;
                $updated_at = $message->messages_updated_at;
                if($message->user_id == $user)
                {
                    $idSender = $message->mdu_id;
                }
                if($room != "")
                {
                    $unread = MessageDetail::where([
                        ['asread','=','0'],
                        ['room','=',$room],
                        ['user_id','=',$user],
                    ])->count('asread');
                }
                $data[] = [
                    'no'=> $num,
                    'idmessage'=> $idmessage,
                    'idsender'=> $idSender,
                    'room'=> $room,
                    'subject'=> $subject,
                    'message'=> $message,
                    'updated_at'=> $updated_at,
                    'unreadmessage'=> $unread,
                ];
            }
        }
        else
        {
            $data[] = ['no' =>"",'idmessage' =>"" ,'idsender' =>"",'room' =>"" ,'subject' =>"" , 'message'=>"" ,'update_at'=>"",'unreadmessage'=>""];
        }
        return json_encode($data);
    }
    public function postSelectdetailmessage()
    {
        $room = Input::get('room');
        $userid = Input::get('userid');
        $unread= Input::get('unread');
        $data = [];
        
        $messages = DB::table('messages')
            ->join('message_details','messages.id','=','message_details.message_id')
            ->join('users','users.id','=','messages.user_id')
            ->where('messages.room','=',$room)
            ->where('messages.user_id','=',$userid)
            ->orWhere('message_details.user_id','=',$userid)
            ->select('messages.id as messages_id','users.name as users_name','messages.room as messages_room','messages.message as messages_message','messages.created_at as messages_created_at')
            ->groupBy('messages.id')
            ->orderBy('created_at','asc')
            ->get();
        if(isset($unread))
        {
            MessageDetail::where('room',$room)
                ->where('user_id',$userid)
                ->update([
                    'asread','=','1',
                ]);
        }
        if($messages)
        {
            foreach($messages as $message)
            {
                $idmessage = $message->messages_id;
                $sender = $message->users_name;
                $room = $message->messages_room;
                $message = $message->messages_message;
                $created_at = $message->created_at;
                
                $data[] = [
                    'idmessage'=> $idmessage,
                    'sender'=> $sender,
                    'room'=> $room,
                    'message'=> $message,
                    'created_at'=> $create_at,
                ];
            }
        }
        else
        {
            $data[] = ['idmessage' =>"" ,'sender' =>"" ,'room' =>""  , 'message'=>"",'created_at'=>""];
        }
        return json_encode($data);
    }
    public function postReplychat()
    {
        $sender = Input::get('sender');
        $room = Input::get('room');
        $subject = Input::get('subject');
        $message = Input::get('message');
        $receiver = Input::get('receiver');
        $data = [];
        date_default_timezone_set("Asia/Jakarta");
        $now = date('Y-m-d H-i-s');
        
        $newdata = Message::create([
            'user_id'=>$sender,
            'room'=>$room,
            'subject'=>$subject,
            'message'=>message,
        ]);
        
        if($newdata)
        {
            $newdatas = MessageDetail::create([
                'message_id' => $newdata->id,
                'user_id' => $receiver,
                'room' => $room,
                'asread' => '0',
            ]);
            if($newdatas)
            {
                $update = Message::where('room','=',$room)
                    ->update([
                        'updated_at'=>$now,
                    ]);
                $status = ($update) ? "success" : "error";
                $message = ($update) ? "error" : "Gagal Update";
            }
            else
            {
                $status = "error";
                $message = "gagal insert ke tabel detail ";
            }
        }
        else
        {
            $status = "error";
            $message = "gagal insert ke tabel messages";
        }
        $data[] = [
            'status' => $status,
            'message' => $message,
        ];
        return json_encode($data);
    }
    public function postLogout()
    {
        $userid = Input::get('userid');
        $deviceid = Input::get('deviceid');
        if (isset($deviceid) and isset($userid)) {
            $delete = Device::where('device_id',$deviceid)
                ->where('user_id',$userid)
                ->delete();
            if($delete)
            {
                return "Success";
            }
            else
            {
                return "Failed logout";
            }
        }
    }
}
