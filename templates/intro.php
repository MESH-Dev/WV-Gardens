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
            <div class="intro-image intro-image-1 intro-image-top">
              <img src="<?php echo get_template_directory_uri(); ?>/img/food-cloud.png" class="animated" />
            </div>
            <div class="intro-image intro-image-2 intro-image-top">
              <img src="<?php echo get_template_directory_uri(); ?>/img/small-plate.png" class="animated" />
            </div>
            <div class="intro-image intro-image-bottom">
              <img src="<?php echo get_template_directory_uri(); ?>/img/hungry.png" class="animated" />
            </div>
          </div>
        </div>
        <div class="six columns">
          <div class="module-section">
            <div class="intro-bubble intro-bubble-1">
              <div class="bubble-text">
                <h1>Hey! I'm Sprout.<br/>I love healthy foods!</h1>
              </div>
            </div>
            <div class="intro-bubble intro-bubble-2">
              <div class="bubble-text">
                <h1>Help me fill up your healthy plate by answering questions. Let's get started!</h1>
              </div>
            </div>
            <button class="next button-control" style="display: inline-block;">
              <div class="next-text">Next</div>
              <div class="next-arrow button-control-arrow"></div>
            </button>
            <button class="start button-control" style="display: inline-block;">
              <div class="next-text">Get Started!</div>
              <div class="next-arrow button-control-arrow"></div>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <audio class="audioDemo" id="audio-intro-one">
     <source src="<?php bloginfo( url ); ?>/wp-content/uploads/2016/07/intro-hi.mp3" type="audio/mpeg">
  </audio>

  <audio class="audioDemo" id="audio-intro-two">
     <source src="<?php bloginfo( url ); ?>/wp-content/uploads/2016/07/intro-help.mp3" type="audio/mpeg">
  </audio>

</main><!-- #main -->

<script type="text/javascript">

	jQuery(".intro .next").click(function() {
    jQuery(".intro-bubble-1").hide();
    jQuery(".intro-bubble-2").show();
    jQuery(".intro-image-1").hide();
    jQuery(".intro-image-2").show();
    jQuery(this).hide();
    jQuery(".intro .start").show();
    var res = 'audio-intro-two';
    document.getElementById(res).play();
  });

  jQuery(".intro .start").hide();

  jQuery(".intro .start").click(function() {
    window.location.href = "<?php echo get_post_type_archive_link( 'modules' ); ?>";
  });

  var res = 'audio-intro-one';
  document.getElementById(res).play();

</script>

<?php get_footer(); ?>
