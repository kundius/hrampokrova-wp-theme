<?php if (isset($args['placeholder']) && $args['placeholder']): ?>
  <div class="header-placeholder"></div>
<?php endif; ?>

<div class="header" data-sticky-header data-mobile-menu-state="closed">
  <div class="container header__container">
    <div class="header__logo">
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
    <button class="header__toggle" type="button" data-mobile-menu-open>
      <span class="header__toggle-icon">
        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="24" height="24" viewBox="0 0 50 50">
          <path fill="currentColor" d="M 0 7.5 L 0 12.5 L 50 12.5 L 50 7.5 Z M 0 22.5 L 0 27.5 L 50 27.5 L 50 22.5 Z M 0 37.5 L 0 42.5 L 50 42.5 L 50 37.5 Z"></path>
        </svg>
      </span>
      <span class="header__toggle-label">Меню</span>
    </button>
    <button class="header__overlay" type="button" data-mobile-menu-close></button>
    <div class="header__menu" data-mobile-menu>
      <?php wp_nav_menu([
        'container' => false,
        'theme_location' => 'menu-main',
      ]); ?>
      <button type="button" class="header__menu-close" data-mobile-menu-close>
        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24">
          <path fill="none" stroke="currentColor" stroke-dasharray="12" stroke-dashoffset="12" stroke-linecap="round" stroke-width="2" d="M12 12L19 19M12 12L5 5M12 12L5 19M12 12L19 5">
            <animate fill="freeze" attributeName="stroke-dashoffset" dur="0.4s" values="12;0" />
          </path>
        </svg>
      </button>
    </div>
    <a href="tel:<?php echo carbon_get_theme_option('crb_theme_phone'); ?>" class="header__phone">
      <span class="header__phone-icon">
        <?php icon('phone'); ?>
      </span>
      <span class="header__phone-text">
        <?php echo carbon_get_theme_option('crb_theme_phone'); ?>
      </span>
    </a>
  </div>
</div>