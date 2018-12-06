<?php if (!file_exists(__DIR__.'/../../system/core.php')) exit("Sorry, has been ocurred an error trying to load the system.");

require_once __DIR__.'/../../system/core.php';

$old_question_data = null;

function questionValidation($data) {
  $errors = 0;

  # Label validation:
  if (empty($data['label'])) {
    ++$errors;
    makeError('label', 'El campo pregunta es requerido.');
  } else if (strlen($data['label']) > 240) {
    ++$errors;
    makeError('label', 'La pregunta no debe ser mayor a 240 caracteres.');
  } else {
    $result = dbQuery("SELECT count(*) as `counter` FROM `questions` WHERE `questions`.`label` = '{$data['label']}'");

    if (getCounter($result) > 0) {
      ++$errors;

      makeError('label', 'La pregunta ingresada ya existe.');
    }
  }

  return ! $errors;
}

function adminCreateQuestionController() {
  global $old_question_data;

  if (!empty($_POST['question'])) {
    $question_data = filterData($_POST['question'], [
      'label'
    ]);

    $old_question_data = $question_data;

    if (questionValidation($question_data)) {
      $question_data['slug'] = chash($question_data['label']);

      $question_saved = dbQuery("INSERT INTO `questions` (`slug`, `label`) 
                                   VALUES ('{$question_data['slug']}', '{$question_data['label']}')");

      if ($question_saved) {
        makeFlash('ALERT_SUCCESS', 'La pregunta se ha creado exitosamente!');
        header('Location: ../index.php');
        return;
      } else {
        makeFlash('ALERT_INFO', 'Lo sentimos, ocurrió un problema en el servidor. Por favor intentelo más tarde.');
      }
    }
  }
}

adminCreateQuestionController();

include_once base('/templates/head.php');
include_once base('/templates/header.php'); 
?>
<div class="page-admin-question-create row">
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
          <div class="question-create-card card">
            <div class="card-content">
              <div class="row">
                <div class="col s12">
                  <span class="card-title">Crear Pregunta</span>
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
