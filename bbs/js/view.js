$('#board_modify').click(function()
{
    if(document.querySelector('#writer').innerHTML == document.querySelector('#board_user').innerHTML)
    {                    
        window.location.replace('/bbs/Main/modify/'+document.querySelector('#board_id').innerHTML);
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
    if(document.querySelector('#writer').innerHTML == document.querySelector('#board_user').innerHTML)
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

$('.modal-close, .show').click(function(){
    $('#myModal1').modal('hide');
    $('#myModal2').modal('hide');
});

$('.modal-action').click(function(){
    window.location.replace('/bbs/Main/delete/'+document.querySelector('#board_id').innerHTML);
});