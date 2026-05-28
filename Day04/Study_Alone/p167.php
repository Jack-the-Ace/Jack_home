<?php
header("Content-Type:text/html; charset=utf-8");
$name=$_POST['name'];
$phone=$_POST['phone'];
$field=$_POST['field'];
$msg=$_POST['msg'];
$file=$_FILES['img'];

$file_name=$file['name'];
$temp_name=$file['tmp_name'];

$dst_name="./saved/".date('YmdHis').$file_name;
$result=move_uploaded_file($temp_name, $dst_name);
if($result){
    echo "File Upload Success !!<br>";
}else{
    echo "File Upload Failure....<br>";
}

$msg=nl2br($msg);

echo "<p>이름: $name</p>";
echo "<p>연락처: $phone</p>";
echo "<p>지원분야: $field</p>";
echo "<p>지원동기:<br> $msg</p>";

$now=date('Y-m-m H:i:s');

$db=mysqli_connect('localhost','jack','a1s2d3f4!','jack');

mysqli_query($db, 'set names utf8');

$sql="INSERT INTO p167(name, phone, field, message, file, date) VALUES('$name','$phone','$field','$msg','$dst_name','$now')";
$result=mysqli_query($db, $sql);
if($result){
    echo "게시글이 저장되었습니다! <br> ";
}else{
    echo "게시글 저장에 실패했습니다.. 다시 시도해주세요.. <br> ";
}

mysqli_close($db);

?>