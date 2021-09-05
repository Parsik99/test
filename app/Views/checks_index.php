<h1>Реестр плановых проверок</h1>
<div class="container">
    <div class="content-list">

        <form action="<?= site_url('/') ?>" method="get">
            <div class="row">
                <div class="col">
                    <div class="form-group"><label>Выберите СМП
                            <select class="form-control" name="subject_id">
                                <option value="">Все</option>
                                <?php foreach ($subjects as $id => $name): ?>
                                    <?php $selected = $id == $filter['subject_id']; ?>
                                    <option value="<?= $id ?>" <?= $selected ? 'selected' : '' ?>><?= $name ?></option>
                                <?php endforeach; ?>
                            </select><br>
                        </label>
                    </div>
                </div>

                <div class="col">
                    <div class="form-group">
                        <label>Контролирующий орган
                            <select class="form-control" name="authority_id">
                                <option value="">Все</option>
                                <?php foreach ($authority as $id => $name): ?>
                                    <?php $selected = $id == $filter['authority_id']; ?>
                                    <option value="<?= $id ?>"<?= $selected ? 'selected' : '' ?>><?= $name ?></option>
                                <?php endforeach; ?>
                            </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label>Период проверки с
                            <input class="form-control" type="date" name="periodFrom"
                                   value="<?= $filter['start_date'] ?: '' ?>"/></label><br>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label>по
                            <input class="form-control" type="date" name="periodTo"
                                   value="<?= $filter['finish_date'] ?: '' ?>"/></label><br>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-group"><label>Длительность проверки<br>
                            <input class="form-control"
                                   type="number"
                                   name="duration"
                                   value="<?= $filter['duration'] ?: '' ?>"
                            /></label>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Найти</button>
            <a class="btn btn-danger" href="<?= site_url('/') ?>">Сбросить</a>
        </form>
    </div>
</div>

<?= $this->section('content') ?>
<div class="actionbutton mt-2">
    <a class="btn btn-info float-right mb20" href="/add">Создать</a>
</div>

<?php if (count($checks) == 0): ?>
    <h2 class="text-center">По Вашему запросу ничего не найдено</h2>
<?php else: ?>
<table class="table table-striped">
    <thead>
    <tr>
        <th>№</th>
        <th>Проверяемый СПМ</th>
        <th>Контролирующий орган</th>
        <th>Период проверки с</th>
        <th>Период проверки по</th>
        <th>Длительность</th>
        <th>Действия</th>
    </tr>
    </thead>
    <tbody>

    <?php for ($i = 0; $i < count($checks); $i++): ?>
        <tr>
            <td><?= $i + 1 ?></td>
            <td><?= $subjects[$checks[$i]['subject_id']] ?></td>
            <td><?= $authority[$checks[$i]['authority_id']] ?></td>
            <td><?= (new DateTime($checks[$i]['start_date']))->format('d-m-Y') ?></td>
            <td><?= (new DateTime($checks[$i]['finish_date']))->format('d-m-y') ?></td>
            <td><?= $checks[$i]['duration'] ?></td>
            <td align="center">
                <a class="btn btn-sm btn-info" href="<?= site_url('/edit/' . $checks[$i]['id']) ?>">Редактировать</a>
                <a class="btn btn-sm btn-danger" href="<?= site_url('home/delete/' . $checks[$i]['id']) ?>">Удалить</a>
            </td>
        </tr>
    <?php endfor; ?>
    <?php endif; ?>
    </tbody>
</table>