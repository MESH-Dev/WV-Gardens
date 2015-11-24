<?php /*
* Template Name: Modules
*/
get_header(); ?>

<div id="primary">
  <div id="content" role="main">
    <div class="container">
        <div class="six columns">
          <div class="module-section">
            <div class="module-text">
              <h1>Hi <span>Jordan!</span></h1>
              <h1>Select your next <span>"MODULE"</span> to the right to get started!</h1>
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

<?php get_footer(); ?>
