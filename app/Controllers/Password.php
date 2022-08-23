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


            dd($usager);

        } else {
            return redirect()->back();
        }
    }
}
