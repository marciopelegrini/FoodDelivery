<?php

/*
 * ce classe est responsable pour authentifier les usagers au sistème.
 */

namespace App\Libraries;

use App\Models\UserModel;

class Authentification
{
    private $usager;

    /*
    *
    */
    public function login(string $email, string $password)
    {
        $usagerModel = new UserModel();
        $usager = $usagerModel->chercherUsagerParEmail($email);

        if ($usager === null) {
            return false;
        }

        if (!$usager->verifierMotDePasse($password)) {
            return false;
        }

        if (!$usager->actif) {
            return false;
        }
        /* Si les donnes sont corrects */
        $this->loginUsager($usager);
        return true;
    }

    public function logout()
    {
        session()->destroy();
    }

    public function getUsagerConnecte()
    {
        if ($this->usager === null) {
            $this->usager = $this->getUsagerSession();
        }
        return $this->usager;
    }

    public function estConnecte()
    {
        return $this->getUsagerConnecte() !== null;
    }

    private function getUsagerSession()
    {
        if (!session()->has('usager_id')) {
            return null;
        }

        $usagerModel = new UserModel();
        $usager = $usagerModel->find(session()->get('usager_id'));

        if ($usager && $usager->actif) {
            return $usager;
        }
    }

    private function loginUsager(object $usager)
    {
        $session = session();
        $session->regenerate();
        $session->set('usager_id', $usager->id);
    }
}