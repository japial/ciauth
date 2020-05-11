<?php $this->load->view('layouts/header');?>
	<div class="row">
		<div class="col-md-8 mx-auto py-2">
			<?php if($this->session->flashdata('success')){ ?>
				<div class="alert alert-success" role="alert">
					<?= $this->session->flashdata('success') ?>
				</div>
			<?php } ?>
			<div class="card">
				<div class="card-header">
					Update Profile
				</div>
				<div class="card-body">
					<form method="POST" action="<?= base_url('profile/update') ?>">
						<div class="form-group">
							<label>Name</label>
							<input type="text" name="name" value="<?= $user->name ?>" class="form-control" required>
							<?php if(form_error('name')){ ?>
								<small class="form-text text-danger"><?= form_error('name') ?></small>
							<?php } ?>
						</div>
						<div class="form-group">
							<label>Email</label>
							<input type="email" name="email" value="<?= $user->email ?>" class="form-control" required>
							<?php if(form_error('email')){ ?>
								<small class="form-text text-danger"><?= form_error('email') ?></small>
							<?php } ?>
							<?php if($this->session->flashdata('emailError')){ ?>
							<small class="text-danger text-center">
								<?= $this->session->flashdata('emailError') ?>
							</small>
							<?php } ?>
						</div>
						<button type="submit" class="btn btn-primary float-right">Update</button>
					</form>
				</div>
			</div>

			<div class="card mt-3">
				<div class="card-header">
					Change Password
				</div>
				<div class="card-body">
					<form method="POST" action="<?= base_url('profile/change_password') ?>">
						<div class="form-group">
							<label>Current Password</label>
							<input type="password" name="current_password" class="form-control" required>
							<?php if(form_error('current_password')){ ?>
								<small class="form-text text-danger"><?= form_error('current_password') ?></small>
							<?php } ?>
							<?php if($this->session->flashdata('passwordError')){ ?>
								<small class="text-danger text-center">
									<?= $this->session->flashdata('passwordError') ?>
								</small>
							<?php } ?>
						</div>
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
<?php $this->load->view('layouts/footer');?>
