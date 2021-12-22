<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\DataTables\UserPostDatatable;

class UserPostController extends Controller
{
    
    public function listUser(UserPostDatatable $UserPostDatatable)
    {
        return $UserPostDatatable->render('admin.User.list-user');
    }

    public function showUserList($id)
    {
        $data = User::find($id);
        return view('admin.user.view-user', compact('data'));
    }

    public function statusUser(Request $request)
    {
        $id = $request['id'];
        $user = User::find($id);
        
        if($user->status == "Active")
        {
            $user->status = "Deactive";
        }else{
            $user->status = "Active";
        }
        $user->save();
        return $user;
    }

    public function destroyUser($id)
    {
        $data = User::find($id);
        $data->delete();
        return $data;
    }
}
