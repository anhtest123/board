
<div class="limiter">
    <div class="container-list100">
        <div class="wrap-list100">
            <div class="container board_scroll">
                <form method="post" action="/bbs/Main/update/<?php echo $view['bnumber']?>/<?php echo $view['no'] ?>">
                    <div class="container list-title100">
                        <h2 id="list-title">
                            Board <?php echo $this->uri->segment(3,'1')?>
                        </h2>
                    </div>   

                    <div class="container">
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
                                    <td colspan="3"><p><?php echo $view['no']; ?></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center"><h4>작성자</h4></td>
                                    <td colspan="3">
                                        <input type="text" name="author" value="<?php echo $view['author']; ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center"><h4>제목</h4></td>
                                    <td colspan="3">
                                        <input type="text" name="title" value="<?php echo $view['title']; ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center"><h4>내용</h4></td>                               
                                </tr>
                                <tr>
                                    <td colspan="4"  height="300px">
                                        <textarea class="form-control ckeditor" name="content" rows="5"><?php echo $view['content']; ?></textarea>
                                    </td>
                                </tr>  
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="container">
                        <a href="/bbs/Main/list/<?php echo $this->uri->segment(3,'1')?>" class="btn btn-success">목록</a>
                        <button type="submit" class="btn btn-danger">수정 제출하기</button>
                    </div>
                </form>
            </div>
        </div>

<script>	
    CKEDITOR.replace( 'content',{
    filebrowserUploadUrl: '/bbs/Main/upload_image'
    } );		
</script>