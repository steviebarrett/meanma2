<?= $this->extend('layouts/dictionary') ?>

<?= $this->section('title') ?>Meanma Home<?= $this->endSection() ?>

<?= $this->section('content') ?>

	<h1 class="title">Welcome to Meanma, <?= current_user()->firstname ?></h1>

	<div class="container">

		<h2 class="title">Dictionaries</h2>
			<table class="table">
					<thead>
						<th>Name</th>
						<th>Role</th>
					</thead>
					<tbody>
						<?php foreach(current_user()->getDictionaries() as $dict): ?>
							<tr>
								<td><a class="dict" data-id="<?= $dict->id ?>" href="/dictionary/<?=$dict->id ?>"
								       title="<?= $dict->name ?>">
										<?= $dict->name ?>
									</a></td>
								<td><?= $dict->getAccessLevelName() ?></td>
							</tr>
						<?php endforeach; ?>
					</tbody>
			</table>
	</div>

<?= $this->endSection() ?>


