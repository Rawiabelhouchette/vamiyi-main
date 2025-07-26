<?php

namespace App\Http\Controllers;

use App\Models\Entreprise;
use App\Http\Requests\StoreEntrepriseRequest;
use App\Http\Requests\UpdateEntrepriseRequest;
use Illuminate\Support\Facades\Auth;

class EntrepriseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->hasRole('Professionnel')) {
            return redirect()->route('entreprises.show', Auth::user()->entreprises->first());
        } else {
            $entreprises = Entreprise::with('quartier', 'quartier.ville', 'quartier.ville.pays')->get();
        }

        return view('admin.entreprise.index', compact('entreprises'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.entreprise.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEntrepriseRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Entreprise $entreprise)
    {
        // check if the user is the owner of the entreprise
        if (!Auth::user()->hasRole('Administrateur') && !Auth::user()->entreprises->contains($entreprise)) {
            return redirect()->route('home');
        }
        return view('admin.entreprise.show', compact('entreprise'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Entreprise $entreprise)
    {
        // check if the user is the owner of the entreprise
        if (!Auth::user()->hasRole('Administrateur') && !Auth::user()->entreprises->contains($entreprise)) {
            return redirect()->route('home');
        }
        return view('admin.entreprise.edit', compact('entreprise'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEntrepriseRequest $request, Entreprise $entreprise)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Entreprise $entreprise)
    {
        //
    }
}
