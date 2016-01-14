<?php /*
* Template Name: Intro
*/

get_header(); ?>

<main id="main" class="site-main" role="main">

  <div id="primary" class="intro">
    <div class="container">
      <div class="row">
        <div class="six columns">
          <div class="module-section">
            <div class="intro-image">
              <img src="<?php echo get_template_directory_uri(); ?>/img/food-cloud.png" class="animated" />
            </div>
            <div class="intro-image">
              <img src="<?php echo get_template_directory_uri(); ?>/img/hungry.png" class="animated" />
            </div>
          </div>
        </div>
        <div class="six columns">
          <div class="module-section">
            <div class="intro-cloud-image">
              <img src="<?php echo get_template_directory_uri(); ?>/img/purple-bubble.png" class="animated" />
            </div>
            <button class="next button-control" style="display: inline-block;">
              <div class="next-text">Next</div>
              <div class="next-arrow button-control-arrow"></div>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>

</main><!-- #main -->

<?php get_footer(); ?>
