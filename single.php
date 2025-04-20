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
          <?php if ($categories = get_the_category()): ?>
            <span class="breadcrumbs__separator"></span>
            <a href="<?php echo get_category_link($categories[0]->term_id); ?>" class="breadcrumbs__link">
              <?php echo get_cat_name($categories[0]->term_id); ?>
            </a>
          <?php endif; ?>
          <span class="breadcrumbs__separator"></span>
          <span class="breadcrumbs__current"><?php the_title(); ?></span>
        </div>

        <h1 class="page-title"><?php the_title(); ?></h1>

        <div class="page-content content mt-12 md:mt-16 lg:mt-24"><?php the_content(); ?></div>
      </div>
    </div>

    <?php get_template_part('partials/footer'); ?>
  </div>
</body>

</html>