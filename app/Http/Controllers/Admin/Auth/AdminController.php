<?php

namespace App\Http\Controllers\Admin\Auth;

use App\DataTables\AdminDatatable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use App\Http\Requests\Admin\AdminRequest;
use App\Http\Requests\Admin\EditAdminRequest;
use Illuminate\Support\Facades\DB;
class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(AdminDatatable $AdminDatatable)
    {
        return $AdminDatatable->render('admin.dashboard.listadmin');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role = Role::all();
        return view('admin.dashboard.addadmin', compact('role'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    public function store(AdminRequest $request)
    {
        $test = $request->input('tests');
        $roles = Role::where('id',$test)->select('name')->get();
        foreach($roles as $a){
            $name = $a['name'];
            // dd($name);
        }
        if($request['image'])
        {
            $file = $request['image'];
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('storage/admin/',$filename);
        }
        $data = Admin::create([
            'name' => $request->name, 
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'confirm_password' => $request->confirm_password,
            'image' => $filename,
            'assign_role' => $name,
        ]);
        $a = $request->input('tests');
        $data->assignRole([$a]);
        return redirect()->route('admin.adminuser.index');
        // $data->assignRole('User Manager');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Admin::find($id);
        $role = Role::all();
        $roles = DB::table("roles")->where("roles.name", $data->assign_role)->first();
        
        return view('admin.dashboard.editadmin', compact('data','role', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditAdminRequest $request, $id)
    {   
        $data = Admin::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        if (isset($request['image'])) {
            $destination = 'storage/admin/' . $data->image;
            if (file::exists($destination)) {
                file::delete($destination);
            }
            $file = $request['image'];
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('storage/admin/',$filename);
            $data->image = $filename;
        }
        $a = $request->input('permission');
        $data->assignRole([$a]);
        $data->save();
        return redirect()->route('admin.adminuser.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Admin::find($id);
        $data->delete();
        return $data;
    }
}
