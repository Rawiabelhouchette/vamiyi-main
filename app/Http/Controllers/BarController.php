<?php

namespace App\Http\Controllers;

use App\Models\Bar;
use App\Http\Requests\StoreBarRequest;
use App\Http\Requests\UpdateBarRequest;

class BarController extends Controller
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
        return view('admin.bar.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBarRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Bar $bar)
    {
        return view('admin.bar.show', compact('bar'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bar $bar)
    {
        return view('admin.bar.edit', compact('bar'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBarRequest $request, Bar $bar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bar $bar)
    {
        //
    }
}
