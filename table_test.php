<?php

require '../library/core.php';
require '../db.php';

$db = new DB();
$requestData = $_REQUEST;
$columns = array(
    0 => 'JobID',
    1 => 'Description',
    2 => 'Price'
);

$sql = "select * from TEST ";
$query = $db->query($sql);
$count_all = $db->rows($query);
$count_filter = $count_all;


if (isset($requestData['search']['value'])) {
    $where = "AND JobID LIKE '" . $requestData['search']['value'] . "%' ";
}
$order = $columns[$requestData['order'][0]['column']] . ' ' . $requestData['order'][0]['dir'];
$sql_filter = "select * from (select *,ROW_NUMBER() over (order by {$order}) as row from TEST where 1=1 {$where}) as a where 1=1 {$where}";

$query_filter = $db->query($sql_filter);
$count_filter = $db->rows($query_filter);
$end = $requestData['start']+$requestData['length'];

$sql_filter .= "AND a.row > " . $requestData['start'] . " AND a.row <= " . $end . " ";
$sql_filter .= "ORDER BY a." . $columns[$requestData['order'][0]['column']] . " " . $requestData['order'][0]['dir'] . " ";

//echo $sql_filter;

$query_where = $db->query($sql_filter);

$data = array();

while ($rs = $db->get($query_where)) {
    $col = array();
    $col['JobIDx'] = $rs['JobID'];
    $col['Description'] = $rs['Description'];
    $col['Price'] = $rs['Price'];

    $data[] = $col;
}
$json_data = array(
    "draw" => intval($requestData['draw']),
    "recordsTotal" => intval($count_all),
    "recordsFiltered" => intval($count_filter),
    "data" => $data
);
echo json_encode($json_data);
?>
