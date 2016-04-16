<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Geekhub-exam
 */

get_header(); ?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">
            <!-- LOGO -->
            <h1 class="logo-wrapper">
                <a class="logo" href="<?php echo home_url(); ?>">
                    <?php if (get_theme_mod('geekhub_logo')) :
                        echo '<img src="' . esc_url(get_theme_mod('geekhub_logo')) . '">';
                    else:
                        echo get_bloginfo('name') . '<span>' . get_bloginfo('description') . '</span>';
                    endif; ?>
                </a>
            </h1>
            <?php
            if (have_posts()) :

                if (is_home() && !is_front_page()) : ?>
                    <header>
                        <h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
                    </header>

                    <?php
                endif;

                /* Start the Loop */
                while (have_posts()) : the_post();

                    /*
                     * Include the Post-Format-specific template for the content.
                     * If you want to override this in a child theme, then include a file
                     * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                     */
                    get_template_part('template-parts/content', get_post_format());

                endwhile;

                the_posts_navigation();

            else :

                get_template_part('template-parts/content', 'none');

            endif; ?>
            <!-- Custom fields -->
            <ul class="contact-info">
                <li id="contact-name"><span class="fa fa-user"> </span> <?php echo get_theme_mod('name', ''); ?>
                </li>
                <li id="contact-address"><span class="fa fa-map-marker"> </span> <a
                        href="<?php echo get_theme_mod('address-map', ''); ?>"><?php echo get_theme_mod('address', ''); ?></a>
                </li>
                <li id="contact-mail"><span class="fa fa-envelope-o"> </span> <a
                        href="mailto:<?php echo get_theme_mod('mail', ''); ?>"><?php echo get_theme_mod('mail', ''); ?></a>
                </li>
            </ul>
            <?php echo get_theme_mod('address-iframe', ''); ?>
            <!--Social media icon-->
            <?php my_social_media_icons(); ?>
            <!--Copyright-->
            <div class="copyright">
                <?php
                if (get_theme_mod('hide_copyright') == '') { ?>
                    <span class="design-sign"><?php echo __('Designed by ', 'text_domain'); ?></span>
                    <?php echo get_theme_mod('copyright_year' . '') . ' '; ?>
                    <a href="<?php the_permalink(); ?>"><?php echo get_theme_mod('copyright_name', '') . ' '; ?></a>
                <?php }
                ?>
            </div>
        </main><!-- #main -->
    </div><!-- #primary -->

<?php
get_footer();
