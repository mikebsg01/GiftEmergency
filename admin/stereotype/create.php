<?php if (!file_exists(__DIR__.'/../../system/core.php')) exit("Sorry, has been ocurred an error trying to load the system.");

require_once __DIR__.'/../../system/core.php';

function adminIndexController() {

}

adminIndexController();

include_once base('/templates/head.php');
include_once base('/templates/header.php'); 
?>
<div class="page-admin-stereotype-create row">
  <section>
    <div class="container">
      <div class="row">
        <div class="col s8 offset-s2">
          <div class="stereotype-create-card card">
            <div class="card-content">
              <span class="card-title">Crear Estereotipo</span>
              <form action="#" method="POST">
                <input type="text" value="hola">
              </form>
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
