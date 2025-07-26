<?php

namespace App\Livewire\Public;

use Livewire\Component;

class Favoris extends Component
{
    public $isEnabled = false;

    public $annonceId;
    public $favorisId;

    public function mount($annonce)
    {
        if (auth()->guest()) {
            return;
        }
        
        $this->annonceId = $annonce->id;
        $favoris = \App\Models\Favoris::where('annonce_id', $this->annonceId)
            ->where('user_id', auth()->user()->id)
            ->first();
        if ($favoris) {
            $this->favorisId = $favoris->id;
            $this->isEnabled = true;
        } else {
            $this->isEnabled = false;
        }
    }

    public function updateFavoris()
    {
        if ($this->favorisId && $this->isEnabled) {
            \App\Models\Favoris::find($this->favorisId)->delete();
            $this->isEnabled = false;
        } else {
            $favoris = \App\Models\Favoris::create([
                'annonce_id' => $this->annonceId,
                'user_id' => auth()->user()->id,
            ]);
            $this->favorisId = $favoris->id;
            $this->isEnabled = true;
        }
    }

    public function render()
    {
        return view('livewire.public.favoris');
    }
}
