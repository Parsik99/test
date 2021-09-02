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
<a href="/add">Создать</a>


