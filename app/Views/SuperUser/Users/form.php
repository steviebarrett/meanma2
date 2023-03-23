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

<div class="form-check mb-3">
	<?php if ($user->id == current_user()->id): ?>
			<input class="form-check-input" type="checkbox" checked disabled>

	<?php else: ?>

			<input type="hidden" name="is_superuser" value="0">

			<input class="form-check-input" type="checkbox" id="is_superuser" name="is_superuser" value="1"
	         <?php if(old('is_superuser', $user->is_superuser)): ?>checked<?php endif; ?>>
	<?php endif; ?>
	<label class="form-check-label" for="is_superuser">SuperUser</label>
</div>

<h3>Dictionaries</h3>
<div class="mb-3">
	<div class="row">
		<div class="col-2">Has Access To</div>
		<?php if (count($user->getDictionaries())): ?>
			<div class="col-5">
				<ul class="list-group">
					<?php foreach($user->getDictionaries() as $dictionary): ?>
						<li class="list-group-item">
								<?= $dictionary->name . ' (' . $dictionary->getAccessLevelName() . ')'?>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>
		<?php else: ?>
			<div class="col-5">No dictionaries</div>
		<?php endif; ?>
		</div>
</div>


<div class="mb-3">
	<div class="row">
		<div class="col-2">
			<label class="form-label" for="dictionary_id">Add to dictionary</label>
		</div>
		<div class="col-5">
			<select class="form-select" aria-label="Add to Dictionary" name="dictionary_id" id="dictionary_id">
				<option value="">-no-</option>
				<?php foreach($dictionaries as $dictionary): ?>
					<?php if(in_array($dictionary->id, $user->getDictionaryIds())): ?>
								<?php continue; ?>
					<?php endif; ?>
					<option value="<?= $dictionary->id ?>"><?= $dictionary->name ?></option>
				<?php endforeach; ?>
			</select>
		</div>
		<div class="col-3">

		</div>
	</div>
</div>

<div id="access_level_container" class="mb-3 d-none">
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

<script>
	$(function() {
		$('#dictionary_id').on('change', function() {
      $('#access_level_container').removeClass('d-none');
		});
	});
</script>
