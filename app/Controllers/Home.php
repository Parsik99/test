<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $data['title'] = ucfirst('Перечень плановых проверок');

        echo view('templates/header', $data);
        echo view('checks_index');
        echo view('templates/footer');
    }

    public function create()
    {
        $data['title'] = ucfirst('Форма добавления');

        echo view('templates/header', $data);
        echo view('checks/checks_views');
        echo view('templates/footer');
    }
}
