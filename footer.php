</div><!-- #page -->

<footer class="site-footer <?php if( is_page_template('templates/homepage-fullscreen.php') ) { echo "footer-fullscreen"; } ?>">

	<div class="container">
		<div class="row">
			<div class="twelve columns">
				<nav class="main-navigation">
					<?php wp_nav_menu( array('menu_id' => 'footer-menu', 'theme_location' => 'footer-menu') ); ?>
				</nav>
					<p>Designed by <a href="http://meshfresh.com" target="_blank">MESH</a></p>
			</div><!-- End of Footer -->
		</div>
	</div>

</footer>

<?php wp_footer(); ?>

</body>
</html>
