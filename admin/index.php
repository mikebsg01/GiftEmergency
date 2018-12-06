<?php if (!file_exists(__DIR__.'/../system/core.php')) exit("Sorry, has been ocurred an error trying to load the system.");

require_once __DIR__.'/../system/core.php';

$stereotypes = [];
$gifts = [];
$questions = [];

function adminIndexController() {
  global $stereotypes, $gifts, $questions;

  $stereotypesResult = dbQuery("SELECT slug, name FROM stereotypes");

  if ($stereotypesResult->num_rows > 0) {
    while ($row = $stereotypesResult->fetch_assoc()) {
      $stereotypes[] = (object) $row;
    }
  }

  $giftsResult = dbQuery("SELECT g.slug, 
                                 CONCAT(img.file_path, '/', img.file_name, '.', img.file_extension) AS 'image_url', 
                                 g.name, 
                                 s.name AS 'stereotype',
                                 g.gender, 
                                 g.price 
                          FROM gifts AS g
                          INNER JOIN stereotypes AS s ON g.stereotype_id = s.id
                          INNER JOIN images AS img ON g.image_id = img.id");

  if ($giftsResult->num_rows > 0) {
    while ($row = $giftsResult->fetch_assoc()) {
      $gifts[] = (object) $row;
    }
  }

  $questionsResult = dbQuery("SELECT q.id, q.slug, q.label FROM questions AS q");

  if ($questionsResult->num_rows > 0) {
    while ($row = $questionsResult->fetch_assoc()) {
      $questions[] = (object) $row;
    }
  }
}

adminIndexController();

include_once base('/templates/head.php');
include_once base('/templates/header.php'); 
?>
<div class="page-admin-index row">
  <?php if (existsFlash('ALERT_SUCCESS')): ?>
    <div class="card-panel green darken-1 alert-success">
      <span class="white-text"><?php echo getFlash('ALERT_SUCCESS'); ?></span>
      <i class="material-icons right app-close-alert">close</i>
    </div>
  <?php endif; ?>
  <?php if (existsFlash('ALERT_INFO')): ?>
    <div class="card-panel orange darken-1 alert-info">
      <span class="white-text"><?php echo getFlash('ALERT_INFO'); ?></span>
      <i class="material-icons right app-close-alert">close</i>
    </div>
  <?php endif; ?>
  <section>
    <div class="admin-panel container">
      <div class="row">
        <h2 class="font-heebo center-align">Panel de Administración</h2>
        <div class="admin-card card">
          <div class="card-content">
            <span class="card-title">Estereotipos</span>
            <a href="<?php echo url('/admin/stereotype/create.php'); ?>" class="btn-large btn-floating halfway-fab waves-effect waves-light red"><i class="material-icons">add</i></a>
            <div class="row">
              <div class="col s12">
                <table class="striped responsive-table shopping-cart-table">
                  <thead>
                    <tr>
                      <th class="left-align">ID #</th>
                      <th class="left-align">Nombre</th>
                      <th class="right-align">Opciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if (count($stereotypes) > 0): ?>
                      <?php foreach ($stereotypes as $stereotype): ?>
                        <tr>
                          <td class="left-align"><?php echo strLimit($stereotype->slug, 7); ?></td>
                          <td class="left-align"><?php echo $stereotype->name; ?></td>
                          <td class="right-align">
                            <a href="stereotype/edit.php?slug=<?php echo $stereotype->slug; ?>" class="btn blue darken-1 waves-effect waves-light white-text"><i class="material-icons">edit</i></a>
                            <form action="stereotype/delete.php" method="POST" class="inline-block">
                              <input type="hidden" name="_method" value="DELETE">
                              <input type="hidden" name="slug" value="<?php echo $stereotype->slug; ?>">
                              <button type="submit" class="app-confirm-operation btn red darken-1 waves-effect waves-light"><i class="material-icons">delete</i></button>
                            </form>
                          </td>
                        </tr>
                      <?php endforeach; ?>
                    <?php else: ?>
                      <tr>
                        <td colspan="3" class="center-align"><span>&laquo; No hay estereotipos todavía. &raquo;</span></td>
                      </tr>
                    <?php endif; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="admin-card card">
          <div class="card-content">
            <span class="card-title">Regalos</span>
            <a href="<?php echo url('/admin/gift/create.php'); ?>" class="btn-large btn-floating halfway-fab waves-effect waves-light red"><i class="material-icons">add</i></a>
            <div class="row">
              <div class="col s12">
                <table class="striped responsive-table shopping-cart-table">
                  <thead>
                    <tr>
                      <th class="left-align">ID #</th>
                      <th class="center-align">Imagen</th>
                      <th class="left-align">Nombre</th>
                      <th class="left-align">Estereotipo</th>
                      <th class="left-align">Género</th>
                      <th class="center-align">Precio</th>
                      <th class="right-align">Opciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if (count($gifts) > 0): ?>
                      <?php foreach ($gifts as $gift): ?>
                        <tr>
                            <td class="left-align"><?php echo strLimit($gift->slug, 7) ?></td>
                            <td class="center-align"><img class="gift-icon circle responsive-img" src="<?php echo url($gift->image_url); ?>"></td>
                            <td class="left-align"><?php echo $gift->name ?></td>
                            <td class="left-align"><?php echo $gift->stereotype ?></td>
                            <td class="left-align"><?php echo (($gift->gender) ? 'Hombre' : 'Mujer') ?></td>
                            <td class="right-align"><?php echo toMoney($gift->price) ?></td>
                            <td class="right-align">
                              <a href="gift/edit.php?slug=<?php echo $gift->slug; ?>" class="btn blue darken-1 waves-effect waves-light white-text"><i class="material-icons">edit</i></a>
                              <form action="gift/delete.php" method="POST" class="inline-block">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="slug" value="<?php echo $gift->slug; ?>">
                                <button type="submit" class="app-confirm-operation btn red darken-1 waves-effect waves-light"><i class="material-icons">delete</i></button>
                              </form>
                            </td>
                        </tr>
                      <?php endforeach; ?>
                    <?php else: ?>
                      <tr>
                        <td colspan="7" class="center-align"><span>&laquo; No hay regalos todavía. &raquo;</span></td>
                      </tr>
                    <?php endif; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="admin-card card">
          <div class="card-content">
            <span class="card-title">Preguntas</span>
            <a href="<?php echo url('/admin/question/create.php'); ?>" class="btn-large btn-floating halfway-fab waves-effect waves-light red"><i class="material-icons">add</i></a>
            <div class="row">
              <div class="col s12">
                <table class="striped responsive-table shopping-cart-table">
                  <thead>
                    <tr>
                      <th class="left-align">ID #</th>
                      <th colspan="3" class="left-align">Pregunta</th>
                      <th class="right-align">Opciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if (count($questions) > 0): ?>
                      <?php foreach ($questions as $question): ?>
                        <tr>
                          <td class="left-align"><?php echo strLimit($question->slug, 7); ?></td>
                          <td colspan="3" class="left-align"><?php echo $question->label; ?></td>
                          <td class="right-align">
                            <a href="question/edit.php?slug=<?php echo $question->slug; ?>" class="btn blue darken-1 waves-effect waves-light white-text"><i class="material-icons">edit</i></a>
                            <form action="question/delete.php" method="POST" class="inline-block">
                              <input type="hidden" name="_method" value="DELETE">
                              <input type="hidden" name="slug" value="<?php echo $question->slug; ?>">
                              <button type="submit" class="app-confirm-operation btn red darken-1 waves-effect waves-light"><i class="material-icons">delete</i></button>
                            </form>
                          </td>
                        </tr>
                        <?php
                          $answers = getAnswersByQuestionId($question->id);
                        ?>
                        <?php if (count($answers) > 0): ?>
                          <tr>
                            <th>&nbsp;</th>
                            <th colspan="4" class="center-align">RESPUESTAS</th>
                          </tr>
                          <tr>
                            <th>&nbsp;</th>
                            <th class="left-align">ID #</th>
                            <th class="left-align">Respuesta</th>
                            <th class="left-align">Estereotipos</th>
                            <th class="right-align">Opciones</th>
                          </tr>
                        <?php endif; ?>
                        <?php foreach ($answers as $answer): ?>
                          <?php
                            $stereotypes = getStereotypesByAnswerId($answer->id);
                            
                            $stereotype_names = array_map(function($element) {
                              return $element->name;
                            }, $stereotypes);
                          ?>
                          <tr>
                            <td>&nbsp;</td>
                            <td class="left-align"><?php echo strLimit($answer->slug, 7); ?></td>
                            <td class="left-align"><?php echo $answer->content; ?></td>
                            <td class="left-align">
                              <?php if (count($stereotype_names) > 0): ?>
                              <ul>
                                <?php foreach($stereotype_names as $stereotype_name): ?>
                                  <li style="list-style: initial;"><?php echo $stereotype_name; ?></li>  
                                <?php endforeach; ?>
                              </ul>
                              <?php endif; ?>
                            </td>
                            <td class="right-align">&nbsp;</td>
                          </tr>
                        <?php endforeach; ?>
                        <tr>
                          <td colspan="5" class="center-align">
                            <a href="<?php echo url("/admin/answer/create.php?question_slug={$question->slug}"); ?>" class="btn halfway-fab waves-effect waves-light red white-text"><i class="material-icons left">add</i> Respuesta</a>
                          </td>
                        </tr>
                      <?php endforeach; ?>
                    <?php else: ?>
                      <tr>
                        <td colspan="5" class="center-align"><span>&laquo; No hay preguntas todavía. &raquo;</span></td>
                      </tr>
                    <?php endif; ?>
                  </tbody>
                </table>
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
