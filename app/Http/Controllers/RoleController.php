<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use function Symfony\Component\String\b;

class RoleController extends Controller
{
    public function index(){
        return view('admin.roles.index',['roles'=>Role::all()]);
    }

    public function store(){
        \request()->validate(['name'=>['required','unique:roles']]);

         $role = Role::create([
            'name'=>Str::ucfirst(Str::lower(\request('name'))),
            'slug'=>Str::of(Str::lower(\request('name')))->slug('-')
        ]);
        Session::flash('role-create-massage','The Role '.$role->name.' Was Created Successfully');
        return back();
    }
    public function edit(Role $role){
        return view('admin.roles.edit',[
            'role'=>$role,
            'permissions'=>Permission::all()
        ]);
    }
    public function update(Role $role){
        \request()->validate(['name'=>['required']]);

        $role->name = Str::ucfirst(Str::lower(\request('name')));
        $role->slug = Str::of(Str::lower(\request('name')))->slug('-');

        if ($role->isDirty('name')){
            Session::flash('role-update-massage','The Role '.$role->name.' Was Updated Successfully');
            $role->save();
            return redirect()->route('roles.index');
        }
        elseif ($role->isClean('name')){
            Session::flash('role-update-massage2','This value is the same, Nothing has been changed.');
            return back();
        }
    }

    public function attach_permission(Role $role){
        $role->permissions()->attach(request('permission'));
        return back();
    }

    public function detach_permission(Role $role){
        $role->permissions()->detach(request('permission'));
        return back();
    }

    public function destroy(Role $role){
        $role->delete();
        Session::flash('role-delete-massage','The Role '.$role->name.' Was Deleted Successfully');
        return back();
    }
}
