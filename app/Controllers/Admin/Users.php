<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Users extends BaseController
{

    private $usagerModel;

    public function __construct()
    {
        $this->usagerModel = new UserModel();
    }

    public function index()
    {
        $data = [
            'titre' => 'Liste des usagers',
            'users' => $this->usagerModel->findAll(),
        ];

        return view('Admin/Users/index', $data);

    }

    public function recherche_usager()
    {
        if (!$this->request->isAJAX()) {
            exit('Page pas trouvé!');
        }

        $users = $this->usagerModel->recherche_usager($this->request->getGet('term'));

        $return = [];

        foreach ($users as $user) {
            $data['id'] = $user->id;
            $data['value'] = $user->nom;

            $return[] = $data;
        }

        return $this->response->setJSON($return);
    }
}
