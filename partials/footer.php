<section class="underground" itemscope itemtype="https://schema.org/Organization">
  <div class="container underground-layout">
    <div class="underground-layout__left">
      <div class="underground-logo">
        <a href="/" class="header-logo" title="<?php bloginfo('name'); ?>">
          <img src="<?php bloginfo('template_url') ?>/dist/assets/logo-small.png" class="header-logo__image" width="68" height="68" />
          <span class="header-logo__text">
            <span class="header-logo__text__first">Русская Православная Церковь</span>
            <span class="header-logo__text__second">
              Храм Покрова<br>
              Пресвятой Богородицы
            </span>
          </span>
        </a>
      </div>

      <div class="underground-contacts">
        <div class="underground-contacts__address">
          <div class="underground-contacts__address-title">
            Адрес:
          </div>
          <div class="underground-contacts__address-content">
            <?php echo nl2br(carbon_get_theme_option('crb_theme_address')); ?>
          </div>
        </div>

        <a href="tel:<?php echo carbon_get_theme_option('crb_theme_phone'); ?>" class="underground-contacts__phone">
          <span class="underground-contacts__phone-icon">
            <?php icon('phone'); ?>
          </span>
          <span class="underground-contacts__phone-value">
            <?php echo carbon_get_theme_option('crb_theme_phone'); ?>
          </span>
        </a>

        <a href="mailto:<?php echo carbon_get_theme_option('crb_theme_email'); ?>" class="underground-contacts__email">
          <span class="underground-contacts__email-icon">
            <?php icon('mail'); ?>
          </span>
          <span class="underground-contacts__email-value">
            <?php echo carbon_get_theme_option('crb_theme_email'); ?>
          </span>
        </a>
      </div>
    </div>

    <div class="underground-layout__middle">
      <?php wp_nav_menu([
        'container' => '',
        'menu_class' => 'underground-menu',
        'theme_location' => 'menu-footer',
      ]); ?>
    </div>

    <div class="underground-layout__right">
      <div class="underground-share">
        <div class="underground-share__title">Поделиться:</div>
        <div class="underground-share__items">
          <script src="https://yastatic.net/share2/share.js"></script>
          <div class="ya-share2" data-curtain data-size="l" data-services="messenger,vkontakte,odnoklassniki,telegram"></div>
        </div>
      </div>

      <?php wp_nav_menu([
        'container' => '',
        'menu_class' => 'underground-links',
        'theme_location' => 'menu-footer-links',
      ]); ?>
    </div>
  </div>
</section>

<section class="footer">
  <div class="container footer__container">
    <div class="footer__copyright">
      <?php echo carbon_get_theme_option('crb_theme_copyright'); ?>
    </div>

    <div class="footer__middle">
      <div class="footer__counters">
        <?php echo carbon_get_theme_option('crb_theme_counters'); ?>
      </div>
      <a href="<?php the_permalink(128); ?>" class="footer__sitemap">Карта сайта</a>
    </div>

    <a href="https://domenart-studio.ru/" target="_blank" class="footer__creator">
      <img src="<?php bloginfo('template_url'); ?>/src/images/creator.png" alt="Разработка и продвижение сайтов «ДоменАРТ»" />
    </a>
  </div>
</section>

<button class="scroll-up" type="button"></button>

<?php wp_footer(); ?>