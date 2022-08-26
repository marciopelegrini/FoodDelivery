<?php

namespace App\Models;

use CodeIgniter\Model;

class CategorieModel extends Model
{
    protected $table = 'categories';
    protected $returnType = '\App\Entities\Categorie';
    protected $useSoftDeletes = true;
    protected $allowedFields = ['nom', 'slug', 'actif'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    protected $validationRules = [
        'nom' => 'required|min_length[4]|max_length[128]|is_unique[categories.nom]',
    ];

    protected $validationMessages = [
        'nom' => [
            'required' => 'Le nom est obligatoire',
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

    public function retablirCategorie(int $id)
    {
        return $this->protect(false)->where('id', $id)
            ->set('deleted_at', null)
            ->update();
    }

    public function recherche_categories($term)
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
