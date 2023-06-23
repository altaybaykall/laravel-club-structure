<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DashboardController extends Controller
{
    public  function  getRoles() {
        $roles =Role::select('id','name')->get();
        return view('Permission/roles-control',compact('roles'));
    }
    public  function  getRolePermission ($id) {
        $perm = Role::with('Permissions')->where('id',decrypt($id))->first();

        $notHaveIds = $perm['permissions'];
        $nothave = Permission::where(function ($query) use ($notHaveIds) {
            foreach ($notHaveIds as $id) {
                $query->where('id', '!=', $id->id);
            }
        })->get();
        return view('Permission/roles-permissions',compact('perm','nothave'));
    }
    public function  roleAddPermission($id,$permission) {
        $role = Role::where('id',decrypt($id))->first();
       $role->givePermissionTo($permission);
        return back();
    }
    public function  roleRemovePermission($id,$permission) {
        $role = Role::where('id',decrypt($id))->first();
        $role->revokePermissionTo($permission);
        return back();
    }
}
