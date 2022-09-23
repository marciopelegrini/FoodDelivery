<?php

namespace App\Models;

use CodeIgniter\Model;

class ProduitModel extends Model
{
    protected $table = 'produits';
    protected $returnType = 'App\Entities\Produit';
    protected $useSoftDeletes = true;
    protected $allowedFields = [
        'categorie_id',
        'nom',
        'slug',
        'photo',
        'ingredients',
        'actif',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    protected $validationRules = [
        'nom' => 'required|min_length[4]|max_length[128]|is_unique[produits.nom]',
        'categorie_id' => 'required|integer',
        'ingredients' => 'required|min_length[4]|max_length[1000]',
    ];

    protected $validationMessages = [
        'nom' => [
            'required' => 'Le nom du produit est obligatoire.',
            'is_unique' => 'Ce produit existe déjà.',
        ],
        'categorie_id' => [
            'required' => 'Le champ catégorie est obligatoire.',
        ],
    ];

    //Evénéments callback
    protected $beforeInsert = ['creerSlug'];
    protected $beforeUpdate = ['creerSlug'];

    protected function creerSlug(array $data)
    {
        if (isset($data['data']['nom'])) {
            $data['data']['slug'] = mb_url_title($data['data']['nom'], '-', true);
        }

        return $data;
    }

    public function retablir_produit(int $id)
    {
        return $this->protect(false)->where('id', $id)
            ->set('deleted_at', null)
            ->update();
    }

    public function recherche_produit($term)
    {
        if ($term === null) {
            return [];
        }

        return $this->select('id, nom')
            ->like('nom', $term)
            ->withDeleted(true)
            ->get()
            ->getResult();
    }
}
