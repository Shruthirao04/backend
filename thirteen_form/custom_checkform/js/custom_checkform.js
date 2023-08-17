(function($, Drupal, drupalSettings) {
  $(document).ready(function() {
    var checkbox = $('#same-lastname');
    var lastname = $('.js-form-item-last-name');

    if (checkbox.is(':checked')) {
      lastname.hide();
    }

    checkbox.on('change',function() {
      if($(this).is(':checked')) {
        lastname.hide();
      }
      else {
        lastname.show();
      }
    });
  });
})(jQuery, Drupal, drupalSettings);
