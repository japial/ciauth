<?php $this->load->view('layouts/header');?>
	<div class="row">
		<div class="col-md-8 mx-auto">
			<div class="card">
				<div class="card-header">
					Profile
				</div>
				<div class="card-body">
					<form method="POST" action="<?= base_url('profile/update') ?>">
						<div class="form-group">
							<label>Name</label>
							<input type="text" name="name" value="<?= set_value('name'); ?>" class="form-control">
							<?php if(form_error('name')){ ?>
								<small class="form-text text-danger"><?= form_error('name') ?></small>
							<?php } ?>
						</div>
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
						<div class="form-group">
							<label>Password Confirmation</label>
							<input type="password" name="password_confirmation" class="form-control">
							<?php if(form_error('password_confirmation')){ ?>
								<small class="form-text text-danger"><?= form_error('password_confirmation') ?></small>
							<?php } ?>
						</div>
						<button type="submit" class="btn btn-primary float-right">Update</button>
					</form>
				</div>
			</div>
		</div>
	</div>
<?php $this->load->view('layouts/footer');?>