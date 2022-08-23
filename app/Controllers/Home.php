<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        return view('welcome_message');
    }

    public function email()
    {
        $email = \Config\Services::email();

        $email->setFrom('your@example.com', 'Marcio');
        $email->setTo('jifof24351@ulforex.com');
//        $email->setCC('another@another-example.com');
//        $email->setBCC('them@their-example.com');

        $email->setSubject('Teste de email');
        $email->setMessage('Testing envio de email.');

        if ($email->send()) {
            echo 'Email enviado';
        } else {
            echo $email->printDebugger();
        }

    }
}
