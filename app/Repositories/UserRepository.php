<?php
namespace App\Repositories;
use App\Contracts\UserContract;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
class UserRepository implements UserContract
{
    public function store(array $array)
    {
        // dd($array);
        $user = new User;
        $user->name = $array['name'];
        $user->mobile = $array['mobile'];
        $user->email = $array['email'];
        $user->gender = $array['gender'];
        $user->dob = $array['dob'];
        if(isset($array['image']))
        {
            $file = $array['image'];
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('storage/admin/',$filename);
            $user->image = $filename;
        }
        $user->password = Hash::make($array['password']);
        $user->status = 'Active';
        $user->slug = $array['name'];
        $user->save();
        // $user->assignRole('User');
        return $user;
    }

    public function show($id)
    {
        $data = $id ? User::find($id):User::all();
        return $data;
    }

    public function update(array $array, $id)
    {
        $user = User::find($id);
        $user->name = $array['name'];
        $user->mobile = $array['mobile'];
        $user->email = $array['email'];
        $user->gender = $array['gender'];
        $user->dob = $array['dob'];
        if(isset($array['image']))
        {
            $file = $array['image'];
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('storage/admin/',$filename);
            $user->image = $filename;
        }
        $user->password = Hash::make($array['password']);
        $user->status = $array['status'];
        $user->slug = $array['slug'];
        
        $user->save();
        return $user;
    }

    public function destroy($id)
    {
        $data = User::find($id);
        $destination = 'storage/admin/'.$data->image;
        if(file::exists($destination))
        {
            file::delete($destination);
        }
        $data->delete();
        return $data;
    }
}
?>