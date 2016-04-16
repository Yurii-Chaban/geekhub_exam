<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Geekhub-exam
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
			if ( is_single() ) {
				the_title( '<h1 class="entry-title">', '</h1>' );
			} else {
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			}
		?>
		<p class="blog-sign"><?php echo get_theme_mod('blog_title_sign', ''); ?></p>
		<div class="author-image"><?php $author_email = get_the_author_email(); echo get_avatar($author_email,'75');?></div>
		<div class="block-meta">
			<?php if ( 'post' === get_post_type() ) : ?>
			<h2 class="single-post-title">
				<?php the_title(); ?>
			</h2>
			<div class="entry-meta">
				<?php gh_exam_posted_on(); ?>
			</div><!-- .entry-meta -->
			<div class="single-post-img"><?php the_post_thumbnail(); ?></div>
		</div>
		<?php
		endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
			the_content( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'gh_exam' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'gh_exam' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php gh_exam_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
