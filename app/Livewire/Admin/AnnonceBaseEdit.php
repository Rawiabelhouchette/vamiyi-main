<?php

namespace App\Livewire\Admin;


trait AnnonceBaseEdit {
    public $old_galerie = [];
    public $deleted_old_galerie = [];
    public $is_old_galerie = true;
    public $old_image;

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

    public function removeImage($array_name, $index)
    {
        if($array_name == 'old_galerie') {
            $this->deleted_old_galerie[] = $index; // correspond à l'id de l'image dans la base de données
        } else if ($array_name == 'galerie') {
            unset($this->galerie[$index]);
            $this->galerie = array_values($this->galerie); // Réindexer le tableau après suppression
        }
    }

    public function removeAllImages() {
        $this->galerie = [];
        $this->deleted_old_galerie = [];
        foreach ($this->old_galerie as $image) {
            $this->deleted_old_galerie[] = $image->id;
        }
    }

    // Cancel all modifications
    public function restoreImages() {
        $this->galerie = [];
        $this->deleted_old_galerie = [];
    }
}