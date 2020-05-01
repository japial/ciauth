<?php $this->load->view('layouts/header');?>
<div class="row">
	<div class="col-md-6 mx-auto py-5">
		<div class="card">
			<div class="card-header">Login</div>
			<div class="card-body">
				<form method="POST" action="<?= base_url('auth/login') ?>">
					<div class="form-group">
						<label>Email</label>
						<input type="email" name="email" value="<?= set_value('email'); ?>" class="form-control">
						<?php if(form_error('email')){ ?>
							<small class="form-text text-danger"><?= form_error('email') ?></small>
						<?php } ?>
					</div>
					<div class="form-group">
						<label>Password</label>
						<input type="password" name="password" class="form-control">
						<?php if(form_error('password')){ ?>
							<small class="form-text text-danger"><?= form_error('password') ?></small>
						<?php } ?>
					</div>
					<?php if(isset($failed)){ ?>
						<small class="form-text text-danger">Your Email and Password not matched!</small>
					<?php } ?>
					<button type="submit" class="btn btn-primary float-right">Login</button>
				</form>
			</div>
		</div>
	</div>
</div>
<?php $this->load->view('layouts/footer');?>
