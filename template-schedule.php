<?php
/*
Template Name: Расписание
*/
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

            <h1 class="page-title mb-8"><?php the_title(); ?></h1>

            <?php if ($crb_schedule = carbon_get_the_post_meta('crb_schedule')): ?>
            <div class="schedule-weeks">
                <?php foreach ($crb_schedule as $week): ?>
                <div class="schedule-week">
                    <div class="schedule-week__title"><?php echo $week['name']; ?></div>
                    <?php if ($days = $week['days']): ?>
                    <div class="schedule-week__days">
                        <?php foreach ($days as $day):

                          $week_n = wp_date('N', strtotime($day['date']));
                          $cls = '';
                          if ($week_n == '7' || $week_n == '6') {
                            $cls = ' schedule-item_weekend';
                          }
                          ?>
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
                        <?php
                        endforeach; ?>
                    </div>
                    <?php endif; ?>
                </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>

            <div class="page-content content mt-12 md:mt-16 lg:mt-24"><?php the_content(); ?></div>
        </div>
    </div>

    <?php get_template_part('partials/footer'); ?>
  </div>
</body>

</html>
