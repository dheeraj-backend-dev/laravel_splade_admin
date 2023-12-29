<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Employee;
use App\Tables\Employees;
use Illuminate\Http\Request;
use App\Forms\CreateEmployeesForm;
use App\Forms\UpdateEmployeesForm;
use ProtoneMedia\Splade\Facades\Splade;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.employees.index', [
            'employees' => Employees::class
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.employees.create', [
            'form' => CreateEmployeesForm::class
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, CreateEmployeesForm $form)
    {
        $city = City::findOrFail($request->city_id);
        $data = $form->validate($request);
        $result = array_merge($data, [
            'country_id' => $city->state->country_id,
            'state_id' => $city->state_id
        ]);
        Employee::create($result);
        Splade::toast("Employees Created successfully")->autoDismiss(5);
        return to_route('admin.employees.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        return view('admin.employees.edit', [
            'form' => UpdateEmployeesForm::make()
            ->action(route('admin.employees.update', $employee))
            ->fill($employee)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee, UpdateEmployeesForm $form)
    {
        $city = City::findOrFail($request->city_id);
        $data = $form->validate($request);
        $result = array_merge($data, [
            'country_id' => $city->state->country_id,
            'state_id' => $city->state_id
        ]);
        $employee->update($result);
        Splade::toast("Employees Updated successfully")->autoDismiss(5);
        return to_route('admin.employees.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();
        Splade::toast("Employee successfully deleted.")->autoDismiss(5);
        return back();
    }
}
