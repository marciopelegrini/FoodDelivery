<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use org\bovigo\vfs\vfsStreamContainerIterator;

class Password extends BaseController
{
    private $usagerModel;

    public function __construct()
    {
        $this->usagerModel = new UserModel();
    }

    public function oublie()
    {
        $data = ['titre' => 'Oublié le mot de passe',];
        return view('Password/oublie', $data);
    }

    public function processOublie()
    {
        if ($this->request->getMethod() === 'post') {

            $usager = $this->usagerModel->chercherUsagerParEmail($this->request->getPost('email'));

            if ($usager === null || !$usager->actif) {
                return redirect()->to(site_url('password/oublie'))
                    ->with('error', 'Nous n\'avons pas trouvé votre compte!')
                    ->withInput();

            }

            $usager->debutMotDePasseReset();

            $this->usagerModel->save($usager);

            $this->envoyerCourrielRetablirMotDePasse($usager);

            return redirect()->to(site_url('login'))->with('success', 'Un courriel a été envoyé avec succès ! ');

        } else {
            return redirect()->back();
        }

    }

    public function reset($token = null)
    {
        if ($token === null) {
            return redirect()->to(site_url('password/oublie'))->with('warning', 'Ce lien n\'est pas valide ou il est expiré');
        }
        $usager = $this->usagerModel->chercheUsagerParToken($token);

        if ($usager != null) {
            $data = [
                'titre' => 'Rédéfinir le mot de passe !',
                'token' => $token,
            ];
            return view('Password/reset', $data);
        } else {
            return redirect()->to(site_url('password/oublie'))->with('warning', 'Ce lien n\'est pas valide ou il est expiré');
        }
    }

    public function processReset($token = null)
    {
        if ($token === null) {
            return redirect()->to(site_url('password/oublie'))->with('warning', 'Ce lien n\'est pas valide ou il est expiré');
        }
        $usager = $this->usagerModel->chercheUsagerParToken($token);

        if ($usager != null) {

            $usager->fill($this->request->getPost());

            if ($this->usagerModel->save($usager)) {

                //Mettre comme null les champs expiry_in et reset_hash
                $usager->completResetMotDePasse();
                $this->usagerModel->save($usager);

                return redirect()->to(site_url('login'))->with('success', 'Le nouveau mot de passe a bien été enregistré !');
            } else {
                return redirect()->to(site_url('password/reset/' . $token))
                    ->with('errors_model', $this->usagerModel->errors())
                    ->with('warning', 'Veuillez vérifier les erreurs ci-dessous !')
                    ->withInput();

            }

            return view('Password/reset', $data);
        } else {
            return redirect()->to(site_url('password/oublie'))->with('warning', 'Ce lien n\'est pas valide ou il est expiré');
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
