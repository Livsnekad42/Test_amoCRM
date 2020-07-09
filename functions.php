<?php 

$curlFunction = function($url, $header, string $req = 'get', $data = []) {
    $curl = curl_init(); 
    /** Устанавливаем необходимые опции для сеанса cURL  */
    curl_setopt($curl,CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl,CURLOPT_USERAGENT,'amoCRM-oAuth-client/1.0');
    curl_setopt($curl,CURLOPT_URL, $url);
    curl_setopt($curl,CURLOPT_HTTPHEADER, $header);
    curl_setopt($curl,CURLOPT_HEADER, false);
    curl_setopt($curl,CURLOPT_CUSTOMREQUEST, strtoupper($req));//определяем тип запроса
    curl_setopt($curl,CURLOPT_POSTFIELDS, json_encode($data));//при необходимости передаём данные
    
    curl_setopt($curl,CURLOPT_SSL_VERIFYPEER, 1);
    curl_setopt($curl,CURLOPT_SSL_VERIFYHOST, 2);
    $out = curl_exec($curl);//Инициируем запрос к API и сохраняем ответ в переменную
    $code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);
	$code = (int)$code;
	$errors = [
		400 => 'Bad request',
		401 => 'Unauthorized',
		403 => 'Forbidden',
		404 => 'Not found',
		500 => 'Internal server error',
		502 => 'Bad gateway',
		503 => 'Service unavailable',
	];

	try
	{
		/** Если код ответа не успешный - возвращаем сообщение об ошибке  */
		if ($code < 200 || $code > 204) {
			throw new Exception(isset($errors[$code]) ? $errors[$code] : 'Undefined error', $code);
		}
	}
	catch(\Exception $e)
	{
		die('Ошибка: ' . $e->getMessage() . PHP_EOL . 'Код ошибки: ' . $e->getCode());
    };
    return $out;
};



$addTask = function($leadID, string $text) {
    $request = [
            'text' => $text,
            "complete_till" => time() + 10000,
            "entity_id" => $leadID,
            "entity_type" => "leads"
    ];
    return $request;
};

$getLeadID = function($entity) { //получаем ID сделки
	return $entity['id'];
};

$tasksCheckState = function($entity) { //получаем состояние задачи
	return $entity['is_completed'];
};
$tasksCompleted = function($entity) { //фильтруем на завершение
	return $entity == 1;
};

?>