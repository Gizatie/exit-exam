<?php
include('config/apply.php');
$tbl_name = "faculty";
$dean_id = $_POST['dean_id'];
$where = "id=$dean_id";
$query = $obj->select_data($tbl_name, $where);
$result = $obj->execute_query($conn, $query);
$row = $obj->fetch_data($result);
echo json_encode($row);
