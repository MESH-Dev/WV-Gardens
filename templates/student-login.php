<?php
/*
* Template Name: Student Login
*/

if ( is_user_logged_in() ) {
  wp_redirect( get_home_url() . '/modules' );
    exit;
}

get_header();

?>

<div id="primary">
	<div id="content" role="main">



			<div class="container">
				<div class="six columns">
					<div class="module-section">
						<div class="bubble">
							<div class="bubble-text">
								<h1>Welcome to<br/>Sprout's Adventure!</h1>
							</div>
						</div>
						<div class="farmer">
							<img src="<?php echo get_template_directory_uri(); ?>/img/farmer.png" />
						</div>
					</div>
				</div>
				<div class="six columns">
					<div class="module-section">
						<?php while ( have_posts() ) : the_post(); ?>

			        <?php

								// Create the list of schools

			          $tax = get_terms ( 'school' );
			          $tax_array = array();

			          if ( ! empty( $tax ) && ! is_wp_error( $tax ) ){
			             foreach ( $tax as $t ) {
			               array_push($tax_array, $t->name);
			             }
			          }

	        		?>

							<div class="login-form">

								<select id="schools"></select><br/>
								<select id="teachers"></select><br/>
								<input id="password" type="password" />
								<select id="students"></select><br/>
								<button id="submit">Sign In!</button>
								<?php wp_nonce_field( 'ajax-login-nonce', 'security' ); ?>

							</div>

						<?php endwhile; ?>
					</div>
				</div>
			</div>




      <script type="text/javascript">

        var schoolList = <?php echo json_encode($tax_array); ?>

				jQuery('#schools').append("<option>Select</option>");

        jQuery.each(schoolList, function (i, item) {
            jQuery('#schools').append("<option>" + item + "</option>");
        });

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
							jQuery('#students').append('<option value="' + item[1] + '">' + item[0] + '</option>');
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


						var url = location.protocol+'//'+location.hostname+(location.port ? ':'+location.port: '');

						if (result == "success") {
							window.location.href = "<?php echo get_post_type_archive_link( 'modules' ); ?>";
						} else {

						}

					}});

				});


      </script>



	</div><!-- #content -->
</div><!-- #primary -->

<?php get_footer(); ?>
