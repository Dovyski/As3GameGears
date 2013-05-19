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
				Powered by <a href="http://wordpress.org" target="_blank">WordPress</a> with theme based on Salju, by <a class="wpcharity" href="http://wpcharity.com" target="_blank">WPCharity</a>. All information on this website is provided "as is" with no guarantees (see <a href="http://www.as3gamegears.com/disclaimer" target="_blank">disclaimer page</a>).
			</p>
		</div><!-- foot -->
		<div id="footer-ad"><?php $aProps = get_option("vijay_props"); echo $aProps['footer_ad']; ?></div>
		</div><!-- #colophon -->
	</div><!-- #footer -->

</div><!-- #wrapper -->
</div><!-- #outer-wrapper -->

<!-- As3GameGears Tooltip - api.as3gamegears.com/#js -->
<script src="http://api.as3gamegears.com/js/as3gamegears.min.js"></script>
<script>As3GameGears.tooltip();</script>
<?php
	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */

	wp_footer();
?>
</body>
</html>
