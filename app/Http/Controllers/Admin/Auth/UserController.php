<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\DataTables\UsersDataTable;
use Illuminate\Support\Facades\File;
use App\Http\Requests\Admin\UserRequest;
use Illuminate\Support\Facades\Hash;

use App\Contracts\UserContract;
use App\Repositories\UserRepository;
use Maatwebsite\Excel\Row;

class UserController extends Controller
{
    public function __construct(UserContract $User)
    {
        $this->User = $User;
        $this->middleware('permission:view-user-data', ['only' => ['show']]);
        $this->middleware('permission:update-user-data', ['only' => ['edit','update']]);
        $this->middleware('permission:delete-user-data', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UsersDataTable $dataTable)
    {
        // $user = User::all();
        return $dataTable->render('admin.dashboard.userlist');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $user = User::find('1');
        // // $user = Role::find('1');
        // $user->assignRole([2]);
        // $user = User::create([
        //     'name' => 'dfd Savaddsdasani', 
        //     'email' => 'adddemin@gsmail.com',
        //     'password' => bcrypt('123456')
        // ]);
        // $role = Role::create(['name' => 'sahise','guard_name'=>'web']);
        // $user->assignRole([$role->id]);
        // dd($user);
        $role = Role::all();
        return view('admin.dashboard.adduser', compact('role'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = User::find('1');
        // dd($user);
        // $user->assignRole($request->input('test'));
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $input['status'] = "Active";
        $input['slug'] = $input['name'];

        $a = $request->input('test');
        $user = User::create($input);
        $user->assignRole([$a]);
        return redirect()->route('admin.dashboard.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = $this->User->show($id);
        return view('admin.dashboard.showuser', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = User::find($id);
        $role = Role::all();
        return view('admin.dashboard.edituser', compact('data','role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->name;
        $user->mobile = $request->mobile;
        $user->email = $request->email;
        $user->gender = $request->gender;
        if($request->hasfile('image'))
        {
            $destination = 'storage/admin/'.$user->image;
            if(file::exists($destination))
            {
                file::delete($destination);
            }
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('storage/admin/',$filename);
            $user->image = $filename;
        }
        // $a = $request->input('test');
        // dd($a);
        // $user->assignRole([$a]);
        $user->save();
        return redirect()->route('admin.dashboard.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = $this->User->destroy($id);
        return $data;
    }

   
}
