<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'usagers';

    protected $returnType = 'App\Entities\Usager';

    protected $allowedFields = ['nom', 'courriel', 'telephone'];

    protected $validationRules = [
        'nom' => 'required|min_length[4]|max_length[120]',
        'courriel' => 'required|valid_email|is_unique[usagers.courriel]',
        'assurance-maladie' => 'required|is_unique[usagers.assurance_maladie|exact_length[14]',
        'mot-de-passe' => 'required|min_length[3]',
        'confirm-mot-de-passe' => 'required_with[mot-de-passe]|matches[mot-de-passe]',
    ];

    protected $validationMessages = [
        'nom' => [
            'required' => 'Le nom est obligatoire',
        ],
        'courriel' => [
            'required' => 'Le courriel est obligatoire.',
            'is_unique' => 'Désolé, mais ce courriel existe déjà !',
        ],
        'assurance-maladie' => [
            'required' => 'Le numéro d\'assurance maladie est obligatoire.',
            'is_unique' => 'Désolé, mais ce numéro existe déjà !',
        ],

    ];

    // Dates
    protected $useSoftDeletes = true;
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

    public function pasDeValidationMotDePasse()
    {
        unset($this->validationRules['mot-de-passe']);
        unset($this->validationRules['confirm-mot-de-passe']);
    }
}
