<?php if (!file_exists(__DIR__.'/../../system/core.php')) exit("Sorry, has been ocurred an error trying to load the system.");

require_once __DIR__.'/../../system/core.php';

if (!empty($_POST['_method']) and $_POST['_method'] == 'DELETE' and
    !empty($_POST['slug'])) {
    $slug = $_POST['slug'];

  $result = dbQuery("SELECT `questions`.`id` FROM `questions`
                     WHERE `questions`.`slug` = '{$slug}'
                     ORDER BY `questions`.`id` ASC, `questions`.`created_at` ASC
                     LIMIT 1");

  if ($result->num_rows > 0) {
    $question = $result->fetch_assoc();
    $id = (int) $question['id'];

    $erased = dbQuery("DELETE FROM `questions` WHERE `questions`.`id` = '$id'");
    
    if ($erased) {
      makeFlash('ALERT_INFO', 'La pregunta ha sido eliminada exitosamente.');
    }
  }
}

return header('Location: ../index.php');