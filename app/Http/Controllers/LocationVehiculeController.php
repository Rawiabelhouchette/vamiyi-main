<?php

namespace App\Http\Controllers;

use App\Models\LocationVehicule;
use App\Http\Requests\StoreLocationVehiculeRequest;
use App\Http\Requests\UpdateLocationVehiculeRequest;

class LocationVehiculeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.location-vehicule.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLocationVehiculeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(LocationVehicule $locationVehicule)
    {
        return view('admin.location-vehicule.show', compact('locationVehicule'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LocationVehicule $locationVehicule)
    {
        return view('admin.location-vehicule.edit', compact('locationVehicule'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLocationVehiculeRequest $request, LocationVehicule $locationVehicule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LocationVehicule $locationVehicule)
    {
        //
    }
}
