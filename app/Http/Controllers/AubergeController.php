<?php

namespace App\Http\Controllers;

use App\Models\Auberge;
use App\Http\Requests\StoreAubergeRequest;
use App\Http\Requests\UpdateAubergeRequest;

class AubergeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.auberge.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.auberge.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAubergeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Auberge $auberge)
    {
        
        return view('admin.auberge.show', compact('auberge'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Auberge $auberge)
    {
        // $auberge->load('annonce');/
        return view('admin.auberge.edit', compact('auberge'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAubergeRequest $request, Auberge $auberge)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Auberge $auberge)
    {
        //
    }
}
