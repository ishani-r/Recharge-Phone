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
        return response([
            'data' => $data,
            'message' => "Request Send Successfully"
        ]);
    }
}
