<?php
    $id = $_POST['login'];
    $pass = $_POST['password'];

 //do your validation here 
 
        if( $id == "gogobox" && $pass == "1234" ) { echo ('{"validation_result": "OK", "guide_text" : "고고박스님 환영합니다."}'); }

        else if( $id != "gogobox" && $pass == "1234") { echo '{"validation_result": "Fail", "guide_text" : "아이디가 맞지 않습니다."}'; }
        
        else if( $id == "gogobox" && $pass !=  "1234") { echo '{"validation_result": "Fail", "guide_text" : "비밀번호가 맞지 않습니다."}'; }
        
        else { echo '{"validation_result": "Fail", "guide_text" : "비밀번호와 아이디가 맞지 않습니다."}'; }


?>