<?php 
include_once 'functions.php';

$tasksOut = $curlFunction($tasksURL, $headers);
$tasksResponse = json_decode($tasksOut, true);
$tasks = $tasksResponse["_embedded"]["tasks"];
$tasksState = array_map($tasksCheckState, $tasks);
$isCompleted = array_filter($tasksState, $tasksCompleted);
$taskText = "Сделка без задач";
if (count($isCompleted) === count($tasksState)) { //сравниваем общее количество задач с завершёнными 
    $queryBody = [];
    for ($i = 0; $i < count($leadsIDList); $i++) {
        $newTask = $addTask($leadsIDList[$i], $taskText, $queryBody);
        array_push($queryBody, $newTask);
    };
    $curlFunction($tasksURL, $headers, 'post', $queryBody);
};
?>