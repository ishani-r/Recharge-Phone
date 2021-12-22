<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\SettingRequest;

use App\Contracts\SettingContract;
use App\Repositories\SettingRepository;

class SettingController extends Controller
{
    public function __construct(SettingContract $Setting)
    {
        $this->Setting = $Setting;
    }

    public function store(SettingRequest $request)
    {
        $set = $this->Setting->store($request->all());
        return $set;
    }

    public function update(Request $request,$id)
    {
        $set = $this->Setting->update($request->all(),$id);
        return response()->json([
            'message' => 'Data Updated Successfully',
            'set' => $set
        ]);
    }

    public function destroy($id)
    {
        $set = $this->Setting->destroy($id);
        return "Data Deleted Successfully";
    }
}