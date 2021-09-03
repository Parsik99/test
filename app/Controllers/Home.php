<?php

namespace App\Controllers;

use App\Models\CheckModel;
use App\Models\SubjectsModel;
use App\Models\SupervisoryAuthoritiesModel;

class Home extends BaseController
{
    public function index()
    {
        $model = new CheckModel();
        $data['checks'] = $model->findAll();
        $data['title'] = ucfirst('Перечень плановых проверок');

        echo view('templates/header', $data);
        echo view('checks_index');
        echo view('templates/footer');
    }

    public function add()
    {
        $subjectModel = new SubjectsModel();
        $authorityModel = new SupervisoryAuthoritiesModel();

        $data['subjects'] = $subjectModel->findAll();
        $data['supervisory'] = $authorityModel->findAll();

        $data['title'] = ucfirst('Форма добавления');
        echo view('templates/header', $data);
        echo view('checks/checks_views', $data);
        echo view('templates/footer');
    }

    public function create()
    {
        $model = new CheckModel();

        if ($model->save([
            'subject_id' => $this->request->getPost('name'),
            'authority_id' => $this->request->getPost('supervisory'),
            'start_date' => $this->request->getPost('periodFrom'),
            'finish_date' => $this->request->getPost('periodTo'),
            'duration' => $this->request->getPost('duration'),
        ])) {
            return $this->response->redirect(site_url('/'));
        }
        $this->response->redirect(site_url('/add'));
    }
}
