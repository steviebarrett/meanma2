<?= $this->extend('layouts/dictionary') ?>

<?= $this->section('title') ?>Meanma Home<?= $this->endSection() ?>

<?= $this->section('content') ?>

<h1 class="title mb-3">Welcome to Meanma, <?= current_user()->firstname ?></h1>

<div class="container">

	<h2 class="title mb-3">Dictionaries</h2>

	<a href="<?= site_url('/superuser/dictionaries/new') ?>">New Dictionary</a>

	<table class="table table-primary table-striped">
		<thead>
			<th>Name</th>
			<th>Edit</th>
		</thead>
		<tbody>
		<?php foreach($dictionaries as $dict): ?>
			<tr>
				<td><a href="/dictionary/<?=$dict->id ?>" title="<?= $dict->name ?>">
						<?= $dict->name ?>
					</a></td>
				<td><a href="/superuser/dictionaries/edit/<?= $dict->id ?>">
						<button class="btn btn-light">edit</button></a></td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>

	<?= $pager->links('dictionaries', 'meanma_full') ?>

	<h2 class="title">Users</h2>

	<a href="<?= site_url('/superuser/users/new') ?>">New User</a>

	<table class="table table-primary table-striped">
		<thead>
		<th>Name</th>
		<th>Dictionaries</th>
		<th>Edit</th>
		</thead>
		<tbody>
	<?php foreach($users as $user): ?>
			<tr>
				<td><a href="/superuser/users/show/<?= $user->id ?>">
								<?= $user->firstname . ' ' . $user->lastname ?></a>
				</td>
				<td>
					<?php foreach ($user->getDictionaries() as $dictionary): ?>
						<em><?= $dictionary->name ?></em><br>
					<?php endforeach; ?>
				</td>
				<td><a href="/superuser/users/edit/<?= $user->id ?>">
						<button class="btn btn-light">edit</button></a></td>
			</tr>
	<?php endforeach; ?>
		</tbody>
	</table>

	<?= $pager->links('users', 'meanma_full') ?>

</div>

<?= $this->endSection() ?>


