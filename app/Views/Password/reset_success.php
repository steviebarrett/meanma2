<?= $this->extend('layouts/default') ?>

<?= $this->section('title') ?>User<?= $this->endSection() ?>

<?= $this->section('content') ?>

	<h1>Password reset</h1>

	<p>Password successfully updated.</p>

	<p><a href="<?= site_url('/login') ?>">Login</a></p>

<?= $this->endSection() ?>