<?php
    
    $id = $_POST['login'];
    $pass = $_POST['password'];

    // DB 연결
    $conn = mysqli_connect("localhost", "root", "1234", "login_id_pw");
    
    // ID 검색
    $sql = "SELECT * FROM member WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);

    // PW 확인
    $row == NULL ? $passwordResult = false : $passwordResult = password_verify($_POST['password'], $row['pw']);

    if($passwordResult)
    {
        $json = json_encode(array('validation_result' => 'OK', 'guide_text' => $row['nickname']."님 환영합니다."));
    }
    else
    {
        $json = json_encode(array('validation_result' => 'Login Fail', 'guide_text' => '아이디 또는 비밀번호가 옳바르지 않습니다.'));    
    }

    echo $json;

?>