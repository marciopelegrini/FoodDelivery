<?php

namespace App\Entities;

use App\Libraries\Token;
use CodeIgniter\Entity\Entity;

class User extends Entity
{
    protected $datamap = [];
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts = [];


    public function verifierMotDePasse(string $password)
    {
        return password_verify($password, $this->password_hash);
    }

    public function debutMotDePasseReset()
    {
        $token = new Token();
        $this->reset_token = $token->getValue();
        $this->reset_hash = $token->getHash();
        $this->reset_expiry_in = date('Y-m-d H:i:s', time() + 7200); //Expire en 2 heures à partir de sa génération

    }
}
