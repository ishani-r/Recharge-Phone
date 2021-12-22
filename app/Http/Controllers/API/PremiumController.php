<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Contracts\PremiumContract;
use App\Repositories\PremiumRepository;

class PremiumController extends Controller
{
    public function __construct(PremiumContract $Premium)
    {
        $this->Premium = $Premium;
    }
    
    public function store(Request $request)
    {
        $pre = $this->Premium->store($request->all());
        return response()->json([
            'message' => 'Data sucessfully inserted',
            'pre' => $pre
        ]);
    }
    
    public function update(Request $request, $id)
    {
        $pre = $this->Premium->update($request->all(),$id);
        return response()->json([
            'message' => 'Data updated sucessfully',
        ]);

    }

    public function destroy($id)
    {
        $pre = $this->Premium->destroy($id);
        return "Data Deleted Successfully";
    }
}
