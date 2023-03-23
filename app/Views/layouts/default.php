<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/html">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?= $this->renderSection('title') ?></title>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>

</head>

<body>

	<div class="container-fluid container-fluid h-100 d-flex flex-column">

		<nav class="navbar navbar-dark navbar-expand-lg" style="background-color: #007bff">
			<div class="container-fluid">
				<a class="navbar-brand" href="/">MEANⓂ️A</a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav me-auto mb-2 mb-lg-0">

						<?= $this->renderSection('nav-links') ?>

				  <?php if (current_user()): ?>

				    <?php if (current_dictionary() !== null): ?>
					    <?php if(current_dictionary()->hasRequiredAccessLevel('admin')): ?>
						    <li class="nav-item">
							    <a class="nav-link" href="/admin">admin</a>
						    </li>
					    <?php endif; ?>
				    <?php endif; ?>
					  <li class="nav-item">
						  <a class="nav-link" href="/logout">logout</a>
					  </li>
				  <?php endif; ?>

					</ul>
				<?php if (current_user()): ?>
					<span class="navbar-text">
						Logged-in as <?= esc(current_user()->firstname) ?>
					</span>
				<?php endif; ?>

				</div>
			</div>
		</nav>

		<?php if (current_user() && current_user()->is_superuser): ?>
			<div class="position-relative alert alert-info">
				<div class="position-absolute top-50 start-50 translate-middle">superuser</div>
			</div>
		<?php endif; ?>

		<?php if (session()->has('warning')): ?>
			<div class="alert alert-primary alert-dismissible" role="alert">
				<?= session('warning') ?>
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
			</div>
		<?php endif; ?>

		<?php if (session()->has('info')): ?>
			<div class="alert alert-warning alert-dismissible" role="alert">
				<?= session('info') ?>
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
			</div>
		<?php endif; ?>

		<?php if (session()->has('error')): ?>
			<div class="alert alert-danger alert-dismissible" role="alert">
				<?= session('error') ?>
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
			</div>
		<?php endif; ?>

			<section>
				<?= $this->renderSection('content') ?>
			</section>

	</div> <!-- end container -->

</body>

</html>