<?php

namespace App\Controllers;

use App\Models\CheckModel;
use App\Models\SubjectsModel;
use App\Models\SupervisoryAuthoritiesModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Home extends BaseController
{
    //Функция отрисовки главной страницы
    public function index()
    {
        $checksModel = new CheckModel();
        $subjectModel = new SubjectsModel();
        $authorityModel = new SupervisoryAuthoritiesModel();
        //получение данных и преобразование их в удобный для селекта вид
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
        //Сохранение значений фильтров
        $filter = [
            'subject_id' => $this->request->getGet('subject_id'),
            'authority_id' => $this->request->getGet('authority_id'),
            'duration' => $this->request->getGet('duration'),
            'start_date' => $this->request->getGet('periodFrom'),
            'finish_date' => $this->request->getGet('periodTo'),
        ];
        //При наличии значения фильтра добавляется условие в запрос поиска
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
        // Получаем проверки с учетом фильтров
        $data['checks'] = $checksModel->findAll();

        //Создание таблицы Excel
        $spreadSheet = new Spreadsheet();
        $sheet = $spreadSheet->getActiveSheet();
        $columns = [
            'A1' => 'Проверяемый СПМ',
            'B1' => 'Контролируемый орган',
            'C1' => 'Период проверки с',
            'D1' => 'Период проверки по',
            'E1' => 'Длительность',
        ];
        foreach ($columns as $key => $value) {
            $sheet->setCellValue($key, $value);
        }

        for ($i = 1; $i < count($data['checks']); $i++) {
            $sheet->setCellValue('A' . ($i + 1), $subjectsMap[$data['checks'][$i]['subject_id']]);
            $sheet->setCellValue('B' . ($i + 1), $authorityMap[$data['checks'][$i]['authority_id']]);
            $sheet->setCellValue('C' . ($i + 1), (new \DateTime($data['checks'][$i]['start_date']))->format('d.m.Y'));
            $sheet->setCellValue('D' . ($i + 1), (new \DateTime($data['checks'][$i]['finish_date']))->format('d.m.Y'));
            $sheet->setCellValue('E' . ($i + 1), $data['checks'][$i]['duration']);
        }
        //Создание файла, в котором будет сохранятся таблица
        $writer = new Xlsx($spreadSheet);
        $writer->save('test.xlsx');

        $data['filter'] = $filter;
        $data['title'] = ucfirst('Перечень плановых проверок');
        //Отрисовка главной страницы сайта
        echo view('templates/header', $data);
        echo view('checks_index', $data);
        echo view('templates/footer');
    }
    //Отображение формы создания
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
    //Обработка фрмы создания проверки
    public function create()
    {
        $model = new CheckModel();
        //Создание записи в бд
        if ($model->save([
            'subject_id' => $this->request->getPost('name'),
            'authority_id' => $this->request->getPost('supervisory'),
            'start_date' => $this->request->getPost('periodFrom'),
            'finish_date' => $this->request->getPost('periodTo'),
            'duration' => $this->request->getPost('duration'),
        ])) {
            //Переход на главную в случае успеха
            return $this->response->redirect(site_url('/'));
        }
        $this->response->redirect(site_url('/add'));
    }
    //Удаление проверки
    public function delete($id)
    {
        $model = new CheckModel();
        $model->delete($id);

        return $this->response->redirect(site_url('/'));
    }
    //Редоктирование проверки
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
            $model->update($id, $_POST);//сохраняем новые значения

            return $this->response->redirect(site_url('/'));
        } else {
            //Ищим в бд запись с нужным айдишником для дальнейшего обновления
            $data['check'] = $model->find($id);
        }

        echo view('templates/header', $data);
        echo view('checks/edit_views', $data);
        echo view('templates/footer');
    }
}

