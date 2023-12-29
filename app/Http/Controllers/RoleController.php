<?php

namespace App\Http\Controllers;

use App\Tables\Roles;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use ProtoneMedia\Splade\SpladeForm;
use ProtoneMedia\Splade\Facades\Splade;
use App\Http\Requests\CreateRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use ProtoneMedia\Splade\FormBuilder\Input;
use ProtoneMedia\Splade\FormBuilder\Select;
use ProtoneMedia\Splade\FormBuilder\Submit;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index()
    {
        return view('admin.roles.index', [
            'roles' => Roles::class
        ]);
    }

    public function create() 
    {
        // $getPermission = Permission::pluck('name', 'id')->toArray();
        // $form = SpladeForm::make()
        //         ->action(route('admin.roles.store'))
        //         ->fields([
        //                 Input::make('name')->label('Name : '),
        //                 Select::make('permissions[]')
        //                         ->label('Choose multiple permissions')
        //                         ->options($getPermission)
        //                         ->multiple()    // Enables choosing multiple options
        //                         ->choices(),
        //                 Submit::make()->label('Submit')
        //             ])->class('space-y-4 bg-white rounded p-4');  

        return view('admin.roles.create', [
            // 'form' => $form
            'permissions' => Permission::pluck('name', 'id')->toArray()
        ]);  
    }

    public function store(CreateRoleRequest $request) 
    {
        $role = Role::create($request->validated());
        $role->syncPermissions($request->permissions);
        Splade::toast('Role created Successfully!')->autoDismiss(5);
        return to_route('admin.roles.index');
    }

    public function edit(Role $role)
    {
        return view('admin.roles.edit', [
            'role' => $role,
            'permissions' => Permission::pluck('name', 'id')->toArray()
        ]);
    }

    public function update(UpdateRoleRequest $request, Role $role)
    {   
        $role->update($request->validated());
        $role->syncPermissions($request->permissions);
        Splade::toast('Role updated Successfully!')->autoDismiss(5);
        return to_route('admin.roles.index');
    }

    public function destroy(Role $role) 
    {
        $role->delete();
        Splade::toast('Role Deleted Successfully!')->autoDismiss(5);
        return back();
    }
}
