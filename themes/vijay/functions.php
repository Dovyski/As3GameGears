<?php

// Prevent Jetpack from adding Open Graph tags
// http://yoast.com/jetpack-and-wordpress-seo/
add_filter( 'jetpack_enable_opengraph', '__return_false', 99 );


// Exclude tags
function jijay_custom_tag_cloud_widget($args) {
	$aProps = get_option("vijay_props");
	$args['exclude'] = isset($aProps['tags_exclude']) ? explode(',', $aProps['tags_exclude']) : array();
	
	return $args;
}
add_filter( 'widget_tag_cloud_args', 'jijay_custom_tag_cloud_widget' );

function vijay_setup_admin_menus() {  
    add_menu_page('Theme settings', 'Vijay', 'manage_options', 'tut_theme_settings', 'vijay_theme_settings_page');  
}

add_action("admin_menu", "vijay_setup_admin_menus"); 

function vijay_theme_settings_page() {  
	$aProps = get_option("vijay_props");
	
	if (!is_array($aProps)) {
		$aProps = array();
	}
	
	if (isset($_POST["update_settings"])) {  
		unset($_POST['update_settings']);
		
		$aProps = $_POST;
		update_option("vijay_props", $aProps);
		
		echo '<div id="message" class="updated">Settings saved</div>';
	}
?>  
    <div class="wrap">  
        <?php screen_icon(); ?> <h2>Vijay Configuration</h2>  
  
        <form method="POST" action="">  
			<input type="hidden" name="update_settings" value="Y" />
			<h3>Features</h3>
            <table class="form-table">  
                <tr valign="top">  
                    <th scope="row"><label for="open_graph">Open Graph tags</label></th>  
                    <td><input type="checkbox" name="open_graph" <?php echo isset($aProps['open_graph']) && $aProps['open_graph'] ? 'checked="checked"' : ''; ?>/></td>
				</tr>
				<tr valign="top">
					<th scope="row"><label for="favicons">Favicons</label></th>  
                    <td><input type="checkbox" name="favicons"  <?php echo isset($aProps['favicons']) && $aProps['favicons'] ? 'checked="checked"' : ''; ?>/></td>  
                </tr>  
				<tr valign="top">
					<th scope="row"><label for="code_highlight">Code Highlight</label></th>  
                    <td><input type="checkbox" name="code_highlight"  <?php echo isset($aProps['code_highlight']) && $aProps['code_highlight'] ? 'checked="checked"' : ''; ?>/></td>  
                </tr>
				<tr valign="top">
					<th scope="row"><label for="tags_exclude">Tags to exclude</label></th>  
                    <td><input type="text" name="tags_exclude"  value="<?php echo @$aProps['tags_exclude']; ?>" /></td>  
                </tr>
            </table>  
			<p style="margin-top: 30px;"><input type="submit" value="Save settings" class="button-primary"/></p> 
        </form>  
    </div>  
<?php  
}

function vijay_change_favicon() { 
	$aProps = get_option("vijay_props");
	
	if(isset($aProps['favicons']) && $aProps['favicons']) {
?>
		<!-- Favicons by Vijay -->
		<link rel="shortcut icon" href="<?php bloginfo('stylesheet_directory'); ?>/img/as3gamegears.png"/>
		<link rel="icon" type="image/png" href="<?php bloginfo('stylesheet_directory'); ?>/img/as3gamegears.png"/>
		<link rel="apple-touch-icon" href="<?php bloginfo('stylesheet_directory'); ?>/img/as3gamegears.png"/>
		<!-- /Favicons by Vijay -->
<?php
	}
}

add_action('wp_head', 'vijay_change_favicon');


function vijay_hide_comments_form( $post_id ) {
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
add_action( 'comment_form_before', 'vijay_hide_comments_form' );


function vijay_code_highlight() {
	$aProps = get_option("vijay_props");
	
	if(isset($aProps['code_highlight']) && $aProps['code_highlight']) {
?>
		<!-- Code highlight by Vijay -->
		<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/js/styles/github.css">
		<script src="<?php bloginfo('stylesheet_directory'); ?>/js/highlight.pack.js"></script>
		<script>
			hljs.tabReplace = '  ';
			jQuery(document).ready(function() {
				jQuery('pre').each(function(i, e) {hljs.highlightBlock(e)});
			});
		</script>
		<!-- /Code highlight by Vijay -->
<?php
	}
}

add_action('wp_footer', 'vijay_code_highlight');


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
	return is_category() || is_single() || is_page() || is_search() || is_home() || is_404();
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
		
	} else if(is_404()) {
		$aRet['title']  = 'Oops!';
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