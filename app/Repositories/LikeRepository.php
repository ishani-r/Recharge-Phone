<?php
namespace App\Repositories;
use App\Contracts\LikeContract;
use App\Models\Like;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class LikeRepository implements LikeContract
{
    public function like(array $array)
    {
        $like = new Like();
        $like->user_id = Auth::Guard('api')->user()->id;
        $like->post_id = $array['post_id'];
        $like->status = $array['status'];
        $like->save();

        $notification = new Notification();
        $notification->sender_user_id = $like->user_id;
        $notification->title = 'Muzville';
        $notification->message = $like->status;
        if($notification->message == 'Like')
        {
            $notification->message = 'Like Your Profile';
            $notification->status = 'Like';
        } else
        {
            $notification->message = 'DisLike Your Profile';
            $notification->status = 'DisLike';
        }
        $notification->reciever_id = $like->post_id;
        $notification->save();
        return $notification;
    }

    public function showNotification(array $array)
    {
        $shownotification = DB::table('notifications')
        ->select('users.name as sender_user_name','notifications.sender_user_id','notifications.title','notifications.message')
        ->join('users', 'users.id', '=', 'notifications.sender_user_id')
        ->where('reciever_id','=',Auth::Guard('api')->user()->id)
        ->get()->last();

        if($shownotification){
            return $shownotification;
        }else{
            return "No Notifications";
        }
    }
}
?>