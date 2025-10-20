<?php
/**
 * Главная страница сайта
 * Подключает все необходимые PHP файлы
 */

// Подключаем WordPress
require_once('../../../wp-config.php');

// Подключаем основные функции темы
require_once('functions.php');

// Подключаем header
get_header();

// Получаем секции для главной страницы
$args = array(
    'post_type'     => 'section',
    'post_status'   => 'publish',
    'hierarchical'  => '0',
    'showposts'     => '-1',
    'orderby'       => 'menu_order',
    'order'         => 'ASC',
);
$posts = get_posts($args);

$countSections = count($posts);
$numSection = 1;

if ($countSections) {
    foreach ($posts as $post) {
        ?>
        <section class="page-section section-<?php echo $post->post_name; ?>" id="section-<?php echo $post->post_name; ?>">
            <?php get_template_part('template-parts/section/'.$post->post_name); ?>
        </section>
        <?php if($post->post_name == 'works') { ?>
            <?php get_template_part('template-parts/modal'); ?>
        <?php } ?>
        <?php
        $numSection++;
    }
}

// Подключаем footer
get_footer();
?>
