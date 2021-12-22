<?php
namespace App\Repositories;
use App\Contracts\UserDetailContract;
use Illuminate\Support\Facades\Auth;
use App\Models\UserDetail;
use App\Models\User;
use App\Models\Distance;

class UserDetailRepository implements UserDetailContract
{
    public function store(array $array)
    {
        $user = new UserDetail();
        $user->user_id = $array['user_id'];
        $user->country = $array['country'];
        $user->state = $array['state'];
        $user->city = $array['city'];
        $user->address = $array['address'];
        $user->education = $array['education'];
        $user->work = $array['work'];
        $user->employer = $array['employer'];
        $user->about_me = $array['about_me'];
        $user->height = $array['height'];
        $user->speaks = $array['speaks'];
        $user->cast = $array['cast'];
        $user->smoking = $array['smoking'];
        $user->drinks = $array['drinks'];
        $user->food = $array['food'];
        $user->marray_age = $array['marray_age'];
        $user->dressing = $array['dressing'];
        $user->latitude = $array['latitude'];
        $user->longitude = $array['longitude'];
        $user->status = 'Active';
        $user->slug = $array['user_id'];
        $user->save();
        return $user;
    }

    public function show($id)
    {
        $dataa = $id ? UserDetail::find($id):UserDetail::all();
        $user = User::where("id" , $dataa['id'])->get();
        $data['data'] = $dataa;
        $data['user'] = $user;
        return $data;
    }

    // public function update(array $array, $id)
    // {
    //     $user = UserDetail::find($id);
    //     $user->user_id = $array['user_id'];
    //     $user->country = $array['country'];
    //     $user->state = $array['state'];
    //     $user->city = $array['city'];
    //     $user->address = $array['address'];
    //     $user->education = $array['education'];
    //     $user->work = $array['work'];
    //     $user->employer = $array['employer'];
    //     $user->about_me = $array['about_me'];
    //     $user->height = $array['height'];
    //     $user->speaks = $array['speaks'];
    //     $user->cast = $array['cast'];
    //     $user->smoking = $array['smoking'];
    //     $user->drinks = $array['drinks'];
    //     $user->food = $array['food'];
    //     $user->marray_age = $array['marray_age'];
    //     $user->dressing = $array['dressing'];
    //     $user->latitude = $array['latitude'];
    //     $user->longitude = $array['longitude'];
    //     $user->status = $array['status'];
    //     $user->slug = $array['slug'];
    //     $user->save();
    //     return $user;
    // }

    public function destroy($id)
    {
        $user = UserDetail::find($id);
        $user->delete();
        return $user;
    }

    public function distance(array $array)
    {
        $distancs = new Distance();
        $distancs->auth_id = Auth::Guard('api')->user()->id;
        $distancs->latitude = $array['latitude'];
        $distancs->longitude = $array['longitude'];
        $latitude = $array['latitude'];
        $longitude = $array['longitude'];
        
        $users = UserDetail::selectRaw("id, latitude, longitude,
        ( 6371  * acos( cos( radians(?) ) *
        cos( radians( latitude ) )
        * cos( radians( longitude ) - radians(?)
        ) + sin( radians(?) ) *
        sin( radians( latitude ) ) )
        ) AS distance", [$latitude, $longitude, $latitude])
        ->where('user_id',Auth::Guard('api')->user()->id)
        ->get();
        $distancs->distance = $users[0]->distance;
        $distancs->save();
    }
}
?>