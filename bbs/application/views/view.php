<div class="limiter">
    <div class="container-list100">
        <div class="wrap-list100">
            <div class="container board_scroll">
                
                <div class="container list-title100">
                    <h2>Board <?php echo $this->uri->segment(3,'1')?></h2>
                </div>

                <table class="table table-hover">
                    <colgroup>
                        <col width="25%">
                        <col width="25%">
                        <col width="25%">
                        <col width="25%">
                    </colgroup>
                
                    <tbody>
                        <tr>
                            <td class="text-center"><h4>번호</h4></td>
                            <td class="text-left"><p id="board_id"><?php echo $view['no']; ?></p></td>
                            <td class="text-center"><h4>작성일</h4></td>
                            <td class=""><p><?php echo $view['date']; ?></p></td>
                        </tr>
                        <tr>
                            <td class="text-center"><h4>작성자</h4></td>
                            <td colspan="3"><p id="writer"><?php echo $view['author']; ?></p></td>
                        </tr>
                        <tr>
                            <td class="text-center"><h4>제목</h4></td>
                            <td colspan="3"><p><?php echo $view['title']; ?></p></td>
                        </tr>
                        <tr>
                            <td class="text-center"><h4>내용</h4></td>
                        </tr>
                        <tr>
                            <td colspan="4" height="300px"><p><?php echo $view['content']; ?></p></td>
                        </tr>
                    </tbody>

                </table>

                <div class="container">
                    <a href="/bbs/Main/list/<?php echo $this->uri->segment(3,'1')?>" class="btn btn-success">목록</a>
                    <button class="btn btn-danger" id="board_modify">수정</button>
                    <button class="btn btn-danger" id="board_remove">삭제</button>
                </div>
            </div>
        </div>


<script>
    $('#board_modify').click(function()
    {
        if('<?php echo $this->session->userdata('logged_in')?>'== '')
        {
            window.location.replace('/bbs/Main/login');
        }
        else if('<?php echo $view['author'] ?>' == '<?php echo $this->session->userdata('nickname') ?>')
        {                    
            window.location.replace('/bbs/Main/modify/'+<?php echo $this->uri->segment(3,'1')?>+'/'+document.querySelector('#board_id').innerHTML);
        }
        else
        {
            document.querySelector('#exampleModalLongTitle1').innerHTML = 'Fail';
            document.querySelector('#modal1_body').innerHTML = '수정권한이 없습니다.';
            $('#myModal1').modal('show');
        }
    });

    $('#board_remove').click(function()
    {
        if('<?php echo $this->session->userdata('logged_in')?>'=='')
        {
            window.location.replace('/bbs/Main/login');
        }
        else if('<?php echo $view['author'] ?>' == '<?php echo $this->session->userdata('nickname') ?>')
        {                    
            document.querySelector('#exampleModalLongTitle2').innerHTML = 'OK';
            document.querySelector('#modal2_body').innerHTML = '정말 삭제하시겠습니까?';
            document.querySelector('.modal-action').innerHTML = "REMOVE"
            $('#myModal2').modal('show');
        }
        else
        {
            document.querySelector('#exampleModalLongTitle1').innerHTML = 'Fail';
            document.querySelector('#modal1_body').innerHTML = '삭제권한이 없습니다.';
            $('#myModal1').modal('show');
        }
    });

    $('.modal-action').click(function(){
        window.location.replace('/bbs/Main/delete/'+<?php echo $this->uri->segment(3,'1')?>+'/'+document.querySelector('#board_id').innerHTML);
    });
</script>
