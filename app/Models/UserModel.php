<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'usagers';

    protected $returnType = 'object';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['nom', 'courriel', 'telephone'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    public function recherche_usager($term)
    {
        if ($term === null) {
            return [];
        }

        return $this->select('id, nom')
            ->like('nom', $term)
            ->get()
            ->getResult();
    }
}
