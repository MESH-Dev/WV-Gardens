

jQuery('#schools').change( function() {

  if ( jQuery('#teachers').is(":hidden") ) {
    jQuery('#teachers').show();
  }

  jQuery.ajax({ url: '<?php bloginfo('wpurl'); ?>/wp-admin/admin-ajax.php', data: 'action=get_classes&school=' + jQuery('#schools :selected').text(), success: function(result) {

    jQuery('#teachers').find('option').remove().end();

    var teacherList = jQuery.parseJSON(result);

    jQuery('#teachers').append("<option>Select</option>");

    jQuery.each(teacherList, function(i, item){
      jQuery('#teachers').append('<option value="' + item[1] + '">' + item[0] + '</option>');
    });

  }});

});

var password = '';
var success = false;

jQuery('#teachers').change( function() {

  if ( jQuery('#password').is(":hidden") ) {
    jQuery('#password').show();
  }

  jQuery.ajax({ url: '<?php bloginfo('wpurl'); ?>/wp-admin/admin-ajax.php', data: 'action=get_password&class=' + jQuery('#teachers :selected').val(), success: function(result) {
    password = result;
  }});

});

jQuery('#students').change( function() {

  if ( jQuery('#submit').is(":hidden") ) {
    jQuery('#submit').show();
  }

});

function getStudentList() {
  jQuery.ajax({ url: '<?php bloginfo('wpurl'); ?>/wp-admin/admin-ajax.php', data: 'action=get_students&class=' + jQuery('#teachers :selected').val(), success: function(result) {

    var studentList = jQuery.parseJSON(result);

    jQuery('#students').append("<option>Select</option>");

    jQuery.each(studentList, function(i, item){
      jQuery('#students').append('<option value="' + item[0] + '">' + item[0] + '</option>');
    });

  }});
}

function checkPasswordMatch() {

  var newPassword = jQuery("#password").val();

  if ((password == newPassword) && (success == false)) {
    success = true;
    jQuery("#students").show();
    getStudentList();
  }
}

jQuery(document).ready(function() {
  jQuery("#password").keyup(checkPasswordMatch);
});

jQuery('#submit').on('click', function() {

  jQuery.ajax({ url: '<?php bloginfo('wpurl'); ?>/wp-admin/admin-ajax.php', data: 'action=check_login&user=' + jQuery('#students :selected').val(), success: function(result) {

    if (result == "success") {
      window.location.href = "http://localhost/gardens/modules/";
    } else {

    }

  }});

});
