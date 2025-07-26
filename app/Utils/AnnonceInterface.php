<?php

namespace App\Utils;

use Illuminate\View\View;

/**
 * Interface AnnonceInterface
 * @package App\Utils
 * @property string $show_url
 * @property string $edit_url
 * @property array $caracteristiques
 */

interface AnnonceInterface
{
    public function getShowUrlAttribute(): string;
    public function getEditUrlAttribute(): string;

    public function getShowInformationBody(): View;
    public function getShowInformationHeader(): View;

    public function getCaracteristiquesAttribute(): array;

    // public function getInformationsAttribute(): View;
    // public function getEquipementsAttribute(): View;
}
