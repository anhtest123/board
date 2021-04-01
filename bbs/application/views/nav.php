<nav class="navbar navbar-expand-lg navbar-light bg-light">
	<div class="container-fluid">
	
		<a class="navbar-brand" href="/bbs/Main">HOME</a>

		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarNav">
			<ul class="navbar-nav me-auto mb-2 mb-lg-0">
				<li class="nav-item">
					<a class="nav-link active" href="/bbs/Main/list/1">Board1</a>
				</li>
				<li class="nav-item">
					<a class="nav-link active" href="/bbs/Main/list/2">Board2</a>
				</li>
				<li class="nav-item">
					<a class="nav-link active" href="/bbs/Main/list/3">Board3</a>
				</li>
				<li class="nav-item">
					<a class="nav-link active" href="/bbs/Main/list/4">Board4</a>
				</li>
				<li class="nav-item">
					<a class="nav-link active" href="/bbs/Main/list/5">Board5</a>
				</li>
			</ul>

			<span class="navbar-item">
				<?php if($this->session->userdata('logged_in')) { ?>
					<a class="navbar-link active" href="#" id="board_user"><?php echo $this->session->userdata('nickname')?></a>님
					<a class="navbar-link active" href="/bbs/Main/logout">logout</a>
				<?php }else{  ?>
					<a class="navbar-link active" href="/bbs/Main/login">login</a>
				<?php } ?>
			</span>
		</div>
	</div>
</nav>
