<?php

    $nickname = $_POST['signup_nickname'];
    // DB 연결
    $conn = mysqli_connect("localhost", "root", "1234", "login_id_pw");

    // DB login 정보 저장
    $sql = "SELECT nickname FROM member WHERE nickname = '$nickname'";
    $result = mysqli_query($conn, $sql);
    // id check
    $row = mysqli_fetch_array($result);

    $row == NULL ? $nicknamecheckResult = true : $nicknamecheckResult = false;

    if($nicknamecheckResult)
    {
        $json = json_encode(array('validation_result' => true));
    }
    else
    {
        $json = json_encode(array('validation_result' => false));    
    }

    echo $json;
?>