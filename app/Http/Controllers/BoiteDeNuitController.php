<?php

namespace App\Http\Controllers;

use App\Models\BoiteDeNuit;
use App\Http\Requests\StoreBoiteDeNuitRequest;
use App\Http\Requests\UpdateBoiteDeNuitRequest;

class BoiteDeNuitController extends Controller
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
        return view('admin.boite-de-nuit.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBoiteDeNuitRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(BoiteDeNuit $boiteDeNuit)
    {
        return view('admin.boite-de-nuit.show', compact('boiteDeNuit'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BoiteDeNuit $boiteDeNuit)
    {
        return view('admin.boite-de-nuit.edit', compact('boiteDeNuit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBoiteDeNuitRequest $request, BoiteDeNuit $boiteDeNuit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BoiteDeNuit $boiteDeNuit)
    {
        //
    }
}
