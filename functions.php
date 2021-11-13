<?php
// add featured image to pages
add_theme_support( 'post-thumbnails' );

function load_css() {
    
    wp_register_style('slick', get_template_directory_uri() . '/css/slick.min.css', array(), false, 'all' );
    wp_enqueue_style('slick');

    wp_register_style('style', get_template_directory_uri() . '/css/style.css', array(), false, 'all' );
    wp_enqueue_style('style');

}
add_action('wp_enqueue_scripts', 'load_css');

function load_js() {
     
    wp_register_script('slick', get_template_directory_uri() . '/js/slick.js', 'jquery', false, true);
    wp_enqueue_script('slick');

    wp_register_script('script', get_template_directory_uri() . '/js/script.js', 'jquery', false, true);
    wp_enqueue_script('script');

    // wp_enqueue_script('jquery-form', 'jquery', false, true);

}
add_action('wp_enqueue_scripts', 'load_js');

function enqueue_jquery_form() {
    wp_enqueue_script('jquery-form');
}
add_action('wp_enqueue_scripts', 'enqueue_jquery_form');


function contact_form() {

	$result = wp_send_json_success($_POST);
	
}
add_action('wp_ajax_send_form', 'contact_form');
add_action('wp_ajax_nopriv_send_form', 'contact_form');


// Theme Options
add_theme_support('menus');


// Register Menu
register_nav_menus(
    [
        'top-menu' => 'Top menu',
        'sub-menu' => 'Sub Menu',
        'mobile-menu' => 'Mobile Menu',
        'footer-menu-1' => 'Footer Menu 1',
        'footer-menu-2' => 'Footer Menu 2', 

    ]
);

// Menu Options
function active_class ($classes, $item) {
  if (in_array('current-menu-item', $classes) ){
    $classes[] = 'active ';
  }
  return $classes;
}
add_filter('nav_menu_css_class' , 'active_class' , 10 , 2);

function remove_wp_nav_menu($text) {
    $replace = array(
      'current-menu-item'     => 'active',
      'current-menu-parent'   => 'active',
      'menu-item-type-post_type' => '',
      'menu-item-object-page' => '',
    );
  
    $text = str_replace(array_keys($replace), $replace, $text);
    return $text;
  }
  add_filter('wp_nav_menu', 'remove_wp_nav_menu');

  function new_submenu_class($menu) {    
    $menu = preg_replace('/ class="sub-menu"/','/ class="drop" /',$menu);        
    return $menu;      
}
add_filter('wp_nav_menu','new_submenu_class'); 


function remove_menu_items() {
    if( current_user_can( 'administrator' ) ):
		// remove_menu_page( 'edit.php?post_type=acf-field-group' );
		remove_menu_page( 'edit.php' );
		// remove_menu_page('plugins.php');
		remove_menu_page('edit-comments.php');
    endif;
}
add_action( 'admin_menu', 'remove_menu_items' );


// Custom post type Events
function news_post_type() {

    $args = [
        'labels' => [
            'name' => 'Events',
            'singular_name' => 'Event'
        ],
        'hierarchical' => true,
        'public' => true,
        'has_archive' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'menu_icon' => 'dashicons-format-status',
        'supports' => ['title', 'editor', 'thumbnail', 'excerpt'],
        // 'rewrite' => ['slug' => 'aktuali']

    ];

    register_post_type('Events', $args);
    flush_rewrite_rules();
    add_theme_support( 'post-thumbnails', array( 'post', 'events' ) );
}
add_action('init', 'news_post_type');


function fancybox_gallery_attribute( $content, $id ) {
	$title = get_the_title( $id );
	return str_replace('<a', '<a data-type="image" data-fancybox="gallery1" class="textpage__gallery-big" title="' . esc_attr( $title ) . '" ', $content);
}
add_filter( 'wp_get_attachment_link', 'fancybox_gallery_attribute', 10, 4 );

// Single images
function fancybox_image_attribute( $content ) {
       global $post;

       $pattern = "/<a(.*?)href=('|\")(.*?).(bmp|gif|jpeg|jpg|png)('|\")(.*?)>/i";
       $replace = '<a$1href=$2$3.$4$5 data-type="image" data-fancybox="image">';
       $content = preg_replace( $pattern, $replace, $content );

       return $content;
}
add_filter( 'the_content', 'fancybox_image_attribute' );

// add_filter( 'use_default_gallery_style', '__return_false' );

