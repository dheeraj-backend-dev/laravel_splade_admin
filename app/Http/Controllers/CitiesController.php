<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Tables\Cities;
use Illuminate\Http\Request;
use App\Forms\CreateCitiesForm;
use App\Forms\UpdateCitiesForm;
use ProtoneMedia\Splade\Facades\Splade;

class CitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.cities.index', [
            'cities' => Cities::class
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.cities.create', [
            'form' => CreateCitiesForm::class
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, CreateCitiesForm $form)
    {
        $data = $form->validate($request);
        // dd($data);
        City::create($data);
        Splade::toast("City Created successfully")->autoDismiss(5);
        return to_route('admin.cities.index');
    }

    /**
     * Display the specified resource.
     */
    public function edit(City $city)
    {
        return view('admin.cities.edit', [
            'form' => UpdateCitiesForm::make()
            ->action(route('admin.cities.update', $city))
            ->fill($city)
        ]);
    }

   
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, City $city, UpdateCitiesForm $form)
    {
        $data = $form->validate($request);
        $city->update($data);
        Splade::toast("City Updated successfully")->autoDismiss(5);
        return to_route('admin.cities.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(City $city)
    {
        $city->delete();
        Splade::toast("City successfully deleted.")->autoDismiss(5);
        return back();
    }
}
