<h1>Редактировать</h1>

<div class="container">
    <div class="content-list">
        <form action="<?= site_url('/edit/' . $id) ?>" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="form-group"><label>Выберите СМП
                        <select class="form-control" name="subject_id">
                            <?php foreach ($subjects as $subject): ?>
                                <option value="<?= $subject['id'] ?>"><?= $subject['name'] ?></option>
                            <?php endforeach; ?>
                        </select><br>
                    </label></div>
                <div class="form-group">
                    <label>Контролирующий орган
                        <select class="form-control" name="authority_id">
                            <?php foreach ($supervisory as $supervisorys): ?>
                                <option value="<?= $supervisorys['id'] ?>"><?= $supervisorys['name'] ?></option>
                            <?php endforeach; ?>
                        </select></div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label>Период проверки с
                        <input class="form-control" type="date" name="start_date" value="<?= $checks['start_date'] ?>"/></label><br>
                </div>

                <div class="form-group">
                    <label>по
                        <input class="form-control" type="date" name="finish_date"
                               value="<?= $checks['finish_date'] ?>"/></label><br></div>
            </div>

            <div class="form-group">
                <label>Плановая длительность проверки<br>
                    <input class="form-control" type="number" name="duration"
                           value="<?= $checks['duration'] ?>"/></label><br></div>

            <button type="submit" class="btn btn-primary">Сохранить</button>
        </form>
    </div>
</div>

