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
                <h1>Hi <span><?php echo wp_get_current_user()->user_firstname; ?>!</span></h1>
              <?php } ?>
              <h1>Select your next <span>"MODULE"</span> to the right to get started!</h1>
            </div>
            <br/>
            <div class="module-image">
              <?php get_template_part( 'partials/bigprogress', 'plate' ); ?>
            </div>
          </div>
        </div>
        <div class="six columns">
          <div class="module-section">
            <div class="module-list">
              <?php

                $sql = "SELECT * FROM students WHERE user_id = " . get_current_user_id();

                global $wpdb;
                $class_row = $wpdb->get_row( $sql , ARRAY_A );

                $class = (int)$class_row['class_id'];

                // Get a list of completed modules

                $sql = "SELECT * FROM sessions WHERE class_id = " . $class . " AND user_id = " . get_current_user_id();

            	?>

              <?php

                // If it's in sessions, that means it's complete

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
