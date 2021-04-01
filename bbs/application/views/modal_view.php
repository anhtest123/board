
<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">

					<h5 class="modal-title" id="exampleModalLongTitle1">Modal title</h5>

					<button type="button" class="modal-close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>

				<div id="modal1_body" class="modal-body">
					...	
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-secondary modal-close">Close</button>
				</div>
			</div>
		</div>
</div>

<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">

					<h5 class="modal-title" id="exampleModalLongTitle2">Modal title</h5>

					<button type="button" class="modal-close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>

				<div id="modal2_body" class="modal-body">
					...	
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-secondary modal-close">Close</button>
					<button type="button" class="btn btn-primary modal-action">Save changes</button>
				</div>
			</div>
		</div>
</div>

<script>
$(document).ready(function(){

	if('<?php echo $view['action']?>' == 'add')
	{
		if(<?php echo $view['validation']?>)
		{
			document.querySelector('#exampleModalLongTitle1').innerHTML = 'OK';
			document.querySelector('#modal1_body').innerHTML = '작성되었습니다.';
			$('#myModal1').modal('show');
		}
		else
		{
			document.querySelector('#exampleModalLongTitle1').innerHTML = 'Fail';
			document.querySelector('#modal1_body').innerHTML = '다시 시도해주세요';
			$('#myModal1').modal('show');
		}
	}

	if('<?php echo $view['action']?>' == 'update')
	{
		if(<?php echo $view['validation']?>)
		{
			document.querySelector('#exampleModalLongTitle1').innerHTML = 'OK';
			document.querySelector('#modal1_body').innerHTML = '수정되었습니다.';
			$('#myModal1').modal('show');
		}
		else
		{
			document.querySelector('#exampleModalLongTitle1').innerHTML = 'Fail';
			document.querySelector('#modal1_body').innerHTML = '다시 시도해주세요';
			$('#myModal1').modal('show');
		}
	}

	if('<?php echo $view['action']?>' == 'delete')
	{
		if(<?php echo $view['validation']?>)
		{
			document.querySelector('#exampleModalLongTitle1').innerHTML = 'OK';
			document.querySelector('#modal1_body').innerHTML = '삭제되었습니다.';
			$('#myModal1').modal('show');
		}
		else
		{
			document.querySelector('#exampleModalLongTitle1').innerHTML = 'Fail';
			document.querySelector('#modal1_body').innerHTML = '다시 시도해주세요';
			$('#myModal1').modal('show');
		}
	}


});

$('.modal-close').click(function()
{
    $('#myModal1').modal('hide');
    $('#myModal2').modal('hide');
});

$('#myModal1').on('hidden.bs.modal', function () {
	if('<?php echo $view['action']?>' == 'add')
    {                    
        window.location.replace('/bbs/Main/list/<?php echo $view['bnumber']?>');
    }

	if('<?php echo $view['action']?>' == 'update')
    {                    
        window.location.replace('/bbs/Main/list/<?php echo $view['bnumber']?>');
    }

	if('<?php echo $view['action']?>' == 'delete')
    {                    
        window.location.replace('/bbs/Main/list/<?php echo $view['bnumber']?>');
    }

});
</script>