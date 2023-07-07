<?php
include "connect.php";
$query = "SELECT * FROM `sanpham`";
$data = mysqli_query($conn, $query);
$result = array();
while ($row = mysqli_fetch_assoc($data)) {
	$result[] = ($row);
	// code...
}
if (!empty($result)) {
	$arr = [
		'success' => true,
		'massage' => "thanh cong",
		'result' => $result 
	];
}else {
	$arr = [
		'success' => false,
		'massage' => "khong thanh cong",
		'result' => $result 
	];
}
print_r(json_encode($arr));
?>