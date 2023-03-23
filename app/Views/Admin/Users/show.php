<?= $this->extend('layouts/default') ?>

<?= $this->section('title') ?>User<?= $this->endSection() ?>

<?= $this->section('content') ?>

<h1>User</h1>

<a href="<?= site_url('/admin/users') ?>">&laquo; Users</a>

<dl>
	<dt>Name</dt>
	<dd><?= $user->firstname . ' ' . $user->lastname ?></dd>

	<dt>Email</dt>
	<dd><?= esc($user->email) ?></dd>

	<dt>Active</dt>
	<dd><?= $user->is_active ? 'yes' : 'no' ?></dd>

	<dt>Access Level for <em><?= $dictionary->name ?></em></dt>
	<dd><?= $dictionary->getAccessLevelName($dictionary->access_level) ?></dd>

	<dt>Last logged-in</dt>
	<dd><?= $user->last_logged_in_at ?>

	</dd>
	<dt>Created at</dt>
	<dd><?= $user->created_at ?></dd>

	<dt>Updated at</dt>
	<dd><?= $user->updated_at ?></dd>

</dl>

<a href="<?= site_url('/admin/users/edit/' . $user->id) ?>">Edit</a>

<?= $this->endSection() ?>
