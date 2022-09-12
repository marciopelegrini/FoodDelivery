<?php

namespace App\Models;

use CodeIgniter\Model;

class ExtraModel extends Model
{
    protected $table = 'extras';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'App\Entities\Extra';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['nom', 'slug', 'prix', 'actif', 'description'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    protected $validationRules = [
        'nom' => 'required|min_length[2]|max_length[128]|is_unique[extras.nom]',
    ];

    protected $validationMessages = [
        'nom' => [
            'required' => 'Le nom est obligatoire',
            'is_unique' => 'Cette extra existe déjà',
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

    public function retablir_extra(int $id)
    {
        return $this->protect(false)->where('id', $id)
            ->set('deleted_at', null)
            ->update();
    }

    public function rechercher_extras($term)
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
