<?php if ($current_action == 'create'): ?>
  <form enctype="multipart/form-data" action="create.php" method="POST">
<?php elseif ($current_action == 'edit'): ?>
  <form enctype="multipart/form-data" action="edit.php?slug=<?php echo $slug; ?>" method="POST">
<?php endif; ?>
  <div class="col s12 top-margin-20px">
    <div class="col s6">
      <div class="input-field col s12 bottom-margin-20px">
        <input id="name" type="text" name="gift[name]" class="validate" required="required"<?php echo (! is_null($old_gift_data) ? " value=\"{$old_gift_data['name']}\"" : '') ?>>
        <label for="name">Nombre(s)</label>
        <?php if (existsError('name')): ?>
          <span class="lbl-error"><?php echo getError('name')[0] ?></span>
        <?php endif; ?>
      </div>
      <div class="input-field col s12 bottom-margin-20px">
        <select id="stereotype" name="gift[stereotype]" required="required">
          <option value="" disabled selected>Elige un estereotipo...</option>
          <?php foreach ($stereotypes as $stereotype): ?>
            <option value="<?php echo $stereotype->slug ?>" <?php echo ((! is_null($old_gift_data) and $old_gift_data['stereotype'] == $stereotype->slug) ? 'selected="selected"' : ''); ?>><?php echo $stereotype->name ?></option>
          <?php endforeach; ?>
        </select>
        <label for="stereotype">Estereotipo</label>
        <?php if (existsError('stereotype')): ?>
          <span class="lbl-error"><?php echo getError('stereotype')[0] ?></span>
        <?php endif; ?>
      </div>
      <div class="col s12 bottom-margin-20px">
        <p class="bottom-margin-10px">
          <label>Género</label>
        </p>
        <p>
          <label>
            <input name="gift[gender]" type="radio" class="with-gap" value="1" required="required" <?php echo ((! is_null($old_gift_data) and $old_gift_data['gender'] == 1) ? 'checked="checked"' : ''); ?>/>
            <span>Hombre</span>
          </label>
        </p>
        <p class="bottom-margin-10px">
          <label>
            <input name="gift[gender]" type="radio" class="with-gap" value="0" required="required" <?php echo ((! is_null($old_gift_data) and $old_gift_data['gender'] == 0) ? 'checked="checked"' : ''); ?>/>
            <span>Mujer</span>
          </label>
        </p>
        <?php if (existsError('gender')): ?>
          <span class="lbl-error"><?php echo getError('gender')[0] ?></span>
        <?php endif; ?>
      </div>
      <div class="input-field col s12">
        <i class="material-icons prefix">attach_money</i>
        <input id="price" type="number" name="gift[price]" min="0.00" step="0.01" max="999999.99" class="validate right-align" value="<?php echo (! is_null($old_gift_data) ? $old_gift_data['price'] : '0.00') ?>" required="required">
        <label for="price">Precio</label>
        <?php if (existsError('price')): ?>
          <span class="lbl-error"><?php echo getError('price')[0] ?></span>
        <?php endif; ?>
      </div>
    </div>
    <div class="col s6">
      <div class="center-align bottom-margin-20px">
        <img id="gift-image" class="gift-image circle responsive-img" src="<?php echo ((! is_null($old_gift_data) and ! empty($old_gift_data['image_url'])) ? url($old_gift_data['image_url']) : url('public/gifts/img/img_default.png')); ?>">
      </div>
      <div class="file-field input-field col s12">
        <div class="btn btn-primary">
          <span>Subir Imagen</span>
          <input data-image="#gift-image" data-image-default="<?php echo url('public/gifts/img/img_default.png'); ?>" type="file" name="gift_image" class="app-field-upload">
        </div>
        <div class="file-path-wrapper">
          <input class="file-path validate" type="text" placeholder="archivo png / jpg...">
        </div>
      </div>
    </div>
    <div class="col s12">
      <div class="center-align top-margin-30px">
        <?php if ($current_action == 'create'): ?>
          <button type="submit" class="btn btn-primary btn-large">Crear<i class="material-icons right">check</i></button>
        <?php elseif ($current_action == 'edit'): ?>
          <button type="submit" class="btn btn-primary btn-large">Guardar<i class="material-icons right">check</i></button>
        <?php endif; ?>
      </div>
    </div>
  </div>
</form>