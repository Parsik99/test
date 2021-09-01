<h1>Добавление проверки</h1>
<div class="content-list">
    <form method="post" enctype="multipart/form-data">
        <label>Выберите СМП<br>
            <select name="name">
                <option value="1">ООО "Колосок"</option>
                <option value="2">ООО "Васильев и Ко"</option>
            </select><br>
        </label>
        <label>Период проверки с<br>
            <input type="date" name="periodFrom"/></label><br>
        <label>по<br>
            <input type="date" name="periodTo"/></label><br>
        <label>Контролирующий орган<br>
            <select name="supervisory">
                <option value="1">Роспотребнадзор</option>
                <option value="2">Природоохрана</option>
            </select>

        <input type="submit" value="Добавить"/>
    </form>
</div>


