<?php if (!file_exists(__DIR__.'/../../system/core.php')) exit("Sorry, has been ocurred an error trying to load the system.");

require_once __DIR__.'/../../system/core.php';

if (!empty($_POST['_method']) and $_POST['_method'] == 'DELETE' and
    !empty($_POST['slug'])) {
    $slug = $_POST['slug'];

  $result = dbQuery("SELECT `stereotypes`.`id` FROM `stereotypes`
                     WHERE `stereotypes`.`slug` = '{$slug}'
                     ORDER BY `stereotypes`.`id` ASC, `stereotypes`.`created_at` ASC
                     LIMIT 1");

  if ($result->num_rows > 0) {
    $stereotype = $result->fetch_assoc();
    $id = (int) $stereotype['id'];

    $erased = dbQuery("DELETE FROM `stereotypes` WHERE `stereotypes`.`id` = '$id'");
    
    if ($erased) {
      makeFlash('ALERT_INFO', 'El alumno ha sido eliminado exitosamente.');
    }
  }
}

return header('Location: ../index.php');