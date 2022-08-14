<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Home extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Home da área Restrita'
        ];
        return view('Admin/Home/index', $data);
    }
}
