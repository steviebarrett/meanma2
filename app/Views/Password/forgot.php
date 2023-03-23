<?= $this->extend('layouts/default') ?>

<?= $this->section('title') ?>Forgot Password<?= $this->endSection() ?>

<?= $this->section('content') ?>

	<h1>Forgot Password</h1>

<?= form_open('/password/processforgot') ?>

	<div class="mb-3">
		<label class="form-label" for="email">Email</label>
		<input type="email" class="form-control" id="email" name="email" value="<?= old('email') ?>">
	</div>

	<button class="btn btn-primary">Send</button>

	</form>

<?= $this->endSection() ?>