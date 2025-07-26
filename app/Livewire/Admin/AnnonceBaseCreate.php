<?php

namespace App\Livewire\Admin;


trait AnnonceBaseCreate {
    public $selected_images = [];
    public $galerie = [];
    public $image;


    public function updatedSelectedImages($images)
    {
        foreach ($images as $image) {
            $this->galerie[] = $image;
        }

        $this->selected_images = [];
    }

    public function removeImage($index)
    {
        unset($this->galerie[$index]);
        $this->galerie = array_values($this->galerie); // Réindexer le tableau après suppression
    }

    public function removeAllImages()
    {
        $this->galerie = [];
    }

    public function removeGalerie($index)
    {
        unset($this->galerie[$index]);
        $this->galerie = array_values($this->galerie); // Réindexer le tableau après suppression
    }
}