<?php
/**
 * pfrf functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package pfrf
 */


if ( ! function_exists( 'pfrf_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function pfrf_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on pfrf, use a find and replace
		 * to change 'pfrf' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'pfrf', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'pfrf' ),
			'footer_menu' => 'Меню Футор'
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'pfrf_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'pfrf_setup' );

function shortcode_button_script() {
  if ( wp_script_is( 'quicktags' ) ) {
    ?>
      <script>
        function getSel() {
          var txtarea = document.getElementById('content');
          var start = txtarea.selectionStart;
          var finish = txtarea.selectionEnd;
          return txtarea.value.substring(start, finish);
        }

        QTags.addButton('button_blue', 'Синий блок', function() {
          QTags.insertContent('<div class="post__blue">' + getSel() + '</div>');
        });

        QTags.addButton('button_yellow', 'Желтый блок', function() {
          QTags.insertContent('<div class="post__yellow">' + getSel() + '</div>');
        });

        QTags.addButton('button_green', 'Зеленый блок', function() {
          QTags.insertContent('<div class="post__green">' + getSel() + '</div>');
        });
      </script>
    <?php
  }
}
add_action( 'admin_print_footer_scripts', 'shortcode_button_script' );


// добавляем кнопки в визуальный редактор
function enqueue_plugin_scripts( $plugin_array ) {
  $plugin_array['my_buttons'] =  get_template_directory_uri() . '/js/tinymce.js';
  return $plugin_array;
}
add_filter( 'mce_external_plugins', 'enqueue_plugin_scripts' );
function register_buttons_editor( $buttons ) {
  array_push( $buttons, 'button_blue' );
  array_push( $buttons, 'button_yellow' );
  array_push( $buttons, 'button_green' );
  return $buttons;
}
add_filter( 'mce_buttons', 'register_buttons_editor' );


// стили для визуального редактора
add_editor_style( 'css/editor-style.css' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function pfrf_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'pfrf_content_width', 640 );
}
add_action( 'after_setup_theme', 'pfrf_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function pfrf_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'pfrf' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'pfrf' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<b class="widget-title">',
		'after_title'   => '</b>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer-1', 'pfrf' ),
		'id'            => 'footer-1',
		'description'   => esc_html__( 'Add widgets here.', 'pfrf' ),
		'before_widget' => '<div class="widget-footer">',
		'after_widget'  => '</div>',
		'before_title'  => '<b class="widget-title">',
		'after_title'   => '</b>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer-2', 'pfrf' ),
		'id'            => 'footer-2',
		'description'   => esc_html__( 'Add widgets here.', 'pfrf' ),
		'before_widget' => '<div class="widget-footer">',
		'after_widget'  => '</div>',
		'before_title'  => '<b class="widget-title">',
		'after_title'   => '</b>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer-3', 'pfrf' ),
		'id'            => 'footer-3',
		'description'   => esc_html__( 'Add widgets here.', 'pfrf' ),
		'before_widget' => '<div class="widget-footer">',
		'after_widget'  => '</div>',
		'before_title'  => '<b class="widget-title">',
		'after_title'   => '</b>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer-4', 'pfrf' ),
		'id'            => 'footer-4',
		'description'   => esc_html__( 'Add widgets here.', 'pfrf' ),
		'before_widget' => '<div class="widget-footer">',
		'after_widget'  => '</div>',
		'before_title'  => '<b class="widget-title">',
		'after_title'   => '</b>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer-bottom', 'pfrf' ),
		'id'            => 'footer-5',
		'description'   => esc_html__( 'Add widgets here.', 'pfrf' ),
		'before_widget' => '<div class="widget-footer">',
		'after_widget'  => '</div>',
		'before_title'  => '<b class="widget-title">',
		'after_title'   => '</b>',
	) );
}
add_action( 'widgets_init', 'pfrf_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function pfrf_scripts() {
	//wp_enqueue_style( 'pfrf-normalize', get_template_directory_uri() . '/css/normalize.css');
	//wp_enqueue_style( 'pfrf-greed', get_template_directory_uri() . '/css/grid.css');
	wp_enqueue_style( 'pfrf-main', get_template_directory_uri() . '/css/main.css');
	//wp_enqueue_style( 'pfrf-libs', get_template_directory_uri() . '/css/libs.min.css');
	wp_enqueue_style( 'pfrf-style', get_stylesheet_uri() );

	wp_enqueue_script( 'pfrf-script', get_template_directory_uri() . '/js/common.js', array(), '20151215', true );

	wp_enqueue_script( 'pfrf-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'pfrf-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'pfrf_scripts' );

add_action( 'wp_enqueue_scripts', 'my_scripts_method' );
function my_scripts_method() {
	// отменяем зарегистрированный jQuery
	// вместо "jquery-core", можно вписать "jquery", тогда будет отменен еще и jquery-migrate
	wp_deregister_script( 'jquery-core' );
	wp_register_script( 'jquery-core', 'https://code.jquery.com/jquery-3.3.1.min.js');
	wp_enqueue_script( 'jquery' );
}
/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

## Отключаем Emojis 
if(1){
	## отключаем DNS prefetch
	add_filter('emoji_svg_url', '__return_empty_string');

	/**
	 * Disable the emoji's
	 */
	add_action( 'init', 'disable_emojis' );
	function disable_emojis() {
		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
		remove_action( 'wp_print_styles', 'print_emoji_styles' );
		remove_action( 'admin_print_styles', 'print_emoji_styles' );
		remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
		remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
		remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
		add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
	}

	/**
	 * Filter function used to remove the tinymce emoji plugin.
	 *
	 * @param    array  $plugins
	 * @return   array             Difference betwen the two arrays
	 */
	function disable_emojis_tinymce( $plugins ) {
		if ( is_array( $plugins ) ) {
			return array_diff( $plugins, array( 'wpemoji' ) );
		} else {
			return array();
		}
	}
}
/*
 * "Хлебные крошки" для WordPress
 * автор: Dimox
 * версия: 2017.01.21
 * лицензия: MIT
*/
function dimox_breadcrumbs() {

  /* === ОПЦИИ === */
  $text['home'] = 'Super Mario'; // текст ссылки "Главная"
  $text['category'] = '%s'; // текст для страницы рубрики
  $text['search'] = 'Результаты поиска по запросу "%s"'; // текст для страницы с результатами поиска
  $text['tag'] = 'Записи с тегом "%s"'; // текст для страницы тега
  $text['author'] = 'Статьи автора %s'; // текст для страницы автора
  $text['404'] = 'Ошибка 404'; // текст для страницы 404
  $text['page'] = 'Страница %s'; // текст 'Страница N'
  $text['cpage'] = 'Страница комментариев %s'; // текст 'Страница комментариев N'

  $wrap_before = '<div class="breadcrumbs" itemscope itemtype="http://schema.org/BreadcrumbList">'; // открывающий тег обертки
  $wrap_after = '</div><!-- .breadcrumbs -->'; // закрывающий тег обертки
  $sep = '›'; // разделитель между "крошками"
  $sep_before = '<span class="sep">'; // тег перед разделителем
  $sep_after = '</span>'; // тег после разделителя
  $show_home_link = 1; // 1 - показывать ссылку "Главная", 0 - не показывать
  $show_on_home = 0; // 1 - показывать "хлебные крошки" на главной странице, 0 - не показывать
  $show_current = 1; // 1 - показывать название текущей страницы, 0 - не показывать
  $before = '<span class="current">'; // тег перед текущей "крошкой"
  $after = '</span>'; // тег после текущей "крошки"
  /* === КОНЕЦ ОПЦИЙ === */

  global $post;
  $home_url = home_url('/');
  $link_before = '<span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">';
  $link_after = '</span>';
  $link_attr = ' itemprop="item"';
  $link_in_before = '<span itemprop="name">';
  $link_in_after = '</span>';
  $link = $link_before . '<a href="%1$s"' . $link_attr . '>' . $link_in_before . '%2$s' . $link_in_after . '</a>' . $link_after;
  $frontpage_id = get_option('page_on_front');
  $parent_id = ($post) ? $post->post_parent : '';
  $sep = ' ' . $sep_before . $sep . $sep_after . ' ';
  $home_link = $link_before . '<a href="' . $home_url . '"' . $link_attr . ' class="home">' . $link_in_before . $text['home'] . $link_in_after . '</a>' . $link_after;

  if (is_home() || is_front_page()) {

    if ($show_on_home) echo $wrap_before . $home_link . $wrap_after;

  } else {

    echo $wrap_before;
    if ($show_home_link) echo $home_link;

    if ( is_category() ) {
      $cat = get_category(get_query_var('cat'), false);
      if ($cat->parent != 0) {
        $cats = get_category_parents($cat->parent, TRUE, $sep);
        $cats = preg_replace("#^(.+)$sep$#", "$1", $cats);
        $cats = preg_replace('#<a([^>]+)>([^<]+)<\/a>#', $link_before . '<a$1' . $link_attr .'>' . $link_in_before . '$2' . $link_in_after .'</a>' . $link_after, $cats);
        if ($show_home_link) echo $sep;
        echo $cats;
      }
      if ( get_query_var('paged') ) {
        $cat = $cat->cat_ID;
        echo $sep . sprintf($link, get_category_link($cat), get_cat_name($cat)) . $sep . $before . sprintf($text['page'], get_query_var('paged')) . $after;
      } else {
        if ($show_current) echo $sep . $before . sprintf($text['category'], single_cat_title('', false)) . $after;
      }

    } elseif ( is_search() ) {
      if (have_posts()) {
        if ($show_home_link && $show_current) echo $sep;
        if ($show_current) echo $before . sprintf($text['search'], get_search_query()) . $after;
      } else {
        if ($show_home_link) echo $sep;
        echo $before . sprintf($text['search'], get_search_query()) . $after;
      }

    } elseif ( is_day() ) {
      if ($show_home_link) echo $sep;
      echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $sep;
      echo sprintf($link, get_month_link(get_the_time('Y'), get_the_time('m')), get_the_time('F'));
      if ($show_current) echo $sep . $before . get_the_time('d') . $after;

    } elseif ( is_month() ) {
      if ($show_home_link) echo $sep;
      echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y'));
      if ($show_current) echo $sep . $before . get_the_time('F') . $after;

    } elseif ( is_year() ) {
      if ($show_home_link && $show_current) echo $sep;
      if ($show_current) echo $before . get_the_time('Y') . $after;

    } elseif ( is_single() && !is_attachment() ) {
      if ($show_home_link) echo $sep;
      if ( get_post_type() != 'post' ) {
        $post_type = get_post_type_object(get_post_type());
        $slug = $post_type->rewrite;
        printf($link, $home_url . $slug['slug'] . '/', $post_type->labels->singular_name);
        if ($show_current) echo $sep . $before . get_the_title() . $after;
      } else {
        $cat = get_the_category(); $cat = $cat[0];
        $cats = get_category_parents($cat, TRUE, $sep);
        if (!$show_current || get_query_var('cpage')) $cats = preg_replace("#^(.+)$sep$#", "$1", $cats);
        $cats = preg_replace('#<a([^>]+)>([^<]+)<\/a>#', $link_before . '<a$1' . $link_attr .'>' . $link_in_before . '$2' . $link_in_after .'</a>' . $link_after, $cats);
        echo $cats;
        if ( get_query_var('cpage') ) {
          echo $sep . sprintf($link, get_permalink(), get_the_title()) . $sep . $before . sprintf($text['cpage'], get_query_var('cpage')) . $after;
        } else {
          if ($show_current) echo $before . get_the_title() . $after;
        }
      }

    // custom post type
    } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
      $post_type = get_post_type_object(get_post_type());
      if ( get_query_var('paged') ) {
        echo $sep . sprintf($link, get_post_type_archive_link($post_type->name), $post_type->label) . $sep . $before . sprintf($text['page'], get_query_var('paged')) . $after;
      } else {
        if ($show_current) echo $sep . $before . $post_type->label . $after;
      }

    } elseif ( is_attachment() ) {
      if ($show_home_link) echo $sep;
      $parent = get_post($parent_id);
      $cat = get_the_category($parent->ID); $cat = $cat[0];
      if ($cat) {
        $cats = get_category_parents($cat, TRUE, $sep);
        $cats = preg_replace('#<a([^>]+)>([^<]+)<\/a>#', $link_before . '<a$1' . $link_attr .'>' . $link_in_before . '$2' . $link_in_after .'</a>' . $link_after, $cats);
        echo $cats;
      }
      printf($link, get_permalink($parent), $parent->post_title);
      if ($show_current) echo $sep . $before . get_the_title() . $after;

    } elseif ( is_page() && !$parent_id ) {
      if ($show_current) echo $sep . $before . get_the_title() . $after;

    } elseif ( is_page() && $parent_id ) {
      if ($show_home_link) echo $sep;
      if ($parent_id != $frontpage_id) {
        $breadcrumbs = array();
        while ($parent_id) {
          $page = get_page($parent_id);
          if ($parent_id != $frontpage_id) {
            $breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));
          }
          $parent_id = $page->post_parent;
        }
        $breadcrumbs = array_reverse($breadcrumbs);
        for ($i = 0; $i < count($breadcrumbs); $i++) {
          echo $breadcrumbs[$i];
          if ($i != count($breadcrumbs)-1) echo $sep;
        }
      }
      if ($show_current) echo $sep . $before . get_the_title() . $after;

    } elseif ( is_tag() ) {
      if ( get_query_var('paged') ) {
        $tag_id = get_queried_object_id();
        $tag = get_tag($tag_id);
        echo $sep . sprintf($link, get_tag_link($tag_id), $tag->name) . $sep . $before . sprintf($text['page'], get_query_var('paged')) . $after;
      } else {
        if ($show_current) echo $sep . $before . sprintf($text['tag'], single_tag_title('', false)) . $after;
      }

    } elseif ( is_author() ) {
      global $author;
      $author = get_userdata($author);
      if ( get_query_var('paged') ) {
        if ($show_home_link) echo $sep;
        echo sprintf($link, get_author_posts_url($author->ID), $author->display_name) . $sep . $before . sprintf($text['page'], get_query_var('paged')) . $after;
      } else {
        if ($show_home_link && $show_current) echo $sep;
        if ($show_current) echo $before . sprintf($text['author'], $author->display_name) . $after;
      }

    } elseif ( is_404() ) {
      if ($show_home_link && $show_current) echo $sep;
      if ($show_current) echo $before . $text['404'] . $after;

    } elseif ( has_post_format() && !is_singular() ) {
      if ($show_home_link) echo $sep;
      echo get_post_format_string( get_post_format() );
    }

    echo $wrap_after;

  }
} // end of dimox_breadcrumbs()

