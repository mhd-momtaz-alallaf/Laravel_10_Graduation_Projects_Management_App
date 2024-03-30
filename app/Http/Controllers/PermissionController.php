<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class PermissionController extends Controller
{
    public function index(){
        return view('admin.permissions.index',['permissions'=>Permission::all()]);
    }

    public function store(){
        \request()->validate(['name'=>['required','unique:permissions']]);
        $permission = Permission::create([
            'name'=>Str::ucfirst(Str::lower(\request('name'))),
            'slug'=>Str::of(Str::lower(\request('name')))->slug('-')
        ]);
        Session::flash('permission-create-massage','The Permission '.$permission->name.' Was Created Successfully');
        return back();
    }

    public function edit(Permission $permission){
        return view('admin.permissions.edit',['permission'=>$permission]);
    }

    public function update(Permission $permission){
        \request()->validate(['name'=>'required']);

        $permission->name = Str::ucfirst(Str::lower(\request('name')));
        $permission->slug = Str::of(Str::lower(\request('name')))->slug('-');

        if ($permission->isDirty('name')){
            Session::flash('permission-update-massage','The Permission '.$permission->name.' Was Updated Successfully');
            $permission->save();
            return redirect()->route('permissions.index');
        }
        elseif ($permission->isClean('name')){
            Session::flash('permission-update-massage2','This value is the same, Nothing has been changed.');
            return back();
        }
    }

    public function destroy(Permission $permission){
        $permission->delete();
        Session::flash('permission-delete-massage','The Permission '.$permission->name.' Was Deleted Successfully');
        return back();
    }


}
