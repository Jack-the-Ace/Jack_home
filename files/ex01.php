<?php
header("Content-Type:text/html; charset=utf-8");
$db= mysqli_connect('localhost','jack','a1s2d3f4!','jack');
mysqli_query($db, "set names utf8");
if($_SERVER['REQUEST_METHOD']==='POST'&&isset($_POST['marry'])){
    $marry= $_POST['marry'];
    $msg= $_POST['msg'];
    $dst_name= "";
    if(isset($_FILES['img']) && $_FILES['img']['error']===UPLOAD_ERR_OK){
        $file= $_FILES['img'];
        $file_name= $file['name'];
        $temp_name= $file['tmp_name'];
        if(!is_dir("./saved")){
            mkdir("./saved",0777,true);
        }
        $dst_name= "./saved".date('YmdHis')."_".$file_name;
        if(move_uploaded_file($temp_name, $dst_name)){
            echo "File Upload Success !! <br>";
        }else{
            echo "File Upload Failure....<br>";
            $dst_name= "";
        }
    }
    // $msg= nl2br($msg);
    $msg= nl2br(htmlspecialchars($msg));
    $now= date('Y-m-d H:i:s');
    $insert_sql= "INSERT INTO UAS(marry, msg, file, date) VALUES('$marry','$msg','$dst_name','$now)";
    $result= mysqli_query($db, $insert_sql);
    if($result){
        echo "<script>alert('Good');</script>";
    }else{
        echo "Bad<br>";
    }
}
$sql= "SELECT * FROM UAS ORDER BY no DESC";
$result_table= mysqli_query($db, $sql);
if($result_table){
    $row_num= mysqli_num_rows($result_table);
    echo "<h2>(total: ".$row_num." 건)</h2><hr>";
    for($i=0; $i<$row_num; $i++){
        $row= mysqli_fetch_array($result_table, MYSQLI_ASSOC);
        $no=$row['no'];
        $marry=$row['marry'];
        $msg=$row['msg'];
        $file=$row['file'];
        $date=$row['date'];
        echo "<h5>No. $no</h5>";
        echo "<h3> ㅇㅇ님께.</h3>";
        echo "<h4>결혼 가치관: $marry</h4>";
        echo "<p>보내신 메시지:<br>$msg</p>";
        echo "<h6>보낸 시간: $date</h6>";
        if($file && file_exists($file)){
            echo "<img src='$file' alt='첨부파일' width='150'>";
        }
        echo "<hr>";
    }
}else{
    echo "게시글 리스트를 불러오지 못했습니다..<br>";
}
mysqli_close($db);
?>