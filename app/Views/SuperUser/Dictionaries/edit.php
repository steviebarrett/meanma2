<?= $this->extend('layouts/default') ?>

<?= $this->section('title') ?>Edit User<?= $this->endSection() ?>

<?= $this->section('content') ?>

	<h1>Edit Dictionary</h1>

<?php if (session()->has('errors')): ?>

	<ul>
		<?php foreach(session('errors') as $error): ?>
			<li><?= $error ?></li>
		<?php endforeach; ?>
	</ul>

<?php endif ?>

<?= form_open('/superuser/dictionaries/update/' . $dictionary->id) ?>

<?= $this->include('SuperUser/Dictionaries/form') ?>

	<button class="btn btn-primary">Save</button>
	<a href="<?= site_url('/superuser/dictionaries/show/' . $dictionary->id) ?>">Cancel</a>

	</form>

<?= $this->endSection() ?>