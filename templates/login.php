<?php /*
* Template Name: Login
*/
get_header(); ?>

<main id="main" class="site-main" role="main">

    <div class="container">

        <div class="twelve columns">

            <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

                <h1><?php the_title(); ?></h1>

                <?php the_content(); ?>

            <?php endwhile; ?>

        </div>

    </div>

</main><!-- #main -->

<?php get_footer(); ?>
