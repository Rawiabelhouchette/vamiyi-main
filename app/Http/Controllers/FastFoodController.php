<?php

namespace App\Http\Controllers;

use App\Models\FastFood;
use App\Http\Requests\StoreFastFoodRequest;
use App\Http\Requests\UpdateFastFoodRequest;

class FastFoodController extends Controller
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
        return view('admin.fast-food.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFastFoodRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(FastFood $fastFood)
    {
        return view('admin.fast-food.show', compact('fastFood'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FastFood $fastFood)
    {
        return view('admin.fast-food.edit', compact('fastFood'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFastFoodRequest $request, FastFood $fastFood)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FastFood $fastFood)
    {
        //
    }
}
