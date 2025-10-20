<?php
/**
 * Шаблон для отображения отдельных товаров
 */

get_header();

if (have_posts()) {
    while (have_posts()) {
        the_post();
        
        // Получаем данные товара
        $descriptionText = get_field('work-description', get_the_ID());
        $material = get_field('work-material', get_the_ID());
        $size = get_field('work-size', get_the_ID());
        $gallery = get_field('work-gallery', get_the_ID());
        $price = get_field('work-price', get_the_ID());
        $photoFull = get_the_post_thumbnail_url(get_the_ID(), 'full');
        ?>
        
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1><?php the_title(); ?></h1>
                    
                    <?php if ($photoFull) { ?>
                        <div class="product-image">
                            <img src="<?php echo $photoFull; ?>" alt="<?php the_title(); ?>" />
                        </div>
                    <?php } ?>
                    
                    <?php if ($descriptionText) { ?>
                        <div class="product-description">
                            <?php echo $descriptionText; ?>
                        </div>
                    <?php } ?>
                    
                    <div class="product-details">
                        <?php if ($material) { ?>
                            <p><strong>Материалы:</strong> <?php echo implode(', ', $material); ?></p>
                        <?php } ?>
                        
                        <?php if ($size) { ?>
                            <p><strong>Размер:</strong> <?php echo $size; ?></p>
                        <?php } ?>
                        
                        <?php if ($price) { ?>
                            <p><strong>Цена:</strong> <?php echo $price; ?></p>
                        <?php } ?>
                    </div>
                    
                    <?php if ($gallery) { ?>
                        <div class="product-gallery">
                            <h3>Галерея</h3>
                            <?php foreach ($gallery as $pic) { ?>
                                <img src="<?php echo $pic['sizes']['thumbnail']; ?>" alt="" />
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        
        <?php
    }
}

get_footer();
?>