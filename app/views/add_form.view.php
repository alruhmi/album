<? require 'template-parts/header.php';?>
    <div class="container">
        <form action="/add" class="mt-3" id="add_form" name="add" method="POST" enctype="multipart/form-data">
            <div class="form-group col-6">
                <label>Имя</label>
                <input type="text" name="name" class="form-control">
                <p class="validation-message text-danger"></p>
            </div>
            <div class="form-group col-6">
                <label>Телефон</label>
                <input type="tel" name="phone" class="form-control">
                <p class="validation-message text-danger"></p>
            </div>
            <div class="form-group col-4">
                <label>Дата рождения</label>
                <input type="date" name="age" class="form-control">
                <p class="validation-message text-danger"></p>
            </div>
            <div class="form-group col-6">
                <label>Фотографии</label>
                <input type="file" name="photos[]" multiple class="form-control">
                <p class="validation-message text-danger"></p>
            </div>
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </form>
    </div>

<? require 'template-parts/footer.php';?>