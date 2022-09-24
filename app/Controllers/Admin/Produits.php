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

    public function show($id = null)
    {
        $produit = $this->chercheProduitOr404($id);

        $data = [
            'titre' => "Détails du produit : $produit->nom",
            'produit' => $produit,
        ];
        return view('Admin/Produits/show', $data);
    }

    public function recherche_produit()
    {
        if (!$this->request->isAJAX()) {
            exit('La page n\'existe pas !');
        }

        $produits = $this->produitModel->recherche_produit($this->request->getGet('term'));
        $return = [];

        foreach ($produits as $produit) {
            $data['id'] = $produit->id;
            $data['value'] = $produit->nom;

            $return[] = $data;
        }
        return $this->response->setJSON($return);
    }

    private function chercheProduitOr404(int $id = null)
    {
        if (!$id || !$produit = $this->produitModel->select('produits.*, categories.nom AS categorie')
                ->join('categories', 'categories.id = produits.categorie_id')
                ->withDeleted(true)
                ->where('produits.id', $id)
                ->first()) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Produit n'était pas trouvé");
        }
        return $produit;
    }

}
