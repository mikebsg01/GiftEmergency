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

  $('.app-field-upload').change(function(){
    var input         = this,
        $input        = $(input),
        url           = $input.val(),
        ext           = url.substring(url.lastIndexOf('.') + 1).toLowerCase(),
        $image        = $($input.data('image')),
        defaultImage  = $input.data('image-default');

    if (input.files && input.files[0] && (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) {
      var reader = new FileReader();

      reader.onload = function (e) {
        $image.attr('src', e.target.result);
      }
      reader.readAsDataURL(input.files[0]);
    } else {
      $image.attr('src', defaultImage);
      $input.val('');
    }
  });
});