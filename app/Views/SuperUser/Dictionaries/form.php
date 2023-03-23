<div class="mb-3">
	<label class="form-label" for="name">Name</label>
	<input class="form-control" type="text" id="name" name="name" value="<?= old('name', esc($dictionary->name)) ?>">
</div>
<div class="mb-3">
	<label class="form-label" for="short_name">Short Name</label>
	<input class="form-control" type="text" id="short_name" name="short_name" value="<?= old('short_name', esc($dictionary->short_name)) ?>">
</div>
