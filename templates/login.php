<?php /*
* Template Name: Login
*/
get_header(); ?>

<main id="main" class="site-main" role="main">

    <div class="container">

        <div class="twelve columns">

            <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

                <h1>Game Name</h1>

                <a href="<?php echo wp_login_url(); ?>?user=teacher" title="Login">Teacher</a><br/>
                <a href="<?php echo wp_login_url(); ?>?user=student" title="Login">Student</a>

            <?php endwhile; ?>

        </div>

    </div>

</main><!-- #main -->

<?php get_footer(); ?>
