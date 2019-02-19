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
