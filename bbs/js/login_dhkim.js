    $('#login_submit').click(function()
    {
        var form_data = {
                        login: $('#ID').val(),
                        password: $('#password').val(),
                    };
        
        console.log(form_data);
        if( $('#ID').val() == '')
        {
            document.querySelector('#exampleModalLongTitle1').innerHTML = 'ID Fail';
            document.querySelector('#modal1_body').innerHTML = '아이디를 입력해 주십시오';
            $('#myModal1').modal('show');
        }
        else if($('#password').val() == '')
        {
            document.querySelector('#exampleModalLongTitle1').innerHTML = 'PW Fail';
            document.querySelector('#modal1_body').innerHTML = '비밀번호를 입력해 주십시오';
            $('#myModal1').modal('show');    
        }
        else
        {
            $.ajax({
                    type: "POST",
                    url: "/bbs/Main/login/",
                    dataType: "json",
                    data : form_data,
                    success: 
                        function(data){
                            console.log(data);
                            document.querySelector('#modal1_body').innerHTML = data.guide_text;
                            document.querySelector('#exampleModalLongTitle1').innerHTML = data.validation_result;
                            $('#myModal1').modal('show');
                        }        
                    });
        }
    });

    // modal 창 닫을때
    $('#myModal1').on('hidden.bs.modal', function () {
        if(document.querySelector('#exampleModalLongTitle1').innerHTML == 'Login Fail')
        {
            $('#password').focus();
        }
        if(document.querySelector('#exampleModalLongTitle1').innerHTML == 'ID Fail')
        {
            $('#ID').focus();
        }
        if(document.querySelector('#exampleModalLongTitle1').innerHTML == 'PW Fail')
        {
            $('#password').focus();
        }
        if(document.querySelector('#exampleModalLongTitle1').innerHTML == 'Login OK')
        {
            window.location.replace('/bbs/Main');
        }
    });

    $("#password").keydown(function(key) {
        if (key.keyCode == 13) {
            $("#login_submit").click();
        }
    });



