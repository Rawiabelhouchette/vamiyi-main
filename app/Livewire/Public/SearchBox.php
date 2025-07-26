<?php

namespace App\Livewire\Public;

use App\Models\Annonce;
use App\Models\Quartier;
use App\Utils\AnnoncesUtils;
use Livewire\Component;
use Livewire\Attributes\On; 

class SearchBox extends Component
{
    public $detail;
    public $location;
    public $type;
    public $key;

    public function mount($detail = false)
    {
        $this->detail = $detail;
    }

    #[On('resetSearchBox')]
    public function resetLocation()
    {
        $this->location = '';
        // $this->type = [];
        $this->key = '';
        $this->dispatch('search-type-input:reload');
    }

    public function render()
    {
        $typeAnnonce = Annonce::public()->pluck('type')->unique()->toArray();

        $params = AnnoncesUtils::getQueryParams();
        $this->key = $params->key ?? '';
        $this->location = $params->location ?? '';
        $this->type = $params->type[0] ?? '';

        $quartiers = Quartier::getAllQuartiers();

        return view('livewire.public.search-box', [
            'typeAnnonce' => $typeAnnonce,
            'quartiers' => $quartiers,
        ]);
    }
}
