<?php get_header(); ?>

<main id="content">

	<div class="container">
		<div class="row">
			<div class="nine columns">
				<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

					<h1><?php the_title(); ?></h1>

					<?php the_content(); ?>

				<?php endwhile; ?>
			</div>
			<div class="three columns">
				<?php get_sidebar(); ?>
			</div>
		</div>
	</div>


</main><!-- End of Content -->

<?php get_footer(); ?>
