<?php
/**
 * The Sidebar containing the primary and secondary widget areas.
 *
 * @package WordPress
 * @subpackage AS3_Game_Gears
 * @since AS3 Game Gears 1.0
 */
?>

		<div id="primary" class="widget-area" role="complementary">
			<ul class="xoxo">

<?php if ( ! is_single() ) : ?>
			<li id=socialinv class="widget-container">
				<p>
					<a href="http://twitter.com/as3gamegears" target="_blank"><img src="<?php bloginfo('template_directory'); ?>/images/icons/twitter.png" border="0" width="50" height="50" title="Follow us on Twitter!" /></a>
					<a href="<?php bloginfo('rss2_url'); ?>" target="_blank"><img src="<?php bloginfo('template_directory'); ?>/images/icons/rss.png" border="0" width="50" height="50" title="RSS feed" /></a>					
					<a href="http://www.linkedin.com/in/fernandobevilacqua" target="_blank"><img src="<?php bloginfo('template_directory'); ?>/images/icons/linkedin.png" border="0" width="50" height="50" title="My LinkedIn profile" /></a>
				</p>		
			</li>
<?php endif; ?>

<?php
	/* When we call the dynamic_sidebar() function, it'll spit out
	 * the widgets for that widget area. If it instead returns false,
	 * then the sidebar simply doesn't exist, so we'll hard-code in
	 * some default sidebar stuff just in case.
	 */
	if ( ! dynamic_sidebar( 'primary-widget-area' ) ) : ?>
	
			<li id="search" class="widget-container widget_search">
				<?php get_search_form(); ?>
			</li>

			<li id="archives" class="widget-container">
				<h3 class="widget-title"><?php _e( 'Archives', 'as3gamegears' ); ?></h3>
				<ul>
					<?php wp_get_archives( 'type=monthly' ); ?>
				</ul>
			</li>

			<li id="meta" class="widget-container">
				<h3 class="widget-title"><?php _e( 'Meta', 'as3gamegears' ); ?></h3>
				<ul>
					<?php wp_register(); ?>
					<li><?php wp_loginout(); ?></li>
					<?php wp_meta(); ?>
				</ul>
			</li>

		<?php endif; // end primary widget area ?>
			</ul>
		</div><!-- #primary .widget-area -->

<?php
	// A second sidebar for widgets, just because.
	if ( is_active_sidebar( 'secondary-widget-area' ) ) : ?>

		<div id="secondary" class="widget-area" role="complementary">
			<ul class="xoxo">
				<?php dynamic_sidebar( 'secondary-widget-area' ); ?>
			</ul>
		</div><!-- #secondary .widget-area -->

<?php endif; ?>
