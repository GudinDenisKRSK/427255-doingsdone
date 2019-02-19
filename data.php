<?php
$project_massive = ["Входящие", "Учеба", "Работа", "Домашние дела", "Авто"];
$tasks_info_mass = [
    [
        'task' => 'Собеседование в IT компании',
        'date_complite' => '01.12.2019',
        'categories' => 'Работа',
        'success' => false
    ],

    [
        'task' => 'Выполнить тестовое задание',
        'date_complite' => '25.12.2019',
        'categories' => 'Работа',
        'success' => false
    ],

    [
        'task' => 'Сделать задание первого раздела',
        'date_complite' => '21.12.2019',
        'categories' => 'Учеба',
        'success' => true
    ],

    [
        'task' => 'Встреча с другом',
        'date_complite' => '22.12.2019',
        'categories' => 'Входящие',
        'success' => false
    ],

    [
        'task' => 'Купить корм для кота',
        'date_complite' => 'Нет',
        'categories' => 'Домашние дела',
        'success' => false
    ],

    [
        'task' => 'Заказать пиццу',
        'date_complite' => 'Нет',
        'categories' => 'Домашние дела',
        'success' => false
    ]

];
$show_complete_tasks = rand(0, 1);
