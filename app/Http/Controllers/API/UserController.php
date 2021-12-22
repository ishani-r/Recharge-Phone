<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\Admin\UserRequest;

use App\Contracts\UserContract;
use App\Repositories\UserRepository;

class UserController extends Controller
{
    public function __construct(UserContract $User)
    {
        $this->User = $User;
    }

    public function store(UserRequest $request)
    {
        $user = $this->User->store($request->all());
        return response()->json([
            'message' => 'Data sucessfully inserted',
            'user' => $user
        ]);
    }

    public function show($id=null)
    {
        $show = $this->User->show($id);
        return $show;
    }

    public function update(Request $request, $id)
    {
        $data = $this->User->update($request->all(),$id);
        return response()->json([
            'message' => 'Data Updated Sucessfully',
            'data' => $data
        ]);
    }

    public function destroy($id)
    {
        $data = $this->User->destroy($id);
        return "Data Deleted Successfully";
    }
}
