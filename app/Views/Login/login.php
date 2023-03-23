<?= $this->extend('layouts/default') ?>

<?= $this->section('title') ?>Login<?= $this->endSection() ?>

<?= $this->section('content') ?>

	<h1 class="title">Login</h1>

	<div class="container">

	  <?= form_open('/login/create') ?>

		<div class="mb-3">
			<label class="form-label" for="email">Email</label>
			<input class="form-control" type="text" id="email" name="email" value="<?= old('email') ?>">
		</div>

		<div class="mb-3">
			<label class="form-label" for="password">Password</label>
			<input class="form-control" type="password" id="password" name="password">
		</div>

		<div>
			<div class="mb-3">
				<button class="btn btn-primary">Log in</button>
			</div>
			<a href="<?= site_url('/password/forgot') ?>">Forgot password</a>
		</div>

		</form>

	</div>

<?= $this->endSection() ?>