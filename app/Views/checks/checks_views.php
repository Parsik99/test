<h1>Добавление проверки</h1>
<div class="container">
    <div class="content-list">
        <form method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="form-group"><label>Выберите СМП
                        <select class="form-control" name="name">
                            <option value="1">ООО "Колосок"</option>
                            <option value="2">ООО "Васильев и Ко"</option>
                        </select><br>
                    </label></div>
                <div class="form-group">
                    <label>Контролирующий орган
                        <select class="form-control" name="supervisory">
                            <option value="1">Роспотребнадзор</option>
                            <option value="2">Природоохрана</option>
                        </select></div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label>Период проверки с
                        <input class="form-control" type="date" name="periodFrom"/></label><br></div>

                <div class="form-group">
                    <label>по
                        <input class="form-control" type="date" name="periodTo"/></label><br></div>
            </div>


            <div class="form-group">
                <label>Плановая длительность проверки<br>
                    <input class="form-control" type="number" name="duration"/></label><br></div>

            <button type="submit" class="btn btn-primary">Добавить</button>
        </form>
    </div>
</div>

