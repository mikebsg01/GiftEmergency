<?php if (!file_exists(__DIR__.'/../system/core.php')) exit("Sorry, has been ocurred an error trying to load the system.");

require_once __DIR__.'/../system/core.php';

$stereotypes = [];

function adminIndexController() {
  global $stereotypes;

  $stereotypesResult = dbQuery("SELECT slug, name FROM stereotypes");

  if ($stereotypesResult->num_rows > 0) {
    while ($row = $stereotypesResult->fetch_assoc()) {
      $stereotypes[] = (object) $row;
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
                <table class="striped shopping-cart-table">
                  <thead>
                    <tr>
                      <th class="left-align">ID #</th>
                      <th class="left-align">Nombre</th>
                      <th class="center-align">Opciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if (count($stereotypes) > 0): ?>
                      <?php foreach ($stereotypes as $stereotype): ?>
                        <tr>
                          <td class="left-align"><?php echo $stereotype->slug; ?></td>
                          <td class="left-align"><?php echo $stereotype->name; ?></td>
                          <td class="center-align">
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
            <a class="btn-large btn-floating halfway-fab waves-effect waves-light red"><i class="material-icons">add</i></a>
            <div class="row">
              <div class="col s12">
                <table class="striped shopping-cart-table">
                  <thead>
                    <tr>
                      <th class="center-align">ID #</th>
                      <th class="center-align">Imagen</th>
                      <th class="left-align">Nombre</th>
                      <th class="left-align">Estereotipo</th>
                      <th class="left-align">Género</th>
                      <th class="right-align">Precio</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td colspan="6" class="center-align"><span>&laquo; No hay regalos todavía. &raquo;</span></td>
                    </tr>
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
