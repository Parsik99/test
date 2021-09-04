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

    public function delete($id)
    {
        $model = new CheckModel();
        $model->delete($id);

        return $this->response->redirect(site_url('/'));
    }

    public function edit($id)
    {
        $model = new CheckModel();
        $subjectModel = new SubjectsModel();
        $authorityModel = new SupervisoryAuthoritiesModel();

        $data['subjects'] = $subjectModel->findAll();

        $data['supervisory'] = $authorityModel->findAll();

        $data['id'] = $id;
        $data['title'] = ucfirst('Форма редактирования');
        if (isset($_POST['subject_id'])) {
            $model->update($id, $_POST);

            return $this->response->redirect(site_url('/'));
        } else {
            $data['checks'] = $model->find($id);
        }

        echo view('templates/header', $data);
        echo view('checks/edit_views', $data);
        echo view('templates/footer');
    }
}
