<?php
    header("Content-Type:text/html; charset=utf-8");

    $name=$_POST['name'];
    $phone=$_POST['phone'];
    $email=$_POST['email'];

    echo "<p>이 름: $name</p>";
    echo "<p>전 화: $phone</p>";
    echo "<p>이메일: $email</p>";
    echo "------------------------------<br>";

    $db=mysqli_connect('localhost','jack','a1s2d3f4!','jack');

    mysqli_query($db, "set names utf8");

    $sql="INSERT INTO p166(name, phone, email) VALUES('$name', '$phone', '$email')";
    $result=mysqli_query($db,$sql);
    if($result){
        echo "게시글이 저장되었습니다!<br>";
    }else{
        echo "게시글 저장에 실패했습니다, 다시 시도해주세요... <br> ";
    }

    mysqli_close($db);

?>