<?php
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
                <a href="<?php echo get_the_permalink(64); ?>" class="breadcrumbs__link">
                    <?php echo get_the_title(64); ?>
                </a>
                <span class="breadcrumbs__separator"></span>
                <span class="breadcrumbs__current"><?php the_title(); ?></span>
            </div>

            <h1 class="page-title mb-8">
                <?php echo carbon_get_the_post_meta('crb_rank'); ?>
                <span class="inline-block"><?php the_title(); ?></span>
            </h1>

            <div class="minister-details">
                <?php if ($description = carbon_get_the_post_meta('crb_description')): ?>
                <div class="minister-details__description">
                    <?php echo $description; ?>
                </div>
                <?php endif; ?>
                <figure class="minister-details__photo">
                    <?php the_post_thumbnail('original'); ?>
                </figure>
            </div>

            <div class="page-content content"><?php the_content(); ?></div>

            <?php if ($crb_awards = carbon_get_the_post_meta('crb_awards')): ?>
            <div class="minister-awards">
                <div class="minister-awards__title">Имеет церковные <span class="inline-block">и государственные награды:</span></div>
                <div class="minister-awards__items">
                    <?php foreach ($crb_awards as $key => $crb_rite): ?>
                    <div class="minister-awards__item">
                        <div class="minister-awards__item-text">
                            <?php echo $crb_rite['name']; ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <?php get_template_part('partials/footer'); ?>
  </div>
</body>

</html>
