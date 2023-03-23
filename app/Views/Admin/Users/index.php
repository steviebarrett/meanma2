<?= $this->extend('layouts/default') ?>

<?= $this->section('title') ?>User Admin<?= $this->endSection() ?>

<?= $this->section('content') ?>

	<h1><?= current_dictionary()->name ?> Users</h1>

	<a href="<?= site_url('/admin/users/new') ?>">Invite user</a>

<?php if ($users): ?>

	<table class="table table-primary table-striped">
			<thead>
				<tr>
					<th scope="col">First Name</th>
					<th scope="col">Last Name</th>
					<th scope="col">Email</th>
					<th scope="col">Active</th>
					<th scope="col">Last Login</th>
				</tr>
			</thead>
			<tbody>
		  <?php foreach ($users as $user): ?>
					<tr>
						<td><?= $user->firstname ?></td>
						<td><?= $user->lastname ?></td>
						<td>
							<a href="<?= site_url('admin/users/show/' . $user->id) ?>">
				        <?= esc($user->email) ?></a>
							</a>
						</td>
						<td><?= $user->is_active ? 'yes' : 'no' ?></td>
		        <td><?php if($user->last_logged_in_at !== null): ?>
				            <?= $user->last_logged_in_at ?>
									<?php endif; ?>
						</td>
					</tr>
		  <?php endforeach; ?>
			</tbody>
	</table>

	<?= $pager->links('users', 'meanma_full') ?>

<?php else: ?>

	<h2>No users</h2>

<?php endif ?>

<?= $this->endSection() ?>