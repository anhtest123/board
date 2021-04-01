<div class="limiter">
    <div class="container-list100">
        <div class="wrap-list100">
            <div class="container" id="board_list">



                <nav class="navbar navbar-light">
                <div class="container-fluid">
                    <h2 class="navbar-brand">Board <?php echo $this->uri->segment(3,'1') ?></h2>
                    <form class="d-flex" action="/bbs/Main/list/">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" id="input_text_search">
                        <button class="btn btn-outline-success" type="submit" id="button_search">Search</button>
                    </form>
                </div>
                </nav>

                <!-- 게시물 -->
                <div class="container">
                    <table class="table">
                        <colgroup>
                        <col width="10%"> <!-- 게시물 번호 -->
                        <col width="45%"> <!-- 제목 -->
                        <col width="20%"> <!-- 작성자 -->
                        <col width="25%"> <!-- 게시물 등록일 -->
                        </colgroup>
                        <thead>
                            <tr>
                                <td>번호</td>
                                <td>제목</td>
                                <td>작성자</td>
                                <td>등록일</td>
                            </tr>
                        </thead>
                        <tfoot></tfoot>
                        <tbody>
                            <?php foreach ($list as $key => $value): ?>
                            <tr>
                                <td><?php echo $value['no']; ?></td>
                                <td><a href="/bbs/Main/view/<?php echo $this->uri->segment(3,'1')?>/<?php echo $value['no']; ?>"><?php echo $value['title']; ?></a></td>
                                <td><?php echo $value['author']; ?></td>
                                <td><?php echo $value['date']; ?></td>
                            </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>

                <!-- 버튼 -->
                <div class ="container">
                    <ul class="nav justify-content-end">
                        <a class="btn btn-success   " href="/bbs/Main/write/<?php echo $this->uri->segment(3,'1') ?>" role="button">글쓰기</a>
                    </ul>
                </div>

                <!-- 페이징 -->
                <div aria-label="Page navigation example"  class ="container">
                    <ul class="pagination justify-content-center">
                        <?php echo $page?>
                    </ul>
                </div>
            </div>
        </div>

        <script>
            $('#button_search').click(function(e){
                e.preventDefault();
                console.log('test');

                window.location.replace('/bbs/Main/list/<?php echo $this->uri->segment(3,'1') ?>/'+$('#input_text_search').val()+'/');
            });
        </script>

  