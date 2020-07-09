<?php
include_once 'functions.php';

$subdomain = ''; //Поддомен нужного аккаунта
$authLink = 'https://' . $subdomain . '.amocrm.ru/oauth2/access_token'; //Формируем URL для запроса

/** Соберем данные для запроса */
$data = [
	'client_id' => '', //ID интеграции
	'client_secret' => '', //секретный ключ
	'grant_type' => 'authorization_code',
	'code' => '', //код авторизации
	'redirect_uri' => '' // ссылка для перенаправления
];


$dataAuth = $curlFunction($authLink, ['Content-Type:application/json'], 'post', $data);//авторизируемся
$response = json_decode($dataAuth, true);
$access_token = $response['access_token']; //Access токен
$refresh_token = $response['refresh_token']; //Refresh токен
$token_type = $response['token_type']; //Тип токена
$expires_in = $response['expires_in'];

?>