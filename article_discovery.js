Drupal.behaviors.article_discovery = function(context) {
  //Callback functions for manipulating selection boxes.
  $('input.article-discovery-select-box').click( function () {
    var before = parseInt($('span.article-discovery-selected-count:first').text());
    //This looks backwards to me.
    //It turns out that the click ticks the box before it runs through this function, then the return false undoes it.
    //At least that's what it does on firefox.
    var action = (this.checked ? 'add':'remove');
    $.getJSON(
      //To work around a drupal/apache bug, triple urlencode slashes here, decode them once on the other side.
      '/articles/select/' + action + ':' + encodeURIComponent(this.id.substr(7)).replace('%2F', '%25252F'),
      (function(elt) { return function (data) {
        if(data.delta == 1) {
          $(elt).attr('checked','checked');
        } else if(data.delta == -1) {
          $(elt).attr('checked', false);
        }
        $('span.article-discovery-selected-count').each( function() { $(this).text(parseInt($(this).text())+parseInt(data.delta)); });
        after = parseInt($('span.article-discovery-selected-count:first').text());
        if(before == 0 || after == 0 && before != after) {
          $('.article-discovery-action-selected-actions').toggle();
        }
      };})(this)
    );
    return false;
  });
  $('#article-discovery-select-clear').click( function () {
    $.getJSON(
      '/articles/select/clear:clear',
      function(data) {
        if(data.delta < 0) {
          $('input.article-discovery-select-box:checked').attr('checked',false);
          $('span.article-discovery-selected-count').each( function() { $(this).text(parseInt($(this).text())+parseInt(data.delta)); });
          $('.article-discovery-action-selected-actions').toggle();
        }
      }
    );
    return false;
  });

  $('#article-discovery-select-all').click( function () {
    var before = parseInt($('span.article-discovery-selected-count:first').text());
    //This looks backwards to me.
    //It turns out that the click ticks the box before it runs through this function, then the return false undoes it.
    //At least that's what it does on firefox.
    if( $('#article-discovery-select-all input').attr('checked') ) {
      var str = 'add:' + $('input.article-discovery-select-box:not(:checked)').map( function () { return encodeURIComponent(this.id.substr(7)).replace('%2F', '%25252F'); }).get().join('/add:');
    } else {
      var str = 'remove:' + $('input.article-discovery-select-box:checked').map( function () { return encodeURIComponent(this.id.substr(7)).replace('%2F', '%25252F'); }).get().join('/remove:');
    }
    if(!(str=='add:' || str=='remove:')){
      $.getJSON(
        '/articles/select/'+str,
        function(data) {
          $('span.article-discovery-selected-count').each( function() { $(this).text(parseInt($(this).text())+parseInt(data.delta)); });
          if(data.delta >= 0) {
            $('input.article-discovery-select-box:not(:checked)').attr('checked','checked');
            $('#article-discovery-select-all input').attr('checked','checked');
          } else if(data.delta < 0) {
          $('input.article-discovery-select-box:checked').attr('checked',false);
            $('#article-discovery-select-all input').attr('checked',false);
          }
          after = parseInt($('span.article-discovery-selected-count:first').text());
          if(before == 0 || after == 0 && before != after) {
            $('.article-discovery-action-selected-actions').toggle();
          }
        }
      );
    } else {
      return true;
    }
    return false;
  });
};