// custom image size
add_image_size( 'small-gallery', 155, 118, true );


// Translate
$name = 'footer_quick_link_title';
$string = 'Ātrās saites';
pll_register_string($name, $string);

$name = 'footer_useful_link_title';
$string = 'Noderīgi';
pll_register_string($name, $string);

$name = 'footer_contact_title';
$string = 'Kontakti';
pll_register_string($name, $string);

$name = 'footer_follow_title';
$string = 'Sekojiet mums';
pll_register_string($name, $string);

$name = 'contact_form_title';
$string = 'Droši sazinies ar mums';
pll_register_string($name, $string);

//Menu Walker

if ( ! class_exists( 'WP_Bootstrap_Navwalker' ) ) {

	class WP_Bootstrap_Navwalker extends Walker_Nav_Menu {

		public function start_lvl( &$output, $depth = 0, $args = array() ) {
			if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
				$t = '';
				$n = '';
			} else {
				$t = "\t";
				$n = "\n";
			}
			$indent = str_repeat( $t, $depth );
			// Default class to add to the file.
			$classes = array( 'dropdown-menu' );

			$class_names = join( ' ', apply_filters( 'nav_menu_submenu_css_class', $classes, $args, $depth ) );
			$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

			$labelledby = '';
			// Find all links with an id in the output.
			preg_match_all( '/(<a.*?id=\"|\')(.*?)\"|\'.*?>/im', $output, $matches );

			if ( end( $matches[2] ) ) {
			
				$labelledby = 'aria-labelledby="' . esc_attr( end( $matches[2] ) ) . '"';
			}
			$output .= "{$n}{$indent}<ul$class_names $labelledby role=\"menu\">{$n}";
		}

		public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
			if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
				$t = '';
				$n = '';
			} else {
				$t = "\t";
				$n = "\n";
			}
			$indent = ( $depth ) ? str_repeat( $t, $depth ) : '';

			$classes = empty( $item->classes ) ? array() : (array) $item->classes;

			$linkmod_classes = array();
			$icon_classes    = array();

			$classes = self::separate_linkmods_and_icons_from_classes( $classes, $linkmod_classes, $icon_classes, $depth );

			$icon_class_string = join( ' ', $icon_classes );

			$args = apply_filters( 'nav_menu_item_args', $args, $item, $depth );

			if ( isset( $args->has_children ) && $args->has_children ) {
				$classes[] = 'dropdown';
			}
			if ( in_array( 'current-menu-item', $classes, true ) || in_array( 'current-menu-parent', $classes, true ) ) {
				$classes[] = 'active';
			}

			$classes[] = 'menu-item-' . $item->ID;
			$classes[] = 'nav-item';

			$classes = apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth );

			$class_names = join( ' ', $classes );
			$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

			$id = apply_filters( 'nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth );
			$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

			$output .= $indent . '<li ' . $id . $class_names . '>';

			$atts = array();

			if ( empty( $item->attr_title ) ) {
				$atts['title'] = ! empty( $item->title ) ? strip_tags( $item->title ) : '';
			} else {
				$atts['title'] = $item->attr_title;
			}

			$atts['target'] = ! empty( $item->target ) ? $item->target : '';
			$atts['rel']    = ! empty( $item->xfn ) ? $item->xfn : '';
			// If the item has children, add atts to the <a>.
			if ( isset( $args->has_children ) && $args->has_children && 0 === $depth && $args->depth > 1 ) {
				$atts['href']          = '#';
				$atts['data-toggle']   = 'dropdown';
				$atts['aria-haspopup'] = 'true';
				$atts['aria-expanded'] = 'false';
				$atts['class']         = 'dropdown-toggle nav-link';
				$atts['id']            = 'menu-item-dropdown-' . $item->ID;
			} else {
				$atts['href'] = ! empty( $item->url ) ? $item->url : '#';
				// For items in dropdowns use .dropdown-item instead of .nav-link.
				if ( $depth > 0 ) {
					$atts['class'] = 'dropdown-item';
				} else {
					$atts['class'] = 'nav-link';
				}
			}

			$atts['aria-current'] = $item->current ? 'page' : '';

			// Update atts of this item based on any custom linkmod classes.
			$atts = self::update_atts_for_linkmod_type( $atts, $linkmod_classes );
			// Allow filtering of the $atts array before using it.
			$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

			// Build a string of html containing all the atts for the item.
			$attributes = '';
			foreach ( $atts as $attr => $value ) {
				if ( ! empty( $value ) ) {
					$value       = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
					$attributes .= ' ' . $attr . '="' . $value . '"';
				}
			}

			$linkmod_type = self::get_linkmod_type( $linkmod_classes );

			$item_output = isset( $args->before ) ? $args->before : '';

			if ( '' !== $linkmod_type ) {
				// Is linkmod, output the required element opener.
				$item_output .= self::linkmod_element_open( $linkmod_type, $attributes );
			} else {
				// With no link mod type set this must be a standard <a> tag.
				$item_output .= '<a' . $attributes . '>';
			}

			$icon_html = '';
			if ( ! empty( $icon_class_string ) ) {
				// Append an <i> with the icon classes to what is output before links.
				$icon_html = '<i class="' . esc_attr( $icon_class_string ) . '" aria-hidden="true"></i> ';
			}

			/** This filter is documented in wp-includes/post-template.php */
			$title = apply_filters( 'the_title', esc_html( $item->title ), $item->ID );
			$title = apply_filters( 'nav_menu_item_title', $title, $item, $args, $depth );

			// If the .sr-only class was set apply to the nav items text only.
			if ( in_array( 'sr-only', $linkmod_classes, true ) ) {
				$title         = self::wrap_for_screen_reader( $title );
				$keys_to_unset = array_keys( $linkmod_classes, 'sr-only', true );
				foreach ( $keys_to_unset as $k ) {
					unset( $linkmod_classes[ $k ] );
				}
			}

			// Put the item contents into $output.
			$item_output .= isset( $args->link_before ) ? $args->link_before . $icon_html . $title . $args->link_after : '';

			if ( '' !== $linkmod_type ) {
				// Is linkmod, output the required closing element.
				$item_output .= self::linkmod_element_close( $linkmod_type );
			} else {
				// With no link mod type set this must be a standard <a> tag.
				$item_output .= '</a>';
			}

			$item_output .= isset( $args->after ) ? $args->after : '';

			// END appending the internal item contents to the output.
			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );

		}

		
		public function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
			if ( ! $element ) {
				return; }
			$id_field = $this->db_fields['id'];
			// Display this element.
			if ( is_object( $args[0] ) ) {
				$args[0]->has_children = ! empty( $children_elements[ $element->$id_field ] ); }
			parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
		}

		
		public static function fallback( $args ) {
			if ( current_user_can( 'edit_theme_options' ) ) {

				// Get Arguments.
				$container       = $args['container'];
				$container_id    = $args['container_id'];
				$container_class = $args['container_class'];
				$menu_class      = $args['menu_class'];
				$menu_id         = $args['menu_id'];

				// Initialize var to store fallback html.
				$fallback_output = '';

				if ( $container ) {
					$fallback_output .= '<' . esc_attr( $container );
					if ( $container_id ) {
						$fallback_output .= ' id="' . esc_attr( $container_id ) . '"';
					}
					if ( $container_class ) {
						$fallback_output .= ' class="' . esc_attr( $container_class ) . '"';
					}
					$fallback_output .= '>';
				}
				$fallback_output .= '<ul';
				if ( $menu_id ) {
					$fallback_output .= ' id="' . esc_attr( $menu_id ) . '"'; }
				if ( $menu_class ) {
					$fallback_output .= ' class="' . esc_attr( $menu_class ) . '"'; }
				$fallback_output .= '>';
				$fallback_output .= '<li class="nav-item"><a href="' . esc_url( admin_url( 'nav-menus.php' ) ) . '" class="nav-link" title="' . esc_attr__( 'Add a menu', 'wp-bootstrap-navwalker' ) . '">' . esc_html__( 'Add a menu', 'wp-bootstrap-navwalker' ) . '</a></li>';
				$fallback_output .= '</ul>';
				if ( $container ) {
					$fallback_output .= '</' . esc_attr( $container ) . '>';
				}

				// If $args has 'echo' key and it's true echo, otherwise return.
				if ( array_key_exists( 'echo', $args ) && $args['echo'] ) {
					echo $fallback_output; // WPCS: XSS OK.
				} else {
					return $fallback_output;
				}
			}
		}

		private function separate_linkmods_and_icons_from_classes( $classes, &$linkmod_classes, &$icon_classes, $depth ) {
			// Loop through $classes array to find linkmod or icon classes.
			foreach ( $classes as $key => $class ) {
				/*
				 * If any special classes are found, store the class in it's
				 * holder array and and unset the item from $classes.
				 */
				if ( preg_match( '/^disabled|^sr-only/i', $class ) ) {
					// Test for .disabled or .sr-only classes.
					$linkmod_classes[] = $class;
					unset( $classes[ $key ] );
				} elseif ( preg_match( '/^dropdown-header|^dropdown-divider|^dropdown-item-text/i', $class ) && $depth > 0 ) {
					/*
					 * Test for .dropdown-header or .dropdown-divider and a
					 * depth greater than 0 - IE inside a dropdown.
					 */
					$linkmod_classes[] = $class;
					unset( $classes[ $key ] );
				} elseif ( preg_match( '/^fa-(\S*)?|^fa(s|r|l|b)?(\s?)?$/i', $class ) ) {
					// Font Awesome.
					$icon_classes[] = $class;
					unset( $classes[ $key ] );
				} elseif ( preg_match( '/^glyphicon-(\S*)?|^glyphicon(\s?)$/i', $class ) ) {
					// Glyphicons.
					$icon_classes[] = $class;
					unset( $classes[ $key ] );
				}
			}

			return $classes;
		}

		private function get_linkmod_type( $linkmod_classes = array() ) {
			$linkmod_type = '';
			// Loop through array of linkmod classes to handle their $atts.
			if ( ! empty( $linkmod_classes ) ) {
				foreach ( $linkmod_classes as $link_class ) {
					if ( ! empty( $link_class ) ) {

						// Check for special class types and set a flag for them.
						if ( 'dropdown-header' === $link_class ) {
							$linkmod_type = 'dropdown-header';
						} elseif ( 'dropdown-divider' === $link_class ) {
							$linkmod_type = 'dropdown-divider';
						} elseif ( 'dropdown-item-text' === $link_class ) {
							$linkmod_type = 'dropdown-item-text';
						}
					}
				}
			}
			return $linkmod_type;
		}

		private function update_atts_for_linkmod_type( $atts = array(), $linkmod_classes = array() ) {
			if ( ! empty( $linkmod_classes ) ) {
				foreach ( $linkmod_classes as $link_class ) {
					if ( ! empty( $link_class ) ) {
						/*
						 * Update $atts with a space and the extra classname
						 * so long as it's not a sr-only class.
						 */
						if ( 'sr-only' !== $link_class ) {
							$atts['class'] .= ' ' . esc_attr( $link_class );
						}
						// Check for special class types we need additional handling for.
						if ( 'disabled' === $link_class ) {
							// Convert link to '#' and unset open targets.
							$atts['href'] = '#';
							unset( $atts['target'] );
						} elseif ( 'dropdown-header' === $link_class || 'dropdown-divider' === $link_class || 'dropdown-item-text' === $link_class ) {
							// Store a type flag and unset href and target.
							unset( $atts['href'] );
							unset( $atts['target'] );
						}
					}
				}
			}
			return $atts;
		}

		private function wrap_for_screen_reader( $text = '' ) {
			if ( $text ) {
				$text = '<span class="sr-only">' . $text . '</span>';
			}
			return $text;
		}

		private function linkmod_element_open( $linkmod_type, $attributes = '' ) {
			$output = '';
			if ( 'dropdown-item-text' === $linkmod_type ) {
				$output .= '<span class="dropdown-item-text"' . $attributes . '>';
			} elseif ( 'dropdown-header' === $linkmod_type ) {
				/*
				 * For a header use a span with the .h6 class instead of a real
				 * header tag so that it doesn't confuse screen readers.
				 */
				$output .= '<span class="dropdown-header h6"' . $attributes . '>';
			} elseif ( 'dropdown-divider' === $linkmod_type ) {
				// This is a divider.
				$output .= '<div class="dropdown-divider"' . $attributes . '>';
			}
			return $output;
		}

		private function linkmod_element_close( $linkmod_type ) {
			$output = '';
			if ( 'dropdown-header' === $linkmod_type || 'dropdown-item-text' === $linkmod_type ) {
				/*
				 * For a header use a span with the .h6 class instead of a real
				 * header tag so that it doesn't confuse screen readers.
				 */
				$output .= '</span>';
			} elseif ( 'dropdown-divider' === $linkmod_type ) {
				// This is a divider.
				$output .= '</div>';
			}
			return $output;
		}
	}
}