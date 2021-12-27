<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contracts\RechargeHistoryContract;

class RechargeController extends Controller
{
    public function __construct(RechargeHistoryContract $Recharge)
    {
        $this->Recharge = $Recharge;
    }

    public function showRechargeHistory($id=null)
    {
        $recharge = $this->Recharge->showRechargeHistory($id);
        if(empty($recharge)){
            return "This ID is not stored in the database.";
        } else {
            return $recharge;
        }
    }
}
