<?php
$category = get_queried_object();
$query_params = [
  'post_type' => 'post',
  'orderby' => [
    'is_sticky' => 'DESC',
    'date' => 'DESC',
  ],
  'paged' => get_query_var('paged') ?: 1,
  'tax_query' => [
    'relation' => 'AND',
    [
      'taxonomy' => $category->taxonomy,
      'field' => 'id',
      'terms' => [$category->term_id]
    ]
  ]
];
$articles = new WP_Query($query_params);
$pagination = [
  'prev_text' => '',
  'next_text' => '',
  'total' => $articles->max_num_pages,
  'current' => max(1, get_query_var('paged'))
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
          <span class="breadcrumbs__current"><?php single_term_title(); ?></span>
        </div>

        <h1 class="page-title"><?php single_term_title(); ?></h1>

        <?php if ($articles->have_posts()): ?>
          <div class="grid grid-cols-3 gap-6 max-lg:grid-cols-2 max-md:grid-cols-1">
            <?php while ($articles->have_posts()): ?>
              <?php $articles->the_post(); ?>
              <article class="archive-card">
                <figure class="archive-card__image">
                  <img src="<?php the_post_thumbnail_url('archive'); ?>" alt="<?php the_title(); ?>" class="archive-card__image__img" />
                  <div class="archive-card__date">
                    <?php echo get_the_date('d F Y'); ?>
                  </div>
                </figure>
                <div class="archive-card__body">
                  <h2 class="archive-card__title"><?php the_title(); ?></h2>
                  <div class="archive-card__excerpt">
                    <?php the_excerpt(); ?>
                  </div>
                  <div class="archive-card__more">
                    <a href="<?php the_permalink(); ?>">
                      <span>подробнее</span>
                    </a>
                  </div>
                </div>
              </article>
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
          </div>

          <?php if ($links = paginate_links($pagination)): ?>
            <div class="my-10 pagination">
              <?php echo $links; ?>
            </div>
          <?php endif; ?>
        <?php endif; ?>

        <div class="page-content content mt-12 md:mt-16 lg:mt-24"><?php echo term_description(); ?></div>
      </div>
    </div>

    <?php get_template_part('partials/footer'); ?>
  </div>
</body>

</html>