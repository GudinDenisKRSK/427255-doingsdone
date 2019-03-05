<?php
function include_template($name, $data) {
    $name = 'templates/' . $name;
    $result = '';

    if (!is_readable($name)) {
        return $result;
    }

    ob_start();
    extract($data);
    require $name;

    $result = ob_get_clean();

    return $result;
}

function get_item_count ($tasks_info_mass,$project) {
    $count = 0;
    foreach ($tasks_info_mass as $key ){
        if ($key['project']==$project){
            $count++;
        }
    }
    return $count;
}

function deadline ($date_comp) {
    $result ='';
    date_default_timezone_set('Asia/Krasnoyarsk');
    $date_now = time();
    $date_end = strtotime($date_comp);
    if ((bool)$date_end == false) {
        return $result;
    }
    $date_end = floor ($date_end/3600);
    $date_now = floor ($date_now/3600);
    $date_diff = $date_end - $date_now;
    return $date_diff;
}

function db_fetch_data($link, $sql, $data = [])
{
    $result = [];
    $stmt = db_get_prepare_stmt($link, $sql, $data);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    if ($res) {
        $result = mysqli_fetch_all($res, MYSQLI_ASSOC);
    }
    return $result;
}

function db_get_prepare_stmt($link, $sql, $data = [])
{
    $stmt = mysqli_prepare($link, $sql);
    if ($data) {
        $types = '';
        $stmt_data = [];
        foreach ($data as $value) {
            $type = null;
            if (is_int($value)) {
                $type = 'i';
            } else if (is_string($value)) {
                $type = 's';
            } else if (is_double($value)) {
                $type = 'd';
            }
            if ($type) {
                $types .= $type;
                $stmt_data[] = $value;
            }
        }
        $values = array_merge([$stmt, $types], $stmt_data);
        $func = 'mysqli_stmt_bind_param';
        $func(...$values);
    }
    return $stmt;
}


function check_date_format($date) {
    $result = false;
    $regexp = '/(\d{2})\.(\d{2})\.(\d{4})/m';
    if (preg_match($regexp, $date, $parts) && count($parts) == 4) {
        $result = checkdate($parts[2], $parts[1], $parts[3]);
    }
    return $result;
}
//  Функция для очистки данных от HTML и PHP тегов
function clean($value = "") {
    $value = trim($value);
    $value = stripslashes($value);
    $value = strip_tags($value);
    $value = htmlspecialchars($value);
    return $value;
}
//Функция для проверки длинны строки
function check_length($value = "", $min, $max) {
    $result = (mb_strlen($value) < $min || mb_strlen($value) > $max);
    return !$result;
}
function text_clean($text) {
    $text = trim($text);
    $text = strip_tags($text);
    $text = htmlspecialchars($text);
    $text = stripslashes($text);
    return $text;
}
function db_insert_data($connect, $sql, $data = []) {
    $stmt = db_get_prepare_stmt($connect, $sql, $data);
    $result = mysqli_stmt_execute($stmt);
    if ($result) {
        $result = mysqli_insert_id($connect);
    }
    return $result;
}

