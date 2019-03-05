<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once ('functions.php');
require_once ('data.php');
//Connecting to database
$connect = mysqli_connect('localhost','root','','doingsdone');
mysqli_set_charset($connect, 'utf8');
if (!$connect){
    print('ошибка подключения: '.mysqlli_connect_error());
}
else {
    $sql = "Select * from project where user_id = " . 1;
    $result = mysqli_query($connect,$sql);
    if (!$result) {
        die('MySQL Error:' . mysqli_connect_error());
    } else {
        $project_massive = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
}
$sql =  "SELECT project.project_name AS project, task.task_name,status,done_at FROM task JOIN project ON task.project_id = project.id WHERE task.user_id = " . 1;
$result = mysqli_query($connect, $sql);
if (!$result) {
    die("MySQL Error:" . mysqli_connect_error());
} else {
    $tasks_info_mass = mysqli_fetch_all($result, MYSQLI_ASSOC);
}
$filters_categories =  '';
if (isset($_GET['filter'])) {
    $filters_categories = $_GET['filter'];
    if (!in_array($filters_categories, $tasks_info_mass)) {
        http_response_code(404);
    }
}
$required_fields =['name','project','date'];
$form_data = [];
$errors =[];
if (isset($_POST['submit'])) {
    $form_data['name'] = $_POST['name'];
    $form_data['project'] = $_POST['project'];
    $form_data['date'] = $_POST['date'];
    $sql = "select id from project where project_name='".$form_data['project']."'";
    $result = mysqli_query($connect, $sql);
    if (!$result) {
        die('MySQL Error:' . mysqli_connect_error());
    }
    else {
        $project_id = mysqli_fetch_all($result,MYSQLI_ASSOC);
        foreach ($project_id as $key) {
            $project_id =  $key['id'];
        }
    }
    if (!empty($_POST['name'])) {
        $name = text_clean($_POST['name']);
    }
    else {
        $errors['name'] = "Введите название задачи";
    }
    $project = text_clean($_POST['project']);
    $date = text_clean($_POST['date']);
    $date_str = strtotime($date);
    $date = (date("Y-m-d H:i:s", $date_str));
    $cur_date = strtotime('now');
    if (($cur_date - $date_str) > 0) {
        $errors['date'] = 'Указанная дата меньше текущей';
    }
    if (isset($_FILES['preview'])) {
        $file_size = $_FILES['preview']['size'];
        if ($file_size > 200000) {
            $errors['file'] = "Размер файла превышает допустимое значение в 2МБ";
        }
        else {
            $file_name = $_FILES['preview']['name'];
            $file_path = __DIR__.'/';
            $file_url = '/'.$file_name;
            move_uploaded_file($_FILES['preview']['tmp_name'],$file_path.$file_name);
        }
    }
    if (empty($errors)){
        $sql = "INSERT INTO task (user_id,status,task_name,done_at,project_id,file_task) VALUES (1,0,?,?,?,?)";
        $ins = db_insert_data($connect,$sql,[$name,$date,$project_id,$file_name]);
    }
}
$page_content = include_template('add.php', [
    'tasks_info_mass' => $tasks_info_mass,
    'show_complete_tasks' => $show_complete_tasks,
    'filters_categories' => $filters_categories,
    'errors' => $errors,
    'form_data' => $form_data,
    'project_massive' => $project_massive
]);
$layout_content = include_template('layout.php', [
    'content' => $page_content,
    'project_massive' => $project_massive,
    'tasks_info_mass' => $tasks_info_mass,
    'title' => 'Doingsdone - Главная страница'
]);
print($layout_content);
?>