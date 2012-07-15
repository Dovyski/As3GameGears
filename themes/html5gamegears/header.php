<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage AS3_Game_Gears
 * @since AS3 Game Gears 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>  prefix="og: http://ogp.me/ns#">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 * We filter the output of wp_title() a bit -- see
	 * as3gg_filter_wp_title() in functions.php.
	 */
	wp_title( '|', true, 'right' );

	?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link  href="http://fonts.googleapis.com/css?family=IM+Fell+DW+Pica|IM+Fell+English:regular" rel="stylesheet" type="text/css" >
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>?ver=1.8" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<meta name="google-site-verification" content="O6lUCx7d2YEg3kHVlg-BCeWPQxLQa5k7VBJdWTMRU8E" />

<!-- SEO stuff -->
<meta property="og:image" content="<?php bloginfo('template_directory'); ?>/images/html5gamegears.png"/>
<meta property="og:site_name" content="Html5GameGears"/>
<meta property="og:type" content="website"/>
<?php if ( is_single()) {
	$aText = @explode('.', strip_tags($post->post_content), 2);
	$aDesc = isset($aText[0]) ? $aText[0].'.' : '';
?>
<meta property="og:title" content="<?php echo $post->post_title;?>"/>
<meta property="og:url" content="<?php echo get_permalink(); ?>"/>
<meta property="og:description" content="<?php echo $aDesc; ?>"/>
<meta name="description" content="<?php echo $aDesc; ?>" />
<?php } else { ?>
<meta property="og:title" content="Html5GameGears"/>
<meta property="og:url" content="<?php echo home_url('/'); ?>"/>
<meta property="og:description" content="Html5GameGears is the right place to find tools, libraries and engines to build your HTML5 game. There is no need to reinvent the wheel for every new HTML5 game you create, all you need is a place to search for the tools that best fit your needs."/>
<meta name="description" content="Html5GameGears is the right place to find tools, libraries and engines to build your HTML5 game. There is no need to reinvent the wheel for every new HTML5 game you create, all you need is a place to search for the tools that best fit your needs." />
<?php } ?>
<meta name="keywords" content="html5, html, css, javascript, js, engine, games, game, game engine, physics, graphics, tweening, isometric, 2D, 3D, engines, 2D games, 3D games, multiplayer, smartfox, particles, path-finding, path finding, profiling, canvas, webgl, ios, android" />
<meta name="author" content="Fernando Bevilacqua" />
<!-- /SEO stuff -->

<?php
	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
?>
</head>

<body <?php body_class(); ?>>
<div id="wrapper" class="hfeed">
	<div id="header">
		<div id="masthead">

			<div id="branding" class="<?php as3gg_header_special_class(); ?>" role="banner">
				<div id="search">
					<?php get_search_form(); ?>
				</div>	
			</div><!-- #branding -->

			<div id="access" role="navigation">
			  <?php /*  Allow screen readers / text browsers to skip the navigation menu and get right to the good stuff */ ?>
				<div class="skip-link screen-reader-text"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'as3gamegears' ); ?>"><?php _e( 'Skip to content', 'as3gamegears' ); ?></a></div>
				<?php /* Our navigation menu.  If one isn't filled out, wp_nav_menu falls back to wp_page_menu.  The menu assiged to the primary position is the one used.  If none is assigned, the menu with the lowest ID is used.  */ ?>
				<?php wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'primary' ) ); ?>
			</div><!-- #access -->
		</div><!-- #masthead -->
	</div><!-- #header -->

	<div id="main">
