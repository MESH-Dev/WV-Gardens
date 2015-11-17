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


        <?php wp_login_form(); ?>

        <script type="text/javascript">

          var schools = jQuery("<select></select>").attr("id", "schools");
          var optionList = <?php echo json_encode($tax_array); ?>

          jQuery.each(optionList, function (i, el) {
              schools.append("<option>" + el + "</option>");
          });

          jQuery('#loginform').prepend(schools);


          jQuery('#schools').change( function() {

            var s = jQuery('#schools :selected').text();

            jQuery.ajax({ url: '<?php bloginfo('template_url'); ?>/functions/select.php', type: "POST", data: { school : s }, success: function(result) {

              var students = jQuery("<select></select>").attr("id", "students");

              

              jQuery(thing).insertAfter('#schools');

            }});

          });



        </script>

			<?php endwhile; ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>
