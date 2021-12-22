<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UsersImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        if(!is_string($row[0]))
        {
            if(isset($row[1]) && !empty($row[1]))
            {
                $id=$row[1];
            }
            else {
                $id=Auth::user()->id;
            }

            $arr=[];

            $arr=[
                'id'=>$row[0],
                'name'=>$row[1],
                'mobile'=>$row[2],
                'email'=>$row[3],
                'gender'=>$row[5],
                'dob' => date('Y-m-d', strtotime($row[6])),
                'image'=>$row[7],
                'password'=>$row[8],
                'status'=>$row[9],
                'slug'=>$row[10],
            ];

            DB::table('users')->insert($arr);
        }
    }
}
