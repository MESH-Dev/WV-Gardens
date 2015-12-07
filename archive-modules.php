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

            	?>

              <?php


              if( have_rows('modules', $class) ):

                  while ( have_rows('modules', $class) ) : the_row();

                      // Your loop code
                      $module = get_sub_field('module', $class);

                      ?>

                      <a href="<?php echo $module->guid; ?>">
                        <div class='module'>
                          <h2><?php echo $module->post_title; ?></h2>
                          <div class="checkbox">
                            <img src="<?php echo get_template_directory_uri(); ?>/img/checkbox.png" />
                          </div>
                          <div class="checkmark">
                            <img src="<?php echo get_template_directory_uri(); ?>/img/checkmark.png" />
                          </div>
                        </div>
                      </a>

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
