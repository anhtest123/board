    $('#login_submit').click(function()
    {
        var form_data = {
                        login: $('#ID').val(),
                        password: $('#password').val(),
                    };
        console.log(form_data);

        if( $('#ID').val() == '')
        {
            document.querySelector('#exampleModalLongTitle').innerHTML = 'ID Fail';
            document.querySelector('#modal_body').innerHTML = '아이디를 입력해 주십시오';
            $('#myModal').modal('show');
        }
        else if($('#password').val() == '')
        {
            document.querySelector('#exampleModalLongTitle').innerHTML = 'PW Fail';
            document.querySelector('#modal_body').innerHTML = '비밀번호를 입력해 주십시오';
            $('#myModal').modal('show');    
        }
        else
        {
            $.ajax({
                    type: "POST",
                    url: "./login.php",
                    dataType: "json",
                    data : form_data,
                    success: 
                        function(data){
                            console.log(data);
                            if(data.validation_result == "OK")
                            {
                                $('.login100-form').css('display','none');
                                $('.login-OK-form').css('display','block');
                                document.querySelector('.login100-OK-title').innerHTML = data.guide_text;
                                document.querySelector('#modal_body').innerHTML = "";
                            }
                            else
                            {
                                document.querySelector('#modal_body').innerHTML = data.guide_text;
                            }
                            document.querySelector('#exampleModalLongTitle').innerHTML = data.validation_result;
                            $('#myModal').modal('show');
                        }        
                    });
        }
    });

    $('.modal-close, .show').click(function(){
        $('#myModal').modal('hide');
    });

    // modal 창 닫을때
    $('#myModal').on('hidden.bs.modal', function () {
        if(document.querySelector('#exampleModalLongTitle').innerHTML == 'Login Fail')
        {
            $('#password').focus();
        }
        if(document.querySelector('#exampleModalLongTitle').innerHTML == 'ID Fail')
        {
            $('#ID').focus();
        }
        if(document.querySelector('#exampleModalLongTitle').innerHTML == 'PW Fail')
        {
            $('#password').focus();
        }
    })

    $("#password").keydown(function(key) {
        if (key.keyCode == 13) {
            $("#login_submit").click();
        }
    });



