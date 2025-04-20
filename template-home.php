<?php
/*
Template Name: Главная
*/

$photoalbum = new WP_Query([
  'post_type' => 'photoalbum',
  'orderby' => [
    'menu_order' => 'ASC',
  ],
  'posts_per_page' => 1,
]);

$preachings = new WP_Query([
  'post_type' => 'preaching',
  'orderby' => [
    'menu_order' => 'ASC',
  ],
  'posts_per_page' => 6,
]);

$schedule_days = [];
if ($crb_schedule = carbon_get_post_meta(107, 'crb_schedule')) {
  foreach ($crb_schedule as $week) {
    if ($days = $week['days']) {
      foreach ($days as $day) {
        if (strtotime('now') < strtotime($day['date'])) {
          $schedule_days[] = $day;
        }
      }
    }
  }
}

$query_params = [
  'post_type' => 'post',
  'orderby' => [
    'is_sticky' => 'DESC',
    'date' => 'DESC',
  ],
  'posts_per_page' => 3,
  'tax_query' => [
    'relation' => 'AND',
    [
      'taxonomy' => 'category',
      'field' => 'id',
      'terms' => [5]
    ]
  ]
];
$events = new WP_Query($query_params);
?>
<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?> itemscope itemtype="http://schema.org/WebSite">

<head>
  <?php get_template_part('partials/head'); ?>
</head>

