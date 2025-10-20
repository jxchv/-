<?php
/**
 * Erta
 * @since Erta 1.0
 */

$siteURL = get_site_url();
define ("SITE_URL", $siteURL.'/');

define('CMS_URL_PREF', '');
define('CMS_TEMPLATE_DIR_URI', get_template_directory_uri());
define('CMS_TEMPLATE_DIR' , get_template_directory());
define('CMS_THEME_FUNCTIONS_PATH' , CMS_TEMPLATE_DIR.'/functions');
define('CMS_IMG' , CMS_TEMPLATE_DIR_URI.'/images/');

// файлы настройки темы
require(CMS_THEME_FUNCTIONS_PATH.'/setup/setup.php');
require(CMS_THEME_FUNCTIONS_PATH.'/scripts/script.php');
require(CMS_THEME_FUNCTIONS_PATH.'/font/font.php');
require(CMS_THEME_FUNCTIONS_PATH.'/widgets/widgets.php');

// функции раздела администрирования
require(CMS_THEME_FUNCTIONS_PATH.'/admin/admin-functions.php');

// файлы настройки данных
require(CMS_THEME_FUNCTIONS_PATH.'/customizer/customizer-favicons.php');
require(CMS_THEME_FUNCTIONS_PATH.'/customizer/customizer-header.php');
require(CMS_THEME_FUNCTIONS_PATH.'/customizer/customizer-footer.php');
require(CMS_THEME_FUNCTIONS_PATH.'/customizer/customizer-sidebar.php');
require(CMS_THEME_FUNCTIONS_PATH.'/customizer/customizer-contacts.php');
require(CMS_THEME_FUNCTIONS_PATH.'/customizer/customizer-forms.php');

// получение настроек темы
$cmsOptions		= cmsSetupData(); 
$cmsSettings	= wp_parse_args (get_option('cms_options', array()), $cmsOptions);

/*
 * Подготовка номера телефона для использовании в ссылке "tel"
 */
function cmsSanitizePhone ($str) {
	$str = str_replace(" ", "", $str);
	$str = str_replace("(", "", $str);
	$str = str_replace(")", "", $str);
	$str = str_replace("-", "", $str);
	return $str;
}

/*
 * Вывод атрибута "title"
 */
function cmsShowTitle($str) {
	if (!$str) {
		return;
	}
	return ' title="'.htmlspecialchars($str).'"';
}


function cmsAddPostTemplateSection() {
    add_meta_box('postparentdiv', __('Шаблон'), 'post_template_meta_box', 'custom_post-type', 'side', 'core');
}
add_action('add_meta_boxes','cmsAddPostTemplateSection');

function cmsConvertYoutubeCode($string, $id) {
	return preg_replace(
		"/\s*[a-zA-Z\/\/:\.]*youtu(be.com\/watch\?v=|.be\/)([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i",
		"<iframe id=\"$id\" width=\"100%\" height=\"315\" src=\"//www.youtube.com/embed/$2?rel=0&enablejsapi=1\"  frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>",
		$string
	);
}
function cmsGetYoutubeCode($string) {
	return preg_replace(
		"/\s*[a-zA-Z\/\/:\.]*youtu(be.com\/watch\?v=|.be\/)([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i",
		"$2",
		$string
	);	
}

/**
 * Данные о работе
 */
function cmsWorkInfo() {

	global $wpdb;
	$id = $_REQUEST['id'];
	$id = str_replace("item-", "", $id);
	
	// Отладочная информация
	error_log("cmsWorkInfo вызвана с ID: " . $id);
	
	$post = get_post( $id);

	if (!$post) {
		cmsAjaxError("Работа не найдена");
		die();
	}

	$descriptionText	= get_field('work-description', $id);
	$material			= get_field('work-material', $id);
	$size				= get_field('work-size', $id);
	$gallery			= get_field('work-gallery', $id);
	$price				= get_field('work-price', $id);
	$photoFull			= get_the_post_thumbnail_url($id, 'full');
	$photoFullThumb		= get_the_post_thumbnail_url($id, 'thumbnail');
								
	$params = '<ul>';
	if ($material) {
		$params .= '<li><label>Материалы:</label>'.implode(', ', $material).'</span></li>';
	}
	if ($size) {
		$params .= '<li><label>Размер:</label>'.$size.'</span></li>';
	}
	if ($price) {
		$params .= '<li class="price"><label>Стоимость:</label><span>'.$price.'</span><span><a href="#" data-toggle="modal" data-target="#works-modal">Заказать</a></span></li>';
	}
	$params .= '</ul>';

	if ($descriptionText) {
		$descriptionText = '<div class="description-text">'.$descriptionText.'</div>';
	}

	$galleryBlock = '';
	$galleryBlockClass = '';
	if ($gallery) {
		$i = 1;
		foreach ($gallery as $pic) {
			$galleryBlock .= '<div><img src="'.$pic['sizes']["thumbnail"].'" data-img="'.$pic['url'].'" /></div>';
			$i++;
		}
		if ($i < 3) {
			$galleryBlockClass = 'gallery-block-small';
		}
	}
	if ($galleryBlock) {
		$galleryBlock = '<div class="gallery-block '.$galleryBlockClass.'"><div><img src="'.$photoFullThumb.'" data-img="'.$photoFull.'" class="selected" /></div>'.$galleryBlock.'</div>';
	}

	$args = array(
					'post_type'		=> 'works',
					'post_status'	=> 'publish',
					'hierarchical'	=> '0',
					'showposts'		=> '-1',
					'orderby'		=> 'menu_order',
					'order'			=> 'ASC'
				);
	$works = get_posts($args);
	if ($id == $works[0]->ID) {
		$prevCLass = 'prev-class-disabled';
	}
	$last = end($works);
	if ($id == $last->ID) {
		$nextCLass = 'next-class-disabled';
	}

echo <<<HTML
        <div class="work-popup">
			<div class="navigation show-mobile">
				<a href="#" class="closeModal x"></a>
				<a href="#" class="prevModal $prevCLass"></a>
				<a href="#" class="nextModal $nextCLass"></a>
			</div>
			<h1 class="title show-mobile">$post->post_title</h1>
			<div class="img">
				<img src="$photoFull" />
			</div>
			<div class="content">
				<div class="navigation hide-mobile">
					<a href="#" class="closeModal x"></a>
					<a href="#" class="prevModal $prevCLass"></a>
					<a href="#" class="nextModal $nextCLass"></a>
				</div>
				<div class="description">
					<h1 class="title hide-mobile">$post->post_title</h1>
					$descriptionText
					$params
				</div>
				$galleryBlock
			</div>
		</div>
HTML;

	die();
}
add_action("wp_ajax_cms_work_info", "cmsWorkInfo");
add_action("wp_ajax_nopriv_cms_work_info", "cmsWorkInfo");

