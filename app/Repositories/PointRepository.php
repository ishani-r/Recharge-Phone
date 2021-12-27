<?php

namespace App\Repositories;
use App\Contracts\PointContract;
use App\Models\Point;

class PointRepository implements PointContract
{
   public function showPoint($id)
   {
      $data = $id ? Point::find($id) : Point::all();
      return $data;
   }
}

?>