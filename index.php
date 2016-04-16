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
            <p class="site-phone">
                <span class="fa fa-phone"></span>
                <?php echo get_theme_mod('phone', ''); ?>
            </p>

            <section class="slider-wrapper">
                <div class="flexslider">
                    <?php $query = new WP_Query(array('post_type' => 'slider', 'posts_per_page' => 3)); ?>
                    <?php if ($query->have_posts()) : ?>
                        <ul class="slideshow slides">
                            <?php while ($query->have_posts()) : $query->the_post(); ?>
                                <li class="slideshow-item">
                                    <div class="slideshow-thumbnail">
                                        <?php if (has_post_thumbnail()) {
                                            the_post_thumbnail();
                                        } ?>
                                    </div>
                                    <div class="slideshow-rollover">
                                        <h3 class="feature-title">
                                            <span class="title-sign">Welcome to</span>
                                            <?php the_title(); ?>
                                        </h3>
                                        <div
                                            class="feature-content"><?php echo wp_trim_words(get_the_content(), 15); ?></div>
                                        <a class="read-more" href="<?php the_permalink(); ?>">
                                            <?php _e('Read more', 'gh_exam'); ?>
                                        </a>
                                    </div>
                                </li>
                            <?php endwhile; ?>
                        </ul>
                    <?php else :
                        get_template_part('template-parts/content', 'none');
                    endif; ?>
                    <?php wp_reset_query(); ?>
                    </ul>
                </div>
            </section>
            <section class="about-us">
                <h2 class="about-title"><?php echo get_theme_mod('title', ''); ?></h2>
                <p class="title-sign"><?php echo get_theme_mod('title_sign', ''); ?></p>
                <p class="about-contant"><?php echo get_theme_mod('about_content', ''); ?></p>
                <a class="read-more" href="<?php the_permalink(); ?>">
                    <?php _e('Read more', 'gh_exam'); ?>
                </a>
            </section>
            <section class="services">
                <h2 class="services-title"><?php echo get_theme_mod('services_title', ''); ?></h2>
                <p class="services-sign"><?php echo get_theme_mod('services_title_sign', ''); ?></p>
                <?php $query = new WP_Query(array('post_type' => 'services', 'posts_per_page' => 4)); ?>
                <?php if ($query->have_posts()) : ?>
                    <ul class="services-item">
                        <?php while ($query->have_posts()) : $query->the_post(); ?>
                            <li <?php post_class(); ?>>
                                <?php if (has_post_thumbnail()) {
                                    the_post_thumbnail();
                                } ?>
                                <div class="rollover">
                                    <h3 class="item-title">
                                        <?php the_title(); ?>
                                    </h3>
                                </div>
                                <div class="services-content">
                                    <?php the_content(); ?>
                                </div>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                <?php else :
                    get_template_part('template-parts/content', 'none');
                endif; ?>
                <?php wp_reset_query(); ?>
                <a class="viev-more" href="<?php the_permalink(); ?>">
                    <?php _e('Viev more', 'gh_exam'); ?>
                </a>
            </section>
            <section class="clients slider-wrapper">
                <div class="flexslider">
                <h2 class="clients-title"><?php echo get_theme_mod('clients_title', ''); ?></h2>
                <p class="clients-title-sign"><?php echo get_theme_mod('clients_title_sign', ''); ?></p>
                <?php $query = new WP_Query(array('post_type' => 'clients', 'posts_per_page' => 3)); ?>
                <?php if ($query->have_posts()) : ?>
                    <ul class="clients-item slideshow-item">
                        <?php while ($query->have_posts()) : $query->the_post(); ?>
                            <li <?php post_class(); ?>>
                                <div class="clients-services-content">
                                    <?php the_content(); ?>
                                </div>
                                <div class="rollover">
                                    <div class="clients-photo">
                                        <?php if (has_post_thumbnail()) {
                                            the_post_thumbnail();
                                        } ?>
                                    </div>
                                    <h3 class="clients-item-title">
                                        <?php the_title(); ?>
                                    </h3>
                                <span class="clients-category">
                                    <?php
                                    $cats = get_categories(array(
                                        'taxonomy' => 'clients_cats',
                                        'hide_empty' => true,
                                        'title_li' => ''
                                    ));

                                    foreach ($cats as $cat) {
                                        ?>
                                        <?php echo $cat->cat_name ?>

                                        <?php
                                    }
                                    ?>
                                </span>
                                </div>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                <?php else :
                    get_template_part('template-parts/content', 'none');
                endif; ?>
                <?php wp_reset_query(); ?>
                    </div>
            </section>
            <section class="news">
                <h2 class="news-title"><?php echo get_theme_mod('news_title', ''); ?></h2>
                <p class="news-sign"><?php echo get_theme_mod('news_title_sign', ''); ?></p>
                <div class="news-blog">
                        <h2 class="main-post-title"><?php _e('Latest Blog Post', 'BlogName'); ?></h2>
                        <?php if (have_posts()):
                            while (have_posts()): the_post(); ?>
                                <div class="content-post">
                                    <a class="posted-date" href="<?php the_permalink(); ?>">
                            <span class="date">
                                <span class="date-number"><?php the_time('j'); ?></span>
                                <span class="date-month"><?php the_time('F'); ?></span>
                            </span>
                                        <ul class="post-meta">
                                            <li>
                                                <span class="fa fa-comment"></span>
                                                <a href="<?php the_permalink(); ?>">
                                                    <?php global $post;
                                                    echo $post->comment_count;
                                                    echo " comments"; ?>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="<?php the_permalink(); ?>">
                                                    <span class="fa fa-folder"></span>
                                                    <?php
                                                    $category = get_the_category();
                                                    echo " Category ";
                                                    echo $category[0]->category_count;
                                                    ?>
                                                </a>
                                            </li>
                                        </ul>
                                    </a>
                                    <div class="post-description">
                                        <div class="post-img"><?php the_post_thumbnail(); ?></div>
                                        <h2 class="post-title">
                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                        </h2>
                                        <span
                                            class="blog-date"><?php the_time('jS, F, Y') ?></span>
                                        <p><?php the_excerpt(); ?></p>
                                    </div>
                                </div>
                            <?php endwhile;
                            the_posts_pagination();

                        else: ?>
                            <p><?php _e('No content found', 'BlogName'); ?></p>
                        <?php endif; ?>
                </div>
                <a class="read-more" href="<?php the_permalink(); ?>">
                    <?php _e('Viev more', 'gh_exam'); ?>
                </a>
            </section>
            <section class="partners">
                <h2 class="partners-title"><?php echo get_theme_mod('partners_title', ''); ?></h2>
                <p class="partners-title"><?php echo get_theme_mod('partners_title_sign', ''); ?></p>
                <?php $query = new WP_Query(array('post_type' => 'partners', 'posts_per_page' => 5)); ?>
                <?php if ($query->have_posts()) : ?>
                    <ul class="services-item">
                        <?php while ($query->have_posts()) : $query->the_post(); ?>
                            <li <?php post_class(); ?>>
                                <?php if (has_post_thumbnail()) {
                                    the_post_thumbnail();
                                } ?>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                <?php else :
                    get_template_part('template-parts/content', 'none');
                endif; ?>
                <?php wp_reset_query(); ?>
            </section>
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
        </main><!-- #main -->
    </div><!-- #primary -->

<?php
get_footer();
