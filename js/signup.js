    $(document).ready(function(){
        $('.wrap-login100').css('padding-top','127px');
        $('.login100-pic').css('margin-top','50px');
    
    });
    var keystatus = false;

    $('#signup_submit').click(function(){      
        var keystatus = false;
        if('rgb(87, 184, 70)' != $('#signup_ID').css('color')) { $('#signup_ID').focus(); }
        else if('rgb(87, 184, 70)' != $('#signup_password').css('color')) { $('#signup_password').focus(); }
        else if('rgb(87, 184, 70)' != $('#passwordcheck').css('color')) { $('#passwordcheck').focus(); }
        else if('rgb(87, 184, 70)'!= $('#nickname').css('color')) { $('#nickname').focus(); }
        else
        {
            var form_data = {   
                            signup_ID: $('#signup_ID').val(),
                            nickname: $('#nickname').val(),
                            signup_password: $('#signup_password').val(),
                        };
            console.log(form_data);
            $.ajax({
                type: "POST",
                url: "./signup.php",
                dataType: "json",
                data : form_data,
                success: 
                function(data){
                    console.log(data);
                    
                }        
            });
            document.querySelector('#modal_body').innerHTML = '회원가입이 완료되었습니다.';
            document.querySelector('#exampleModalLongTitle').innerHTML = 'OK';
            $('#myModal').modal('show');
        }
    });

    $('.input100').keydown(function(key) {
        if (key.keyCode == 13) {
            $('.input100').blur();
            keystatus = true;
        }   
    });

    // 입력 가이드 
    $('#signup_ID').blur(function(){
        if( $('#signup_ID').val() == '')
        {
            $('#signup_ID_comment').html('This is required');
            $('#signup_ID_comment').css('display','block');
            $('#signup_ID').css('color','#666666');
        }
        else if($('#signup_ID').val().trim().match(/^[A-Za-z0-9_\-]{5,20}$/) == null)
        {
            $('#signup_ID_comment').html('Use 5~20 lowercase letters, numbers and special symbols (_), (-) can be used');
            $('#signup_ID_comment').css('display','block');
            $('#signup_ID').css('color','#666666');
        }
        else
        {
            var form_data = {
                signup_ID: $('#signup_ID').val(),
            };
            $.ajax({
                type: "POST",
                url: "./signup_ID_check.php",
                dataType: "json",
                data : form_data,
                success: 
                    function(data){
                        console.log(data);
                        if(data.validation_result)
                        {
                            $('#signup_ID').css('color','#57b846');
                            $('#signup_ID_comment').css('display','none'); 
                            if(keystatus) $('#signup_submit').click();
                        }
                        else
                        {
                            $('#signup_ID_comment').html('This ID is already in use');
                            $('#signup_ID_comment').css('display','block');  
                            $('#signup_ID').css('color','#666666');
                        }
                    }        
                });
        }
    });

    $('#signup_password').blur(function(){
        if( $('#signup_password').val() == '')
        {   
            $('#signup_password_comment').html('This is required');
            $('#signup_password').css('color','#666666');
            $('#signup_password_comment').css('display','block');
        }
        else if($('#signup_password').val().trim().match(/^(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[!@#$%^*()\-_=+\\|\[\]{};:\'",.<>\/?]).{8,16}$/) == null)
        {   
            $('#signup_password_comment').html('Use 8~16 uppercase and lowercase letters, numbers, and special characters');
            $('#signup_password_comment').css('display','block');
            $('#signup_password').css('color','#666666');
        }
        else
        {
            $('#signup_password').css('color','#57b846');
            $('#signup_password_comment').css('display','none');
        }
    });

    $('#passwordcheck').blur(function(){
        if( $('#passwordcheck').val() == '')
        {
            $('#signup_passwordcheck_comment').html('This is required');
            $('#signup_passwordcheck_comment').css('display','block');
            $('#passwordcheck').css('color','#666666');
            
        }
        else
        {
            if($('#passwordcheck').val() == $('#signup_password').val())
            { 
                $('#passwordcheck').css('color','#57b846');
                $('#signup_passwordcheck_comment').css('display','none');
            }
            else
            {
                $('#signup_passwordcheck_comment').html('Passwords do not match');    
                $('#signup_passwordcheck_comment').css('display','block');
                $('#passwordcheck').css('color','#666666');
            }
        }
    });

    $('#nickname').blur(function(){
        if( $('#nickname').val() == '')
        {
            $('#signup_nickname_comment').html('This is required');
            $('#signup_nickname_comment').css('display','block');  
            $('#nickname').css('color','#666666'); 
        }
        else
        {
            var form_data = {
                signup_nickname: $('#nickname').val(),
            };
            $.ajax({
                type: "POST",
                url: "./signup_nickname_check.php",
                dataType: "json",
                data : form_data,
                success: 
                    function(data){
                        console.log(data);
                        if(data.validation_result)
                        {
                            $('#nickname').css('color','#57b846');
                            $('#signup_nickname_comment').css('display','none');
                            if(keystatus) $('#signup_submit').click();
                        }
                        else
                        {
                            $('#signup_nickname_comment').html('This nickname is already in use');
                            $('#signup_nickname_comment').css('display','block');
                            $('#nickname').css('color','#666666');
                        }
                    }        
                });
        }
    });

    $('.modal-close, .show').click(function(){
        $('#myModal').modal('hide');
    });

    $('#myModal').on('hidden.bs.modal', function () {
        window.location.replace('index.html');
    })