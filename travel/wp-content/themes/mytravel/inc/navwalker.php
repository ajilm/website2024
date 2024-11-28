<?php
// Include WP_Bootstrap_Navwalker class if not already included
require_once get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php';

// Extend the WP_Bootstrap_Navwalker class to customize it
class WP_Bootstrap_Navwalker_Extended extends WP_Bootstrap_Navwalker {
    // Your custom code goes here (e.g., adding the 'has-children' and 'dropdown' classes)
    protected function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        
        // Add 'dropdown' class to the parent menu item
        if (in_array('menu-item-has-children', $classes)) {
            $classes[] = 'has-children dropdown'; // Add the 'has-children' and 'dropdown' classes
        }

        $classes[] = 'menu-item-' . $item->ID; // Add menu item ID class
        $classes = array_filter( $classes ); // Clean up any empty classes
        
        // Add the class to the item
        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_unique( $classes ), $item, $args ) );
        $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
        
        // Add custom attributes to the <a> tag
        $id = 'menu-item-'. $item->ID; // Set the item ID
        $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

        // Build the opening <li> tag and <a> tag
        $output .= '<li' . $id . $class_names .'>';
        $attributes = !empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) . '" ' : '';
        $attributes .= !empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) . '" ' : '';
        $attributes .= !empty( $item->xfn )        ? ' rel="' . esc_attr( $item->xfn        ) . '" ' : '';
        $attributes .= !empty( $item->url )        ? ' href="' . esc_attr( $item->url        ) . '" ' : '';
        
        // Add the dropdown-toggle class for items with submenus
        $classes = ['menu-link'];
        if (in_array('has-children', $classes)) {
            $attributes .= ' class="dropdown-toggle" data-bs-toggle="dropdown"';
        }
        
        $item_output = $args->before;
        $item_output .= '<a'. $attributes .'>';
        $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;
        
        $output .= $item_output;
    }
}
