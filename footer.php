<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Geekhub-exam
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="wrapper">
			<h1 class="logo-wrapper">
				<a class="logo" href="<?php echo home_url(); ?>">
					<?php if (get_theme_mod('geekhub_logo')) :
						echo '<img src="' . esc_url(get_theme_mod('geekhub_logo')) . '">';
					else:
						echo get_bloginfo('name') . '<span>' . get_bloginfo('description') . '</span>';
					endif; ?>
				</a>
			</h1>
			<div class="copyright">
				<?php
				if (get_theme_mod('hide_copyright') == '') { ?>
					<span class="design-sign"><?php echo __('Designed by ', 'text_domain'); ?></span>
					<?php echo get_theme_mod('copyright_year' . '') . ' '; ?>
					<a href="<?php the_permalink(); ?>"><?php echo get_theme_mod('copyright_name', '') . ' '; ?></a>
				<?php }
				?>
			</div>
			<!--Social media icon-->
			<div class="footer-social"><?php my_social_media_icons(); ?></div>
			<nav id="site-navigation" class="footer-navigation" role="navigation">
				<?php wp_nav_menu(array('theme_location' => 'primary', 'menu_id' => 'footer-menu')); ?>
			</nav><!-- #site-navigation -->
			<div class="feedback-frm"><?php echo do_shortcode('[formCustom]') ?></div>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery.flexslider.js"></script>
<script type="text/javascript">
	// Can also be used with $(document).ready()
	jQuery(window).load(function () {
		jQuery('.flexslider').flexslider({
			animation: "slide"
		});
	});
</script>

</body>
</html>
