<?php if (!file_exists('system/core.php')) exit("Sorry, has been ocurred an error trying to load the system.");

require_once 'system/core.php';

function aboutUsController() {

}

aboutUsController();

include_once 'templates/head.php';
include_once 'templates/header.php'; 
?>
<div class="page-about-us">
    <section class="row">
        <article class="col s12">
            <div class="container">
                <h1 class="animated rollIn">Conocenos</h1>
                <p>
                    GiftEmergency surge del grandioso dilema ¿qué debo regalarle a mi ser querido?.
                    Y que citando la conocida frase –“si algo puede salir mal, ¡saldrá mal!”-, 
                    por lo que el enfoque de nuestra app y su objetivo es brindarte un obsequio de acuerdo 
                    al criterio de quién lo busca y para quién.
                </p>
                <h1 class="animated rollIn">Objetivo</h1>
                <p>
                    Otorgar al usuario un obsequio de acuerdo a los gustos de sus seres queridos.
                </p>
            </div>
        </article>
    </section>
    <section class="container">
        <div class="row" style="margin-bottom: 0; padding-bottom: 45px;">
            <article class="col s12">
                <h1 class="animated rollIn">Fundadores</h1>
                <div class="row">
                    <div class="col s12 m4 l4 animated fadeInLeft delay-s2">
                        <img class="responsive-img circle" src="<?php echo url('assets/img/viz.jpg'); ?>">
                        <h4 class="center-align">Jose Nieto</h4>
                    <p class="center-align">Estudiante de Ing. de Software<br>Facultad de Informatica. UAQ</p>
                    </div>
                    <div class="col s12 m4 l4 animated fadeInLeft delay-s2">
                        <img class="responsive-img circle" src="<?php echo url('assets/img/mich.jpg'); ?>">
                        <h4 class="center-align">Michael Guerrero</h4>
                        <p class="center-align">Estudiante de Ing. de Software<br>Facultad de Informatica. UAQ</p>
                    </div>
                    <div class="col s12 m4 l4 animated fadeInLeft delay-s2">
                        <img class="responsive-img circle" src="<?php echo url('assets/img/lu.jpg'); ?>">
                        <h4 class="center-align">Luis Gallegos</h4>
                        <p class="center-align">Estudiante de Ing. de Software<br>Facultad de Informatica. UAQ</p>
                    </div>
                </div>
            </article>
        </div>
    </section>
</div>
<?php include_once 'templates/scripts.php' ?>
<script type="text/javascript" src="assets/js/app/index.js?v=<?php echo time() ?>"></script>
<?php include_once 'templates/footer.php' ?>

