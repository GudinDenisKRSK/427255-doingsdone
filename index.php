<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

//Connecting to database
$connect = mysqli_connect('localhost','root','','doingsdone');
mysqli_set_charset($connect, 'utf8');

if (!$connect){
    print('ошибка подключения: '.mysqlli_connect_error());
}
else {
    $sql_get_list_project = "Select * from project where user_id = " . 1;
    $result = mysqli_query($connect,$sql_get_list_project);
    if (!$result) {
        die('MySQL Error:' . mysqli_connect_error());
    } else {
        $project_massive = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
    $sql =  "SELECT project.project_name AS project, task.task_name,status,done_at FROM task JOIN project ON task.project_id = project.id WHERE task.user_id = " . 1;
    $result = mysqli_query($connect, $sql);
    if (!$result) {
        die("MySQL Error:" . mysqli_connect_error());
    } else {
        $tasks_info_mass = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
}

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
