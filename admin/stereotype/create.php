<?php if (!file_exists(__DIR__.'/../../system/core.php')) exit("Sorry, has been ocurred an error trying to load the system.");

require_once __DIR__.'/../../system/core.php';

$old_stereotype_data = null;

function stereotypeValidation($data) {
  $errors = 0;

  # Name validation:
  if (empty($data['name'])) {
    ++$errors;
    makeError('name', 'El campo nombre es requerido.');
  } else if (strlen($data['name']) > 45) {
    ++$errors;
    makeError('name', 'El campo nombre no debe ser mayor a 45 caracteres.');
  } else {
    $result = dbQuery("SELECT count(*) as `counter` FROM `stereotypes` WHERE `stereotypes`.`name` = '{$data['name']}'");

    if (getCounter($result) > 0) {
      ++$errors;

      makeError('name', 'El nombre ingresado ya existe.');
    }
  }

  return ! $errors;
}

function adminCreateStereotypeController() {
  global $old_stereotype_data;

  if (!empty($_POST['stereotype'])) {
    $stereotype_data = filterData($_POST['stereotype'], [
      'name'
    ]);

    $old_stereotype_data = $stereotype_data;

    if (stereotypeValidation($stereotype_data)) {
      $stereotype_data['slug'] = chash($stereotype_data['name']);

      $stereotype_saved = dbQuery("INSERT INTO `stereotypes` (`slug`, `name`) 
                                   VALUES ('{$stereotype_data['slug']}', '{$stereotype_data['name']}')");

      if ($stereotype_saved) {
        makeFlash('ALERT_SUCCESS', 'El estereotipo se ha creado exitosamente!');
        header('Location: ../index.php');
        return;
      } else {
        makeFlash('ALERT_INFO', 'Lo sentimos, ocurrió un problema en el servidor. Por favor intentelo más tarde.');
      }
    }
  }
}

adminCreateStereotypeController();

include_once base('/templates/head.php');
include_once base('/templates/header.php'); 
?>
<div class="page-admin-stereotype-create row">
  <?php if (existsFlash('ALERT_INFO')): ?>
    <div class="card-panel orange darken-1 alert-info">
      <span class="white-text"><?php echo getFlash('ALERT_INFO'); ?></span>
      <i class="material-icons right app-close-alert">close</i>
    </div>
  <?php endif; ?>
  <section>
    <div class="container">
      <div class="row">
        <div class="col s6 offset-s3">
          <div class="stereotype-create-card card">
            <div class="card-content">
              <div class="row">
                <div class="col s12">
                  <span class="card-title">Crear Estereotipo</span>
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
