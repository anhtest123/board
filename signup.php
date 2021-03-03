<?php

    $ID = $_POST['signup_ID'];
    $nickname = $_POST['nickname'];
    $password = $_POST['signup_password'];

    // DB 연결
    $conn = mysqli_connect("localhost", "root", "1234", "login_id_pw");
    // PW 암호화
    $hashedPassword = password_hash($_POST['signup_password'], PASSWORD_DEFAULT);
    // DB login 정보 저장
    $sql = " INSERT INTO member(`id`, `nickname`, `pw`) VALUES ('$ID','$nickname','$hashedPassword')";
    $result = mysqli_query($conn, $sql);
    /* // Debug
    $json = json_encode(array('validation_result' => $_POST['signup_password'], 'pass'=>$hashedPassword));
    echo $json; */ 

    if ($result === false) {
        echo "저장에 문제가 생겼습니다. 관리자에게 문의해주세요.";
        echo mysqli_error($conn);
    }
?>