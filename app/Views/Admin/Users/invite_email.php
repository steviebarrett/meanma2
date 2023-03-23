<h1>Addition to <?= $dictionary->name ?></h1>

<p>Dear <?= $user->firstname ?>,</p>

<p>You have been invited to join the <?= $dictionary->name ?> dictionary on Meanma.</p>

<?php if($token !== null): ?>
	<p>An account has been created for you. Please set your password using this link: <a href="<?= site_url("/password/reset/$token") ?>">Reset password</a> </p>
<?php endif; ?>


