<h1>Реестр плановых проверок</h1>
<div class="container">
    <div class="content-list">

        <form method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col">
                    <div class="form-group"><label>Наименование СМП<br>
                            <input class="form-control" type="text" name="name"/></label><br></div>
                </div>

                <div class="col">
                    <div class="form-group"><label>Контролирующий орган<br>
                            <input class="form-control" type="text" name="supervisory"/></label></div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-group"><label>Период проверки с<br>
                            <input class="form-control" type="date" name="periodFrom"/></label></div>
                </div>

                <div class="col">
                    <div class="form-group"><label>по<br>
                            <input class="form-control" type="date" name="periodTo"/></label><br></div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Найти</button>
        </form>
    </div>
</div>


<?= $this->section('content') ?>
<div class="actionbutton mt-2">
    <a class="btn btn-info float-right mb20" href="/add">Создать</a>
</div>

<table class="table table-striped">
    <thead>
    <tr>
        <th>№</th>
        <th>Проверяемый СПМ</th>
        <th>Контролирующий орган</th>
        <th>Период проверки</th>
        <th>Период проверки</th>
        <th>Длительность</th>
        <th>Действия</th>
    </tr>
    </thead>

    <tbody>
    <?php for ($i = 0; $i < count($checks); $i++): ?>
<tr>
    <td><?= $i+1?></td>
    <td><?= $checks[$i]['subject_id'] ?></td>
    <td><?= $checks[$i]['authority_id'] ?></td>
    <td><?= $checks[$i]['start_date'] ?></td>
    <td><?= $checks[$i]['finish_date'] ?></td>
    <td><?= $checks[$i]['duration'] ?></td>
    <td align="center">
        <a class="btn btn-sm btn-info" href="<?= site_url('/edit/'.$checks[$i]['id'])?>">Редактировать</a>
        <a class="btn btn-sm btn-danger" href="<?= site_url('home/delete/'.$checks[$i]['id'])?>">Удалить</a>
    </td>
</tr>
    <?php endfor; ?>
    </tbody>
</table>