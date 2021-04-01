<!-- 이번에는 게시물의 번호를 URL로 보내지 않고, form data 로 보냄 -->
<section class="container">
    <form method="post" action="/bbs/Main/delete">
        <h1>선택한 게시물을 삭제하시겠습니까?</h1>
        <h3>제목 : <?php echo $view['title']?></h3>
        <h3>작성자 : <?php echo $view['author']?></h3>
        <hr>
        <h4>※ 한번 삭제한 게시물은 복원할 수 없습니다</h4>
         
        <!-- type hidden 은 실제로 웹페이지에는 보이지 않고, 데이터를 저장 -->
        <input type="hidden" name="no" value="<?php echo $view['no'] ?>">
 
        <a href="/bbs/Main/view/<?php echo $view['no'] ?>" class="btn btn-warning">취소</a>    
        <button type="submit" class="btn btn-danger">삭제하기</button>  
    </form>   
</section>