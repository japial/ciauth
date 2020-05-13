<div class="row">
	<div class="col-md-6 mx-auto py-2">
		<div class="card mt-3">
			<div class="card-header">
				Reset Your Password
			</div>
			<div class="card-body">
				<?php if($this->session->flashdata('error')){ ?>
					<div class="alert alert-danger" role="alert">
						<?= $this->session->flashdata('error') ?>
					</div>
				<?php } ?>
				<form method="POST" action="<?= base_url('forgot/change_password') ?>">
					<input type="hidden" name="token" value="<?= $token ?>">
					<div class="form-group">
						<label>Password</label>
						<input type="password" name="password" class="form-control" required>
						<?php if(form_error('password')){ ?>
							<small class="form-text text-danger"><?= form_error('password') ?></small>
						<?php } ?>
					</div>
					<div class="form-group">
						<label>Password Confirmation</label>
						<input type="password" name="password_confirmation" class="form-control" required>
						<?php if(form_error('password_confirmation')){ ?>
							<small class="form-text text-danger"><?= form_error('password_confirmation') ?></small>
						<?php } ?>
					</div>
					<button type="submit" class="btn btn-primary float-right">Change Password</button>
				</form>
			</div>
		</div>
	</div>
</div>
