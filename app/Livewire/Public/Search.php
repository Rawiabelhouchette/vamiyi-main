<?php

namespace App\Livewire\Public;

use App\Models\Annonce;
use App\Models\Entreprise;
use App\Models\Favoris;
use App\Models\Quartier;
use App\Models\Ville;
use App\Utils\CustomSession;
use Livewire\Component;
use Livewire\WithPagination;

class Search extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $booted = true;

    // filter input on the back
    public $type = [];
    public $key = '';
    public $location = '';
    public $column = '';
    public $direction = '';
    public $ville = [];
    public $quartier = [];
    public $entreprise = [];

    protected $queryString = [
        'type',
        'key',
        'location',
        'column',
        'direction',
        'ville',
        'quartier',
        'entreprise',
    ];

    // filter input on the front (facette)
    public string $typeFilterValue = '';
    public string $villeFilterValue = '';
    public string $quartierFilterValue = '';
    public string $entrepriseFilterValue = '';

    public $sortOrder = 'created_at|desc'; // default sorting column and direction
    public $perPage = 10;
    // public $pageTest = 1;

    // List of facette's elements
    public $typeAnnonces = [];
    public $villes = [];
    public $quartiers = [];
    public $entreprises = [];

    private $initURL = '';


    public function mount($hasSessionValue)
    {
        if ($hasSessionValue) {
            $session = new CustomSession();
            $this->key = $session->key;
            $this->type = $session->type;
            $this->location = $session->location;
            $this->column = $session->column;
            $this->direction = $session->direction;
            $this->ville = $session->ville;
            $this->quartier = $session->quartier;
            $this->entreprise = $session->entreprise;
            $this->sortOrder = $session->sortOrder;
            // $this->setPage($session->page);
        }

        if (is_string($this->type)) {
            $this->type = [$this->type];
        }

        $this->changeTypeName();

        $this->type = array_filter($this->type ?? []);
        $this->ville = array_filter($this->ville ?? []);
        $this->quartier = array_filter($this->quartier ?? []);
        $this->entreprise = array_filter($this->entreprise ?? []);


        $this->getAllEntreprises();
        $this->getVillesParType();
        $this->getQuartiersParVilles();


        if ($this->location) {
            $tmp = explode(',', $this->location);
            if (count($tmp) == 3) {
                // pattern : quartier, ville, Pays
                $villesValues = array_column($this->villes, 'value');
                $quartiersValues = array_column($this->quartiers, 'value');

                if (in_array(trim($tmp[1]), $villesValues)) {
                    $this->ville[] = trim($tmp[1]);
                }

                if (in_array(trim($tmp[0]), $quartiersValues)) {
                    $this->quartier[] = trim($tmp[0]);
                }
            }
        }
        $this->location = '';

        $url = url()->current();

        $properties = ['type', 'ville', 'quartier'];
        $hasFirst = false;

        if ($this->key) {
            $url .= $hasFirst ? '&' : '?';
            $url .= 'key=' . $this->key;
            $hasFirst = true;
        }

        foreach ($properties as $property) {
            if ($this->$property) {
                foreach ($this->$property as $key => $value) {
                    $url .= $hasFirst ? '&' : '?';
                    $url .= $property . '[' . $key . ']=' . $value;
                    $hasFirst = true;
                }
            }
        }

        $url = str_replace(' ', '+', $url);

        $this->initURL = trim($url);
    }

    public function changeTypeName()
    {
        if (!$this->type) {
            $this->type = [];
        }
        // change vehicule to Location vehicule
        // check if type contains Véhicule if yes replace it with Location Véhicule
        if (in_array('Véhicule', $this->type)) {
            $key = array_search('Véhicule', $this->type);
            $this->type[$key] = 'Location de véhicule';
        }
    }

    private function getAllVilles(): void
    {
        $this->villes = [];
        foreach (Ville::all() as $ville) {
            $tmp = ['value' => $ville->nom, 'count' => $ville->nombre_annonce];
            $tmp = array_unique($tmp, SORT_REGULAR);
            if (!in_array($tmp, $this->villes)) {
                $this->villes[] = $tmp;
            }
        }
    }

    private function getAllQuartiers(): void
    {
        $this->quartiers = [];
        foreach (Quartier::all() as $quartier) {
            $tmp = ['value' => $quartier->nom, 'count' => $quartier->nombre_annonce];
            $tmp = array_unique($tmp, SORT_REGULAR);
            if (!in_array($tmp, $this->quartiers)) {
                $this->quartiers[] = $tmp;
            }
        }
    }

    public function getAllEntreprises()
    {
        $this->entreprises = [];
        // Company that have at least one active subscription
        // public scope filter the annonces that are public (that has a subscription)
        $entreprises = Entreprise::whereHas('annonces', function ($query) {
            $query->public();
        })->get();
        foreach ($entreprises as $entreprise) {
            $tmp = ['value' => $entreprise->nom, 'count' => $entreprise->nombre_annonces];
            $tmp = array_unique($tmp, SORT_REGULAR);
            if (!in_array($tmp, $this->entreprises)) {
                $this->entreprises[] = $tmp;
            }
        }
    }

    public function updatedSortOrder()
    {
        if (!$this->sortOrder) {
            return;
        }

        $parts = explode('|', $this->sortOrder);

        if (count($parts) === 2) {
            [$this->column, $this->direction] = $parts;
            $this->resetPage();
        }
    }

    public function changeState($value, $category, $remove = false)
    {
        $this->booted = false;

        if ($category == 'key' && $remove) {
            $this->key = '';
            $this->dispatch('resetSearchKey');
            return;
        }

        if (in_array($category, ['type', 'ville', 'quartier', 'entreprise'])) {
            if ($remove || in_array($value, $this->$category)) {
                $this->$category = array_diff($this->$category, [$value]);
            } else {
                array_push($this->$category, $value);
            }

            if ($category === 'type') {
                $this->getVillesParType();
            } elseif ($category === 'ville') {
                $this->getQuartiersParVilles();
            }
        }

        $this->dispatch('$refresh');

        $this->resetPage();
    }

    protected function getQuartiersParVilles()
    {
        if (count($this->ville) > 0) {
            $villes = $this->ville;
            $quartiers = [];
            // $annonces = Annonce::public()->where('type', $type)->get();
            $annonces = Annonce::public()->whereHas('entreprise.quartier.ville', function ($query) use ($villes) {
                $query->whereIn('nom', $villes);
            })->get();

            foreach ($annonces as $annonce) {
                $quartiers[] = ['value' => $annonce->entreprise->quartier->nom];
            }
            // parcourir chaque valeur et chercher le nombre d'annonce correspondant
            foreach ($quartiers as $key => $quartier) {
                $quartiers[$key]['count'] = Annonce::public()
                    ->whereHas('entreprise.quartier', function ($query) use ($quartier) {
                        $query->where('nom', 'like', '%' . $quartier['value'] . '%');
                    })
                    ->count();
            }
            $quartiers = array_unique($quartiers, SORT_REGULAR);
            $this->quartiers = $quartiers;
        } else {
            $this->getAllQuartiers();
        }

        $tmp = [];
        foreach ($this->quartiers as $quartier) {
            $tmp[] = $quartier['value'];
        }
        $this->quartier = array_intersect($this->quartier, $tmp);
    }

    protected function getVillesParType()
    {
        $this->getAllVilles();


        // if (count($this->type) > 0) { 
        // $quartiers = [];
        // $villes = [];
        // // $annonces = Annonce::public()->where('type', $type)->get();
        // $annonces = Annonce::public()->where(function ($query) use ($type) {
        //     foreach ($type as $t) {
        //         $query->orWhere('type', 'like', '%' . $t . '%');
        //     }
        // })->get();
        // foreach ($annonces as $annonce) {
        //     $quartiers[] = ['value' => $annonce->entreprise->quartier->nom];
        //     $villes[] = ['value' => $annonce->entreprise->quartier->ville->nom];
        // }
        // // parcourir chaque valeur et chercher le nombre d'annonce correspondant
        // foreach ($quartiers as $key => $quartier) {
        //     $quartiers[$key]['count'] = Annonce::public()->where('type', $type)->whereHas('entreprise.quartier', function ($query) use ($quartier) {
        //         $query->where('nom', 'like', '%' . $quartier['value'] . '%');
        //     })->count();
        // }
        // foreach ($villes as $key => $ville) {
        //     $villes[$key]['count'] = Annonce::public()->where('type', $type)->whereHas('entreprise.quartier.ville', function ($query) use ($ville) {
        //         $query->where('nom', 'like', '%' . $ville['value'] . '%');
        //     })->count();
        // }
        // // rendre le tableau unique
        // $quartiers = array_unique($quartiers, SORT_REGULAR);
        // $villes = array_unique($villes, SORT_REGULAR);
        // Filtre en fonction de du type selectionner
        // $this->quartiers = $quartiers;
        // $this->villes = $villes;
        // } else {
        //     $this->getAllVilles();
        //     // dd($this->villes);
        // }


    }

    public function updateFavoris($annonceId)
    {
        $favorite = Favoris::where('annonce_id', $annonceId)
            ->where('user_id', auth()->user()->id)
            ->first();
        if ($favorite) {
            $favorite->delete();
        } else {
            Favoris::create([
                'annonce_id' => $annonceId,
                'user_id' => auth()->user()->id,
            ]);
        }
    }


    public function search()
    {
        $annonces = Annonce::public()->with('entreprise');
        $annonces = $this->filters($annonces);
        // $annonces = $annonces->paginate($this->perPage);
        return $annonces;
    }

    // =============================== 
    // =========== FILTERS ===========
    // =============================== 

    public function resetFilters()
    {
        $this->key = '';
        $this->type = [];
        $this->location = '';
        $this->ville = [];
        $this->quartier = [];
        $this->entreprise = [];
        $this->column = '';
        $this->direction = '';
        $this->sortOrder = 'created_at|desc';
        $this->reset('typeFilterValue', 'villeFilterValue', 'quartierFilterValue', 'entrepriseFilterValue', 'ville');
        $this->dispatch('resetSearchBox');

        // dump($this->ville, $this->quartier);

    }

    // Apply all filters (the filters on the left side of the page)
    protected function filters($annonces)
    {
        $filters = [
            'filterByEntreprise',
            'filterByVille',
            'filterByQuartier',
            'filterAnnoncesByTypeKeyLocation',
            'filterByOrder',
        ];

        foreach ($filters as $filter) {
            $annonces = $this->$filter($annonces);
        }

        return $annonces;
    }

    // filter the annonces by type, key and location
    protected function filterAnnoncesByTypeKeyLocation($annonces)
    {
        if ($this->type) {
            $annonces = $annonces->where(function ($query) {
                foreach ($this->type as $type) {
                    $query->orWhere('type', 'like', '%' . $type . '%');
                }
            });
        }

        if ($this->key) {
            $key = $this->key;
            $annonces = $annonces->where(function ($query) use ($key) {
                $query->orWhereRaw('LOWER(titre) LIKE ?', ['%' . strtolower($key) . '%'])->orWhereRaw('LOWER(description) LIKE ?', ['%' . strtolower($key) . '%']);
            });
        }

        if ($this->location) {
            $parts = explode(',', $this->location);

            if (count($parts) > 0) {
                $quartier = trim($parts[0]);
                $annonces = $annonces->whereHas('entreprise.quartier', function ($query) use ($quartier) {
                    $query->where('nom', 'like', '%' . $quartier . '%');
                });
            }
        }

        return $annonces;
    }

    protected function filterByVille($annonces)
    {
        $this->location = '';

        if ($this->ville) {
            $villes = $this->ville;
            $annonces = $annonces->whereHas('entreprise.quartier.ville', function ($query) use ($villes) {
                $query->where(function ($query) use ($villes) {
                    foreach ($villes as $ville) {
                        $query->orWhere('nom', 'like', '%' . $ville . '%');
                    }
                });
            });
        }

        return $annonces;
    }

    public function filterByEntreprise($annonces)
    {
        if ($this->entreprise) {
            $entreprises = $this->entreprise;
            $annonces = $annonces->whereHas('entreprise', function ($query) use ($entreprises) {
                $query->whereIn('nom', $entreprises);
            });
        }

        return $annonces;
    }

    protected function filterByQuartier($annonces)
    {
        $this->location = '';

        if ($this->quartier) {
            $quartiers = $this->quartier;
            $annonces = $annonces->whereHas('entreprise.quartier', function ($query) use ($quartiers) {
                $query->where(function ($query) use ($quartiers) {
                    foreach ($quartiers as $quartier) {
                        $query->orWhere('nom', 'like', '%' . $quartier . '%');
                    }
                });
            });
        }

        return $annonces;
    }

    // Filter by order
    protected function filterByOrder($annonces)
    {
        if (!in_array($this->direction, ['asc', 'desc'])) {
            $this->direction = 'desc';
        }

        if (!in_array($this->column, ['created_at', 'titre'])) {
            $this->column = 'created_at';
        }

        $this->sortOrder = $this->column . '|' . $this->direction;

        if ($this->column && $this->direction) {
            $annonces = $annonces->orderBy($this->column, $this->direction);
        }

        return $annonces;
    }

    public function getFacettes(): array
    {
        return [
            (object) [
                'id' => uniqid(),
                'title' => 'Type d\'annonce',
                'category' => 'type',
                'items' => $this->typeAnnonces,
                'selectedItems' => $this->type,
                'icon' => 'ti-briefcase',
                'filterModel' => 'typeFilterValue',
            ],
            (object) [
                'id' => uniqid(),
                'title' => 'Ville',
                'category' => 'ville',
                'items' => $this->villes,
                'selectedItems' => $this->ville,
                'icon' => 'ti-map-alt',
                'filterModel' => 'villeFilterValue',
            ],
            (object) [
                'id' => uniqid(),
                'title' => 'Quartier',
                'category' => 'quartier',
                'items' => $this->quartiers,
                'selectedItems' => $this->quartier,
                'icon' => 'ti-location-pin',
                'filterModel' => 'quartierFilterValue',
            ],
            (object) [
                'id' => uniqid(),
                'title' => 'Entreprise',
                'category' => 'entreprise',
                'items' => $this->entreprises,
                'selectedItems' => $this->entreprise,
                'icon' => 'ti-briefcase',
                'filterModel' => 'entrepriseFilterValue',
            ],
        ];
    }

    public function render()
    {
        $this->typeAnnonces = Annonce::public()
            ->pluck('type')
            ->countBy()
            ->map(function ($count, $type) {
                return ['value' => $type, 'count' => $count];
            })
            ->values()
            ->all();

        $tmpTypeAnnonces = Annonce::pluck('type')->unique();

        // check if the type is in the typeAnnonces if not add it and add count 0
        foreach ($tmpTypeAnnonces as $type) {
            if (!in_array($type, array_column($this->typeAnnonces, 'value'))) {
                $this->typeAnnonces[] = ['value' => $type, 'count' => 0];
            }
        }

        // dd($this->type);

        $annonces = $this->search()->paginate($this->perPage);

        $this->saveVariableToSession();

        return view('livewire.public.search', [
            'annonces' => $annonces,
            'facettes' => $this->getFacettes(),
        ]);
    }


    public function rendering()
    {
        if (!$this->booted) {
            $this->dispatch('custom:element-removal', [
                'element' => $this->search()->get()->pluck('id')->toArray(),
                'perPage' => $this->perPage,
                'key' => $this->key,
                'facette' => count($this->type) + count($this->ville) + count($this->quartier) + count($this->entreprise),
            ]);
        }
    }

    private function saveVariableToSession()
    {
        CustomSession::clear();

        CustomSession::create([
            'annonces' => $this->search()->get()->pluck('id')->toArray(),
            'type' => $this->type,
            'key' => $this->key,
            'location' => $this->location,
            'column' => $this->column,
            'direction' => $this->direction,
            'ville' => $this->ville,
            'quartier' => $this->quartier,
            'entreprise' => $this->entreprise,
            'sortOrder' => $this->sortOrder,
            'page' => $this->search()->paginate($this->perPage)->currentPage(),
        ]);
    }

    public function rendered($view, $html)
    {
        $this->dispatch('refresh:filter');

        $this->dispatch('refresh:url', [
            'url' => $this->initURL,
        ]);
    }
}
