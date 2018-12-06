<?php if (!file_exists('system/core.php')) exit("Sorry, has been ocurred an error trying to load the system.");

require_once 'system/core.php';

function questionController() {
  if (! isLoggued()) {
    header('Location: login.php');
    return;
  }

}

questionController();

include_once 'templates/head.php';
include_once 'templates/header.php';
?>
<div class="row">
  <?php if (existsFlash('ALERT_INFO')): ?>
    <div class="card-panel orange darken-1 alert-info">
      <span class="white-text"><?php echo getFlash('ALERT_INFO'); ?></span>
      <i class="material-icons right app-close-alert">close</i>
    </div>
  <?php endif; ?>
  <div class="col s12">
    <div class="col offset-s3 s6">
      <div class="card">
        <div class=" page-questions card-content ">
          <div class="row">
            <div class="col s12">
              <span class="card-title">¿Qué genero de música te gusta más?...</span>
            </div>
            <div class="card-content">
              <form action="quetions.php">
                <p>
                  <label class="center">
                    <input name="group1" type="radio" />
                    <span>Rock</span>
                  </label>
                </p>
                <p>
                  <label class="center">
                    <input name="group1" type="radio" />
                    <span>Pop</span>
                  </label>
                </p>
                <p>
                  <label class="center">
                    <input name="group1" type="radio" />
                    <span>Indie / aunque no sea Música...</span>
                  </label>
                </p>
                <p>
                  <label class="center">
                    <input name="group1" type="radio" />
                    <span>Reggaeton</span>
                  </label>
                </p>
              </form>
            </div>
            <div class="card-action right-align">
              <a href="question.php">
                <button class="btn btn-primary btn-large waves-effect waves-light">
                  Continuar <i class="material-icons right">send</i>
                </button>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include_once 'templates/scripts.php' ?>
<?php include_once 'templates/footer.php' ?>