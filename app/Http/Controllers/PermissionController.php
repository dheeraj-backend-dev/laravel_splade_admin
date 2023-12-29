<?php

namespace App\Http\Controllers;

use App\Tables\Permissions;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\SpladeForm;
use ProtoneMedia\Splade\Facades\Splade;
use Spatie\Permission\Models\Permission;
use ProtoneMedia\Splade\FormBuilder\Input;
use ProtoneMedia\Splade\FormBuilder\Submit;
use App\Http\Requests\CreatePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    public function index()
    {
        return view('admin.permissions.index', [
            'permissions' => Permissions::class
        ]);
    }

    public function create() 
    {
        // $form = SpladeForm::make()
        //         ->action(route('admin.permissions.store'))
        //         ->fields([
        //                 Input::make('name')->label('Name : '),
        //                 Submit::make()->label('Submit')
        //             ])->class('space-y-4 bg-white rounded p-4');  

        return view('admin.permissions.create', [
            // 'form' => $form
            'roles' => Role::pluck('name', 'id')->toArray()
        ]);  
    }

    public function store(CreatePermissionRequest $request) 
    {
        $permission = Permission::create($request->validated());
        $permission->syncRoles($request->roles);
        Splade::toast('Permission created Successfully!')->autoDismiss(5);
        return to_route('admin.permissions.index');
    }

    public function edit(Permission $permission)
    {
        // $form = SpladeForm::make()->action(route('admin.permissions.update', $permission))->method('PUT')->fields([
        //     Input::make('name')->label('Name : '),
        //     Submit::make()->label('Update')
        // ])->fill($permission)->class('space-y-4 bg-white rounded p-4');

        return view('admin.permissions.edit', [
            // 'form' => $form
            'roles' => Role::pluck('name', 'id')->toArray(),
            'permission' => $permission
        ]);
    }

    public function update(UpdatePermissionRequest $request, Permission $permission)
    {   
        $permission->update($request->validated());
        $permission->syncRoles($request->roles);
        Splade::toast('Permission updated Successfully!')->autoDismiss(5);
        return to_route('admin.permissions.index');
    }

    public function destroy(Permission $permission) 
    {
        $permission->delete();
        Splade::toast('Permission Deleted Successfully!')->autoDismiss(5);
        return back();
    }
}
