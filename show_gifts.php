<?php if (!file_exists('system/core.php')) exit("Sorry, has been ocurred an error trying to load the system.");

require_once 'system/core.php';

$plates = [];

function showGiftsController() {
  global $plates;

  $result = dbQuery("SELECT * FROM `plates` 
                     WHERE 1 
                     ORDER BY created_at ASC 
                     LIMIT 6");

  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $plates[] = (object) $row;
    }
  }
}

showGiftsController();

include_once 'templates/head.php';
include_once 'templates/header.php'; 
?>
<section class="container">
  <!-- barra de selectores de genero estereotipo y busqueda -->
  <article class="row" style="margin:1rem;">
    <div class="col s4">
      <div class="input-field col s12">
        <select>
          <option value="" disabled selected>Selecciona una opcion</option>
          <option value="1">Hombre</option>
          <option value="2">Mujer</option>
        </select>
        <label>Genero</label>
      </div>
    </div>
    <div class="col s4">
      <div class="input-field col s12">
        <select>
          <option value="" disabled selected>Selecciona una opcion</option>
          <option value="1">Hombre</option>
          <option value="2">Mujer</option>
        </select>
        <label>Estereotipo</label>
      </div>
    </div>
    <div class="col s4">
      <div class="input-field col s12">
        <input id="last_name" type="text" class="validate">
        <label for="last_name">Buscar</label>
      </div>
    </div>
  </article>
  <!-- Comienza Area de todos los regalos -->
  <article class="row">
    <div class="col s12 m4 l4">
      <div class="row">
        <div class="col s12 m12">
          <div class="card">
            <div class="card-image">
              <img class="" src="<?php echo url('assets/img/logo-navbar-gift.svg'); ?>" style="height:100px;">
              <span class="card-title">Card Title</span>
            <div>
            <div class="card-content">
              <p>I am a very simple card. I am good at containing small bits of information.
              I am convenient because I require little markup to use effectively.</p>
            </div>
            <div class="card-action">
              <a href="#">AGREGAR AL CARRITO</a>
            </div>
          </div>
        </div>
      </div>
    </div>   
    <div class="col s12 m4 l4">
      <div class="row">
        <div class="col s12 m12">
          <div class="card">
            <div class="card-image">
              <img class="" src="<?php echo url('assets/img/logo-navbar-gift.svg'); ?>" style="height:100px;">
              <span class="card-title">Card Title</span>
            </div>
            <div class="card-content">
              <p>I am a very simple card. I am good at containing small bits of information.
              I am convenient because I require little markup to use effectively.</p>
            </div>
            <div class="card-action">
              <a href="#">This is a link</a>
            </div>
          </div>
        </div>    
      </div>
    </div>
    <div class="col s12 m4 l4">
      <div class="row">
        <div class="col s12 m12">
          <div class="card">
            <div class="card-image">
              <img class="" src="<?php echo url('assets/img/logo-navbar-gift.svg'); ?>" style="height:100px;">
              <span class="card-title">Card Title</span>
            </div>
            <div class="card-content">
              <p>I am a very simple card. I am good at containing small bits of information.
              I am convenient because I require little markup to use effectively.</p>
            </div>
            <div class="card-action">
              <a href="#">This is a link</a>
            </div>
          </div>
        </div>
      </div>
    </div> 
  </article>
</section>
<?php include_once 'templates/scripts.php' ?>
<script type="text/javascript" src="assets/js/app/index.js?v=<?php echo time() ?>"></script>
<?php include_once 'templates/footer.php' ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>