<body <?php body_class(); ?>>
  <?php wp_body_open(); ?>

  <div class="flex flex-col min-h-screen">
    <?php get_template_part('partials/header'); ?>

    <div class="home-intro">
      <div class="container">
        <div class="home-intro__content">
          <div class="home-intro__desc">
            Русская Православная Церковь
          </div>
          <div class="home-intro__title">
            Храм<br>
            Покрова Пресвятой<br>
            Богородицы
          </div>
        </div>
        <div class="home-intro__arrow"></div>
      </div>
    </div>

    <div class="home-about-section">
      <div class="container">
        <div class="home-about">
          <div class="home-abount__content">
            <div class="home-about__desc">
              По благословению Высокопреосвященнейшего ЛЕОНТИЯ, митрополита Воронежского и Лискинского
            </div>
            <div class="home-about__title">
              Приют в Отрадном
            </div>
            <div class="home-about__donations">
              <a href="<?php the_permalink(118); ?>">
                Пожертвование
              </a>
            </div>
            <div class="home-about__more">
              <a href="<?php the_permalink(299); ?>" class="ui-more">Подробнее<span class="ui-more__arrow"></span></a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="home-schedule-section">
      <div class="container">
        <div class="home-schedule-section__title">
          Расписание богослужений в храме<br>
          Покрова Пресвятой Богородицы
        </div>

        <div class="schedule-carousel">
          <div class="schedule-carousel__view" data-schedule-carousel>
            <div class="schedule-carousel__container">

              <?php foreach ($schedule_days as $day):

                $week_n = wp_date('N', strtotime($day['date']));
                $cls = '';
                if ($week_n == '7' || $week_n == '6') {
                  $cls = ' schedule-item_weekend';
                }
              ?>
                <div class="schedule-carousel__slide">
                  <div class="schedule-item<?php echo $cls; ?>">
                    <div class="schedule-item__title">
                      <?php echo wp_date('l', strtotime($day['date'])); ?>
                    </div>
                    <div class="schedule-item__date">
                      <?php echo wp_date('j F Y', strtotime($day['date'])); ?>
                    </div>
                    <div class="schedule-item__desc">
                      <?php echo $day['desc']; ?>
                    </div>
                    <?php if ($parts = $day['parts']): ?>
                      <div class="schedule-item__rows">
                        <?php foreach ($parts as $part): ?>
                          <div class="schedule-item__row">
                            <div class="schedule-item__row-title">
                              <?php echo $part['name']; ?>
                            </div>
                            <?php if ($items = $part['items']): ?>
                              <?php foreach ($items as $item): ?>
                                <div class="schedule-item__row-content">
                                  <div class="schedule-item__row-time">
                                    <?php echo $item['time']; ?>
                                  </div>
                                  <div class="schedule-item__row-arrow"></div>
                                  <div class="schedule-item__row-name">
                                    <?php echo $item['name']; ?>
                                  </div>
                                </div>
                              <?php endforeach; ?>
                            <?php endif; ?>
                          </div>
                        <?php endforeach; ?>
                      </div>
                    <?php endif; ?>
                  </div>
                </div>
              <?php
              endforeach; ?>

            </div>
          </div>

          <button type="button" data-schedule-carousel-prev class="carousel__nav-prev"></button>
          <button type="button" data-schedule-carousel-next class="carousel__nav-next"></button>
        </div>

        <div class="home-schedule-section__more">
          <a href="<?php the_permalink(107); ?>" class="ui-more">Полное расписание</a>
        </div>
      </div>
    </div>

    <?php if ($events->have_posts()): ?>
      <div class="home-events-section">
        <div class="container">
          <div class="home-events-section__headline">
            <div class="home-events-section__headline-content">
              <div class="home-events-section__headline-title">
                События
              </div>
              <a href="<?php echo get_category_link(5); ?>" class="home-events-section__headline-more">смотреть все</a>
            </div>
          </div>

          <div class="grid grid-cols-3 gap-6 max-lg:grid-cols-2 max-md:grid-cols-1">
            <?php while ($events->have_posts()): ?>
              <?php $events->the_post(); ?>
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

          <div class="home-events-section__more">
            <a href="<?php echo get_category_link(5); ?>" class="ui-more">Подробнее<span class="ui-more__arrow"></span></a>
          </div>
        </div>
      </div>
    <?php endif; ?>

    <?php if ($preachings->have_posts()): ?>
      <div class="home-preaching-section">
        <div class="container">
          <div class="home-preaching-section__headline">
            <div class="home-preaching-section__headline-content">
              <div class="home-preaching-section__headline-title">
                Проповеди
              </div>
              <a href="<?php the_permalink(
                          90
                        ); ?>" class="home-preaching-section__headline-more">смотреть все</a>
            </div>
          </div>

          <div class="home-preaching-carousel">
            <div class="home-preaching-carousel__view" data-home-preaching-carousel>
              <div class="home-preaching-carousel__container">
                <?php while ($preachings->have_posts()): ?>
                  <?php $preachings->the_post(); ?>
                  <div class="home-preaching-carousel__slide">
                    <div class="home-preaching-section__item">
                      <a href="#video-<?php echo get_the_ID(); ?>" target="_blank" data-fslightbox="gallery" class="home-preaching-section__item-link">
                        <?php the_post_thumbnail('original'); ?>
                        <span class="home-preaching-section__item-play"></span>
                      </a>
                      <?php if (
                        $crb_embed_url = carbon_get_the_post_meta('crb_embed_url')
                      ): ?>
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
                    </div>
                  </div>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
              </div>
            </div>

            <button type="button" data-home-preaching-carousel-prev class="carousel__nav-prev"></button>
            <button type="button" data-home-preaching-carousel-next class="carousel__nav-next"></button>
          </div>

          <div class="home-preaching-section__more">
            <a href="<?php the_permalink(90); ?>" class="ui-more">Подробнее<span class="ui-more__arrow"></span></a>
          </div>
        </div>
      </div>
    <?php endif; ?>

    <?php if ($photoalbum->have_posts()): ?>
      <div class="home-photoalbum-section">
        <div class="container">
          <div class="home-photoalbum-section__headline">
            <div class="home-photoalbum-section__headline-content">
              <div class="home-photoalbum-section__headline-title">
                Фотогалерея
              </div>
              <a href="<?php the_permalink(339); ?>" class="home-photoalbum-section__headline-more">смотреть все</a>
            </div>
          </div>

          <?php while ($photoalbum->have_posts()): ?>
            <?php $photoalbum->the_post(); ?>
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
          <?php endwhile; ?>
          <?php wp_reset_postdata(); ?>
        </div>
      </div>
    <?php endif; ?>

    <div class="home-music-section">
      <div class="container">
        <div class="home-music-section__grid">
          <div class="home-music-section__grid__cell">
            <div class="sunday-school-card">
              <div class="sunday-school-card__title">Воскресная школа</div>
              <div class="sunday-school-card__more">
                <a href="<?php the_permalink(116); ?>" class="ui-more">Подробнее<span class="ui-more__arrow"></span></a>
              </div>
            </div>
          </div>

          <div class="home-music-section__grid__cell">
            <div class="donation-card">
              <div class="donation-card__title">Пожертвование</div>
              <div class="donation-card__more">
                <a href="<?php the_permalink(118); ?>" class="ui-more">Подробнее<span class="ui-more__arrow"></span></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php get_template_part('partials/footer'); ?>
  </div>
</body>

</html>