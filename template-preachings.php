<?php
/*
Template Name: Проповеди
*/
$preachings = new WP_Query([
  'post_type' => 'preaching',
  'orderby' => [
    'menu_order' => 'ASC',
  ],
  'paged' => get_query_var('paged') ?: 1,
]);
$pagination = [
  'total' => $preachings->max_num_pages,
  'current' => max(1, get_query_var('paged')),
  'prev_text' => '',
  'next_text' => '',
];
?>
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
                <span class="breadcrumbs__current"><?php the_title(); ?></span>
            </div>

            <h1 class="page-title"><?php the_title(); ?></h1>

            <?php if ($preachings->have_posts()): ?>
            <div class="preachings">
                <?php while ($preachings->have_posts()): ?>
                <?php $preachings->the_post(); ?>
                <div class="preachings__item">
                    <article class="preachings-card">
                        <a href="#video-<?php echo get_the_ID(); ?>" class="preachings-card__image" target="_blank" data-fslightbox="gallery">
                            <?php the_post_thumbnail('original'); ?>
                        </a>
                        <?php if ($crb_embed_url = carbon_get_the_post_meta('crb_embed_url')): ?>
                        <div class="hidden">
                            <iframe
                            src="<?php echo $crb_embed_url; ?>"
                            id="video-<?php echo get_the_ID(); ?>"
                            width="1920px"
                            height="1080px"
                            frameBorder="0"
                            allow="fullscreen"
                            allowFullScreen></iframe>
                        </div>
                        <?php endif; ?>
                    </article>
                </div>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
            </div>
            <?php if ($links = paginate_links($pagination)): ?>
            <div class="pagination mt-20">
                <?php echo $links; ?>
            </div>
            <?php endif; ?>
            <?php endif; ?>

            <div class="page-content content mt-12 md:mt-16 lg:mt-24"><?php the_content(); ?></div>
        </div>
    </div>

    <?php get_template_part('partials/footer'); ?>
  </div>
</body>

</html>
