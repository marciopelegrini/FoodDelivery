<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';

    protected $returnType = 'object';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['name', 'email', 'telephone'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    public function find_user($term)
    {
        if ($term === null) {
            return [];
        }

        return $this->select('id, name')
            ->like('name', $term)
            ->get()
            ->getResult();
    }
}
