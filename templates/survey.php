<?php /*
* Template Name: Survey
*/
get_header(); ?>

<main id="main" class="site-main" role="main">

    <div class="container">
        <div class="twelve columns">

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
                    $module = get_sub_field('module', $class)->ID;

                    echo "<div class='module'>";

                    if ( have_rows('questions', $module) ):

                        while ( have_rows('questions', $module) ) : the_row();

                            echo "<div class='question'>";
                            echo get_sub_field('question', $module)->post_title;
                            echo "</div>";

                        endwhile;

                    else :

                    endif;

                    echo "</div>";

                endwhile;

            else :

                // no rows found

            endif;

            ?>

        </div>
    </div>

</main><!-- #main -->

<?php get_footer(); ?>
