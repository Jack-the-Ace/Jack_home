<?php
header('Content-Type: text/html; charset=utf-8');
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$db=mysqli_connect('localhost','jack','a1s2d3f4!','jack');
mysqli_query($db, "set names utf8");

$userid = $_POST['userid'];
$password = $_POST['password'];
$name = $_POST['name'];
$gender = $_POST['gender'];

$profile_img_name=null;
if(isset($_FILES['profile_img']) && $_FILES['profile_img']['error']===0){
    $upload_dir='./uploads/';
    if(!is_dir($upload_dir)){mkdir($upload_dir,0777,true);}

    $file_ext=pathinfo($_FILES['profile_img']['name'],PATHINFO_EXTENSION);
    $profile_img_name=time().'_'.uniqid().'.'.$file_ext;

    $dest_path=$upload_dir . $profile_img_name;
    move_uploaded_file($_FILES['profile_img']['tmp_name'],$dest_path);
}
$password = password_hash($password, PASSWORD_DEFAULT);
try {
    $sql = "INSERT INTO UAS_sign (userid, password, name, gender, profile_img) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($db, $sql);
    
    mysqli_stmt_bind_param($stmt, "sssss", $userid, $password, $name, $gender, $profile_img_name);
    mysqli_stmt_execute($stmt);
    
     echo "<script>
            alert('솔로나라에 정상적으로 가입되었습니다! 로그인해 주세요.');
            location.href = './start2.html';
          </script>";

} catch (mysqli_sql_exception $e) {
    // 중복된 아이디 에러 등이 터졌을 때 예외 처리
    if ($e->getCode() == 1062) {
        echo "<script>
                alert('이미 사용 중인 아이디입니다.');
                history.back();
              </script>";
    } else {
        echo "오류 발생: " . $e->getMessage();
    }
}

// 연결 종료
mysqli_stmt_close($stmt);
mysqli_close($db);
?>