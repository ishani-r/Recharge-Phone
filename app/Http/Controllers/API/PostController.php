<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contracts\PostContract;
use App\Http\Requests\Front\PostRequest;
use App\Http\Requests\Front\RechargeRequest;

class PostController extends Controller
{
    public function __construct(PostContract $Post)
    {
        $this->Post = $Post;
    }

    public function createPost(PostRequest $request)
    {
        $data = $this->Post->createPost($request->all());
        return response([
            'data' => $data,
            'message' => "Post Created Successfully"
        ]);
    }

    public function sendRequest(RechargeRequest $request)
    {
        $data = $this->Post->sendRequest($request->all());
        if (isset($data['message'])) {
            return response([
                'message' => "Ooops Your Points is less than 30 points.....😔"
            ]);
        } elseif (isset($data['error'])) {
            return response([
                'message' => "you cannot do recharge out of your total points....."
            ]);
        } else {
            return response([
                'data' => $data,
            ]);
        }
    }
}
