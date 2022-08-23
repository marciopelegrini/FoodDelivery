<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\Authentification;

class Login extends BaseController
{
    public function nouveau()
    {
        $data = [
            'titre' => 'Connexion à l\'application.',
        ];
        return view('Login/nouveau', $data);
    }

    public function creer()
    {
        if ($this->request->getMethod() === 'post') {

            $email = $this->request->getPost('email');
            $password = $this->request->getPost('mot_de_passe');

            $auth = service('authentification');

            if ($auth->login($email, $password)) {
                $usager = $auth->getUsagerConnecte();

                if (!$usager->is_admin) {
                    return redirect()->to(site_url('/'));
                }

                return redirect()->to(site_url('admin/home'))->with('success', "Bienvenue, $usager->nom !");
            } else {
                return redirect()->back()->with('error', 'Usager ou mot de passe invalide');
            }

        } else {
            return redirect()->back();
        }
    }

    public function logout()
    {
        service('authentification')->logout();
        return redirect()->to(site_url('login/afficherMessageLogout'));
    }

    public function afficherMessageLogout()
    {
        return redirect()->to(site_url('login/nouveau'))->with('info', 'Vous êtes bien déconnecté !');
    }
}
