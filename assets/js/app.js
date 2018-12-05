$(document).ready(function() {
  M.AutoInit();

  $('#logout-link').click(function (event) {
    event.preventDefault();

    $('#logout-form').submit();
  });

  $('.app-close-alert').click(function (event) {
    event.preventDefault();

    $(this).parent().fadeOut(200);
  });

  $('.app-confirm-operation').click(function (event) {
    event.preventDefault();

    if (confirm('Are you sure to delete this item?')) {
      var $form = $(this).closest('form');
      $form.submit();
    }
  });
});