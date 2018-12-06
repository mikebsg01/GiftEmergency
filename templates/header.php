<?php if (!file_exists(__DIR__.'/../system/core.php')) exit("Sorry, has been ocurred an error trying to load the system.");

require_once __DIR__.'/../system/core.php';

$is_loggued = false;
$user_data = null;
$total_plates_added = 0;
$current_action = null;

function headerController() {
  global $is_loggued, $current_action, $user_data, $total_plates_added;

  $is_loggued = isLoggued();

  if ($is_loggued) {
    $user_data = getUserData(['first_name', 'last_name']);
  }

  $current_action     = App::getCurrentAction();
  $total_plates_added = getTotalPlatesAdded();
}

headerController();
?>
<div class="navbar-fixed">
  <nav class="app-nav">
    <div class="nav-wrapper">
      <a href="<?php echo ((! isAdmin()) ? url('index.php') : url('admin/index.php')); ?>" title="Ir al Inicio" class="brand-logo">
        <img src="<?php echo url('assets/img/logo-navbar-gift.svg'); ?>">
        <span>GiftEmergency</span>
        <?php if (isAdmin()): ?>
          <span class="admin-badge badge new amber" data-badge-caption="Admin"></span>
        <?php endif; ?>
      </a>
      <ul class="right hide-on-med-and-down">
        <?php if ($is_loggued): ?>
          <li class="<?php echo ($current_action == 'shopping_cart' ? 'active' : '') ?>">
            <a href="<?php echo url('shopping_cart.php'); ?>">
              <?php if ($total_plates_added > 0): ?>
                <span class="shopping-cart-notification-badge new badge" data-badge-caption="<?php echo $total_plates_added; ?>"></span>
              <?php endif; ?>
              <i class="material-icons left">shopping_cart</i> Mi carrito
            </a>
          </li>
          <li>
            <a href="#" class="dropdown-trigger" href="#!" data-target="dropdown-menu-user"><i class="material-icons left">person</i><?php echo getShortName($user_data['first_name'], $user_data['last_name']); ?><i class="material-icons right">arrow_drop_down</i></a>
          </li>
          <ul id="dropdown-menu-user" class="dropdown-content">
            <li class="divider"></li>
            <li>
              <!-- [NEW FEATURE]
              <a href="#">Perfil<i class="material-icons right">person</i></a>
              -->
              <a id="logout-link" href="#">Cerrar sesión<i class="material-icons right">exit_to_app</i></a>
              <form method="POST" action="<?php echo url('logout.php'); ?>" accept-charset="UTF-8" id="logout-form">
                <input type="hidden" name="logout" value="1">
              </form>
            </li>
          </ul>
        <?php else: ?>
          <li><a href="<?php echo url('login.php'); ?>"><i class="material-icons left">person</i> Iniciar sesión</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </nav>
</div>