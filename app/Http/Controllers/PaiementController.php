<?php

namespace App\Http\Controllers;

use App\Models\OffreAbonnement;
use App\Services\Paiement\PaiementService;
use Illuminate\Http\Request;
use Log;

class PaiementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $validated = session()->get('abonnement');
        if (!$validated) {
            return redirect()->route('pricing');
        }

        // prix et id de l'utilisateur
        $guichet = PaiementService::getGuichet(auth()->user()->id, $validated);

        if ($guichet->status == 'success') {
            return redirect($guichet->url);
        } else {
            Log::error('' . $guichet->status);
            return back()->with('error', $guichet->status);
        }
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    public function returnURL()
    {
    }

    public function notifyURL()
    {
    }
}
