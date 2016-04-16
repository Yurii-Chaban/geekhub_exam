<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Geekhub-exam
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
				<?php if (get_theme_mod('gootheme_blog')) :
					echo '<img src="' . esc_url(get_theme_mod('gootheme_blog')) . '">';
				else:
					echo get_bloginfo('name') . '<span>' . get_bloginfo('description') . '</span>';

				endif; ?>
			<div class="wrapper">

				<?php
				while ( have_posts() ) : the_post();

					get_template_part( 'template-parts/content', get_post_format() ); ?>


					<?php the_post_navigation();

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;

				endwhile; // End of the loop.
				?>
			</div>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
