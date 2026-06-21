<?php
// 한글 깨짐 방지 및 에러 모드 설정
header('Content-Type: text/html; charset=utf-8');
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// 1. DB 연결 (본인의 닷홈 DB 정보)
$db = mysqli_connect('localhost', 'jack', 'a1s2d3f4!', 'jack');
mysqli_query($db, "set names utf8");

// 2. 로그인 폼에서 입력한 아이디, 비밀번호 가져오기
$userid = $_POST['userid'];
$password = $_POST['password'];

try {
    // 3. DB에서 입력된 아이디가 존재하는지 조회 (Prepared Statement 사용)
    $sql = "SELECT userid, password, name FROM UAS_sign WHERE userid = ?";
    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_bind_param($stmt, "s", $userid);
    mysqli_stmt_execute($stmt);
    
    // 결과 가져오기
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);

    // 4. 회원 정보 판별 로직
    if ($user) {
        // 💡 아이디가 존재하는 경우 -> 암호화된 비밀번호 비교 (password_verify)
        if (password_verify($password, $user['password'])) {
            
            // 로그인 성공!!
            // 여기에 세션(Session)을 생성하면 로그인 상태가 유지됩니다.
            session_start();
            $_SESSION['userid'] = $user['userid'];
            $_SESSION['name'] = $user['name'];

            echo "<script>
                    alert('" . $user['name'] . "님, 솔로나라에 오신 것을 환영합니다! ❤️');
                    location.href = './main2.html'; 
                  </script>";
        } else {
            // 아이디는 맞지만 비밀번호가 틀린 경우
            echo "<script>
                    alert('비밀번호가 일치하지 않습니다.');
                    history.back();
                  </script>";
        }
    } else {
        // 💡 DB에 아이디 자체가 없는 경우 (회원가입 안 된 사람)
        echo "<script>
                alert('존재하지 않는 아이디입니다. 회원가입을 먼저 해주세요.');
                location.href = './sign_in.html';
              </script>";
    }

} catch (mysqli_sql_exception $e) {
    echo "오류 발생: " . $e->getMessage();
}

// 연결 종료
mysqli_stmt_close($stmt);
mysqli_close($db);
?>