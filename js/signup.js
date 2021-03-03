$('#signup_submit').click(function()
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
                                location.replace("/LOGIN_V1/index.html");
                            }        
                        });
            });