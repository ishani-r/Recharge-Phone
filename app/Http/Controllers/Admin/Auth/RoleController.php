<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\RoleDatatable;
use App\Models\RoleHasPermission;
// use App\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(RoleDatatable $RoleDatatable)
    {
        $role = Role::all();
        return view('admin.dashboard.listrole', compact('role'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $per = Permission::all();
        $permission = Permission::all();
        return view('admin.dashboard.addrole', compact('per','permission'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $data = new Role();
        // $data->name = $request->name;
        // $data->guard_name = $request->guard_name;
        // $data->save();
        // $a = $data->givePermissionTo($test);
        $data = Role::create(['name' => $request->name, 'guard_name' => "admin"]);
        $data->syncPermissions($request->input('permission'));
        return redirect()->route('admin.role.index');
    }

    public function checkName(Request $request)
    {
        if ($request->get('name')) {
            $name = $request->get('name');
            $data = DB::table("roles")->where('name', $name)->count();
            if ($data > 0) {
                return 'Name_Exists';
            } else {
                return 'Unique';
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Role::find($id);
        return view('');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::find($id);
        $permission = Permission::all();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();
        return view('admin.dashboard.editroles', compact('role', 'permission', 'rolePermissions'));
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
        $data = Role::find($id);
        $data->name = $request->name;
        $data->syncPermissions($request->input('permission'));
        $data->save();
        return redirect()->route('admin.role.index');
        // $test = $request->input('test');
        // $a = $data->givePermissionTo($test);
        // foreach($test as $a){
        //     $b = $a;
        // }
        // dd($b);
        // foreach($test as $tests){
        //     $role_has_permission = new RoleHasPermission();
        //     $role_has_permission->$tests;
        //     $role_has_permission->role_id = $data->id;
        // }
        // dd($role_has_permission);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::find($id);
        $role->delete();
        return $role;
    }
}
