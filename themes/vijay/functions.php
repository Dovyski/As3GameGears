<?php
function childtheme_favicon() { ?>
	<link rel="shortcut icon" href="<?php echo bloginfo('stylesheet_directory') ?>/img/wpcharity.png" >
<?php }
add_action('wp_head', 'childtheme_favicon');


function test( $post_id ) {
    echo '<div id="comment-switch" style="margin-bottom: 40px;"><a href="#"><h3 id="reply-title"><span>Click here to post a comment</span></h3></a></div>';
	echo "<script type=\"text/javascript\">
            jQuery(document).ready(function () {
				jQuery('#comment-switch').on('hover', function() {
					jQuery('#comment-switch').hide();
					jQuery('#respond').slideDown();
				});  
			});
        </script>";
}
add_action( 'comment_form_before', 'test' );


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
	global $post;
	$aClass = '';
	
	if(is_category()) {
		$aClass = 'header-bg-category';
	} else if(is_single()) {
		$aClass = 'header-bg-item';
	} else if(is_page()) {
		$aClass = 'header-bg-' . $post->post_name;
	} else if(is_search()) {
		$aClass = 'header-bg-search';
	}
	
	echo 'class="'.$aClass.'"';
}
endif;


if ( ! function_exists( 'vijay_has_custom_site_title' ) ) :
/**
 *
*
* @since Twenty Ten 1.0
*/
function vijay_has_custom_site_title() {
	return is_category() || is_single() || is_page() || is_search() || is_home();
}
endif;


if ( ! function_exists( 'vijay_get_site_title_info' ) ) :
/**
 *
*
* @since Twenty Ten 1.0
*/
function vijay_get_site_title_info() {
	global $post;
	$aRet = array('title' => '', 'desc' => '', 'class' => '', 'style' => '');	

	if(is_category()) {
		$aCat 			= get_category( get_query_var( 'cat' ) );
		$aRet['title']  = $aCat->name;
		$aRet['desc']	= $aCat->description;
		$aRet['class']	= 'site-title-category';
		
	} else if(is_single()){
		$aRet['title']  = $post->post_title;
	
	} else if(is_page()){
		$aRet['title']  = $post->post_title;
		$aRet['desc']	= $post->post_excerpt;
		
	} else if(is_search()) {
		$aRet['title']  = 'Search';
		
	} else if(is_home()) {
		$aRet['title']  = 'Blog';
	}
	
	$aRet['style'] = strlen($aRet['title']) >= 20 ? 'font-size: 50px !important;' : $aRet['style'];
	$aRet['style'] = strlen($aRet['title']) >= 30 ? 'font-size: 40px !important;' : $aRet['style'];
	
	return $aRet;
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