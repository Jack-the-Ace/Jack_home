<?php
    header('Content-Type:text/html; charset=utf-8');

    $db=mysqli_connect('localhost','jack','a1s2d3f4!','jack');

    mysqli_query($db,"set names utf8");

    $sql="SELECT * FROM p166";
    $result_table=mysqli_query($db,$sql);
    if($result_table){
        $row_num=mysqli_num_rows($result_table);
        for($i=0; $i<$row_num; $i+=1){
            $row=mysqli_fetch_array($result_table, MYSQLI_ASSOC);

            $no=$row['no'];
            $name=$row['name'];
            $phone=$row['phone'];
            $email=$row['email'];

            echo "<h4>$no $name</h4>";
            echo "<h3>$phone</h3>";
            echo "<p>$email</p>";
            echo "<hr>";
        }        
    }else{
        echo "게시글 리스트를 불러오는 중 오류가 발생했습니다.<br>";
    }

    mysqli_close($db);

?>