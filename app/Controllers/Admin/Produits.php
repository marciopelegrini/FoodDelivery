<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Entities\Produit;
use App\Models\ProduitModel;

class Produits extends BaseController
{
    private $produitModel;

    public function __construct()
    {
        $this->produitModel = new ProduitModel();
    }

    public function index()
    {
        $data = [
            'titre' => 'Liste des produits enregistrées.',
            'produits' => $this->produitModel
                ->select('produits.*, categories.nom AS categorie')
                ->join('categories', 'categories.id = produits.categorie_id')
                ->withDeleted(true)
                ->paginate(10),
            'pager' => $this->produitModel->pager,
        ];

        return view('Admin/Produits/index', $data);
    }
}
