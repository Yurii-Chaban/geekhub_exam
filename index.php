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

    <div id="home primary" class="content-area">
        <main id="main" class="site-main" role="main">
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
                                        <a class="read-more-slider" href="<?php the_permalink(); ?>">
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
            <section id="about" class="about-us">
                <div class="wrapper">
                    <div class="left-block">
                        <h2 class="about-title"><?php echo get_theme_mod('title', ''); ?></h2>
                        <p class="title-sign"><?php echo get_theme_mod('title_sign', ''); ?></p>
                    </div>
                    <div class="right-block">
                        <p class="about-contant"><?php echo get_theme_mod('about_content', ''); ?></p>
                        <a class="about-read-more" href="<?php the_permalink(); ?>">
                            <?php _e('Read more', 'gh_exam'); ?>
                        </a>
                    </div>
                </div>
            </section>
            <section id="services" class="services">
                <div class="wrapper">
                    <h2 class="services-title"><?php echo get_theme_mod('services_title', ''); ?></h2>
                    <p class="services-sign"><?php echo get_theme_mod('services_title_sign', ''); ?></p>
                    <?php $query = new WP_Query(array('post_type' => 'services', 'posts_per_page' => 4)); ?>
                    <?php if ($query->have_posts()) : ?>
                        <ul class="services-item">
                            <?php while ($query->have_posts()) : $query->the_post(); ?>
                                <li <?php post_class(); ?>>
                                    <div class="post-img">
                                        <?php if (has_post_thumbnail()) {
                                            the_post_thumbnail();
                                        } ?>
                                    </div>
                                    <div class="rollover">
                                        <h3 class="item-title">
                                            <?php the_title(); ?>
                                        </h3>
                                        <div class="services-content">
                                            <?php the_content(); ?>
                                        </div>
                                    </div>
                                </li>
                            <?php endwhile; ?>
                        </ul>
                    <?php else :
                        get_template_part('template-parts/content', 'none');
                    endif; ?>
                    <?php wp_reset_query(); ?>
                    <a class="services-viev-more" href="<?php the_permalink(); ?>">
                        <?php _e('Viev more', 'gh_exam'); ?>
                    </a>
                </div>
            </section>
            <section id="tesimonial" class="clients slider-wrapper">
                <div class="wrapper">
                    <div class="flexslider">
                        <h2 class="clients-title"><?php echo get_theme_mod('clients_title', ''); ?></h2>
                        <p class="clients-title-sign"><?php echo get_theme_mod('clients_title_sign', ''); ?></p>
                        <?php $query = new WP_Query(array('post_type' => 'clients', 'posts_per_page' => 3)); ?>
                        <?php if ($query->have_posts()) : ?>
                            <ul class="clients-item">
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
                </div>
            </section>
            <section id="blog" class="news">
                <div class="wrapper">
                    <h2 class="news-title"><?php echo get_theme_mod('news_title', ''); ?></h2>
                    <p class="news-sign"><?php echo get_theme_mod('news_title_sign', ''); ?></p>
                    <div class="news-blog">
                        <div class="post-meta-single">
                            <?php if (have_posts()):
                            while (have_posts()):
                            the_post(); ?>
                            <ul class="content-post">
                                <li>
                                    <a class="posted-date" href="<?php the_permalink(); ?>">
                            <span class="date">
                                <span class="date-number"><?php the_time('j'); ?></span>
                                <span class="date-month"><?php the_time('F'); ?></span>
                            </span>
                                    </a>
                                </li>
                                <li>
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
                                </li>
                            </ul>
                            <div class="post-description">
                                <div class="post-img"><?php the_post_thumbnail(); ?></div>
                                <h2 class="post-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h2>
                                <span class="blog-date"><?php the_time('jS, F, Y') ?></span>
                                <p class="post-content-single"><?php the_excerpt(); ?></p>
                            </div>
                        </div>
                        <?php endwhile;
                        the_posts_pagination();

                        else: ?>
                            <p><?php _e('No content found', 'BlogName'); ?></p>
                        <?php endif; ?>
                        <a class="news-viev-more" href="<?php the_permalink(); ?>">
                            <?php _e('Viev more', 'gh_exam'); ?>
                        </a>
                    </div>
                </div>
            </section>
            <section id="partners" class="partners">
                <div class="wrapper">
                    <h2 class="partners-title"><?php echo get_theme_mod('partners_title', ''); ?></h2>
                    <p class="partners-title-sign"><?php echo get_theme_mod('partners_title_sign', ''); ?></p>
                    <?php $query = new WP_Query(array('post_type' => 'partners', 'posts_per_page' => 5)); ?>
                    <?php if ($query->have_posts()) : ?>
                        <ul class="partners-item">
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
                </div>
            </section>
        </main><!-- #main -->
    </div><!-- #primary -->

<?php
get_footer();
