$('#login_submit').click(function()
            {


                var form_data = {
                                login: $('#ID').val(),
                                password: $('#password').val(),
                            };
                console.log(form_data);
                $.ajax({
                        type: "POST",
                        url: "./b.php",
                        dataType: "json",
                        data : form_data,
                        success: 
                            function(data){
                                console.log(data);
                                document.querySelector('#exampleModalLongTitle').innerHTML = data.validation_result
                                document.querySelector('#modal_body').innerHTML = data.guide_text;
                                     
                            }        
                        });
            });