// Убираем Атрибут srcset
function meks_disable_srcset( $sources ) {
    return false;
}
 
add_filter( 'wp_calculate_image_srcset', 'meks_disable_srcset' );

// удаляем атрибут type у scripts и styles
add_filter('style_loader_tag', 'clean_style_tag');
function clean_style_tag($src) {
    return str_replace("type='text/css'", '', $src);
}

add_filter('script_loader_tag', 'clean_script_tag');
function clean_script_tag($src) {
    return str_replace("type='text/javascript'", '', $src);
}

// Шоркод выводит УРЛ главной страницы
function true_urlhome_func( $atts ){
	return site_url();
}
 
add_shortcode( 'urlhome', 'true_urlhome_func' );

// Миниатюра для категории
if ( function_exists( 'add_image_size' ) ) {
	add_image_size( 'category-thumb', 9999, 180 ); // 300 в ширину и без ограничения в высоту
}


//Комментарии
function mytheme_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment; ?>
<li id="comment-<?php comment_ID() ?>">
	<div id="div-comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
		<div class="gravatar"><?php echo get_avatar($comment, $size='50', $default=''); ?></div>
		<div class="comment_content">
			<div class="cauthor">
				<span class="author_name"><?php printf(__('<span class="fn">%s</span>'), get_comment_author_link()) ?></span>
				<span class="comment_date"> | <?php comment_date('j.m.Y H:i');?> <?php edit_comment_link(__('(Edit)'),'  ','') ?></span>
			</div>

			<div class="ctext">
				<?php if ($comment->comment_approved == '0') : ?>
					<p><em><?php _e('Your comment is awaiting moderation.') ?></em></p>
				<?php endif; ?>
				<?php comment_text() ?>

				<?php if (/*comments_open() AND */(get_option('thread_comments') == 1) AND ($depth != $args['max_depth'])) { ?>
				<div class="reply">
					<?php comment_reply_link(array_merge( $args, array('add_below' => 'div-comment', 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
				</div>
				<?php } ?>
			</div><!-- .ctext -->
		</div><!-- .comment_content -->
	</div>
<?php
}

function src_simple_recent_comments($src_count=7, $src_length=60) {
	global $wpdb;
	$sql = "SELECT DISTINCT ID, post_title, post_password, comment_ID, comment_post_ID, comment_author, comment_date_gmt, comment_date, comment_approved, comment_type,
		SUBSTRING(comment_content,1,$src_length) AS com_excerpt
		FROM $wpdb->comments
		LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID = $wpdb->posts.ID)
		WHERE comment_approved = '1' AND comment_type = '' AND post_password = ''
		ORDER BY comment_date_gmt DESC
		LIMIT $src_count";
	$comments = $wpdb->get_results($sql);
	foreach ($comments as $comment) {
		// $date = apply_filters('the_time', mysql2date("j F, H:i", $comment->comment_date));
?>
		<li>
			<p><?php echo strip_tags($comment->com_excerpt) ?>...</p>
			от: <?php echo $comment->comment_author ?> <a href="<?php echo get_permalink($comment->ID) ?>#comment-<?php echo $comment->comment_ID ?>"><?php echo $comment->post_title ?></a>
		</li>
<?php
	}
}

function delete_rel($link) {
    return str_replace('rel="category tag"', "", $link);
}
add_filter('the_category', 'delete_rel');

function year_shortcode() {
  $year = date('Y');
  return $year;
}
add_shortcode('year', 'year_shortcode');

add_action('show_user_profile', 'add_extra_field');
add_action('edit_user_profile', 'add_extra_field');

function add_extra_field( $user )
{
	?>
		<h3>Дополнительные данные пользователя</h3>

		<table class="form-table">
			<tr>
				<th><label for="user_score">Очки пользователя</label></th>
				<td><input type="number" name="user_score" value="<?php echo esc_attr(get_the_author_meta('user_score', $user->ID)); ?>" class="regular-text" /></td>
			</tr>
			<tr>
				<th><label for="last_user_score">Очки за последнюю игру</label></th>
				<td><input type="number" name="last_user_score" value="<?php echo esc_attr(get_the_author_meta('last_user_score', $user->ID)); ?>" class="regular-text" /></td>
			</tr>
			<tr>
				<th><label for="user_place">Место в игре</label></th>
				<td><input type="number" name="user_place" value="<?php echo esc_attr(get_the_author_meta('user_place', $user->ID)); ?>" class="regular-text" /></td>
			</tr>
			<tr>
				<th><label for="last_date">Дата последней игры</label></th>
				<td><input type="text" name="last_date" value="<?php echo esc_attr(get_the_author_meta('last_date', $user->ID)); ?>" class="regular-text" /></td>
			</tr>
			<tr>
				<th><label for="user_comments">Количество комментариев</label></th>
				<td><input type="number" name="user_comments" value="<?php echo esc_attr(get_the_author_meta('user_comments', $user->ID)); ?>" class="regular-text" /></td>
			</tr>
			<tr>
				<th><label for="game_counts">Количество игр</label></th>
				<td><input type="number" name="game_counts" value="<?php echo esc_attr(get_the_author_meta('game_counts', $user->ID)); ?>" class="regular-text" /></td>
			</tr>
		</table>
	<?php
}

add_action('personal_options_update', 'save_extra_field');
add_action('edit_user_profile_update', 'save_extra_field');

function save_extra_field( $user_id )
{
	update_user_meta($user_id, 'user_score', sanitize_text_field($_POST['user_score']));
	update_user_meta($user_id, 'last_user_score', sanitize_text_field($_POST['last_user_score']));
	update_user_meta($user_id, 'user_place', sanitize_text_field($_POST['user_place']));
	update_user_meta($user_id, 'last_date', sanitize_text_field($_POST['last_date']));
	update_user_meta($user_id, 'user_comments', sanitize_text_field($_POST['user_comments']));
	update_user_meta($user_id, 'game_counts', sanitize_text_field($_POST['game_counts']));
}

add_action('wp_ajax_send_data', 'send_data');
add_action('wp_ajax_nopriv_send_data', 'send_data');
function send_data()
{
	$userID = get_current_user_id();
	$currentUserScore = get_the_author_meta('user_score', $userID);
	$currentUserGameCounts = empty(get_the_author_meta('game_counts', $userID)) ? 1 + 1 : get_the_author_meta('game_counts', $userID) + 1;
	$userScore = $_POST['score'];
	update_user_meta($userID, 'last_date', sanitize_text_field(date("d.m.Y")));
	update_user_meta($userID, 'last_user_score', sanitize_text_field($userScore));
	update_user_meta($userID, 'game_counts', sanitize_text_field($currentUserGameCounts++));
	if ($currentUserScore < $userScore || empty($currentUserScore)) {
		update_user_meta($userID, 'user_score', sanitize_text_field($userScore));
	}
}

add_action('wp_ajax_get_sorted_data', 'get_sorted_data');
add_action('wp_ajax_nopriv_get_sorted_data', 'get_sorted_data');
function get_sorted_data()
{
	global $wpdb;
	$filter = $_POST['filter'];
	$sort = $_POST['sort'];
	$counts = $_POST['counts'];
	$currentPage = $_POST['currentPage'] - 1;
	$search = $_POST['search'];
	if ($currentPage !== 0) {
		$currentPage = $currentPage * $counts;
	}
	$leaders = $wpdb->get_results("SELECT * FROM wp_game_leader WHERE user_name LIKE '%$search%' ORDER BY $filter $sort LIMIT $currentPage, $counts");
	$maxScore = $wpdb->get_var("SELECT user_score FROM wp_game_leader LIMIT 1");
	$newTable = '';
	$countries = include get_template_directory() . '/inc/countries.php';
	foreach($leaders as $key=>$leader) {
		$ID = $leader->newid;
		$userID = $leader->ID;
		$userScore = $leader->user_score;
		$userComments = $leader->user_comments;
		$userScoreText = number_format($leader->user_score, 0, '.', ' ');;
		$userLastDate = $leader->last_date;
		$userGameCount = $leader->game_count;
		$userProgress = floor($userScore * 100 / $maxScore);
		um_fetch_user($userID);
		$userPhoto = um_user('profile_photo', 64);
		$userLogin = um_user('user_login');
		$userName = um_user('first_name');
		$userCountry = um_user('country');
		$isoCountry = strtolower($countries[$userCountry]);
		$userEmail = um_user('user_email');
		$userLink = '/user/' . $userLogin;
		$userClassForFirstsPlace = '';
		if ($ID == 1) {
			$userClassForFirstsPlace = 'table__first-place';
		} elseif ($ID == 2) {
			$userClassForFirstsPlace = 'table__second-place';
		} elseif ($ID == 3) {
			$userClassForFirstsPlace = 'table__third-place';
		}
		$newTable .= "
		<tr class='$userClassForFirstsPlace'>
			<td class='table__place'>$ID</td>
			<td class='table__user'>
				<div class='table__user-wrapper'>
					<div class='table__user-image'><a href='$userLink'>$userPhoto</a></div>
					<div class='table__user-info'>
						<div class='table__user-name'>$userName</div>
						<div class='table__user-id'><a href='$userLink'>@$userLogin</a></div>
					</div>
				</div>
			</td>
			<td class='table__country'>
				<img src='/wp-content/themes/supermario/img/flags/$isoCountry.svg' alt='$userCountry'>
			</td>
			<td class='table__points'>$userScoreText</td>
			<td class='table__progress'>
				<div class='table__progress-wrapper'>
					<div class='table__progress-line' style='width: $userProgress%;'></div>
				</div>
				</td>
				<td class='table__gamecount'>$userGameCount</td>
			<td class='table__comments'><a href='#'>$userComments</a></td>
			<td class='table__lastgame'>$userLastDate</td>
		</tr>
		";
	}
	print_r($newTable);
}

function comment_count($email){
	global $wpdb;
	$count = $wpdb->get_var("SELECT COUNT(*) FROM wp_comments WHERE comment_author_email = '$email'");
	echo $count;
}

add_action( 'comment_count_action', 'comment_count', 10, 1 );

function get_iso_code($searchCountry){
	$countries = include get_template_directory() . '/inc/countries.php';
	echo strtolower($countries[$searchCountry]);
}

add_action( 'get_iso_code_action', 'get_iso_code', 10, 1 );

add_action( 'admin_head', 'cron_activation' );
function cron_activation() {
	if( ! wp_next_scheduled( 'set_champ_list_action' ) ) {
		wp_schedule_event( time(), '5min', 'set_champ_list_action');
	}
}

function lts($a, $b) {
	if ($a['user_score'] == $b['user_score']) {
			return 0;
	}
	return ($a['user_score'] > $b['user_score']) ? -1 : 1;
}

function get_leaders() {
	global $wpdb;
	$wpdb->query("TRUNCATE TABLE `wp_game_leader`");
	$users = get_users([
		'fields' => ['ID', 'user_nicename'],
	]);
	$tempArray = [];
	foreach($users as $user) {
		$ID = $user->ID;
		$userFullName = get_user_meta($ID, 'first_name', true);
		$userName = $user->user_nicename . '; ' . $userFullName;
		$userScore = get_the_author_meta('user_score', $ID);
		$lastDate = get_the_author_meta('last_date', $ID);
		$gameCount = get_the_author_meta('game_counts', $ID);
		um_fetch_user($ID);
		$userEmail = um_user('user_email');
		$count = $wpdb->get_var("SELECT COUNT(*) FROM wp_comments WHERE comment_author_email = '$userEmail'");
		update_user_meta($ID, 'user_comments', sanitize_text_field($count));
		$userComments = get_the_author_meta('user_comments', $ID);
		update_user_meta($ID, 'user_place', sanitize_text_field(0));
		if (!empty($userScore)) {
			array_push($tempArray, array('ID' => $ID, 'user_score' => $userScore, 'last_date' => $lastDate, 'user_name' => $userName, 'user_comments' => $userComments, 'game_count' => $gameCount));
		}
	}
	uasort($tempArray, 'lts');
	$leaderArray = array_slice($tempArray, 0, 100);
	foreach($leaderArray as $key=>$leader) {
		$userID = $leader['ID'];
		$userScore = $leader['user_score'];
		$lastDate = $leader['last_date'];
		$userName = $leader['user_name'];
		$userComments = $leader['user_comments'];
		$gameCount = $leader['game_count'];
		update_user_meta($userID, 'user_place', sanitize_text_field($key + 1));
		$wpdb->insert(
			$wpdb->prefix . 'game_leader',
			array(
				'ID' => $userID,
				'user_score' => $userScore,
				'last_date' => $lastDate,
				'user_name' => $userName,
				'user_comments' => $userComments,
				'game_count' => $gameCount,
			),
			array(
				'%d',
				'%d',
				'%s',
				'%s',
				'%d',
				'%d'
			)
		);
	}
}

add_action( 'set_champ_list_action', 'set_champ_list' );
function set_champ_list(){
	get_leaders();
	// update_user_meta(20, 'user_place', sanitize_text_field(rand() . ' ' . date('G:i:s')));
}