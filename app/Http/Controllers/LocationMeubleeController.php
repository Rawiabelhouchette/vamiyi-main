<?php

namespace App\Http\Controllers;

use App\Models\LocationMeublee;
use App\Http\Requests\StoreLocationMeubleeRequest;
use App\Http\Requests\UpdateLocationMeubleeRequest;

class LocationMeubleeController extends Controller
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
        return view('admin.location-meublee.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLocationMeubleeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(LocationMeublee $LocationMeublee)
    {
        return view('admin.location-meublee.show', compact('LocationMeublee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LocationMeublee $LocationMeublee)
    {
        return view('admin.location-meublee.edit', compact('LocationMeublee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLocationMeubleeRequest $request, LocationMeublee $LocationMeublee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LocationMeublee $LocationMeublee)
    {
        //
    }
}
