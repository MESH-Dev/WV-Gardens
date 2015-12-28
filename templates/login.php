<?php /*
* Template Name: Login
*/

if ( is_user_logged_in() ) {
  wp_redirect( get_home_url() . '/modules' );
    exit;
}

get_header(); ?>

<main id="main" class="site-main" role="main">

    <span id="login-flag" style="display:none;"></span>

    <div class="container">
      <div class="row">
        <div class="twelve columns">
          <div class="login-text">
            <h1>Sprout's Adventure</h1>
          </div>
        </div>
      </div>
      <div class="four columns offset-by-two center">
        <a href="<?php echo wp_login_url(); ?>?user=teacher" title="Login" class="login-button">Teacher Login</a>
      </div>
      <div class="four columns center">
        <a href="<?php echo get_home_url(); ?>/student-login" title="Login" class="login-button">Student Login</a>
      </div>

    </div>

</main><!-- #main -->

<?php get_footer(); ?>
