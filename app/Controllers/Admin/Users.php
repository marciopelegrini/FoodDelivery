<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Users extends BaseController
{

    private $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Listing users',
            'users' => $this->userModel->findAll(),
        ];

        return view('Admin/Users/index', $data);

    }

    public function find_user()
    {
        if (!$this->request->isAJAX()) {
            exit('Page not found!');
        }

        $users = $this->userModel->find_user($this->request->getGet('term'));

        $return = [];

        foreach ($users as $user) {
            $data['id'] = $user->id;
            $data['value'] = $user->name;

            $return[] = $data;
        }

        return $this->response->setJSON($return);
    }
}
