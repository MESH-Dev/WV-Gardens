<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->

<?php

	if( is_page_template('templates/homepage-fullscreen.php') ) {
		$imageArray = get_field('background_image');
		$imageURL = $imageArray['sizes']['background-fullscreen'];
	}

?>

<html <?php if( is_page_template('templates/homepage-fullscreen.php') ) { ?> style="background: url('<?php echo $imageURL; ?>') no-repeat center center fixed;" class="background-fullscreen" <?php } ?>>

<head>
	<meta charset="utf-8">
	<title><?php bloginfo('name'); ?></title>
 

	<!-- Mobile Specific Metas
	================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- CSS
	================================================== -->
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" />
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/animate.css" />
		<?php if(is_page()){ ?>
		<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/chartist.css" />

	<?php } ?>

	<!-- Favicons
	================================================== -->
	<link rel="shortcut icon" href="images/favicon.ico">
	<link rel="apple-touch-icon" href="images/apple-touch-icon.png">
	<link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">


	<script src="https://use.typekit.net/yyp4jff.js"></script>
	<script>try{Typekit.load({ async: true });}catch(e){}</script>



	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

	<div id="page" class='hfeed site content-fullscreen <?php if (!is_post_type_archive() && !is_page_template("templates/login.php")) { echo "module-" . get_order( $post ); } ?>'>
