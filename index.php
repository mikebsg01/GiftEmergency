<?php if (!file_exists('system/core.php')) exit("Sorry, has been ocurred an error trying to load the system.");

require_once 'system/core.php';

$plates = [];

function indexController() {
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

indexController();

include_once 'templates/head.php';
include_once 'templates/header.php'; 
?>
<div class="page-index">
  <header>
    <div class="header">
     <section class="row valign-wrapper" style="height:100%; margin-bottom:0px;">
         <article class="col s6 center-align">
             <h1 class="animated fadeInLeft">Una app <br> que regala sonrisas</h1>
             <a class="btn-large red lighten-1 white-text animated fadeInLeft" href="">Encontrar regalo</a>
         </article>
         <article class="col s6 center-align white-text animated zoomIn">
            <h2 class="white-text">Encuentra el regalo ideal en 3 pasos:</h2> 
             <h3 class="white-text">
               <ul>
                   <li>> Contesta una breve encuesta</li>
                   <li>> Agregar el producto a tu carrito</li>
                   <li>> Y pide el regalo a tu domicilio</li>
               </ul> 
             </h3> 
             <h2 class="white-text">Pruebalo, es GRATIS</h2>
         </article>
     </section>
    </div>
  </header>
  
</div>
<?php include_once 'templates/scripts.php' ?>
<script type="text/javascript" src="assets/js/app/index.js?v=<?php echo time() ?>"></script>
<?php include_once 'templates/footer.php' ?>
