<?php
$photoalbums = new WP_Query([
  'post_type' => 'photoalbum',
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
                <a href="<?php echo get_the_permalink(339); ?>" class="breadcrumbs__link">
                    <?php echo get_the_title(339); ?>
                </a>
                <span class="breadcrumbs__separator"></span>
                <span class="breadcrumbs__current"><?php the_title(); ?></span>
            </div>

            <h1 class="page-title mb-8">
                <?php echo carbon_get_the_post_meta('crb_rank'); ?>
                <span class="inline-block"><?php the_title(); ?></span>
            </h1>
            
            <?php if ($crb_media_gallery = carbon_get_the_post_meta('crb_media_gallery')): ?>
              <div class="photoalbum-carousel">
                <div class="photoalbum-carousel-main">
                  <div class="photoalbum-carousel-main__viewport" data-photoalbum-main>
                    <div class="photoalbum-carousel-main__container">
                      <?php foreach ($crb_media_gallery as $crb_media_gallery_id): ?>
                        <div class="photoalbum-carousel-main__slide">
                          <a href="<?php echo wp_get_attachment_url($crb_media_gallery_id) ?>" class="photoalbum-carousel-main__slide__image" target="_blank" data-fslightbox="photoalbum">
                            <img src="<?php echo wp_get_attachment_image_url($crb_media_gallery_id, 'large-crop') ?>" alt="">
                            <span class="photoalbum-carousel-main__slide__image__loupe">
                              <?php icon('loupe'); ?>
                            </span>
                          </a>
                        </div>
                      <?php endforeach; ?>
                    </div>
                    <button type="button" data-photoalbum-main-prev class="photoalbum-carousel-main__prev"></button>
                    <button type="button" data-photoalbum-main-next class="photoalbum-carousel-main__next"></button>
                  </div>
                  <div class="photoalbum-carousel-thumbs">
                    <div class="photoalbum-carousel-thumbs__viewport" data-photoalbum-thumbs>
                      <div class="photoalbum-carousel-thumbs__container">
                        <?php foreach ($crb_media_gallery as $crb_media_gallery_id): ?>
                          <div class="photoalbum-carousel-thumbs__slide">
                            <button class="photoalbum-carousel-thumbs__slide__thumb">
                              <img src="<?php echo wp_get_attachment_image_url($crb_media_gallery_id, 'small') ?>" alt="">
                            </button>
                          </div>
                        <?php endforeach; ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            <?php endif; ?>

            <div class="page-content content"><?php the_content(); ?></div>
        </div>
    </div>

    <?php get_template_part('partials/footer'); ?>
  </div>
</body>

</html>
