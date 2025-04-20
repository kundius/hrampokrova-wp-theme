<?php
/*
Template Name: Ответы на вопросы
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

            <div class="page-content content mt-12 md:mt-16 lg:mt-24"><?php the_content(); ?></div>

            <?php if ($crb_answers = carbon_get_the_post_meta('crb_answers')): ?>
            <div class="answers-list">
                <?php foreach ($crb_answers as $answer): ?>
                <div class="answers-item">
                    <div class="answers-item__headline">
                        <?php echo $answer['question_content']; ?>
                        <span class="answers-item__arrow"></span>
                    </div>
                    <div class="answers-item__body">
                        <div class="answers-item__inner">
                            <div class="answers-item__author">
                                <div class="answers-item__author-photo">
                                    <?php echo wp_get_attachment_image(
                                      $answer['author_photo'],
                                      'original'
                                    ); ?>
                                </div>
                                <div class="answers-item__author-rank">
                                    <?php echo $answer['author_rank']; ?>
                                </div>
                                <div class="answers-item__author-name">
                                    <?php echo $answer['author_name']; ?>
                                </div>
                            </div>
                            <div class="answers-item__content">
                                <?php echo str_replace("\n", '<br>', $answer['answer_content']); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>

            <form action="<?php echo admin_url(
              'admin-ajax.php'
            ); ?>" method="post" class="question-form mt-12 md:mt-16 lg:mt-24" data-question-form>
                <input type="hidden" name="submitted" value="">
                <input type="hidden" name="nonce" value="<?php echo wp_create_nonce(
                  'question-nonce'
                ); ?>">

                <div class="question-form__title">Задать вопрос священнику</div>

                <div class="question-form__layout">
                    <div class="question-form__layout-field">
                        <div class="question-form-field">
                            <input type="text" name="client" class="question-form-field__input" placeholder="Представьтесь">
                        </div>
                    </div>
                  
                    <div class="question-form__layout-field">
                        <div class="question-form-field">
                            <input type="text" name="email" class="question-form-field__input" placeholder="Ваш e-mail">
                        </div>
                    </div>

                    <div class="question-form__layout-field question-form__layout-field_wide">
                        <div class="question-form-field">
                            <textarea type="text" name="question" class="question-form-field__textarea" placeholder="Задайте вопрос"></textarea>
                        </div>
                    </div>

                    <div class="question-form__layout-submit">
                        <div class="question-form__messages" data-question-form-messages></div>
                        <button type="submit" class="question-form__submit">Отправить</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <?php get_template_part('partials/footer'); ?>
  </div>
</body>

</html>
