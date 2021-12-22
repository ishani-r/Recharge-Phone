<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\PermissionDatatable;
use App\Models\Permission;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PermissionDatatable $PermissionDatatable)
    {
        return $PermissionDatatable->render('admin.dashboard.listpermission');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.dashboard.addpermission');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $permissions = array();
        $create_per = $request->module_name . '-create';
        $update_per = $request->module_name . '-update';
        $view_per = $request->module_name . '-list';
        $delete_per = $request->module_name . '-delete';
        
        $permissions[] = $create_per;
        $permissions[] = $update_per;
        $permissions[] = $view_per;
        $permissions[] = $delete_per;
        foreach ($permissions as $permission) {
            Permission::create(
                [
                    'module_name' => $request->module_name,
                    'name' => $permission,
                    'guard_name' => $request->guard_name,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]
            );
        }
        return redirect()->route('admin.permission.index');
    }

    public function moduleName(Request $request)
    {
        if ($request->get('module_name')) {
            $module_name = $request->get('module_name');
            $data = DB::table("permissions")->where('module_name', $module_name)->count();
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
        $data = Permission::find($id);
        return view('admin.dashboard.editpermission' ,compact('data'));
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
        $data = Permission::find($id);
        $data->name = $request->name;
        $data->save();
        return redirect()->route('admin.permission.index', compact('data'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Permission::find($id);
        $data->delete();
        return $data;
    }
}
