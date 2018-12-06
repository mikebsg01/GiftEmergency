<?php if (!file_exists(__DIR__.'/../../system/core.php')) exit("Sorry, has been ocurred an error trying to load the system.");

require_once __DIR__.'/../../system/core.php';

$question_slug = null;
$old_answer_data = null;
$stereotypes = [];

function answerValidation($data) {
  $errors = 0;

  # Label validation:
  if (empty($data['content'])) {
    ++$errors;
    makeError('content', 'El campo respuesta es requerido.');
  } else if (strlen($data['content']) > 240) {
    ++$errors;
    makeError('content', 'La respuesta no debe ser mayor a 240 caracteres.');
  } else {
    $result = dbQuery("SELECT count(*) as `counter` FROM `answers` WHERE `answers`.`content` = '{$data['content']}'");

    if (getCounter($result) > 0) {
      ++$errors;

      makeError('content', 'La respuesta ingresada ya existe.');
    }
  }

  App::print($data['stereotypes'], $errors);
  return;

  return ! $errors;
}

function adminCreateAnswerController() {
  global $old_answer_data, $question_slug, $stereotypes;

  if (empty($_GET['question_slug'])) {
    header('Location: ../index.php');
    return;
  }

  $question_slug = $_GET['question_slug'];
  $questionResult = dbQuery("SELECT count(*) as `counter` FROM `questions` WHERE `questions`.`slug` = '{$question_slug}'
                             ORDER BY `questions`.`id` ASC, `questions`.`created_at` ASC
                             LIMIT 1");

  if (getCounter($questionResult) == 0) {
    header('Location: ../index.php');
    return;
  }

  $stereotypesResult = dbQuery("SELECT slug, name FROM stereotypes");

  if ($stereotypesResult->num_rows > 0) {
    while ($row = $stereotypesResult->fetch_assoc()) {
      $stereotypes[] = (object) $row;
    }
  }

  if (!empty($_POST['answer'])) {
    $answer_data = filterData($_POST['answer'], [
      'content',
      'stereotypes'
    ]);

    $old_answer_data = $answer_data;

    if (answerValidation($answer_data)) {
      $answer_data['slug'] = chash($answer_data['content']);

      $answer_saved = dbQuery("INSERT INTO `answers` (`slug`, `label`) 
                                   VALUES ('{$answer_data['slug']}', '{$answer_data['content']}')");

      if ($answer_saved) {
        makeFlash('ALERT_SUCCESS', 'La pregunta se ha creado exitosamente!');
        header('Location: ../index.php');
        return;
      } else {
        makeFlash('ALERT_INFO', 'Lo sentimos, ocurrió un problema en el servidor. Por favor intentelo más tarde.');
      }
    }
  }
}

adminCreateAnswerController();

include_once base('/templates/head.php');
include_once base('/templates/header.php'); 
?>
<div class="page-admin-answer-create row">
  <?php if (existsFlash('ALERT_INFO')): ?>
    <div class="card-panel orange darken-1 alert-info">
      <span class="white-text"><?php echo getFlash('ALERT_INFO'); ?></span>
      <i class="material-icons right app-close-alert">close</i>
    </div>
  <?php endif; ?>
  <section>
    <div class="container">
      <div class="row">
        <div class="col s8 offset-s2">
          <div class="answer-create-card card">
            <div class="card-content">
              <div class="row">
                <div class="col s12">
                  <span class="card-title">Crear Respuesta</span>
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
