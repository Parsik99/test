<h1>Добавление проверки</h1>

<div class="container">
    <div class="content-list">
        <form action="create" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="form-group"><label>Выберите СМП
                        <select class="form-control" name="name">
                            <?php foreach ($subjects as $subject): ?>
                                <option value="<?= $subject['id'] ?>"><?= $subject['name'] ?></option>
                            <?php endforeach; ?>
                        </select><br>
                    </label></div>
                <div class="form-group">
                    <label>Контролирующий орган
                        <select class="form-control" name="supervisory">
                            <?php foreach ($supervisory as $authority): ?>
                                <option value="<?= $authority['id'] ?>"><?= $authority['name'] ?></option>
                            <?php endforeach; ?>
                        </select></div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label>Период проверки с
                        <input required class="form-control" type="date" name="periodFrom"/></label><br></div>

                <div class="form-group">
                    <label>по
                        <input required class="form-control" type="date" name="periodTo"/></label><br></div>
            </div>


            <div class="form-group">
                <label>Плановая длительность проверки<br>
                    <input required class="form-control" type="number" name="duration"/></label><br></div>

            <button type="submit" class="btn btn-primary">Добавить</button>
        </form>
    </div>
</div>

