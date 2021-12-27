<?php

namespace App\Repositories;
use App\Contracts\RechargeHistoryContract;
use App\Models\Recharge;

class RechargeHistoryRepository implements RechargeHistoryContract
{
   public function showRechargeHistory($id)
   {
      $data = $id ? Recharge::find($id) : Recharge::all();
      return $data;
   }
}

?>