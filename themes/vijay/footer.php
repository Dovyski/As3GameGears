<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content
 * after.  Calls sidebar-footer.php for bottom widgets.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
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

		<div id="foot">
			<p>
				&copy; <?php echo date('Y');?> As3GameGears - Boost your tools!<br/>
				Powered by <a href="http://wordpress.org" target="_blank">WordPress</a> with theme based on Salju, by <a class="wpcharity" href="http://wpcharity.com" target="_blank">WPCharity</a>
			</p>
		</div><!-- foot -->
		</div><!-- #colophon -->
	</div><!-- #footer -->

</div><!-- #wrapper -->
</div><!-- #outer-wrapper -->
<?php
	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */

	wp_footer();
?>
</body>
</html>
