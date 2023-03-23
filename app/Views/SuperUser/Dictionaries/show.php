<?= $this->extend('layouts/default') ?>

<?= $this->section('title') ?>User<?= $this->endSection() ?>

<?= $this->section('content') ?>

<h1>Dictionary</h1>

<a href="<?= site_url('/') ?>">&laquo; Dictionaries</a>

<dl>
	<dt>Name</dt>
	<dd><?= $dictionary->name ?></dd>

	<dt>Short Name</dt>
	<dd><?= $dictionary->short_name ?></dd>

	<dt>Created at</dt>
	<dd><?= $dictionary->created_at ?></dd>

	<dt>Updated at</dt>
	<dd><?= $dictionary->updated_at ?></dd>

</dl>

<a href="<?= site_url('/superuser/dictionaries/edit/' . $dictionary->id) ?>">Edit</a>

<?= $this->endSection() ?>
