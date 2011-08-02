<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content
 * after.  Calls sidebar-footer.php for bottom widgets.
 *
 * @package WordPress
 * @subpackage AS3_Game_Gears
 * @since AS3 Game Gears 1.0
 */
?>
	</div><!-- #main -->

	<div id="footer" role="contentinfo">
		<div id="colophon">

<?php
	/* A sidebar in the footer? Yep. You can can customize
	 * your footer with four columns of widgets.
	 */
	get_sidebar( 'footer' );
?>
			<div id="rss-info">
				<a href="<?php bloginfo('rss2_url'); ?>" title="RSS Feeds">
					<img src="<?php bloginfo('template_directory'); ?>/images/feeds.png" border="0" title="RSS feeds" />
				</a>
			</div><!-- #rss-info -->

			<div id="site-info">
				<a href="<?php echo home_url( '/' ) ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
					<?php bloginfo( 'name' ); ?> - <?php bloginfo( 'description' ); ?>
				</a>
			</div><!-- #site-info -->

			<div id="site-generator">
				<?php do_action( 'as3gg_credits' ); ?>
				<a href="<?php echo esc_url( __('http://wordpress.org/', 'as3gamegears') ); ?>"
						title="<?php esc_attr_e('Semantic Personal Publishing Platform', 'as3gamegears'); ?>" rel="generator">
					<?php bloginfo( 'name' ); ?> <?php printf( __('is proudly powered by %s.', 'as3gamegears'), 'WordPress' ); ?>
				</a>
			</div><!-- #site-generator -->
		</div><!-- #colophon -->
	</div><!-- #footer -->

</div><!-- #wrapper -->

<?php
	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */

	wp_footer();
?>
</body>
</html>
