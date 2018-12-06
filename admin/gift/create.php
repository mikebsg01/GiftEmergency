<?php if (!file_exists(__DIR__.'/../../system/core.php')) exit("Sorry, has been ocurred an error trying to load the system.");

require_once __DIR__.'/../../system/core.php';

$old_gift_data = null;
$stereotypes = [];

function giftValidation($data) {
  $errors = 0;

  # Name validation:
  if (empty($data['name'])) {
    ++$errors;
    makeError('name', 'El campo nombre es requerido.');
  } else if (strlen($data['name']) > 45) {
    ++$errors;
    makeError('name', 'El campo nombre no debe ser mayor a 45 caracteres.');
  } else {
    $result = dbQuery("SELECT count(*) as `counter` FROM `gifts` WHERE `gifts`.`name` = '{$data['name']}'");

    if (getCounter($result) > 0) {
      ++$errors;

      makeError('name', 'El nombre ingresado ya existe.');
    }
  }

  # Stereotype Validation
  if (empty($data['stereotype'])) {
    ++$errors;
    makeError('stereotype', 'El campo estereotipo es requerido.');
  } else {
    $result = dbQuery("SELECT count(*) as `counter` FROM `stereotypes`
                       WHERE `stereotypes`.`slug` = '{$data['stereotype']}'
                       ORDER BY `stereotypes`.`id` ASC, `stereotypes`.`created_at` ASC
                       LIMIT 1");

    if (getCounter($result) == 0) {
      ++$errors;

      makeError('stereotype', 'El estereotipo ingresado no existe.');
    }
  }

  # Gender Validation
  if (! isset($data['gender'])) {
    ++$errors;
    makeError('gender', 'El campo género es requerido.');
  } else if (! ($data['gender'] == 0 or $data['gender'] == 1)) {
    makeError('gender', 'El género ingresado no existe.');
  }

  # Price Validation
  if (empty($data['price'])) {
    ++$errors;
    makeError('price', 'El campo precio es requerido.');
  } else if (! is_numeric($data['price'])) {
    makeError('price', 'El precio debe ser de tipo numérico.');
  } else {
    $price = (float) $data['price'];

    if ($price < 0.00 or $price > 999999.99) {
      makeError('price', 'El precio debe tener un valor entre 0.00 y 999999.99.');
    }
  }

  return ! $errors;
}

function adminCreateGiftController() {
  global $old_gift_data, $stereotypes;

  $stereotypesResult = dbQuery("SELECT slug, name FROM stereotypes");

  if ($stereotypesResult->num_rows > 0) {
    while ($row = $stereotypesResult->fetch_assoc()) {
      $stereotypes[] = (object) $row;
    }
  }

  if (!empty($_POST['gift'])) {
    $gift_data = filterData($_POST['gift'], [
      'name',
      'stereotype',
      'gender',
      'price'
    ]);

    $old_gift_data = $gift_data;

    if (giftValidation($gift_data)) {
      $gift_data['slug'] = chash($gift_data['name']);
      $gift_saved = false;

      try {
        $getStereotype = dbQuery("SELECT `id` FROM `stereotypes`
                                  WHERE `stereotypes`.`slug` = '{$gift_data['stereotype']}'
                                  ORDER BY `stereotypes`.`id` ASC, `stereotypes`.`created_at` ASC
                                  LIMIT 1");

        $stereotype = $getStereotype->fetch_assoc();
        $gift_data['stereotype_id'] = (int) $stereotype['id'];

        $gift_saved = dbQuery("INSERT INTO `gifts` (`slug`, `name`, `stereotype_id`, `gender`, `price`, `image_id`) 
                              VALUES ('{$gift_data['slug']}', '{$gift_data['name']}', {$gift_data['stereotype_id']}, {$gift_data['gender']}, '{$gift_data['price']}', 2)");
      } catch (Exception $e) {}

      if ($gift_saved) {

        if (! empty($_FILES['gift_image']) and ! empty($_FILES['gift_image']['name'])) {
          $gift_image = $_FILES['gift_image'];
          $file_info = pathinfo($gift_image['name']);
          $file_extension = $file_info['extension'];

          if (preg_match('/(gif|png|jpg|jpeg)/', $file_extension)) {
            $slug         = slugify($gift_data['name']);
            $file_name    = "gift-{$slug}";
            $file_path    = "/public/gifts/img";
            $destination  = situate("{$file_path}/{$file_name}.{$file_extension}");
            move_uploaded_file($gift_image['tmp_name'], $destination);

            $image_id = dbQuery("INSERT INTO `images` (`file_path`, `file_name`, `file_extension`)
                                 VALUES ('{$file_path}', '{$file_name}', '{$file_extension}')", true);
            
            if (is_int($image_id) and $image_id >= 1) {
              $gift_updated = dbQuery("UPDATE `gifts` SET `gifts`.`image_id` = {$image_id}
                                       WHERE `gifts`.`slug` = '{$gift_data['slug']}'");
            }
          }
        }

        makeFlash('ALERT_SUCCESS', 'El regalo se ha creado exitosamente!');
        header('Location: ../index.php');
        return;
      } else {
        makeFlash('ALERT_INFO', 'Lo sentimos, ocurrió un problema en el servidor. Por favor intentelo más tarde.');
      }
    }
  }
}

adminCreateGiftController();

include_once base('/templates/head.php');
include_once base('/templates/header.php'); 
?>
<div class="page-admin-gift-create row">
  <?php if (existsFlash('ALERT_INFO')): ?>
    <div class="card-panel orange darken-1 alert-info">
      <span class="white-text"><?php echo getFlash('ALERT_INFO'); ?></span>
      <i class="material-icons right app-close-alert">close</i>
    </div>
  <?php endif; ?>
  <section>
    <div class="container">
      <div class="row">
        <div class="col s12">
          <div class="gift-create-card card">
            <div class="card-content">
              <div class="row">
                <div class="col s12">
                  <span class="card-title">Crear Regalo</span>
                </div>
                <div class="col s12">
                  <?php include '_form.php'; ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<?php include_once base('/templates/scripts.php'); ?>
<script type="text/javascript" src="<?php echo url('assets/js/app/index.js?v='.time()); ?>"></script>
<?php include_once base('/templates/footer.php'); ?>
