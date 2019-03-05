<main class="content__main">
    <h2 class="content__main-heading">Добавление задачи</h2>

    <form class="form"  action="add.php" method="post" enctype="multipart/form-data">
        <div class="form__row">
            <label class="form__label" for="name">Название <sup>*</sup></label>

            <input class="form__input<?php if (isset($errors['name'])): ?> form__input--error<?php endif ?>" type="text" name="name" id="name" value="<?=($form_data['name']) ?? ''?>" placeholder="Введите название">
            <?php if (isset($errors['name'])): ?>
                <p class="form__message"><?=$errors['name'];?></p>
            <?php endif ?>

        </div>

        <div class="form__row">
            <label class="form__label" for="project">Проект</label>

            <select class="form__input form__input--select" name="project" id="project">
                <?php foreach ($project_massive as $key): ?>
                    <option value="<?=$key['project_name'];?>"><?=$key['project_name'];?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form__row">
            <label class="form__label" for="date">Дата выполнения</label>

            <input class="form__input form__input--date<?php if (isset($errors['date'])): ?> form__input--error<?php endif ?>" type="date" name="date" id="date" value="<?=($form_data['date']) ?? ''?>" placeholder="Введите дату в формате ДД.ММ.ГГГГ">
            <?php if (isset($errors['date'])): ?>
                <p class="form__message"><?=$errors['date'];?></p>
            <?php endif ?>
        </div>

        <div class="form__row">
            <label class="form__label" for="preview">Файл</label>

            <div class="form__input-file">
                <input class="visually-hidden" type="file" name="preview" id="preview" value="">

                <label class="button button--transparent" for="preview">
                    <span>Выберите файл</span>
                </label>
                <?php if (isset($errors['file'])): ?>
                    <p class="form__message"><?=$errors['file'];?></p>
                <?php endif ?>
            </div>
        </div>

        <div class="form__row form__row--controls">
            <input class="button" type="submit" name="submit" value="Добавить">
        </div>
    </form>
</main>