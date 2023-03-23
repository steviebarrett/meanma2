<?= $this->extend('layouts/dictionary') ?>

<?= $this->section('title') ?> <?= current_dictionary()->name ?> <?= $this->endSection() ?>

<?= $this->section('content') ?>

	<h1 class="title"><?= current_dictionary()->name ?></h1>

		<p>Access level: <?= current_dictionary()->access_level ?></p>

	<div class="container">


	</div>

<?= $this->endSection() ?>