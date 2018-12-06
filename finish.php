<?php if (!file_exists('system/core.php')) exit("Sorry, has been ocurred an error trying to load the system.");

require_once 'system/core.php';

function finishController() {

}

finishController();

include_once 'templates/head.php';
include_once 'templates/header.php'; 
?>
<section>
    <article class="row">
        <div class="col s12 m12 l9 push-l1 offset-s0 animated bounceInDown" style="margin:3rem;">
            <div class="card-panel">
                <div class="row">
                    <div class="col s6">
                        <img src="<?php echo url('assets/img/logo-navbar-gift.svg'); ?>" alt="">
                    </div>
                    <div class="col s6">
                    <h1 class="center-align animated jackInTheBox delay-1s">Enhorabuena!</h1>
                    <div class="container">
                        <h2 class="center-align  animated jackInTheBox delay-1s">El regalo ideal para tu persona ideal</h2>
                        <h3 class="font-heebo center-align">Precio</h3>
                        <div class="center-align">
                            <h4 class="font-heebo">$3000</h4>
                        </div>
                        <div class="row">
                            <div class="col s9 offset-s2">
                                <a class="white-text btn-large red lighten-1" href="#">Agregar al carrito</a>
                            </div>
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