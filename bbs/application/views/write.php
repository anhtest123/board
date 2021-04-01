<div class="limiter">
    <div class="container-list100">
        <div class="wrap-list100">
            <div class="container board_scroll">

                <div class="container list-title100">
                    <h2 id="list-title">
                        Board <?php echo $this->uri->segment(3,'1') ?>
                    </h2>
                </div>

                <div class="container">
                    <form id="form_write" method="post" action="/bbs/Main/add/<?php echo $this->uri->segment(3,'1') ?>">
 
                        <div class="form-group">
                            <label for="author">작성자</label>
                            <input type="text" name="author" class="form-control" id="author" value="<?php echo $this->session->userdata('nickname')?>" readonly >
                        </div>

                        <div class="form-group">
                            <label for="title">제목</label>
                            <input type="text" name="title" class="form-control" id="title" placeholder="글 제목">
                        </div>

                        <div class="form-group">
                            <textarea class="form-control" name="content" rows="5" placeholder="글 내용"></textarea>
                        </div>

                        <button type="submit" id="button_write" class="btn btn-success">제출하기</button> 
                    </form>
                </div>
            </div>
        </div>




<script>   
$('#button_write').click(function(e)
{
    e.preventDefault();
    if($('#title').val() == '')
    {
        document.querySelector('#exampleModalLongTitle1').innerHTML = 'Fail';
        document.querySelector('#modal1_body').innerHTML = '제목을 작성해주세요';
        $('#myModal1').modal('show');
    }
    else
    {
        $('#form_write').submit();
    }
});

$('#myModal1').on('hidden.bs.modal', function () {
    if(document.querySelector('#modal1_body').innerHTML == '제목을 작성해주세요')
    {
        $('#title').focus();
    }
})
</script>

<script>	
    CKEDITOR.replace( 'content',{
    filebrowserUploadUrl: '/bbs/Main/upload_image'
    } );		
</script>