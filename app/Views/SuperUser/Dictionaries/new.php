<?= $this->extend('layouts/default') ?>

<?= $this->section('title') ?>New Dictionary<?= $this->endSection() ?>

<?= $this->section('content') ?>

	<h1>New Dictionary</h1>

<?php if (session()->has('errors')): ?>

	<ul>
		<?php foreach(session('errors') as $error): ?>
			<li><?= $error ?></li>
		<?php endforeach; ?>
	</ul>

<?php endif ?>

<?= form_open('/superuser/dictionaries/create') ?>

<?= $this->include('SuperUser/Dictionaries/form') ?>

	<button class="btn btn-primary">Save</button>
	<a href="<?= site_url('/') ?>">Cancel</a>

	</form>

<?= $this->endSection() ?>