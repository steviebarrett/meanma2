<?= $this->extend('layouts/default') ?>

<?= $this->section('title') ?>Edit User<?= $this->endSection() ?>

<?= $this->section('content') ?>

	<h1>Edit User</h1>

<?php if (session()->has('errors')): ?>

	<ul>
		<?php foreach(session('errors') as $error): ?>
			<li><?= $error ?></li>
		<?php endforeach; ?>
	</ul>

<?php endif ?>

<?= form_open('/superuser/users/update/' . $user->id) ?>

<?= $this->include('SuperUser/Users/form') ?>

	<button class="btn btn-primary">Save</button>
	<a href="<?= site_url('/superuser/users/show/' . $user->id) ?>">Cancel</a>

	</form>

<?= $this->endSection() ?>