<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use App\Models\User;
use App\Models\UserDetail;

class ProfileController extends Controller
{
    public function showProfile()
    {
        return view('admin.dashboard.editprofile');
    }

    public function updateProfile(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|regex:/(.+)@(.+)\.(.+)/i',
            'image' => 'mimes:jpg,bmp,png',
        ]);
        $admin = Admin::find($request->id);
        $admin->name = $request->name;
        $admin->email = $request->email;
        // dd($request->name);
        if ($request->hasfile('image')) {
            $destination = 'storage/admin/' . $admin->image;
            if (file::exists($destination)) {
                file::delete($destination);
            }
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('storage/admin/', $filename);
            $admin->image = $filename;
        }
        $admin->save();
        return redirect()->route('admin.showprofile');
    }

    public function changePassword(Request $request, $id)
    {
        $this->validate($request, [
            'current_password' => 'required',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);
        $a = Auth::guard('admin')->user();
        if (Hash::check($request->current_password, $a->password)) {
            $a->password = Hash::make($request->password);
            $a->save();
            return redirect()->route('admin.main');
        } else {
            return redirect()->back()->with('error', 'Current Password is not match !!');
        }
    }
    public function changeStatus(Request $request)
    {
        $id = $request['id'];
        $user = User::find($id);
        if ($user->status == "Active") {
            $userdetail = UserDetail::where('user_id', $request['id'])->get();
            foreach ($userdetail as $a) {
                $b = UserDetail::find($a->id);
                $b->status = "Deactive";
                $b->save();
            }
            $user->status = "Deactive";
        } else {
            $userdetail = UserDetail::where('user_id', $request['id'])->get();
            foreach ($userdetail as $a) {
                $b = UserDetail::find($a->id);
                $b->status = "Active";
                $b->save();
            }
            $user->status = "Active";
        }
        $user->save();
        return $user;
    }
    public function statusChange(Request $request)
    {
        $id = $request['id'];
        $user = UserDetail::find($id);

        if ($user->status == "Active") {
            $users = user::where('id', $request['id'])->get();
            foreach ($users as $a) {
                $b = user::find($a->id);
                $b->status = "Deactive";
                $b->save();
            }
            $user->status = "Deactive";
        } else {
            $users = user::where('id', $request['id'])->get();
            foreach ($users as $a) {
                $b = user::find($a->id);
                $b->status = "Active";
                $b->save();
            }
            $user->status = "Active";
        }
        $user->save();
        return $user;
    }
}
