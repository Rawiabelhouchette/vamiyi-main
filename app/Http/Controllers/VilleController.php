<?php

namespace App\Http\Controllers;

use App\Models\Ville;
use App\Http\Requests\StoreVilleRequest;
use App\Http\Requests\UpdateVilleRequest;

class VilleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $villes = Ville::with('pays')->get();
        return view('admin.localisation.ville.index', compact('villes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.localisation.ville.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVilleRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Ville $ville)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ville $ville)
    {
        return view('admin.localisation.ville.edit', compact('ville'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVilleRequest $request, Ville $ville)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ville $ville)
    {
        //
    }
}
