(function ($) {
  Drupal.behaviors.article_discovery_advanced = {
    attach : function(context) {
      $('#edit-published').change(function() {
        if ($(this).val() == 'between')
          $('.article-published-between').css('visibility', 'visible');
        else
          $('.article-published-between').css('visibility', 'hidden');
      });
    }
  }
})(jQuery);