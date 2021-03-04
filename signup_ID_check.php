<?php

    $ID = $_POST['signup_ID'];
    // DB 연결
    $conn = mysqli_connect("localhost", "root", "1234", "login_id_pw");

    // DB login 정보 저장
    $sql = "SELECT id FROM member WHERE id = '$ID'";
    $result = mysqli_query($conn, $sql);
    // id check
    $row = mysqli_fetch_array($result);

    $row == NULL ? $idcheckResult = true : $idcheckResult = false;

    if($idcheckResult)
    {
        $json = json_encode(array('validation_result' => true));
    }
    else
    {
        $json = json_encode(array('validation_result' => false));    
    }

    echo $json;
?>