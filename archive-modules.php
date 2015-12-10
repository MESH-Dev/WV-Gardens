<?php

if ( !is_user_logged_in() ) {

  wp_redirect( get_home_url() );
    exit;
}

get_header(); ?>

<div id="primary">
  <div id="content" role="main">
    <div class="container">
        <div class="six columns">
          <div class="module-section">
            <div class="module-text">
              <?php if ( $user_login ) { ?>
                <!-- text that logged in users will see -->
                <h1>Hi <span><?php echo $user_login; ?>!</span></h1>
              <?php } ?>
              <h1>Select your next <span>"MODULE"</span> to the right to get started!</h1>
            </div>
            <br/>
            <div class="module-image">
              <img src="<?php echo get_template_directory_uri(); ?>/img/halfplate.png" />
            </div>
          </div>
        </div>
        <div class="six columns">
          <div class="module-section">
            <div class="module-list">
              <?php

              // Determine the class that the current user is in

            	$args = array( 'post_type' => 'classes', 'posts_per_page' => -1 );
            	$loop = new WP_Query( $args );

              $class = 0;

            	while ( $loop->have_posts() ) : $loop->the_post();

            		$students = get_field('students', $post_id);

                foreach ($students as $student) {
                  if ( $student['student']['ID'] == get_current_user_id() ) {
                    $class = get_the_id();
                  }
                }

            	endwhile;

              $modules = get_field('modules', $post_id);

            	?>

              <?php

              $sql = "SELECT * FROM sessions WHERE class_id = " . $class . " AND user_id = " . get_current_user_id();

              global $wpdb;
              $results = $wpdb->get_results( $sql , ARRAY_A );

              $modules = array();

              foreach ( $results as $result ) {
                array_push($modules, $result['module_id']);
              }

              // 2nd Method - Utilizing the $GLOBALS superglobal. Does not require global keyword ( but may not be best practice )

              ?>

              <?php

              if( have_rows('modules', $class) ):

                  while ( have_rows('modules', $class) ) : the_row();

                      // Your loop code
                      $module = get_sub_field('module', $class);

                      $module_complete = false;

                      if (in_array($module->ID, $modules)) {
                        $module_complete = true;
                      }

                      ?>


                          <div class='module'>
                            <?php if ($module_complete == false) { ?>
                              <a href="<?php echo $module->guid; ?>">
                            <?php } ?>
                            <h2><?php echo $module->post_title; ?></h2>
                            <?php if($module_complete == false) { ?>
                              </a>
                            <?php } ?>
                            <div class="checkbox">
                              <img src="<?php echo get_template_directory_uri(); ?>/img/checkbox.png" />
                            </div>
                            <?php if ($module_complete == true) { ?>
                              <div class="checkmark">
                                <img src="<?php echo get_template_directory_uri(); ?>/img/checkmark.png" />
                              </div>
                            <?php } ?>
                          </div>


                      <?php

                  endwhile;

              else :

                  // no rows found

              endif;

              ?>
            </div>
          </div>
        </div>
    </div>
  </div>
</div><!-- #main -->

<div class="module-food">
  <img src="<?php echo get_template_directory_uri(); ?>/img/food.png" />
</div>

<?php get_footer(); ?>
