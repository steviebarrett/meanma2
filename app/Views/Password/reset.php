<?= $this->extend('layouts/default') ?>

<?= $this->section('title') ?>User<?= $this->endSection() ?>

<?= $this->section('content') ?>

	<h1>Password reset</h1>

<?php if (session()->has('errors')): ?>

	<ul>
		<?php foreach(session('errors') as $error): ?>
			<li><?= $error ?></li>
		<?php endforeach; ?>
	</ul>

<?php endif ?>

<?= form_open("/password/processreset/$token") ?>

	<div class="mb-3">
		<label class="form-label" for="password">Password</label>
		<input class="form-control" type="password" id="password" name="password">
	</div>

	<div class="mb-3">
		<label class="form-label" for="password_confirm">Password confirm</label>
		<input class="form-control" type="password" id="password_confirm" name="password_confirm">
	</div>

	<button type="submit" class="btn btn-primary">Reset password</button>

<?= $this->endSection() ?>