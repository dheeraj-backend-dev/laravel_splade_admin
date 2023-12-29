<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Tables\Departments;
use Illuminate\Http\Request;
use App\Forms\CreateDepartmentsForm;
use App\Forms\UpdateDepartmentsForm;
use ProtoneMedia\Splade\Facades\Splade;

class DepartmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.departments.index', [
            'departments' => Departments::class
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.departments.create', [
            'form' => CreateDepartmentsForm::class
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, CreateDepartmentsForm $form)
    {
        $data = $form->validate($request);
        // dd($data);
        Department::create($data);
        Splade::toast("Department Created successfully")->autoDismiss(5);
        return to_route('admin.departments.index');
    }

    /**
     * Display the specified resource.
     */
    public function edit(Department $department)
    {
        return view('admin.departments.edit', [
            'form' => UpdateDepartmentsForm::make()
            ->action(route('admin.departments.update', $department))
            ->fill($department)
        ]);
    }

   
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Department $department, UpdateDepartmentsForm $form)
    {
        $data = $form->validate($request);
        $department->update($data);
        Splade::toast("Department Updated successfully")->autoDismiss(5);
        return to_route('admin.departments.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        $department->delete();
        Splade::toast("Department successfully deleted.")->autoDismiss(5);
        return back();
    }
}
