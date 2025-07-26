<?php

namespace App\Http\Controllers;

use App\Models\Quartier;
use App\Http\Requests\StoreQuartierRequest;
use App\Http\Requests\UpdateQuartierRequest;

class QuartierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $quartiers = Quartier::with('ville')->get();
        return view("admin.localisation.quartier.index", compact("quartiers"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.localisation.quartier.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreQuartierRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Quartier $quartier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Quartier $quartier)
    {
        return view("admin.localisation.quartier.edit", compact("quartier"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateQuartierRequest $request, Quartier $quartier)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Quartier $quartier)
    {
        //
    }

    public function localisation()
    {
        $quartiers = Quartier::with("ville")->get();
        return view("admin.localisation.index", compact("quartiers"));
    }
}
