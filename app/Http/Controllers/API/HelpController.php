<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\User;
use App\Http\Requests\Admin\ContactRequest;

class HelpController extends Controller
{
    public function show(Request $request)
    {
        $question = $request['question'];

        $help = DB::table('helps')
        ->select('helps.question', 'helps.answer')
        ->where('question', '=', $question)
        ->get();
        return $help;
        
    }

    public function store(ContactRequest $request)
    {
        $record = User::where('email', $request['email'])->first();
        if($record){
            $data = new Contact();
            $data->subject = $request->subject;
            $data->email = $request->email;
            $data->message = $request->message;
            $data->save();
            return "Data Save Successfully";
        }else{
            return "Email is not exists !!";
        }
    }
}
