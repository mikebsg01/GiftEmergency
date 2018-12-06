<?php if (!file_exists(__DIR__.'/../../system/core.php')) exit("Sorry, has been ocurred an error trying to load the system.");

require_once __DIR__.'/../../system/core.php';

$slug = null;
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

function adminEditQuestionController() {
  global $old_question_data, $slug;

  if (empty($_GET['slug'])) {
    header('Location: ../index.php');
    return;
  }
  
  $slug = $_GET['slug'];
  $questionResult = dbQuery("SELECT label FROM `questions` WHERE `questions`.`slug` = '{$slug}'");

  if ($questionResult->num_rows == 0) {
    header('Location: ../index.php');
    return;
  }
    
  $old_question_data = $questionResult->fetch_assoc();

  if (!empty($_POST['question'])) {
    $question_data = filterData($_POST['question'], [
      'label'
    ]);

    $old_question_data = $question_data;

    if (questionValidation($question_data)) {
      $question_saved = dbQuery("UPDATE `questions` SET `questions`.`label` = '{$question_data['label']}'
                                 WHERE `questions`.`slug` = '{$slug}'");

      if ($question_saved) {
        makeFlash('ALERT_SUCCESS', 'La pregunta ha sido editada exitosamente!');
        header('Location: ../index.php');
        return;
      } else {
        makeFlash('ALERT_INFO', 'Lo sentimos, ocurrió un problema en el servidor. Por favor intentelo más tarde.');
      }
    }
  }
}

adminEditQuestionController();

include_once base('/templates/head.php');
include_once base('/templates/header.php'); 
?>
<div class="page-admin-question-edit row">
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
          <div class="question-edit-card card">
            <div class="card-content">
              <div class="row">
                <div class="col s12">
                  <span class="card-title">Editar Estereotipo</span>
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
