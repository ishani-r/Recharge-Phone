<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\Front\PostRequest;
use App\Http\Requests\Front\RechargeRequest;
use App\Contracts\PostContract;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    public function __construct(PostContract $Post)
    {
        $this->Post = $Post;
    }

    public function createPost(PostRequest $request)
    {
        $this->Post->createPost($request->all());
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
        $data = $this->Post->sendRequest($request->all());
        if(isset($data['recharge']))
        {
        //  return Session::flash("success", "Request Send Suucessfully..... ");
         return redirect()->back()->with("success", "Request Send Suucessfully..... ");
        } else {
        //  return Session::flash("error", "Ooops Your Points is less than 30 points..... ");
         return redirect()->back()->with("error", "Ooops Your Points is less than 30 points..... ");
        }        
    }
}
