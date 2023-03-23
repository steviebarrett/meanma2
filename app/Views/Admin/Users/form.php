<div class="mb-3">
	<label class="form-label" for="firstname">First Name</label>
	<input class="form-control" type="text" id="firstname" name="firstname" value="<?= old('firstname', esc($user->firstname)) ?>">
</div>
<div class="mb-3">
	<label class="form-label" for="lastname">Last Name</label>
	<input class="form-control" type="text" id="lastname" name="lastname" value="<?= old('lastname', esc($user->lastname)) ?>">
</div>
<div class="mb-3">
	<label class="form-label" for="email">Email</label>
	<input class="form-control" type="text" id="email" name="email" value="<?= old('email', esc($user->email)) ?>">
</div>

<?php if($user->id === current_user()->id): ?>
<div class="mb-3">
	<label class="form-label" for="password">Password</label>
	<input class="form-control" type="password" id="password" name="password">
	<?php if ($user->id): ?>
		<p><small>Leave blank to keep existing password</small></p>
	<?php endif; ?>
</div>
<div class="mb-3">
	<label class="form-label" for="password_confirm">Confirm Password</label>
	<input class="form-control" type="password" id="password_confirm" name="password_confirm">
</div>
<?php endif; ?>

<div class="form-check mb-3">
	  <?php if ($user->id == current_user()->id): ?>
				<input class="form-check-input" type="checkbox" checked disabled>

	  <?php else: ?>

				<input type="hidden" name="is_active" value="0">

				<input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1"
		       <?php if(old('is_active', $user->is_active)): ?>checked<?php endif; ?>>
	  <?php endif; ?>
	<label class="form-check-label" for="is_active">Active</label>
</div>

<div class="mb-3">
	<div class="row">
		<div class="col-2">
			<label class="form-label" for="access_level">Access Level</label>
		</div>
		<div class="col-3">
			<select class="form-select" aria-label="Access Level" name="access_level" id="access_level">
				<?php foreach(current_dictionary()->accessLevels as $name => $level): ?>
					<?php if($level > current_dictionary()->access_level): break; endif;?>
					<option value="<?= $level ?>"
		        <?php if($level == current_dictionary($user->id)->access_level): ?>selected<?php endif ?>
					><?= $name ?></option>
				<?php endforeach; ?>
			</select>
		</div>
	</div>
</div>
