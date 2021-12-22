<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Follow;
use App\Models\Notification;
use App\Models\User;
use App\Http\Requests\Admin\FollowRequest;
use Illuminate\Support\Facades\DB;

class FollowController extends Controller
{
    public function sendRequest(FollowRequest $request)
    {
        $data = User::where('id', $request->follow_id)->first();
        if ($data) {
            $a = Follow::where('sender_user_id', Auth::guard('api')->id())
                ->where('follow_id', $request->follow_id)->first();
            if (!empty($a)) {
                return "request already send...😜";
            } else {
                $follow = new Follow();
                $follow->sender_user_id = Auth::guard('api')->id();

                if ($request->follow_id != Auth::guard('api')->id()) {
                    $follow->follow_id = $request->follow_id;
                    $follow->status = "0";
                    $follow->save();

                    $noti = new Notification();
                    $noti->sender_user_id = $follow->sender_user_id;
                    $noti->title = "Request";
                    $noti->message = "Send You Request";
                    $noti->reciever_id = $follow->follow_id;
                    $noti->status = "0";
                    $noti->save();

                    return "follow request send successfully........😊";
                } else {
                    return "you are not follow for you........please sent another user";
                }
            }
        } else {
            return "This id is not Exists......😔";
        }
    }

    public function showRequest()
    {
        $showrequest = DB::table('follows')
            ->select('users.name as sender_user_name', 'follows.sender_user_id', 'follows.status')
            ->join('users', 'users.id', '=', 'follows.sender_user_id')
            ->where('follow_id', Auth::guard('api')->id())
            ->get();
        return $showrequest;
    }

    public function acceptRequest(Request $request)
    {
        $data = Follow::where('follow_id', Auth::guard('api')->id())
            ->where('sender_user_id', $request->sender_user_id)
            ->first();
        if ($data) {
            if ($request['request'] == "1") {
                $data->status = "1";
                $data->save();

                $noti = new Notification();
                $noti->sender_user_id = $data->follow_id;
                $noti->title = "Request";
                $noti->message = "Accept Your Request";
                $noti->reciever_id = $data->sender_user_id;
                $noti->status = "1";
                $noti->save();
                return "Now You are friend";
            } else {
                return "Request not accepted";
            }
        } else {
            return "This id has not send you requests......😔";
        }
    }
}
