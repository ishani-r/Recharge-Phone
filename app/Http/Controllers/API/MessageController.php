<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Contracts\MessageContract;
use App\Repositories\MessageRepository;

class MessageController extends Controller
{
    public function __construct(MessageContract $Message)
    {
        $this->Message = $Message;
    }

    public function store(Request $request)
    {
        $mesg = $this->Message->store($request->all());
        return $mesg;
    }
    
    public function show(Request $request)
    {
        $mesg = $this->Message->show($request->all());
        return $mesg;
    }
}