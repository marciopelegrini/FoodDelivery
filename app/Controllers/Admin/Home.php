<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Home extends BaseController
{
    public function index()
    {
        $data = [
            'titre' => 'Accueil de la page Admin'
        ];
        return view('Admin/Home/index', $data);
    }
}
