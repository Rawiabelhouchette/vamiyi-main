<?php

namespace App\Livewire\Admin;


use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Comment extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    private $perPage = 20;
    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $search = $this->search;
        $user = User::find(auth()->user()->id);
        $annonces = $user->commentaires()->where(function ($query) use ($search) {
            $query->orWhereRaw('LOWER(titre) LIKE ?', ['%' . strtolower($search) . '%'])
                ->orWhereRaw('LOWER(description) LIKE ?', ['%' . strtolower($search) . '%']);
        })->paginate($this->perPage);
        return view('livewire.admin.comment', compact('annonces'));
    }
}
