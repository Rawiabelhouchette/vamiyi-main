<?php

namespace App\Http\Controllers;

use App\Models\Favoris;
use App\Http\Requests\StoreFavorisRequest;
use App\Http\Requests\UpdateFavorisRequest;

class FavorisController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFavorisRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Favoris $favoris)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Favoris $favoris)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFavorisRequest $request, Favoris $favoris)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Favoris $favoris)
    {
        //
    }
}
