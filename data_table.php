<?php

require '../library/core.php';
require '../db.php';
$db = new DB();
//$JobID = isset($_POST['JobID']) ? $_POST['JobID'] : '';
$options = array(
    'table' => 'TEST'
);
$query = $db->select($options);


$data = array();

while ($rs = $db->get($query)) {
    $col = array();
    $col['JobID'] = $rs['JobID'];
    $col['Description'] = $rs['Description'];
    $col['Price'] = $rs['Price'];
    $col['start_date'] = '21/11/2017';
    $col['office'] = 'Thailand';
    $col['extn'] = '3992';
    
    array_push($data, $col);
}
echo '{"data": ' . json_encode($data) . '}';
