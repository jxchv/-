<?php global $cmsSettings, $cmsMessengers, $cmsSocialLinks; ?>
<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no, shrink-to-fit=no">
		<title><?php wp_title( '|', true, 'right' ); ?></title>
		<meta name="keywords" content="" />
        <meta name="yandex-verification" content="fbe056a41a1439e5" />
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
		<?php wp_head(); ?>
		
		<?php get_template_part('template-parts/favicons'); ?>

<!--        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>-->
        <!-- Yandex.Metrika counter -->
        <script type="text/javascript" >
            (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
                m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
            (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

            ym(71364376, "init", {
                clickmap:true,
                trackLinks:true,
                accurateTrackBounce:true
            });
        </script>
        <noscript><div><img src="https://mc.yandex.ru/watch/71364376" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
        <!-- /Yandex.Metrika counter -->
	</head>

	<body <?php body_class(); ?>>

		<?php if ($cmsSettings['header_main_bg']) { ?>
		<div class="preloader-wrapper">
			<div class="preloader">
				<img src="<?php echo $cmsSettings['header_main_bg']; ?>" <?php if ($cmsSettings['header_main_bg_alt']) { ?>alt="<?php echo htmlspecialchars($cmsSettings['header_main_bg_alt']); ?>"<?php } ?>>
			</div>
		</div>
		<?php } ?>

		<div class="sidebar">
			<?php if($cmsSettings['header_logo'] || $cmsSettings['header_slogan']) { ?>
			<div class="logo">
				<img src="<?php echo $cmsSettings['header_logo']; ?>" <?php if ($cmsSettings['header_logo_alt']) { ?>alt="<?php echo htmlspecialchars($cmsSettings['header_logo_alt']); ?>"<?php } ?> />
				<?php if ($cmsSettings['header_slogan'] || $cmsSettings['contacts_phone_1'] || $cmsSettings['messenger_whatsapp']) { ?>
				<div class="sidebar-contacts">
					<?php if($cmsSettings['header_slogan']) { ?>
						<h1 style="display: none;" <?php echo cmsShowTitle($cmsSettings['header_slogan_title']); ?>><?php echo $cmsSettings['header_slogan']; ?></h1>
					<?php } ?>
					<?php if ($cmsSettings['contacts_phone_1']) { ?>
						<a href="tel:<?php echo cmsSanitizePhone($cmsSettings['contacts_phone_1']); ?>" class="phone" target="_blank">
							<?php echo $cmsSettings['contacts_phone_1']; ?>
						</a>
					<?php } ?>
					<?php if ($cmsSettings['messenger_whatsapp']) { ?>
						<a href="https://wa.me/<?php echo cmsSanitizePhone($cmsSettings['messenger_whatsapp']); ?>" target="_blank" class="wa-link">
							<svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="icon"><path fill="currentColor" d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"></path></svg>
						</a>
					<?php } ?>	
				</div>
				<?php } ?>
				<button class="hamburger hamburger--stand" type="button">
					<span class="hamburger-box">
						<span class="hamburger-inner"></span>
					</span>
				</button>
			</div>
			<?php } ?>
			<?php
			if (is_active_sidebar('main-menu')) {
				$args = array(
					'order'                  => 'ASC',
					'orderby'                => 'menu_order',
					'output'                 => ARRAY_A,
					'output_key'             => 'menu_order',
					'update_post_term_cache' => false,
				);
				$links = wp_get_nav_menu_items('Main', $args);
				if ($links) {
				?>
				<div class="navigation">
					<nav>
						<ul>
						<?php
						$i = 0;
						foreach ($links as $link) {
							$linkPage = get_post($link->object_id); 
						?>
							<li><a href="#" rel="nofollow" data-section="<?php echo $linkPage->post_name; ?>" <?php if (!$i) { ?>class="active"<?php } ?> data-lock=""><?php echo $link->title; ?></a></li>
						<?php
							$i++;
						}
						?>
						</ul>
						<div class="nav-contacts">
							<?php if ($cmsSettings['instagram']) { ?>
								<a href="<?php echo $cmsSettings['instagram']; ?>" rel="no-follow">
									<svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="icon icon-big"><path fill="currentColor" d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z">&gt;</path></svg>
								</a>
							<?php } ?>
							<?php if ($cmsSettings['facebook']) { ?>
								<a href="<?php echo $cmsSettings['facebook']; ?>" rel="no-follow">
									<svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="icon icon-big"><path fill="currentColor" d="M504 256C504 119 393 8 256 8S8 119 8 256c0 123.78 90.69 226.38 209.25 245V327.69h-63V256h63v-54.64c0-62.15 37-96.48 93.67-96.48 27.14 0 55.52 4.84 55.52 4.84v61h-31.28c-30.8 0-40.41 19.12-40.41 38.73V256h68.78l-11 71.69h-57.78V501C413.31 482.38 504 379.78 504 256z"></path></svg>
								</a>
							<?php } ?>
							<?php if ($cmsSettings['contacts_address']) { ?>
								<address><?php echo $cmsSettings['contacts_address']; ?></address>
							<?php } ?>
						</div>
					</nav>
				</div>
				<?php
				}
			}
			?>
		</div>
	
		<?php get_template_part('content'); ?>