<?php if ($current_action == 'create'): ?>
  <form action="create.php" method="POST">
<?php elseif ($current_action == 'edit'): ?>
  <form action="edit.php?slug=<?php echo $slug; ?>" method="POST">
<?php endif; ?>
  <div class="input-field col s12 top-margin-20px bottom-margin-20px">
    <textarea id="label" name="question[label]" class="materialize-textarea validate" required="required"><?php echo (! is_null($old_question_data) ? $old_question_data['label'] : '') ?></textarea>
    <label for="label">Pregunta</label>
    <?php if (existsError('label')): ?>
      <span class="lbl-error"><?php echo getError('label')[0] ?></span>
    <?php endif; ?>
  </div>
  <div class="center-align">
    <?php if ($current_action == 'create'): ?>
      <button type="submit" class="btn btn-primary">Crear<i class="material-icons right">check</i></button>
    <?php elseif ($current_action == 'edit'): ?>
      <button type="submit" class="btn btn-primary">Guardar<i class="material-icons right">check</i></button>
    <?php endif; ?>
  </div>
</form>