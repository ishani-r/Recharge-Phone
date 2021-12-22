<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\Point;
use App\Models\User;
use App\Models\Recharge;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\DataTables\PointListDatatable;
use Illuminate\Support\Facades\Mail;
use App\Mail\RechargeMail;

class PointController extends Controller
{

    public function pointList(PointListDatatable $PointListDatatable)
    {
        return $PointListDatatable->render('admin.User.point-list');
    }

    public function sendRequest(Request $request)
    {
        $id = $request['id'];
        $user = Point::find($id);
        
        if($user->user_send_request == "Panding")
        {
            $useremail = User::where('id', $user->user_id)->first();
            
            Mail::to($useremail->email)->send(new RechargeMail());
            
            $notification = new Notification();
            $notification->user_id = $useremail->id;
            $notification->message = "Your Recharge success...";
            $notification->save();

            $recharge = Recharge::select('id')->get()->last();
            // dd($recharge);
            $recharge->status = "Succes";
            // dd($recharge);
            $recharge->save();
            $user->user_send_request = "Approved";
        }else{
            $user->user_send_request = "Panding";
        }
        $user->save();
        return $user;
    }

    public function requestStatus(Request $request)
    {
        $id = $request['id'];
        $user = Point::find($id);
         
        if($user->status == "Active")
        {
            $user->status = "Deactive";
        }else{
            $user->status = "Active";
        }
        $user->save();
        return $user;
    }

    public function destroyPoint($id)
    {   
        $data = Point::find($id);
        $data->delete();
        return $data;
    }
}
