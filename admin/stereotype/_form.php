<?php if ($current_action == 'create'): ?>
  <form action="create.php" method="POST">
<?php elseif ($current_action == 'edit'): ?>
  <form action="edit.php?slug=<?php echo $slug; ?>" method="POST">
<?php endif; ?>
  <div class="input-field col s12">
    <input id="name" type="text" name="stereotype[name]" class="validate" required="required"<?php echo (! is_null($old_stereotype_data) ? " value=\"{$old_stereotype_data['name']}\"" : '') ?>>
    <label for="name">Nombre(s)</label>
    <?php if (existsError('name')): ?>
      <span class="lbl-error"><?php echo getError('name')[0] ?></span>
    <?php endif; ?>
  </div>
  <div class="center-align">
    <?php if ($current_action == 'create'): ?>
      <button type="submit" class="btn btn-primary">Crear</button>
    <?php elseif ($current_action == 'edit'): ?>
      <button type="submit" class="btn btn-primary">Guardar</button>
    <?php endif; ?>
  </div>
</form>