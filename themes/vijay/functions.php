<?php
function childtheme_favicon() { ?>
	<link rel="shortcut icon" href="<?php echo bloginfo('stylesheet_directory') ?>/img/wpcharity.png" >
<?php }
add_action('wp_head', 'childtheme_favicon');


if ( ! function_exists( 'twentyten_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post—date/time and author.
 *
 * @since Twenty Ten 1.0
 */
function twentyten_posted_on() {
	printf( __( '<span class="%1$s"></span> %2$s <span class="meta-sep"></span> %3$s', 'twentyten' ),
		'meta-prep meta-prep-author',
		sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
			get_permalink(),
			esc_attr( get_the_time() ),
			get_the_date()
		),
		sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
			get_author_posts_url( get_the_author_meta( 'ID' ) ),
			sprintf( esc_attr__( 'View all posts by %s', 'twentyten' ), get_the_author() ),
			get_the_author()
		)
	);
}
endif;

if ( ! function_exists( 'vijay_header_class' ) ) :
/**
 * 
 *
 * @since Twenty Ten 1.0
 */
function vijay_header_class() {
	$aClass = '';
	
	if(is_category()) {
		$aClass = 'header-category';
	} else if(is_single()) {
		$aClass = 'header-item';
	}
	echo 'class="'.$aClass.'"';
}
endif;

if ( ! function_exists( 'twentyten_posted_in' ) ) :
/**
 * Prints HTML with meta information for the current post (category, tags and permalink).
 *
 * @since Twenty Ten 1.0
 */
function twentyten_posted_in() {
	// Retrieves tag list of current post, separated by commas.
	$tag_list = get_the_tag_list( '', ', ' );
	if ( $tag_list ) {
		$posted_in = __( '<span class="entry-utility-prep-cat-links"></span> %1$s <span class="entry-utility-prep-tag-links"></span> %2$s. <a href="%3$s" title="Permalink to %4$s" rel="bookmark">URL</a>.', 'twentyten' );
	} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
		$posted_in = __( '<span class="entry-utility-prep-cat-links"></span> %1$s. <a href="%3$s" title="Permalink to %4$s" rel="bookmark">URL</a>.', 'twentyten' );
	} else {
		$posted_in = __( '<a href="%3$s" title="Permalink to %4$s" rel="bookmark">URL</a>.', 'twentyten' );
	}
	// Prints the string, replacing the placeholders.
	printf(
		$posted_in,
		get_the_category_list( ', ' ),
		$tag_list,
		get_permalink(),
		the_title_attribute( 'echo=0' )
	);
}
endif;

?>