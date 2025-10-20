<?php global $cmsSettings; ?>

	<!-- Footer -->
	<footer>
		<div class="container">
			<div class="row">
				<div class="offset-1 col-11 col-md-3 offset-md-3 col-lg-2 offset-lg-2">
					<!-- Copyright -->
					<div class="footer-copyright">
						Copyright &copy;
						<?php
						echo $cmsSettings['footer_copyright']?$cmsSettings['footer_copyright'].' ':$cmsSettings['contacts_company'].' '; 
						if ($cmsSettings['footer_start_year'] == date('Y')) {
							echo $cmsSettings['footer_start_year'];
						} else {
							echo $cmsSettings['footer_start_year']?$cmsSettings['footer_start_year'].'-':''; echo date('Y');
						}
						?>
					</div>
					<!-- /copyright -->
				</div>
				<?php if ($cmsSettings['footer_offer']) { ?>
				<!-- Offer -->
				<div class="offer offset-1 col-11 offset-md-0 col-md-6 offset-lg-2 col-lg-6 text-right">
					<?php echo $cmsSettings['footer_offer']; ?>
				</div>
				<!-- /offer -->
				<?php } ?>
			</div>
		</div>
	</footer>
	<!-- /footer -->
<div class="modal fade" id="partnerModal" data-toggle="modal" tabindex="-1" role="document" aria-labelledby="partnerModalTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="embed-responsive embed-responsive-16by9">
                <iframe id="pdf-frame" src="" class="embed-responsive-item"></iframe>
            </div>
        </div>
    </div>
</div>

<!-- Grid background -->
<div class="grid-container container">
	<div class="row">
		<div class="col-1 col-md-3 col-lg-2 col-sidebar"></div>
		<div class="col-1 col-md-3 col-lg-2"></div>
		<div class="d-none d-md-block col-md-3 col-lg-2"></div>
		<div class="d-none d-md-block col-md-3 col-lg-2"></div>
		<div class="d-none d-lg-block col-lg-2"></div>
		<div class="d-none d-lg-block col-lg-2"></div>
	</div>
</div>
<!-- /grid background -->


<?php get_template_part('template-parts/forms'); ?>

<?php wp_footer(); ?>

<?php
$args = array(
				'post_type'		=> 'works',
				'post_status'	=> 'publish',
				'hierarchical'	=> '0',
				'showposts'		=> '-1',
				'orderby'		=> 'menu_order',
				'order'			=> 'ASC'
			);
$works = get_posts($args);
$totalCount = count($works);
?>
<?php /* if ($works) { ?>
	<script type="text/javascript">
		(function ($) {
			$(document).ready(function () {
		
				$(function(){
					$("#elastic_grid_demo").elastic_grid({
						'showAllText' : 'All',
						'filterEffect': 'popup', // moveup, scaleup, fallperspective, fly, flip, helix , popup
						'hoverDirection': true,
						'hoverDelay': 0,
						'hoverInverse': false,
						'expandingSpeed': 500,
						'expandingHeight': 500,
						'items' :
						[
							<?php
							foreach ($works as $work) {
								$descriptionText	= get_field('work-description', $work->ID);
								$material			= get_field('work-material', $work->ID);
								$size				= get_field('work-size', $work->ID);
								$gallery			= get_field('work-gallery', $work->ID);
								$price				= get_field('work-price', $work->ID);
								$photoFull			= get_the_post_thumbnail_url($work->ID, 'full');
								$photoSmall			= get_the_post_thumbnail_url($work->ID, 'gallery-thumb');
								
								$thumbsSmall = "'".$photoSmall."', ";
								$thumbsBig = "'".$photoFull."', ";
								if ($gallery) {
									foreach ($gallery as $pic) {
										//var_dump($pic);
										$thumbsSmall .= "'".$pic['sizes']["thumbnail"]."', ";
										$thumbsBig .= "'".$pic['url']."', ";
									}
								}
								$thumbsSmall = substr_replace($thumbsSmall, '', strlen($thumbsSmall)-2);
								$thumbsBig = substr_replace($thumbsBig, '', strlen($thumbsBig)-2);
								
								$description = '';
								$descriptionText = str_replace(array("\n", "\r"), '', $descriptionText);
								
								if ($descriptionText) {
									$description .= '<div class="work-description">'.$descriptionText.'</div>';
								}
								
								if ($material) {
									$material = implode(', ', $material);
									$description .= '<p class="material data"><label>Материал:</label> '.$material.'</p>';
								}
								
								if ($size) {
									$description .= '<p class="size data"><label>Размер:</label>'.$size.'</p>';
								}
								
								if ($price) {
									$description .= '<p class="price data"><label>Цена:</label>'.$price.'</p>';
								}
								
								?>
								{
									'title'         : '<?php echo $work->post_title; ?>',
									'description'   : '<?php echo $description; ?>',
									'thumbnail'     : [<?php echo $thumbsSmall; ?>],
									'large'         : [<?php echo $thumbsBig; ?>],
									'img_title'     : ['jquery elastic grid 1 ', 'jquery elastic grid 2', 'jquery elastic grid 3', 'jquery elastic grid 4', 'jquery elastic grid 5'],
									'tags'          : ['Self Portrait']
								},
								<?php } ?>
						]
					});
				});
			});
		})(jQuery);
	</script>
<?php } */?>
</body>
</html>
