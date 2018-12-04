<?php if (!file_exists(__DIR__.'/../system/core.php')) exit("Sorry, has been ocurred an error trying to load the system.");

require_once __DIR__.'/../system/core.php';

function adminIndexController() {

}

adminIndexController();

include_once base('/templates/head.php');
include_once base('/templates/header.php'); 
?>
<div class="page-admin-index row">
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
                      <th class="center-align">ID #</th>
                      <th class="left-align">Nombre</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td colspan="2" class="center-align"><span>&laquo; No hay estereotipos todavía. &raquo;</span></td>
                    </tr>
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