/*
 * =========================================================== БЛОГ
 */

/*
 * Получение данных автора поста
 */
function cmsGetAuthor ($id) {
	$user	= get_user_meta($id);
	if (!$user) {
		return false;
	}
	$data['name'] = $user['first_name'][0].' '.$user['last_name'][0];
	$data['avatar']	= '';
	return $data;
}

/*
 * Получение списка последних постов блога
 */
function cmsGetLastPosts ($excludeID = '') {
	global $cmsSettings;
	if (!$cmsSettings['blog_last_num']) {
		$cmsSettings['blog_last_num'] = '3';
	}

	$args = array(
					'post_type'     	=> 'post',
					'post_status'       => 'publish',
					'posts_per_page'    => $cmsSettings['blog_last_num'],
					'orderby'           => 'post_date',
					'order'             => 'DESC'
				);
	if ($excludeID) {
		$args['post__not_in'] = array($excludeID);
	}
	$posts = get_posts($args);
	if (!$posts) {
		return false;
	}
	$return = array();
	foreach ($posts as $post) {
		$array['ID']			= $post->ID;
		$array['post_title']	= $post->post_title;
		$array['post_name']		= $post->post_name;
		$array['date']			= date("d.m.Y", strtotime($post->post_date));
		$array['title']			= get_field("title", $post->ID);
		$array['alt']			= get_field("alt", $post->ID);
		
		$headline				= get_field("headline", $post->ID);
		if ($headline && $headline['bg']) {
			$array['thumb'] = $headline['bg'];
		} else {
			$array['thumb'] = false;
		}
		$return[] = $array;
	}
	return $return;
}

/*
 * КОММЕНТАРИИ --------------------------------------------------------------------------------------------
 */

/**
 * Удаление дефолтного поля для текста комментария из формы добавления комментария
 */
function cmsRemoveCommentField ($defaults) {
	//var_dump($defaults);
    if (isset($defaults['comment_field'])) {
        $defaults['comment_field'] = '<textarea id="comment" placeholder="Комментарий*" name="comment" cols="45" rows="8" required="required" aria-required="true"></textarea>';
    }
    return $defaults;
}
add_filter('comment_form_defaults', 'cmsRemoveCommentField', 10, 1);

/**
 * Customize comment form default fields.
 * Move the comment_field below the author, email, and url fields.
 */
function cmsAddCommentFields( $fields ) {
    $commenter     = wp_get_current_commenter();
    $user          = wp_get_current_user();
    $user_identity = $user->exists() ? $user->display_name : '';
    $req           = get_option( 'require_name_email' );
    $aria_req      = ( $req ? " aria-required='true'" : '' );
    $html_req      = ( $req ? " required='required'" : '' );
    $html5         = current_theme_supports( 'html5', 'comment-form' ) ? 'html5' : false;

    $fields = [
				'author' =>
				'<input id="author" name="author" type="text" placeholder="Ваше имя*" value="' . esc_attr( $commenter['comment_author'] ) .'" size="30" required="required" />',
													
				'email' =>
				'<input id="email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' placeholder="Email*" value="' . esc_attr(  $commenter['comment_author_email'] ) .'" size="30" required="required" />',

				'url' =>
				'<p class="comment-form-url">' .
				'<input id="url" name="url" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' placeholder="Ваш сайт" value="' . esc_attr( $commenter['comment_author_url'] ) .'" size="30" /></p>'
    ];

    return $fields;
}
add_filter('comment_form_default_fields', 'cmsAddCommentFields', 11);




/**
 * Добавление текста перед формой комментария
 */
function cmsChangeNoteBeforeCommentForm($defaults) {
	global $cmsSettings;
    $defaults['comment_notes_before'] = '<p class="comment-notes">'.$cmsSettings['blog_comments_note_before'].'</p>';
    return $defaults;
}
add_filter('comment_form_defaults', 'cmsChangeNoteBeforeCommentForm');

/**
 * Добавление текста после формы комментария
 */
function cmsChangeNoteAfterCommentForm($defaults) {
	global $cmsSettings;
	$defaults['comment_notes_after'] = '<p class="comment-notes-after">'.$cmsSettings['blog_comments_note_after'].'</p>';
    return $defaults;
}
add_filter('comment_form_defaults', 'cmsChangeNoteAfterCommentForm');



?>
