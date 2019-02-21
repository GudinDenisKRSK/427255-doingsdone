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
    foreach ($tasks_info_mass as $key => $val){
        if ($val['categories']==$project){
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