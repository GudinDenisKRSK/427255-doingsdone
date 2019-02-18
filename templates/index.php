<main class="content__main">
    <h2 class="content__main-heading">Список задач</h2>
    <form class="search-form" action="index.php" method="post">
        <input class="search-form__input" type="text" name="" value="" placeholder="Поиск по задачам">
        <input class="search-form__submit" type="submit" name="" value="Искать">
    </form>
    <div class="tasks-controls">
        <nav class="tasks-switch">
            <a href="/" class="tasks-switch__item tasks-switch__item--active">Все задачи</a>
            <a href="/" class="tasks-switch__item">Повестка дня</a>
            <a href="/" class="tasks-switch__item">Завтра</a>
            <a href="/" class="tasks-switch__item">Просроченные</a>
        </nav>
        <label class="checkbox">
            <!--добавить сюда аттрибут "checked", если переменная $show_complete_tasks равна единице-->
            <input class="checkbox__input visually-hidden show_completed" type="checkbox">
            <span class="checkbox__text">Показывать выполненные</span>
        </label>
    </div>
    <table class="tasks">
        <?php foreach ($tasks_info_mass as $key => $value): ?>
            <?php if (($value['success'] == true) & ($show_complete_tasks) == 1): ?>
                <tr class="tasks__item task task--completed">
                <td class="task__select">
                    <label class="checkbox task__checkbox">
                        <input class="checkbox__input visually-hidden task__checkbox" type="checkbox"
                               value="1">
                        <span class="checkbox__text"> <?= htmlspecialchars($value['task']); ?> </span>
                    </label>
                </td>
                <td class="task__select">
                    <label class="checkbox task__checkbox">
                        <input class="checkbox__input visually-hidden task__checkbox" type="checkbox"
                               value="1">
                        <span class="checkbox__text"><?= htmlspecialchars($value['date_complite']); ?></span>
                    </label>
                </td>
                <td class="task__select">
                    <label class="checkbox task__checkbox">
                        <input class="checkbox__input visually-hidden task__checkbox" type="checkbox"
                               value="1">
                        <span class="checkbox__text"><?= htmlspecialchars($value['categories']); ?></span>
                    </label>
                </td>
                <td class="task__select">
                    <label class="checkbox task__checkbox">
                        <input class="checkbox__input visually-hidden task__checkbox" type="checkbox"
                               value="1">
                        <span class="checkbox__text"><? echo ('Да'); ?></span>
                    </label>
                </td>
            <?php elseif ($value['success'] == false): ?>
                <tr class="tasks__item task ">
                    <td class="task__select">
                        <label class="checkbox task__checkbox">
                            <input class="checkbox__input visually-hidden task__checkbox" type="checkbox"
                                   value="1">
                            <span class="checkbox__text"> <?= htmlspecialchars($value['task']); ?> </span>
                        </label>
                    </td>
                    <td class="task__select">
                        <label class="checkbox task__checkbox">
                            <input class="checkbox__input visually-hidden task__checkbox" type="checkbox"
                                   value="1">
                            <span class="checkbox__text"><?= htmlspecialchars($value['date_complite']); ?></span>
                        </label>
                    </td>
                    <td class="task__select">
                        <label class="checkbox task__checkbox">
                            <input class="checkbox__input visually-hidden task__checkbox" type="checkbox"
                                   value="1">
                            <span class="checkbox__text"><?= htmlspecialchars($value['categories']); ?></span>
                        </label>
                    </td>
                    <td class="task__select">
                        <label class="checkbox task__checkbox">
                            <input class="checkbox__input visually-hidden task__checkbox" type="checkbox"
                                   value="1">
                            <span class="checkbox__text"><? echo('Нет'); ?></span>
                        </label>
                    </td>
                </tr>
            <?php endif; ?>
        <?php endforeach; ?>
        <!--показывать следующий тег <tr/>, если переменная $show_complete_tasks равна единице-->
    </table>
</main>

