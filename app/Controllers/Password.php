<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Password extends BaseController
{
    private $usuagerModel;

    public function __construct()
    {
        $this->usuagerModel = new UserModel();
    }

    public function oublie()
    {
        $data = ['titre' => 'Oublié le mot de passe',];
        return view('Password/oublie', $data);
    }

    public function processOublie()
    {
        if ($this->request->getMethod() === 'post') {

            $usager = $this->usuagerModel->chercherUsagerParEmail($this->request->getPost('email'));

            if ($usager === null || !$usager->actif) {
                return redirect()->to(site_url('password/oublie'))
                    ->with('error', 'Nous n\'avons pas trouvé votre compte!')
                    ->withInput();

            }

            $usager->debutMotDePasseReset();

            $this->usuagerModel->save($usager);

            $this->envoyerCourrielRetablirMotDePasse($usager);

            return redirect()->to(site_url('login'))->with('success', 'Un courriel a été envoyé avec succès ! ');

        } else {
            return redirect()->back();
        }

    }

    public function envoyerCourrielRetablirMotDePasse(object $usager)
    {
        $email = service('email');

        $email->setFrom('no-reply@food-delivery.ca', 'Admin');
        $email->setTo($usager->courriel);

        $email->setSubject('Rédefinition de mot de passe');

        $message = view('Password/reset_email', ['token' => $usager->reset_token]);

        $email->setMessage($message);

        $email->send();

    }
}
