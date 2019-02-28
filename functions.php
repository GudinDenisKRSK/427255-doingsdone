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

