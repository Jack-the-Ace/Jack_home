<?php

header("Content-Type:text/html; charset=utf-8");

$name=$_POST['name'];
$phone=$_POST['phone'];
$email=$_POST['email'];

echo "<p>이 름: $name</p>";
echo "<p>전 화: $phone</p>";
echo "<p>이메일: $email</p>";



?>