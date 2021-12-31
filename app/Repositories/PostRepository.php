<?php

namespace App\Repositories;

use App\Contracts\PostContract;
use App\Models\Post;
use App\Models\Point;
use Illuminate\Support\Facades\Auth;
use App\Models\Recharge;

class PostRepository implements PostContract
{
   public function createPost(array $array)
   {
      $post = new Post();
      $post->user_id = Auth::user()->id;
      $post->title_name = $array['title_name'];
      if (isset($array['image'])) {
         $file = $array['image'];
         $extension = $file->getClientOriginalExtension();
         $filename = time() . '.' . $extension;
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
      return [$post, $point];
   }

   public function sendRequest(array $array)
   {
      $total_point = Point::where('user_id', Auth::user()->id)->first();
      // dd($total_point->total_point);

      if ($total_point->total_point < 31) {
         $data['message'] = "Ooops Your Points is less than 30 points.....😔 ";
      } else if($array['request_point'] > $total_point->total_point){
         $data['error'] = "you cannot do recharge out of your total points.....";
      } else {
         $id = $total_point->id;
         $point_request = Point::find($id);
         $point_request->user_send_request = "Panding";
         $point_request->request_point = $array['request_point'];
         $point_request->total_point = $point_request->total_point - $array['request_point'];
         $point_request->save();

         $recharge = new Recharge();
         $recharge->user_id = Auth::user()->id;
         $recharge->recharge_point = $array['request_point'];
         $recharge->total_point = $point_request->total_point;
         $recharge->status = "Panding";
         $recharge->save();

         $data['recharge'] = "Request Send Suucessfully.....😊 ";
      }
      return $data;
   }
}
