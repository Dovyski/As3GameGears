<?php
/**
 * The template for displaying Category Archive pages.
 *
 * @package WordPress
 * @subpackage AS3_Game_Gears
 * @since AS3 Game Gears 1.0
 */

get_header(); ?>

		<div id="container">
			<div id="content" role="main">

				<h1 class="entry-title">
					<div id="category-thumb"></div>
					<?php single_cat_title(''); ?>
				</h1>

				<?php
					$category_description = category_description();
					$category_description = !empty($category_description) ? $category_description : __( 'No description available. Sorry!', 'as3gamegears' );

					echo '<div class="archive-meta">' . $category_description . '</div>';

				/* Run the loop for the category page to output the posts.
				 * If you want to overload this in a child theme then include a file
				 * called loop-category.php and that will be used instead.
				 */
				get_template_part( 'loop', 'category' );
				?>

			</div><!-- #content -->
		</div><!-- #container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
