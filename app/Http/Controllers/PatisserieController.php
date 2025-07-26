<?php

namespace App\Http\Controllers;

use App\Models\Patisserie;
use App\Http\Requests\StorePatisserieRequest;
use App\Http\Requests\UpdatePatisserieRequest;

class PatisserieController extends Controller
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
        return view('admin.patisserie.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePatisserieRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Patisserie $patisserie)
    {
        return view('admin.patisserie.show', compact('patisserie'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Patisserie $patisserie)
    {
        return view('admin.patisserie.edit', compact('patisserie'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePatisserieRequest $request, Patisserie $patisserie)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Patisserie $patisserie)
    {
        //
    }
}
