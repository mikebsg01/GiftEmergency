<?php if ($current_action == 'create'): ?>
  <form action="create.php?question_slug=<?php echo $question_slug; ?>" method="POST">
<?php elseif ($current_action == 'edit'): ?>
  <form action="edit.php?slug=<?php echo $slug; ?>" method="POST">
<?php endif; ?>
  <div class="input-field col s12 top-margin-20px bottom-margin-20px">
    <textarea id="content" name="answer[content]" class="materialize-textarea validate" required="required"><?php echo (! is_null($old_answer_data) ? $old_answer_data['content'] : '') ?></textarea>
    <label for="content">Respuesta</label>
    <?php if (existsError('content')): ?>
      <span class="lbl-error"><?php echo getError('content')[0] ?></span>
    <?php endif; ?>
  </div>
  <div class="col s12 bottom-margin-30px">
    <p class="bottom-margin-10px">
      <label>Estereotipos</label>
    </p>
    <?php foreach ($stereotypes as $stereotype): ?>
      <p class="bottom-margin-10px">
        <label>
          <input type="checkbox" name="answer[stereotypes][]" value="<?php echo $stereotype->slug ?>" <?php echo ((! is_null($old_answer_data) and in_array($stereotype->slug, $old_answer_data['stereotypes'])) ? 'checked="checked"' : ''); ?>/>
          <span><?php echo $stereotype->name ?></span>
        </label>
      </p>
    <?php endforeach; ?>
    <?php if (existsError('stereotypes')): ?>
      <span class="lbl-error"><?php echo getError('stereotypes')[0] ?></span>
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