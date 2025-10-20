<?php
/*
Template Name: Главная
*/

get_header();

$args = array(
				'post_type'		=> 'section',
				'post_status'	=> 'publish',
				'hierarchical'	=> '0',
				'showposts'		=> '-1',
				'orderby'		=> 'menu_order',
				'order'         => 'ASC',
			);
$posts = get_posts($args);

$countSections = count($posts);
$numSection = 1;

if ($countSections) {
	foreach ($posts as $post) {
		/*if ($post->post_name != 'works') {
			continue;
		}*/
?>
	<section class="page-section section-<?php echo $post->post_name; ?>" id="section-<?php echo $post->post_name; ?>">
		<?php get_template_part( 'template-parts/section/'.$post->post_name); ?>
	</section>
    <?php if($post->post_name == 'works') {?>
        <?php get_template_part('template-parts/modal'); ?>
    <?php }?>
<?php
		$numSection++;
	}
}
?>

<?php get_footer(); ?>
