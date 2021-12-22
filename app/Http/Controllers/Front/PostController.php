<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Recharge;
use App\Models\Point;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Front\PostRequest;
use App\Http\Requests\Front\RechargeRequest;

class PostController extends Controller
{
    public function createPost(PostRequest $request)
    {
        $post = new Post();
        $post->user_id = Auth::Guard('web')->user()->id;
        $post->title_name = $request->title_name;
        if ($request->image) {
            $file = $request->image;
            $extension = $file->getclientoriginalextension();
            $filename = rand() . '_about.' . $extension;
            $file->move('storage/admin/', $filename);
            $post->image = $filename;
        }
        $post->point = "10";
        $post->save();

        $a = Point::where('user_id', $post->user_id)->get()->count();
        if ($a > 0) {
            $data = Point::where('user_id', $post->user_id)->first();
            $id = $data->id;
            $point = Point::find($id);
            $point->total_post = $data->total_post + 1;
            $point->total_point = $data->total_point + 10;
            $point->save();
        } else {
            $point = new Point();
            $point->user_id = $post->user_id;
            $point->total_post = "1";
            $point->total_point = "10";
            $point->status = "Active";
            $point->save();
        }
        return redirect()->route('home');
    }

    public function titleName(Request $request)
    {
        if ($request->get('title_name')) {
            $title_name = $request->get('title_name');
            $data = DB::table("posts")->where('title_name', $title_name)->count();
            if ($data > 0) {
                return 'Name_Exists';
            } else {
                return 'Unique';
            }
        }
    }

    public function sendRequest(RechargeRequest $request)
    {
        $total_point = Point::where('user_id', Auth::Guard('web')->user()->id)->first();

        if ($total_point->total_point < 31) {
            Session::flash("error", "Ooops Your Points is less than 30 points.....😔 ");
        } else {
            $id = $total_point->id;
            $point_request = Point::find($id);
            $point_request->user_send_request = "Panding";
            $point_request->request_point = $request->request_point;
            $point_request->total_point = $point_request->total_point - $request->request_point;
            $point_request->save();

            $recharge = new Recharge();
            $recharge->user_id = Auth::Guard('web')->user()->id;
            $recharge->recharge_point = $request->request_point;
            $recharge->total_point = $point_request->total_point;   
            $recharge->status = "Panding";  
            $recharge->save();

            Session::flash("success", "Request Send Suucessfully.....😊 ");
        }
        return redirect()->route('home');
    }
}
