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
$sql =  "SELECT email  FROM user ";
$result = mysqli_query($connect, $sql);
if (!$result) {
    die("MySQL Error:" . mysqli_connect_error());
} else {
    $emails = mysqli_fetch_all($result, MYSQLI_ASSOC);
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

$required_fields =['name','email','password'];
$form_data = [];
$errors =[];
if (isset($_POST['reg'])) {
    $loc = false;
    /* $form_data['name'] = $_POST['name'];
    $form_data['email'] = $_POST['email'];
    $form_data['password'] = $_POST['password'];
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
   */
    if (!empty($_POST['name'])) {
        $name = text_clean($_POST['name']);
    }
    else {
        $errors['name'] = "Введите имя!";
    }
    if (filter_var($_POST['email'],FILTER_VALIDATE_EMAIL) != false) {
        foreach ($emails as $key) {
            if ($key['email'] == $_POST['email']) {
                $errors['email'] = "Такой email уже существует";
            }
        }
    }
    else if ($_POST[email]==''){
        $errors[email] = "Введите email";
    }
    if ($_POST['password']=="") {
        $errors['password'] = "Введите пароль";
    }
    if (empty($errors)){
        $password = password_hash($_POST['password'],PASSWORD_DEFAULT);
        $sql = "INSERT INTO user (name_user,email,password) VALUES (?,?,?)";
        $ins = db_insert_data($connect,$sql,[$name,$_POST['email'],$password]);
        $loc = true;
    }
    if ($loc == true){
        header('Location: /index.php');
    }
}
$page_content = include_template('reg.php', [
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