<?php

namespace App\Repositories;

use App\Contracts\MessageContract;
use App\Models\Message;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MessageRepository implements MessageContract
{
    public function store(array $array)
    {
        $masg = new Message;
        $masg->sender_user_id = Auth::Guard('api')->user()->id;
        $masg->reciever_id = $array['reciever_id'];
        $masg->message = $array['message'];
        $masg->save();
        
        $notification = new Notification;
        $notification->sender_user_id = Auth::Guard('api')->user()->id;
        $notification->title = "Message";
        $notification->message = "Send You Message";
        $notification->reciever_id = $masg->reciever_id;
        $notification->status = "NULL";
        $notification->save();

        return $masg;
    }

    public function show(array $array)
    {
        $user = Auth::user()->id;
        $reciever_id = $array['reciever_id'];
       
        $chatsname = DB::table('messages')
        ->select('users.name as reciever_name' , 'messages.sender_user_id' , 'messages.reciever_id' , 'messages.message' , 'messages.created_at' , 'messages.updated_at')
        ->join('users', 'users.id', '=' , 'messages.reciever_id')
        ->where('sender_user_id', '=', $user)
        ->where('reciever_id', '=', $reciever_id)
        ->get();
        return $chatsname;
    }
}
?>