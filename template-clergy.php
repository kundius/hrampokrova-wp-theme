<?php
/*
Template Name: Духовенство
*/
$ministers = new WP_Query([
  'post_type' => 'minister',
  'orderby' => [
    'menu_order' => 'ASC',
  ],
  'posts_per_page' => -1,
]); ?>
<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?> itemscope itemtype="http://schema.org/WebSite">

<head>
  <?php get_template_part('partials/head'); ?>
</head>

<body <?php body_class(); ?>>
  <?php wp_body_open(); ?>

  <div class="flex flex-col min-h-screen">
    <?php get_template_part('partials/header', null, ['placeholder' => true]); ?>

    <div class="pb-12 md:pb-16 lg:pb-24">
        <div class="container">
            <div class="breadcrumbs">
                <a href="<?php echo get_the_permalink(2); ?>" class="breadcrumbs__link">
                    <?php echo get_the_title(2); ?>
                </a>
                <span class="breadcrumbs__separator"></span>
                <a href="<?php echo get_the_permalink(49); ?>" class="breadcrumbs__link">
                    <?php echo get_the_title(49); ?>
                </a>
                <span class="breadcrumbs__separator"></span>
                <span class="breadcrumbs__current"><?php the_title(); ?></span>
            </div>

            <h1 class="page-title mb-8"><?php the_title(); ?></h1>

            <?php if ($ministers->have_posts()): ?>
            <div class="clergy-ministers">
                <?php while ($ministers->have_posts()): ?>
                <?php $ministers->the_post(); ?>
                <div class="clergy-ministers__item">
                    <article class="clergy-minister">
                        <figure class="clergy-minister__image">
                            <?php the_post_thumbnail('original'); ?>
                        </figure>
                        <?php if ($rank = carbon_get_the_post_meta('crb_rank')): ?>
                        <div class="clergy-minister__rank"><?php echo $rank; ?></div>
                        <?php endif; ?>
                        <div class="clergy-minister__name"><?php the_title(); ?></div>
                        <?php if ($description = carbon_get_the_post_meta('crb_description')): ?>
                        <div class="clergy-minister__description"><?php echo $description; ?></div>
                        <?php endif; ?>
                        <div class="clergy-minister__grow"></div>
                        <a href="<?php the_permalink(); ?>" class="clergy-minister__details">
                            <span>Подробнее</span>
                        </a>
                    </article>
                </div>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
            </div>
            <?php endif; ?>

            <div class="page-content content mt-12 md:mt-16 lg:mt-24"><?php the_content(); ?></div>
        </div>
    </div>

    <?php get_template_part('partials/footer'); ?>
  </div>
</body>

</html>
