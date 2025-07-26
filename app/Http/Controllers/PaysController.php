<?php

namespace App\Http\Controllers;

use App\Models\Pays;
use App\Http\Requests\StorePaysRequest;
use App\Http\Requests\UpdatePaysRequest;

class PaysController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pays = Pays::all();
        return view('admin.localisation.pays.index', compact('pays'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.localisation.pays.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePaysRequest $request)
    {
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Pays $pays)
    {
        dd('show');
        dd($pays->id);
        return view('admin.localisation.pays.edit', compact('pays'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pays $pay)
    {
        return view('admin.localisation.pays.edit', compact('pay'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePaysRequest $request, Pays $pays)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pays $pays)
    {
        //
    }
}
