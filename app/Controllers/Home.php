<?php

namespace App\Controllers;

use App\Models\CheckModel;
use App\Models\SubjectsModel;
use App\Models\SupervisoryAuthoritiesModel;

class Home extends BaseController
{
    public function index()
    {
        $checksModel = new CheckModel();
        $subjectModel = new SubjectsModel();
        $authorityModel = new SupervisoryAuthoritiesModel();

        $subjectsMap = [];
        $subjects = $subjectModel->findAll();
        foreach ($subjects as $subject) {
            $subjectsMap[$subject['id']] = $subject['name'];
        }
        $data['subjects'] = $subjectsMap;

        $authorityMap = [];
        $authority = $authorityModel->findAll();
        foreach ($authority as $aut) {
            $authorityMap[$aut['id']] = $aut['name'];
        }
        $data['authority'] = $authorityMap;
        /* $data['supervisory'] = $authorityModel->findAll();*/

        $filter = [
            'subject_id' => $this->request->getGet('subject_id'),
            'authority_id' => $this->request->getGet('authority_id'),
            'duration' => $this->request->getGet('duration'),
            'start_date' => $this->request->getGet('periodFrom'),
            'finish_date' => $this->request->getGet('periodTo'),
        ];

        if ($filter['subject_id']) {
            $checksModel->where('subject_id', $filter['subject_id']);
        }

        if ($filter['authority_id']) {
            $checksModel->where('authority_id', $filter['authority_id']);
        }

        if ($filter['duration']) {
            $checksModel->where('duration', $filter['duration']);
        }

        if ($filter['start_date']) {
            $checksModel->where('start_date', $filter['start_date']);
        }

        if ($filter['finish_date']) {
            $checksModel->where('finish_date', $filter['finish_date']);
        }

        $data['checks'] = $checksModel->findAll();
        $data['filter'] = $filter;
        $data['title'] = ucfirst('Перечень плановых проверок');

        echo view('templates/header', $data);
        echo view('checks_index', $data);
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
