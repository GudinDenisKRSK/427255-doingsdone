<?php

require_once ('functions.php');
require_once ('data.php');

$page_content = include_template('index.php', [
        'tasks_info_mass' => $tasks_info_mass,
        'show_complete_tasks' => $show_complete_tasks
    ]);
$layout_content = include_template('layout.php', [
        'content' => $page_content,
        'project_massive' => $project_massive,
        'tasks_info_mass' => $tasks_info_mass,
        'title' => 'Doingsdone - Главная страница'
]);
print($layout_content);
?>
