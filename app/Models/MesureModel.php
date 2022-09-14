<?php

namespace App\Models;

use CodeIgniter\Model;

class MesureModel extends Model
{
    protected $table = 'mesures';
    protected $returnType = 'App\Entities\Mesure';
    protected $useSoftDeletes = true;
    protected $allowedFields = ['nom', 'description', 'actif'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    protected $validationRules = [
        'nom' => 'required|min_length[2]|max_length[128]|is_unique[mesures.nom]',
    ];

    protected $validationMessages = [
        'nom' => [
            'required' => 'Le nom est obligatoire',
            'is_unique' => 'Cette mesure existe déjà',
        ],
    ];

    public function retablir_mesure(int $id)
    {
        return $this->protect(false)->where('id', $id)
            ->set('deleted_at', null)
            ->update();
    }

    public function rechercher_mesures($term)
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
