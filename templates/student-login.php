<?php
/*
* Template Name: Student Login
*/
get_header(); ?>

	<div id="primary">
		<div id="content" role="main">

			<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<h1><?php the_title(); ?></h1>

        <?php

          // Determine the class that the current user is in

          $tax = get_terms ( 'school' );

          $tax_array = array();

          if ( ! empty( $tax ) && ! is_wp_error( $tax ) ){

             foreach ( $tax as $t ) {
               array_push($tax_array, $t->name);
             }
          }

        ?>

        <select id="schools"></select>

        <select id="teachers"></select>

        <select id="students"></select>


        <?php wp_login_form(); ?>

        <script type="text/javascript">

          var optionList = <?php echo json_encode($tax_array); ?>

          jQuery.each(optionList, function (i, el) {
              jQuery('#schools').append("<option>" + el + "</option>");
          });

          jQuery('#loginform').prepend(jQuery('#schools'));

          jQuery('#schools').change( function() {

            if ( jQuery('#teachers').length ) {

              jQuery('#teachers').show();

              var s = jQuery('#schools :selected').text();

              jQuery.ajax({ url: '<?php bloginfo('wpurl'); ?>/wp-admin/admin-ajax.php', data: 'action=my_special_ajax_call&school=' + s, success: function(result) {

                jQuery('#teachers').find('option').remove().end();

                var data = jQuery.parseJSON(result);

                jQuery.each(data, function(i, item){
                  jQuery('#teachers').append('<option>' + item + '</option>');
                });

                // jQuery('#teachers').insertAfter('#schools');

              }});

            } else {

              var s = jQuery('#schools :selected').text();

              jQuery.ajax({ url: '<?php bloginfo('wpurl'); ?>/wp-admin/admin-ajax.php', data: 'action=my_special_ajax_call&school=' + s, success: function(result) {

                jQuery('#teachers').show();

                var data = jQuery.parseJSON(result);

                jQuery.each(data, function(i, item){
                  teachers.append('<option>' + item + '</option>');
                });

                teachers.insertAfter('#schools');

              }});

            }

          });

          jQuery('#teachers').change( function() {

            // if ( jQuery('#students').length ) {
            //
            //   var s = jQuery('#teachers :selected').text();
            //
            //   jQuery.ajax({ url: '<?php bloginfo('wpurl'); ?>/wp-admin/admin-ajax.php', data: 'action=my_special_ajax_call&school=' + s, success: function(result) {
            //
            //     jQuery(students).find('option').remove().end();
            //
            //     var data = jQuery.parseJSON(result);
            //
            //     jQuery.each(data, function(i, item){
            //       jQuery(students).append('<option value="' + item + '">' + item + '</option>');
            //     });
            //
            //     jQuery(students).insertAfter('#teachers');
            //
            //   }});
            //
            // } else if {
            //
            //   var s = jQuery('#teachers :selected').text();
            //
            //   jQuery.ajax({ url: '<?php bloginfo('wpurl'); ?>/wp-admin/admin-ajax.php', data: 'action=my_special_ajax_call&school=' + s, success: function(result) {
            //
            //     var students = jQuery("<select></select>").attr("id", "students");
            //     var data = jQuery.parseJSON(result);
            //
            //     jQuery.each(data, function(i, item){
            //       students.append('<option value="' + item + '">' + item + '</option>');
            //     });
            //
            //     students.insertAfter('#teachers');
            //
            //   }});
            //
            // }



          });



        </script>

			<?php endwhile; ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>
