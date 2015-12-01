<?php /*
* Template Name: Login
*/
get_header(); ?>

<main id="main" class="site-main" role="main">

    <div class="container">
      <div class="twelve columns">

        <div class="login-text">
          <h1>Game Name</h1>

          <a href="<?php echo wp_login_url(); ?>?user=teacher" title="Login" class="login-button">Teacher Login</a>
          <a href="<?php echo get_home_url(); ?>/student-login" title="Login" class="login-button">Student Login</a>
        </div>

      </div>
    </div>

</main><!-- #main -->

<?php get_footer(); ?>
