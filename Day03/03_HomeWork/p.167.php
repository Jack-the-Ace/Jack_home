<?php
header("Content-Type:text/html; charset=utf-8");
$name=$_POST['name'];
$phone=$_POST['phone'];
$field=$_POST['field'];
// $webp=$_POST['webp'];
// $webapp=$_POST['webapp'];
// $dev=$_POST['dev'];
$msg=$_POST['msg'];

$msg=nl2br($msg);

echo "<p>이름: $name</p>";
echo "<p>연락처: $phone</p>";
echo "<p>지원분야: $field</p>";
echo "<p>지원동기:<br> $msg</p>";

?>