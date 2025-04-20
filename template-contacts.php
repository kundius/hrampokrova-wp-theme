<?php
/*
Template Name: Контакты
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


            <h1 class="page-title"><?php the_title(); ?></h1>

            <div class="page-content content"><?php the_content(); ?></div>

            <div class="contacts">
                <div class="contacts-data">
                    <div class="contacts-data__address">
                        <div class="contacts-data__address-title"><span>Адрес:</span></div>
                        <div class="contacts-data__address-content">
                            <?php echo nl2br(carbon_get_theme_option('crb_theme_address')); ?>
                        </div>
                    </div>

                    <a href="tel:<?php echo carbon_get_theme_option(
                      'crb_theme_phone'
                    ); ?>" class="contacts-data__phone">
                        <span class="contacts-data__phone-icon">
                            <?php icon('phone'); ?>
                        </span>
                        <span class="contacts-data__phone-value">
                            <?php echo carbon_get_theme_option('crb_theme_phone'); ?></span>
                    </a>

                    <a href="mailto:<?php echo carbon_get_theme_option(
                      'crb_theme_email'
                    ); ?>" class="contacts-data__email">
                        <span class="contacts-data__email-icon">
                            <?php icon('mail'); ?>
                        </span>
                        <span class="contacts-data__email-value"><?php echo carbon_get_theme_option(
                          'crb_theme_email'
                        ); ?></span>
                    </a>
                </div>

                <?php if ($items = carbon_get_theme_option('crb_theme_social')): ?>
                <div class="contacts-social">
                    <div class="contacts-social__title"><span>В соцсетях:</span></div>
                    <div class="contacts-social__items">
                        <?php foreach ($items as $key => $item): ?>
                        <a class="contacts-social__item" href="<?php echo $item[
                          'url'
                        ]; ?>" target="_blank">
                            <?php echo wp_get_attachment_image($item['icon'], 'original'); ?>
                        </a>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>
                <?php if ($map = carbon_get_theme_option('crb_theme_map')): ?>
                <div class="contacts-map">
                    <?php echo $map; ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <?php get_template_part('partials/footer'); ?>
  </div>
</body>

</html>
