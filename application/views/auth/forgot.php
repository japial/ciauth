<?php $this->load->view('layouts/header');?>
<div class="row">
	<div class="col-md-6 mx-auto py-5">
		<div class="card">
			<div class="card-header">Forgot Password</div>
			<div class="card-body">
				<?php if($this->session->flashdata('success')){ ?>
					<div class="alert alert-success" role="alert">
						<?= $this->session->flashdata('success') ?>
					</div>
				<?php } ?>

				<?php if($this->session->flashdata('timeError')){ ?>
					<div class="alert alert-danger" role="alert">
						<?= $this->session->flashdata('timeError') ?>
					</div>
				<?php } ?>
				<form method="POST" action="<?= base_url('forgot/send_email') ?>">
					<div class="form-group">
						<label>Enter Your Email</label>
						<input type="email" name="email" value="<?= set_value('email'); ?>" class="form-control" required>
						<?php if(form_error('email')){ ?>
							<small class="form-text text-danger"><?= form_error('email') ?></small>
						<?php } ?>
						<?php if(isset($failed)){ ?>
							<small class="form-text text-danger">This Email Not Found!</small>
						<?php } ?>
					</div>

					<div class="form-group">
						<button type="submit" class="btn btn-primary float-right">Send Verification Email</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<?php $this->load->view('layouts/footer');?>
