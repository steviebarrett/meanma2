<?= $this->extend('layouts/dictionary') ?>

<?= $this->section('title') ?>Test<?= $this->endSection() ?>

<?= $this->section('content') ?>

	<h1 class="title">Test</h1>

	<div class="container">

		<h3>Simple page for routing and authentication testing</h3>

		<h3>Showing <?= $view ?></h3>

	</div>

<?= $this->endSection() ?>