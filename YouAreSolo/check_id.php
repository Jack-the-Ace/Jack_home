<?php
header('Content-Type: application/json; charset=utf-8');

// DB 연결
$db = mysqli_connect('localhost', 'jack', 'a1s2d3f4!', 'jack');

// POST로 전송된 userid 받기
$userid = isset($_POST['userid']) ? trim($_POST['userid']) : '';

$response = array('status' => 'success', 'exists' => false);

if (!empty($userid)) {
    // DB에 해당 아이di가 있는지 쿼리문 날리기
    $sql = "SELECT no FROM UAS_sign WHERE userid = ?";
    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_bind_param($stmt, "s", $userid);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    
    // 존재하면 exists를 true로 변경
    if (mysqli_stmt_num_rows($stmt) > 0) {
        $response['exists'] = true;
    }
    mysqli_stmt_close($stmt);
}

mysqli_close($db);

// 결과를 JSON 형태로 반환해 자바스크립트가 읽을 수 있게 합니다.
echo json_encode($response);
?>