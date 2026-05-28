<?php
header('Content-Type:text/html; charset=utf-8');

$db=mysqli_connect('localhost','jack','a1s2d3f4!','jack');

mysqli_query($db, "set names utf8");

$sql="SELECT * FROM p167";
$result_table=mysqli_query($db,$sql);
if($result_table){
    $row_num=mysqli_num_rows($result_table);
    for($i=0; $i<$row_num; $i++){
        $row=mysqli_fetch_array($result_table, MYSQLI_ASSOC);

        $no=$row['no'];
        $name=$row['name'];
        $phone=$row['phone'];
        $field=$row['field'];
        $msg=$row['msg'];
        $file=$row['file'];
        $date=$row['date'];

        echo "<h3>$no</h3>";
        echo "<h2>$name</h2>";
        echo "<p>$phone</p>";
        echo "<h4>$field</h4>";
        echo "<p>$msg</p>";
        echo "<h5>$date</h5>";

        if($file){
            echo "<img src='$file' alt='첨부파일' width='200'>";
        }
        echo "<hr>";
    }
}else{
    echo "게시글 리스트를 불러오지 못했습니다...ㅠㅠ<br>";
}
mysqli_close($db);

?>