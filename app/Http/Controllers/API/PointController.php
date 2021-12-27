<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contracts\PointContract;

class PointController extends Controller
{
    public function __construct(PointContract $Point)
    {
        $this->Point = $Point;
    }

    public function showPoint($id=null)
    {
        $point = $this->Point->showPoint($id);
        if(empty($point))
        {
            return "This ID is not stored in the database.";
        } else {
            return $point;
        }
    }
}
