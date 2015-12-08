jQuery(document).ready(function($){

  jQuery(".question").each(function() {
    jQuery(this).find(".answer").each(function() {
      jQuery(this).click(function() {

        jQuery('.answer').removeClass('answer-hover');
        jQuery('.answer-image').removeClass('answer-image-1-hover');
        jQuery('.answer-image').removeClass('answer-image-2-hover');
        jQuery('.answer-image').removeClass('answer-image-3-hover');
        jQuery('.answer-image').removeClass('answer-image-4-hover');

        if (jQuery(this).hasClass('answer-1')) {
          jQuery(this).addClass('answer-hover');
          jQuery(this).find('.answer-image').addClass('answer-image-1-hover');
        }
        if (jQuery(this).hasClass('answer-2')) {
          jQuery(this).addClass('answer-hover');
          jQuery(this).find('.answer-image').addClass('answer-image-2-hover');
        }
        if (jQuery(this).hasClass('answer-3')) {
          jQuery(this).addClass('answer-hover');
          jQuery(this).find('.answer-image').addClass('answer-image-3-hover');
        }
        if (jQuery(this).hasClass('answer-4')) {
          jQuery(this).addClass('answer-hover');
          jQuery(this).find('.answer-image').addClass('answer-image-4-hover');
        }

      });
    });
  });



});
