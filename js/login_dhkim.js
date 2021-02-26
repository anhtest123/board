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
                                if(data.validation_result == "OK")
                                {
                                    $('.login100-form').css('display','none');
                                    $('.login-OK-form').css('display','block');
                                    document.querySelector('.login100-OK-title').innerHTML = data.guide_text;
                                }
                                else
                                {
                                    document.querySelector('#modal_body').innerHTML = data.guide_text;
                                }
                                document.querySelector('#exampleModalLongTitle').innerHTML = data.validation_result;
                                $('#myModal').modal('show');
                            }        
                        });
            });
            
$('.modal-close').click(function(){
    $('#myModal').modal('hide');
});