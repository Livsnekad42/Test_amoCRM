<?php 
include_once 'functions.php';

$leadsOut = $curlFunction($leadsURL, $headers, 'get');
$leadsResponse = json_decode($leadsOut, true);
$leads = $leadsResponse["_embedded"]["leads"];
$leadsIDList = array_map($getLeadID, $leads);
?>