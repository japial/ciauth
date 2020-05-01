<nav class="navbar navbar-expand-lg navbar-light bg-light">
	<a class="navbar-brand" href="<?= base_url() ?>">CI Auth</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>

	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav mr-auto">
			<?php if(authentic()){ ?>
			<li class="nav-item active">
				<a class="nav-link" href="<?= base_url('home') ?>">Home <span class="sr-only">(current)</span></a>
			</li>
			<?php } ?>
		</ul>

		<ul class="navbar-nav ml-auto">
			<?php if(!authentic()){ ?>
			<li class="nav-item active">
				<a class="nav-link" href="<?= base_url('auth/login') ?>">Login</a>
			</li>
			<li class="nav-item active">
				<a class="nav-link" href="<?= base_url('auth/register') ?>">Register</a>
			</li>
			<?php }else{ ?>
				<li class="nav-item active">
					<a class="nav-link" href="<?= base_url('auth/logout') ?>">Logout</a>
				</li>
			<?php } ?>
		</ul>
	</div>
</nav>
