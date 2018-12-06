<?php if (!file_exists(__DIR__.'/../../system/core.php')) exit("Sorry, has been ocurred an error trying to load the system.");

require_once __DIR__.'/../../system/core.php';

if (!empty($_POST['_method']) and $_POST['_method'] == 'DELETE' and
    !empty($_POST['slug'])) {
    $slug = $_POST['slug'];

  $result = dbQuery("SELECT `id`, `image_id` FROM `gifts`
                     WHERE `gifts`.`slug` = '{$slug}'
                     ORDER BY `gifts`.`id` ASC, `gifts`.`created_at` ASC
                     LIMIT 1");

  if ($result->num_rows > 0) {
    $gift         = (object) $result->fetch_assoc();
    $id           = (int) $gift->id;
    $gift_erased  = dbQuery("DELETE FROM `gifts` WHERE `gifts`.`id` = {$id}");
    
    if ($gift_erased) {
      makeFlash('ALERT_INFO', 'El regalo ha sido eliminado exitosamente.');
    }

    if ($gift->image_id != 1) {
      $getImage = dbQuery("SELECT CONCAT(img.file_path, '/', img.file_name, '.', img.file_extension) AS 'url'
                          FROM images AS img
                          WHERE img.id = {$gift->image_id}");

      if ($getImage->num_rows > 0) {
        $image = (object) $getImage->fetch_assoc();
        $file_url = base($image->url);
        unlink($file_url);
      }

      $image_erased = dbQuery("DELETE FROM `images` WHERE `images`.`id` = {$gift->image_id}");
    }
  }
}

return header('Location: ../index.php');
