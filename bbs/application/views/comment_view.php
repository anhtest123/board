 
                <div class="wrap-comment" id="div_comment">
                    <div class="container"><label id="comment_title">댓글</label></div>
                    
                    <div class="container comment_form">
                        <form class ="row g-12" method="post">
                            <div class="col-10 textarea_comment_div">
                                <textarea class="form-control" id="form_textarea" name="comment" rows="3" placeholder="댓글 내용"></textarea>
                            </div>
                            <div class="col-2 button_comment_div">
                                <button class="btn-primary button_comment" type="submit">제출</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- <?php // foreach ($list as $key => $value): ?>
                <div class="wrap-comment">
                    <div class="container">
                        <span><strong><?php // echo $value['writer']; ?></strong></span>
                        <span>/ <?php // echo $value['date']; ?></span>
                    </div>
                    <div class="container">
                        <?php // echo $value['comment']; ?>
                    </div>
                </div>
                <?php // endforeach ?> -->

                <div class="container" id="div_comment_more">
                    <ul class="justify-content-center container" id="ul_comment_more">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                    </ul>
                </div>
           


        <script>
        var num=0; 
        $('#div_comment_more').click(function(){
            var form_data = {
                show: num,
                board_no: "<?php echo $this->uri->segment(4) ?>"
            };

            // 스크롤 이동
            if(num != 0)
            {
                var offset = $("#div_comment_more").offset();
                $('html, body').animate({scrollTop : offset.top}, 100);
            }


            $.ajax({
                type: "POST",
                    url: "/bbs/Main/comment_view_more",
                    dataType: "json",   
                    data : form_data,
                    success: 
                        function(data){
                            for(var i=0;i<5;i++)
                            {
                                
                                if(data[data.length-1].tatal_comment <= num)
                                {
                                    $('#div_comment_more').css('display','none');
                                    break;
                                }
                    
                                var tag ='<div class="wrap-comment"><div class="container"><span><strong>'+data[i].writer+' </strong></span><span>/ '+data[i].date+'</span></div><div class="container">'+data[i].comment+'</div></div>';
                                $('#div_comment_more').before(tag);
                                
                                num = num + 1;
                            }

                        }  

            });
        });

        $('.button_comment').click(function(e)
        {
            num = num+1;
            e.preventDefault();
            var form_data = {
                comment: $('#form_textarea').val(),
                board_no: "<?php echo $this->uri->segment(4) ?>",
                writer: "<?php echo $this->session->userdata('nickname') ?>"
            };
             console.log(form_data);
            
            if('<?php echo $this->session->userdata('logged_in') ?>' == '')
            {
                window.location.replace('/bbs/Main/login');
            }
            else if($('#form_textarea').val() == '')
            {
                document.querySelector('#modal1_body').innerHTML = '댓글을 입력해주세요';
                document.querySelector('#exampleModalLongTitle1').innerHTML = 'Fail';
                $('#myModal1').modal('show');
            }
            else
            {
                $.ajax({
                    type: "POST",
                    url: "/bbs/Main/comment_add",
                    dataType: "json",   
                    data : form_data,
                    success: 
                        function(data){
                            console.log(data);
                            var tag ='<div class="wrap-comment"><div class="container"><span><strong>'+data.writer+' </strong></span><span>/ '+data.date+'</span></div><div class="container">'+data.comment+'</div></div>';
                            $('#div_comment').after(tag);
                            $('#form_textarea').val('');
                        }        
                });
            }
            
        });

        $('#myModal1').on('hidden.bs.modal', function () {
            if(document.querySelector('#modal1_body').innerHTML == '댓글을 입력해주세요')
            {
                $('#form_textarea').focus();
            }
        });

        $(document).ready(function(){
            $('#div_comment_more').click();
        });
        </script>
        


    <!-- <script>	
        CKEDITOR.replace('comment');		
    </script> -->   