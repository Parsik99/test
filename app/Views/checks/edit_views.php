<h1>Редактировать</h1>

<div class="container">
    <div class="content-list">
        <form action="<?= site_url('/edit/' . $id) ?>" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="form-group"><label>Выберите СМП
                        <select class="form-control" name="subject_id">
                            <?php foreach ($subjects as $subject): ?>
                                <?php $selected = $subject['id'] == $check['subject_id']; ?>
                                <option value="<?= $subject['id'] ?>" <?= $selected ? 'selected' : '' ?>><?= $subject['name'] ?></option>
                            <?php endforeach; ?>
                        </select><br>
                    </label></div>
                <div class="form-group">
                    <label>Контролирующий орган
                        <select class="form-control" name="authority_id">
                            <?php foreach ($supervisory as $supervisorys): ?>
                                <?php $selected = $supervisorys['id'] == $check['authority_id']; ?>
                                <option value="<?= $supervisorys['id'] ?>" <?= $selected ? 'selected' : '' ?>><?= $supervisorys['name'] ?></option>
                            <?php endforeach; ?>
                        </select></div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label>Период проверки с
                        <input class="form-control" type="date" name="start_date" value="<?= (new DateTime($check['start_date']))->format('Y-m-d') ?>"/></label><br>
                </div>

                <div class="form-group">
                    <label>по
                        <input class="form-control" type="date" name="finish_date"
                               value="<?= (new DateTime($check['finish_date']))->format('Y-m-d') ?>"/></label><br></div>
            </div>

            <div class="form-group">
                <label>Плановая длительность проверки<br>
                    <input class="form-control" type="number" name="duration"
                           value="<?= $check['duration'] ?>"/></label><br></div>

            <button type="submit" class="btn btn-primary">Сохранить</button>
        </form>
    </div>
</div>

