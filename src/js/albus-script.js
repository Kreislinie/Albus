(function( $ ) {

  $('.upload_image_button').click(function() {

    var send_attachment_bkp = wp.media.editor.send.attachment;
    var button = $(this);

    wp.media.editor.send.attachment = function(props, attachment) {
      $(button).parent().prev().attr('src', attachment.url);
      $(button).prev().val(attachment.id);
      wp.media.editor.send.attachment = send_attachment_bkp;
    }

    wp.media.editor.open(button);
    return false;

  });

  // "Remove" button (remove the value from input type='hidden')
  $('.remove_image_button').click(function() {

    var src = $(this).parent().prev().attr('data-src');
    $(this).parent().prev().attr('src', src);
    $(this).prev().prev().val('');
    return false;

  });

})(jQuery);
