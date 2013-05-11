<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 * @subpackage AS3_Game_Gears
 * @since AS3 Game Gears 1.0
 */

get_header(); ?>

	<div id="container" style="width: 100% !important;">
		<div id="content" role="main" style="width: 100% !important;">

			<div id="post-0" class="post error404 not-found">
				<div id="texting">
					<h1 class="entry-title"><?php _e( 'Not Found', 'as3gamegears' ); ?></h1>
					<div class="entry-content">
						<p><?php _e( 'Apologies, but the page you requested could not be found. Some of the reasons for that:', 'as3gamegears' ); ?></p>
						<ul>
							<li>Cookie (dog in the picture) ate the page;</li>	
							<li>An alien army vaporized it;</li>	
							<li>The page is shy;</li>	
							<li>You already unlocked that achievement;</li>	
							<li>The page uses a negative FPS rate to be rendered;</li>	
							<li>The page did not make the deadline, so it was left out;</li>
							<li>The page is a plugin, but you live in a plugin-free universe;</li>
							<li>Apple is still reviewing the page and asking for changes before it can be published;</li>
							<li>The page is still being hammered by Steam's Green Light commenters;</li>
							<li>The page was exchanged by some game assets;</li>
						</ul>
					</div><!-- .entry-content -->
				</div>
				<img src="<?php bloginfo('stylesheet_directory'); ?>/img/404_3.jpg" style="float: right;"/>
			</div><!-- #post-0 -->

		</div><!-- #content -->
	</div><!-- #container -->

<?php get_footer(); ?>