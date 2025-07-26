<?php

namespace App\Utils;

class CustomSessionAlt
{
    public $key = '';
    public $type = '';
    public $sortOrder = '';
    public $column = '';
    public $direction = '';
    public $url = '';
    public $annonces;

    public function __construct()
    {
        $this->key = session()->get('search_key');
        $this->type = session()->get('search_type');
        $this->sortOrder = session()->get('search_sortOrder');
        $this->column = session()->get('search_column');
        $this->direction = session()->get('search_direction');
        $this->url = session()->get('search_url');
        $this->annonces = session()->get('search_annonces');
    }

    public static function create($data = [])
    {
        if (empty($data)) {
            return new self();
        }

        session(['search_key' => $data['key'] ?? '']);
        session(['search_type' => $data['type'] ?? '']);
        session(['search_sortOrder' => !session()->get('search_sortOrder') ? $data['sortOrder'] ?? '' : session()->get('search_sortOrder')]);
        session(['search_column' => !session()->get('search_column') ? $data['column'] ?? '' : session()->get('search_column')]);
        session(['search_direction' => !session()->get('search_direction') ? $data['direction'] ?? '' : session()->get('search_direction')]);
        session(['search_url' => $data['url'] ?? '']);
        session(['search_annonces' => $data['annonces'] ?? null]);
        return new self();
    }

    public function save()
    {
        session(['search_key' => $this->key]);
        session(['search_type' => $this->type]);
        session(['search_sortOrder' => $this->sortOrder]);
        session(['search_column' => $this->column]);
        session(['search_direction' => $this->direction]);
        session(['search_url' => $this->url]);
        session(['search_annonces' => $this->annonces]);
    }

    public static function clear()
    {
        session()->forget('search_key');
        session()->forget('search_type');
        session()->forget('search_sortOrder');
        session()->forget('search_column');
        session()->forget('search_direction');
        session()->forget('search_url');
        session()->forget('search_annonces');
    }
}
