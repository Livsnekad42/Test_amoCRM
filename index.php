<?php

include_once 'authorize.php';
include_once 'functions.php';

$subdomain = ''; //Поддомен нужного аккаунта
$leadsURL = 'https://' . $subdomain . '.amocrm.ru/api/v4/leads'; //получаем сделки
$tasksURL = 'https://' . $subdomain . '.amocrm.ru/api/v4/tasks'; //получаем задачи

$headers = [
	'Authorization: Bearer ' . $access_token //применяем токен для авторизации
];






include_once 'leads.php';

include_once 'tasks.php';

?>