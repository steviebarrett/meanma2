<?= $this->extend('layouts/default') ?>

<?= $this->section('title') ?>User<?= $this->endSection() ?>

<?= $this->section('content') ?>

<h1>User</h1>

<a href="<?= site_url('/') ?>">&laquo; Users</a>

<dl>
	<dt>Name</dt>
	<dd><?= $user->firstname . ' ' . $user->lastname ?></dd>

	<dt>Email</dt>
	<dd><?= esc($user->email) ?></dd>

	<dt>Active</dt>
	<dd><?= $user->is_active ? 'yes' : 'no' ?></dd>

	<dt>Is SuperUser</dt>
	<dd><?= $user->is_superuser ? 'yes' :  'no' ?></dd>

	<dt>Dictionaries</dt>
	<dd>
		<?php if(count($dictionaries) > 0): ?>
			<ul class="list-group">
				<?php foreach($dictionaries as $dictionary):?>
					<li class="list-group-item list-group-item-action w-50">
							<a href="/dictionary/<?= $dictionary->id ?>" title="<?=  $dictionary->name ?>">
				        <?=  $dictionary->name ?>
							</a></li>
				<?php endforeach; ?>
			</ul>
		<?php else: ?>
			None
		<?php endif; ?>
	</dd>

	<dt>Last logged-in</dt>
	<dd><?= $user->last_logged_in_at ?>

	<dt>Created at</dt>
	<dd><?= $user->created_at ?></dd>

	<dt>Updated at</dt>
	<dd><?= $user->updated_at ?></dd>

</dl>

<a href="<?= site_url('/superuser/users/edit/' . $user->id) ?>">Edit</a>

<?= $this->endSection() ?>
