<?php

/**
 * Get Xprofile Group Icon
 */
function youzify_get_xprofile_group_icon( $group_id = null ) {

	// Get Group Icon.
	$icon = youzify_option( 'youzify_xprofile_group_icon_' . $group_id, 'fas fa-info' );

	return apply_filters( 'youzify_xprofile_group_icon', $icon, $group_id );
}

/**
 * Get Open Graph Tags
 */
function youzify_get_open_graph_tags( $type = null, $url = null,  $title = nul, $description = null, $image = null, $size = null ) {

    if ( ! apply_filters( 'youzify_display_open_graph_tags', true ) ) {
        return;
    }

    $type = ! empty( $type ) ? $type : 'profile';

    ?>

    <!-- Youzify Open Graph Tags -->

    <meta property="twitter:card" content="summary_large_image">
    <meta property="og:type" content="<?php echo $type; ?>">

    <?php if ( ! empty( $title ) ) : ?>
        <meta property="twitter:title" content="<?php echo $title; ?>">
        <meta property="og:title" content="<?php echo $title; ?>">
    <?php endif; ?>

    <meta property="og:url" content="<?php echo $url; ?>">

    <?php if ( ! empty( $image ) ) : ?>
        <meta property="og:image" content="<?php echo $image; ?>">
        <meta property="twitter:image" content="<?php echo $image; ?>">
    <?php endif; ?>

    <?php if ( ! empty( $description ) ) : $description = wp_strip_all_tags( $description ); ?>
        <meta property="og:description" content="<?php echo $description; ?>">
        <meta property="twitter:description" content="<?php echo $description; ?>">
    <?php endif; ?>

    <!-- End of Youzify Open Graph Tags -->

    <?php

}

/**
 * Default Cover Path
 */
function youzify_get_default_profile_cover() {
    return apply_filters( 'youzify_default_profile_cover', YOUZIFY_ASSETS . 'images/geopattern.png' );
}

/**
 * Navbar Settings Menu.
 */
function youzify_get_social_buttons( $user_id = false ) {

    if ( ! is_user_logged_in() ) {
        return;
    }

    ?><div id="item-header" class="youzify-social-buttons"><?php

            if ( bp_is_active( 'friends' ) ) {
                bp_add_friend_button( $user_id );
            }

            do_action( 'youzify_social_buttons', $user_id );

            if ( ! youzify_is_bpfollowers_active() ) {
                youzify_send_private_message_button( $user_id );
            }

    ?></div><?php

}

/**
 * Get Profile Layout
 */
function youzify_get_profile_layout() {
    // Set Up Variable
    $header_layout = youzify_option( 'youzify_header_layout', 'hdr-v1' );
    return false !== strpos( $header_layout, 'youzify-author' ) ? 'youzify-vertical-layout' : 'youzify-horizontal-layout';
}

function youzify_profile_tab_content() {
    do_action( 'youzify_profile_tab_content' );
}

/**
 * Get Function Args.
 */
function youzify_get_profile_widget_args( $widget ) {
    switch ( $widget ) {

        case 'post':
            $args = array(
                'id' => 'post',
                'order' => 90,
                'display_title' => false,
                'icon' => 'fas fa-pencil-alt',
                'main_data' => 'youzify_wg_post_id',
                'name' => youzify_option( 'youzify_wg_post_title', __( 'Post', 'youzify' ) ),
            );
            break;

        case 'link':
            $args = array(
                'order' => 70,
                'id' => 'link',
                'icon' => 'fas fa-link',
                'main_data' => 'youzify_wg_link_url',
                'display_title' => youzify_option( 'youzify_wg_link_display_title', 'off' ),
                'name'  => youzify_option( 'youzify_wg_link_title', __( 'Link', 'youzify' ) ),
            );
            break;

        case 'quote':
             $args = array(
                'order' => 60,
                'id' => 'quote',
                'icon' => 'fas fa-quote-right',
                'main_data' => 'youzify_wg_quote_txt',
                'display_title' => youzify_option( 'youzify_wg_quote_display_title', 'off' ),
                'name' => youzify_option( 'youzify_wg_quote_title', __( 'Quote', 'youzify' ) ),
            );
            break;

        case 'video':
             $args = array(
                'order' => 80,
                'id' => 'video',
                'icon' => 'fas fa-video',
                'main_data'  => 'youzify_wg_video_url',
                'name'  => youzify_option( 'youzify_wg_video_title', __( 'Video', 'youzify' ) ),
            );
            break;

        case 'flickr':
            $args = array(
                'order' => 100,
                'id' => 'flickr',
                'icon' => 'fab fa-flickr',
                'main_data'   => 'youzify_wg_flickr_account_id',
                'name'  => youzify_option( 'youzify_wg_flickr_title', __( 'Flickr', 'youzify' ) ),
            );

            break;

        case 'skills':
             $args = array(
                'order'  => 20,
                'icon' => 'fas fa-tasks',
                'id' => 'skills',
                'main_data'   => 'youzify_skills',
                'name'  => youzify_option( 'youzify_wg_skills_title', __( 'Skills', 'youzify' ) ),
            );
            break;

        case 'groups':
            $args = array(
                'id' => 'groups',
                'icon' => 'fas fa-users',
                'name'  => youzify_option( 'youzify_wg_groups_title', __( 'Groups', 'youzify' ) ),
            );
            break;

        case 'friends':
            $args = array(
                'id' => 'friends',
                'icon' => 'fas fa-handshake',
                'name'  => youzify_option( 'youzify_wg_friends_title', __( 'Friends', 'youzify' ) ),
            );
            break;

        case 'project':
            $args = array(
                'order'  => 50,
                'id' => 'project',
                'display_title' => false,
                'icon' => 'fas fa-suitcase',
                'main_data'   => 'youzify_wg_project_desc',
                'name'  => youzify_option( 'youzify_wg_project_title', __( 'Project', 'youzify' ) ),
            );
            break;

        case 'login':
            $args = array(
                'id' => 'login',
                'display_title' => 'off',
                'icon' => 'fas fa-sign-in-alt',
                'name'  => __( 'Login', 'youzify' ),
            );
            break;

        case 'reviews':
            $args = array(
                'id' => 'reviews',
                'icon' => 'far fa-star',
                'name'  => youzify_option( 'youzify_wg_reviews_title', __( 'Reviews', 'youzify' ) ),
            );
            break;

        case 'about_me':
            $args = array(
                'order'  => 10,
                'icon' => 'fas fa-user',
                'id' => 'about_me',
                'main_data'   => 'youzify_wg_about_me_bio',
                'name'  => youzify_option( 'youzify_wg_aboutme_title', __( 'About Me', 'youzify' ) ),
            );
            break;

        case 'services':
            $args = array(
                'order'   => 40,
                'icon'  => 'fas fa-wrench',
                'id'  => 'services',
                'main_data'    => 'youzify_services',
                'name' => youzify_option( 'youzify_wg_services_title', __( 'Services', 'youzify' ) ),
            );
            break;

        case 'user_tags':
            $args = array(
                'order'  => 30,
                'icon' => 'fas fa-tags',
                'id' => 'user_tags',
                'display_title' => youzify_option( 'youzify_wg_user_tags_display_title', 'off' ),
                'name'  => youzify_option( 'youzify_wg_user_tags_title', __( 'User Tags', 'youzify' ) ),
            );
            break;


        case 'portfolio':
            $args = array(
                'order'  => 30,
                'id' => 'portfolio',
                'icon' => 'fas fa-images',
                'main_data'   => 'youzify_portfolio',
                'name'  => youzify_option( 'youzify_wg_portfolio_title', __( 'Portfolio', 'youzify' ) ),
            );
            break;

        case 'slideshow':
            $args = array(
                'order'  => 30,
                'id' => 'slideshow',
                'icon' => 'fas fa-film',
                'main_data'   => 'youzify_slideshow',
                'display_title' => youzify_option( 'youzify_wg_slideshow_display_title', 'off' ),
                'name'  => youzify_option( 'youzify_wg_slideshow_title', __( 'Slideshow', 'youzify' ) ),
            );
            break;

        case 'instagram':
            $args = array(
                'order'  => 100,
                'id' => 'instagram',
                'icon' => 'fab fa-instagram',
                'main_data'   => 'youzify_wg_instagram_account_id',
                'name'  => youzify_option( 'youzify_wg_instagram_title', __( 'Instagram', 'youzify' ) ),
            );
            break;

        case 'wall_media':
            $args = array(
                'order'  => 30,
                'display_title' => youzify_option( 'youzify_wg_media_display_title', 'on' ),
                'load_effect' => 'fadeIn',
                'id' => 'wall_media',
                'icon' => 'fas fa-photo-video',
                'name'  => youzify_option( 'youzify_wg_media_title', __( 'Media', 'youzify' ) ),
            );
            break;

        case 'user_badges':
            $args = array(
                'order'  => 100,
                'icon' => 'fas fa-trophy',
                'id' => 'user_badges',
                'name'  => youzify_option( 'youzify_wg_user_badges_title', __( 'User Badges', 'youzify' ) ),
            );

            break;

        case 'user_balance':
            $args = array(
                'order'  => 100,
                'icon' => 'fas fa-gem',
                'id' => 'user_balance',
                'display_title' => youzify_option( 'youzify_wg_user_balance_display_title', 'off' ),
                'name'  => youzify_option( 'youzify_wg_user_balance_title', __( 'User Balance', 'youzify' ) ),
            );
            break;

        case 'gamipress_user_badges':
            $args = array(
                'order'  => 100,
                'icon' => 'fas fa-trophy',
                'id' => 'gamipress_user_badges',
                'name'  => youzify_option( 'youzify_wg_gamipress_user_badges_title', __( 'User Badges', 'youzify' ) ),
            );

            break;

        case 'gamipress_user_balance':
            $args = array(
                'order'  => 100,
                'icon' => 'fas fa-gem',
                'id' => 'gamipress_user_balance',
                'display_title' => youzify_option( 'youzify_wg_gamipress_user_balance_display_title', 'off' ),
                'name'  => youzify_option( 'youzify_wg_gamipress_user_balance_title', __( 'User Balance', 'youzify' ) ),
            );
            break;

        case 'recent_posts':
             $args = array(
                'id' => 'recent_posts',
                'icon' => 'fas fa-newspaper',
                'main_data'   => 'recent_posts',
                'display_title' => youzify_option( 'youzify_wg_rposts_display_title', 'on' ),
                'name'  => youzify_option( 'youzify_wg_rposts_title', __( 'Recent Posts', 'youzify' ) ),
            );
            break;

        case 'phone':
            $args =array(
                'display_title' => 'off',
                'name'    => 'phone',
                'id'     => 'phone',
                'icon'     => 'fas fa-phone-volume',
                'main_data'       => 'phone_nbr',
                'function_options'  => array(
                    'box_class' => 'phone',
                    'box_id'  => 'phone_nbr',
                    'box_icon'  => 'fas fa-phone-volume',
                    'option_id' => 'youzify_phone_info_box_field',
                    'box_title' => __( 'Phone Number', 'youzify' )
                )
            );

            break;

        case 'email':
            $args = array(
                'display_title'   => 'off',
                'name'    => 'email',
                'id'     => 'email',
                'icon'     => 'far fa-envelope',
                'function_options'  => array(
                    'box_icon'  => 'far fa-envelope',
                    'box_class' => 'email',
                    'box_id'  => 'email_address',
                    'option_id' => 'youzify_email_info_box_field',
                    'box_title' => __( 'E-mail Address', 'youzify' )
                ),
                'main_data'       => 'email_address'
            );
            break;

        case 'social_networks':
            $args = array(
                'icon' => 'fas fa-share-alt',
                'id' => 'social_networks',
                'main_data'   => 'youzify_social_networks',
                'display_title' => youzify_option( 'youzify_wg_social_networks_display_title', 'on' ),
                'name'  => youzify_option( 'youzify_wg_sn_title', __( 'Keep in touch', 'youzify' ) ),
            );
            break;

        case 'website':
            $args = array(
                'display_title'   => 'off',
                'name'    => 'website',
                'id'     => 'website',
                'icon'     => 'fas fa-link',
                'main_data'       => 'user_url',
                'function_options'  => array(
                    'box_icon'  => 'fas fa-link',
                    'box_class' => 'website',
                    'box_id'  => 'user_url',
                    'option_id' => 'youzify_website_info_box_field',
                    'box_title' => __( 'Website', 'youzify' )
                )
            );
            break;

        case 'address':
            $args = array(
                'display_title'   => 'off',
                'name'    => 'address',
                'id'     => 'address',
                'icon'     => 'fas fa-home',
                'main_data'       => 'user_address',
                'function_options'  => array(
                    'box_icon'  => 'fas fa-home',
                    'box_class' => 'address',
                    'box_id'  => 'user_address',
                    'option_id' => 'youzify_address_info_box_field',
                    'box_title' => __( 'ADDRESS', 'youzify' ),
                )
            );
            break;

        default:

            $args = array();

            if ( false !== strpos( $widget, 'youzify_custom_widget_' ) ) {

                $widgets = youzify_option( 'youzify_custom_widgets' );

                // Get Custom Widgets
                $custom_widget_data = $widgets[ $widget ];

                // Get Custom Widget Args.
                $args = array(
                    'id'     => 'custom_widgets',
                    'function_options'  => $widget,
                    'main_data'       => 'youzify_custom_widgets',
                    'name'    => $custom_widget_data['name'],
                    'icon'     => $custom_widget_data['icon'],
                    'display_title'   => $custom_widget_data['display_title'],
                    'display_padding' => $custom_widget_data['display_padding'],
                    'load_effect'     => youzify_option( 'youzify_custom_widgets_load_effect', 'fadeIn' )
                );

            } elseif ( false !== strpos( $widget, 'youzify_ad_' ) ) {

                // Get ads
                $get_ads = youzify_option( 'youzify_ads' );

                // AD Args.
                $args = array(
                    'id'     => 'ad',
                    'icon'     => 'fas fa-bullhorn',
                    'name'    => $get_ads[ $widget ]['title'],
                    'function_options'  => $widget,
                    'widget_function' => 'youzify_ad_widget',
                    'load_effect'     => youzify_option( 'youzify_ads_load_effect', 'fadeIn' ),
                    'display_title'   => $get_ads[ $widget ]['is_sponsored']
                );
            }

            break;
    }


    return apply_filters( 'youzify_profile_widget_args', $args, $widget );
}

/**
 * User Quick Buttons.
 */
function youzify_user_quick_buttons( $user_id = false ) {

    $user_id = ! empty( $user_id ) ? $user_id : bp_loggedin_user_id();

    ?>

    <div class="youzify-quick-buttons">

        <?php if ( bp_is_active( 'friends' ) ) : ?>

            <?php

                // Get Buttons Data
                $friends_url = bp_loggedin_user_domain() . bp_get_friends_slug();
                $friend_requests = bp_friend_get_total_requests_count( $user_id );

            ?>

            <a href="<?php echo esc_url( $friends_url . '/requests' ); ?>" class="youzify-button-item youzify-friends-btn">
                <span class="dashicons dashicons-groups"></span>
                <?php if ( $friend_requests > 0 ) : ?>
                    <div class="youzify-button-count"><?php echo $friend_requests; ?></div>
                <?php endif; ?>
            </a>

        <?php endif; ?>

        <?php if ( bp_is_active( 'messages' ) ) : ?>

            <?php $msgs_nbr = bp_get_total_unread_messages_count( $user_id ); ?>

            <a href="<?php echo esc_url( bp_nav_menu_get_item_url( bp_get_messages_slug() ) ); ?>" class="youzify-button-item youzify-messages-btn">
                <span class="dashicons dashicons-email-alt"></span>
                <?php if ( $msgs_nbr > 0 ) : ?>
                <div class="youzify-button-count"><?php echo $msgs_nbr; ?></div>
                <?php endif; ?>
            </a>

        <?php endif; ?>

        <?php if ( bp_is_active( 'notifications' ) ) : ?>

            <?php $notification_nbr = bp_notifications_get_unread_notification_count( $user_id ); ?>

            <a href="<?php echo esc_url( bp_nav_menu_get_item_url( bp_get_notifications_slug() ) ); ?>" class="youzify-button-item youzify-notification-btn">
                <i class="fas fa-globe-asia"></i>
                <?php if ( $notification_nbr > 0 ) : ?>
                <div class="youzify-button-count"><?php echo $notification_nbr; ?></div>
                <?php endif; ?>
            </a>

        <?php endif; ?>

    </div>

    <?php
}

/**
 * Get User Profile Page.
 */
function youzify_get_user_profile_page( $slug = false, $user_id = false ) {

    // Get User ID.
    $user_id = ! empty( $user_id ) ? $user_id : bp_displayed_user_id();

    // Get User Profile Url.
    $page_url = bp_members_get_user_url( $user_id );

    if ( $slug ) {
        $page_url = $page_url . $slug;
    }

    return $page_url;
}

/**
 * Get Post Thumbnail
 */
function youzify_get_post_thumbnail( $args = false ) {

    $widget = isset( $args['widget'] ) ? $args['widget'] : 'post';
    $img_size = isset( $args['size'] ) ? $args['size'] : apply_filters( 'youzify_default_blog_post_image_size','medium' );

    if ( 'post' == $widget ) {

        if ( ! empty( $args['attachment_id'] ) ) {
            echo '<div class="youzify-post-thumbnail"><img loading="lazy" ' . youzify_get_image_attributes(apply_filters( 'youzify_blog_posts_thumbnail', $args['attachment_id'] ), $args['size'], $args['element'] ) . ' alt=""></div>';
        } else {
            // Get Post Format
            $format = get_post_format();
            $format = ! empty( $format ) ? $format : 'standard';
            echo '<div class="youzify-no-thumbnail"><div class="thumbnail-icon"><i class="' . youzify_get_format_icon( $format ) . '"></i></div></div>';
        }

    } else {

        if ( $args['attachment_id'] ) {
            echo "<div class='youzify-$widget-thumbnail'><img loading='lazy' " . youzify_get_image_attributes( $args['attachment_id'], $args['size'], $args['element'] ) . " alt=''></div>";
        } else {
            echo '<div class="youzify-no-thumbnail"><div class="thumbnail-icon"><i class="fas fa-image"></i></div></div>';
        }
    }

}

/**
 * Get Post Thumbnail
 */
function youzify_get_course_thumbnail( $args = false ) {

    $widget = isset( $args['widget'] ) ? $args['widget'] : 'course';
    $img_size = isset( $args['size'] ) ? $args['size'] : apply_filters( 'youzify_default_blog_post_image_size','medium' );

    if ( 'course' == $widget ) {

        if ( ! empty( $args['attachment_id'] ) ) {
            echo '<div class="youzify-course-thumbnail"><img loading="lazy" ' . youzify_get_image_attributes(apply_filters( 'youzify_blog_course_thumbnail', $args['attachment_id'] ), $args['size'], $args['element'] ) . ' alt=""></div>';
        } else {
            // Get Post Format
            $format = get_post_format();
            $format = ! empty( $format ) ? $format : 'standard';
            echo '<div class="youzify-no-thumbnail"><div class="thumbnail-icon"><i class="' . youzify_get_format_icon( $format ) . '"></i></div></div>';
        }

    } else {

        if ( $args['attachment_id'] ) {
            echo "<div class='youzify-$widget-thumbnail'><img loading='lazy' " . youzify_get_image_attributes( $args['attachment_id'], $args['size'], $args['element'] ) . " alt=''></div>";
        } else {
            echo '<div class="youzify-no-thumbnail"><div class="thumbnail-icon"><i class="fas fa-image"></i></div></div>';
        }
    }

}

/**
 * Get All BP Fields
 */
function youzify_get_bp_profile_fields() {
    // Init Fields.
    $fields = array();

    if ( ! bp_is_active( 'xprofile' ) ) {
        return $fields;
    }
    // Get Profile Groups Fields.
    $profile_groups = BP_XProfile_Group::get( array( 'fetch_fields' => true ) );
    if ( ! empty( $profile_groups ) ) {
         foreach ( $profile_groups as $profile_group ) {
            if ( ! empty( $profile_group->fields ) ) {
                foreach ( $profile_group->fields as $field ) {
                    $fields[] = array(
                        'id' => $field->id,
                        'name' => $field->name
                    );
                }
            }
        }
    }
    // Filter;
    $fields = apply_filters( 'youzify_get_bp_profile_fields', $fields );
    return $fields;
}

/**
 * Get Xprofile fields by field type.
 */
function youzify_get_xprofile_fields_by_type( $fields_type ) {

    global $wpdb;

    // Get Fields Table Name.
    $fields_table = buddypress()->profile->table_name_fields;

    // Get Sql Query.
    $sql = "SELECT id FROM {$fields_table} WHERE type = %s";

    // Get Fields ID'S.
    $fields_ids = $wpdb->get_col( $wpdb->prepare( $sql, $fields_type ) );

    return $fields_ids;
}

/**
 * Activate Shortcode in Wordpress Menu
 */
add_filter( 'wp_nav_menu_items', 'youzify_activate_wp_menus_shortcodes', 10 );

function youzify_activate_wp_menus_shortcodes( $items ) {
    return do_shortcode( $items );
}

/**
 * Replace Wordpress Menu Variable
 */
add_filter( 'nav_menu_link_attributes', 'youzify_wp_menu_custom_tag_override', 10, 2 );

function youzify_wp_menu_custom_tag_override( $atts, $item ) {

    if ( $item->object == 'custom' ) {
        $user = wp_get_current_user();
        $atts['href'] = str_replace( '#youzify_user#', $user->user_login, $atts['href'] );
    }

    return $atts;
}

/**
 * Create Menu Shortcode.
 */
function youzify_user_account_avatar() {

    if ( ! is_user_logged_in() ) {
        return false;
    }

    // Get Logged-IN User ID.
    $user_id = bp_loggedin_user_id();

    ob_start();

    ?>

    <div class="youzify-primary-nav-area">

        <div class="youzify-primary-nav-settings">
            <div class="youzify-primary-nav-img" style="background-image: url(<?php echo bp_core_fetch_avatar( array(
            'item_id' => $user_id, 'type' => 'thumbnail', 'html' => false ) ); ?>)"></div>
            <span><?php echo apply_filters( 'youzify_account_avatar_shortcode_username', bp_members_get_user_slug( $user_id ), $user_id ); ?></span>
            <?php if ( 'on' == youzify_option( 'youzify_disable_wp_menu_avatar_icon', 'on' ) ) : ?><i class="fas fa-angle-down youzify-settings-icon"></i><?php endif; ?>
        </div>

    </div>

    <script type="text/javascript">

        // Show/Hide Primary Nav Message
        jQuery( '.youzify-primary-nav-settings' ).click( function( e ) {
            // e.preventDefault();
            // Get Parent Box.
            var settings_box = jQuery( this ).closest( '.youzify-primary-nav-area' );
            // Toggle Menu.
            settings_box.toggleClass( 'open-settings-menu' );
            // Display or Hide Box.
            settings_box.find( '.youzify-settings-menu' ).fadeToggle( 400 );
        });

    </script>

    <?php

    return ob_get_clean();;
}

add_shortcode( 'youzify_account_avatar', 'youzify_user_account_avatar' );

/**
 * Profile Hidden Tabs
 **/
function youzify_profile_hidden_tabs() {
    return apply_filters( 'youzify_profile_hidden_tabs', array( 'youzify-home', 'widgets', 'profile', 'settings', 'messages', 'notifications' ) );
}

/**
 * Get Primary Navigation Menu Icon
 */
function youzify_get_profile_primary_nav() {

    global $bp;

    // Init Array().
    $new_primary_nav = array();

    // Get Original Primary Nav
    $primary_nav = $bp->members->nav->get_primary();

    // Filter Hidden Tabs.
    $hidden_tabs = youzify_profile_hidden_tabs();

    foreach ( $primary_nav as $nav ) {

        // Don't Show Youzify Hidden Tabs.
        if ( in_array( $nav['slug'], $hidden_tabs ) ) {
            continue;
        }

        if ( ! is_admin() ) {

            // Hide Invisible Tabs.
            if ( isset( $nav['visibility'] ) ) {
                continue;
            }

            // Check if tab should be displayed for the current user.
            if ( empty( $nav['show_for_displayed_user'] ) && ! bp_is_my_profile() ) {
                continue;
            }

            // Hide Comments Menu if User Have no comments.
            if ( apply_filters( 'youzify_show_profile_comments_tab_if_user_has_comments', true ) ) {
                if ( $nav['slug'] == 'comments' && ! youzify_is_user_have_comments() ) {
                    continue;
                }
            }

            // Hide Posts Menu if User Have no posts.
            if ( apply_filters( 'youzify_show_profile_posts_tab_if_user_has_posts', true ) ) {
                if ( $nav['slug'] == 'posts' && ! youzify_is_user_have_posts() ) {
                    continue;
                }
            }
        }

        // Add Tab.
        $new_primary_nav[] = $nav;
    }

    return apply_filters( 'youzify_profile_primary_nav', $new_primary_nav );
}

/**
 * Profile Tabs Default Values
 */
function youzify_profile_tabs_default_value() {

    // Init
    $tabs = array(
        'overview' => array( 'visibility' => 'on', 'icon' => 'fas fa-globe-asia' ),
        'activity' => array( 'visibility' => 'on', 'icon' => 'fas fa-address-card' ),
        'info' => array( 'visibility' => 'on', 'icon' => 'fas fa-info' ),
        'comments' => array( 'visibility' => 'on', 'icon' => 'far fa-comments' ),
        'posts' => array( 'visibility' => 'on', 'icon' => 'fas fa-pencil-alt' ),
        'friends' => array( 'visibility' => 'on', 'icon' => 'fas fa-handshake' ),
        'follows' => array( 'visibility' => 'on', 'icon' => 'fas fa-rss' ),
        'groups' => array( 'visibility' => 'on', 'icon' => 'fas fa-users' ),
        'notifications' => array( 'visibility' => 'off', 'icon' => 'fas fa-bell' ),
        'invitations' => array( 'visibility' => 'on', 'icon' => 'fas fa-envelope-open-text' ),
        'messages' => array( 'visibility' => 'off', 'icon' => 'fas fa-envelope-open-text' ),
        'widgets' => array( 'visibility' => 'off', 'icon' => 'fas fa-sliders' ),
        'settings' => array( 'visibility' => 'off', 'icon' => 'fas fa-cogs' ),
        'profile' => array( 'visibility' => 'off', 'icon' => 'fas fa-user-circle' ),
        'badges' => array( 'visibility' => 'on', 'icon' => 'fas fa-trophy' ),
        'events' => array( 'visibility' => 'on', 'icon' => 'fas fa-calendar-week' ),
        'reviews' => array( 'visibility' => 'on', 'icon' => 'fas fa-star' ),
        'bookmarks' => array( 'visibility' => 'on', 'icon' => 'fas fa-bookmark' ),
        'media' => array( 'visibility' => 'on', 'icon' => 'fas fa-photo-video' ),
        'forums' => array( 'visibility' => 'on', 'icon' => 'far fa-comments' ),
        'courses' => array( 'visibility' => 'on', 'icon' => 'fas fa-book' ),
        'shop' => array( 'visibility' => 'on', 'icon' => 'fas fa-shopping-cart' )
    );

    return $tabs;
}

/**
 * Media Shortcode.
 **/
add_shortcode( 'youzify_media', 'youzify_media_shortcode' );

function youzify_media_shortcode( $atts ) {

    // return '';
    if ( is_admin() ) {
        return;
    }

    $media = youzify_media();

    // Scripts
    $media->scripts();

    // Get Args.
    $args = apply_filters( 'youzify_media_shortcode_args', wp_parse_args( $atts, array(
        'box' => 'small',
        'filters' => 'photos,videos,audios,files',
        'photos_number' => 9,
        'videos_number' => 9,
        'audios_number' => 6,
        'files_number' => 6
    ) ) );

    // Get Allowed Boxes Sizes
    $args['box'] = in_array( $args['box'], array( 'small', 'medium', 'large' ) ) ? esc_attr( $args['box'] ) : 'small';

    // Get Filters
    $filters = explode( ',', str_replace( ' ', '', $args['filters'] ) );

    // Get Available Filters
    $available_filters = apply_filters( 'youzify_widget_media_filter_args', array(
        'photos' => array(
            'type'  => 'photos',
            'view_all' => true,
            'icon' => 'fas fa-image',
            'limit' => $args['photos_number'],
            'title' => __( 'Photos', 'youzify' )
        ),
        'videos' => array(
            'type' => 'videos',
            'view_all' => true,
            'icon' => 'fas fa-film',
            'limit' => $args['videos_number'],
            'title' => __( 'Videos', 'youzify' )
        ),
        'audios' => array(
            'type' => 'audios',
            'view_all' => true,
            'icon' => 'fas fa-volume-up',
            'limit' => $args['audios_number'],
            'title' => __( 'Audios', 'youzify' )
        ),
        'files' => array(
            'type' => 'files',
            'view_all' => true,
            'limit' => $args['files_number'],
            'title' => __( 'Files', 'youzify' ),
            'icon' => 'fas fa-cloud-download-alt'
        )
    ));

    $box_filters = array();

    // Get Filters to Show.
    foreach ( $filters as $key => $filter ) {
        if ( isset( $available_filters[ $filter ] ) ) {
            $box_filters[] = $available_filters[ $filter ];
        } else {
            unset( $filters[ $key ] );
        }
    }

    // Reset Filters
    $default_type = array_values( $filters )[0];

    // Set Default Query Type.
    $args['type'] = $default_type;

    ?>

    <div class="youzify-media youzify-media-box" style="display: none;">
        <?php $count = count( $box_filters ); if ( $count > 1 ) : ?>
        <div class="youzify-media-filter">
            <?php foreach( $box_filters as $filter ) : ?>
            <div class="youzify-filter-item" style="width:<?php echo 100 / $count; ?>%;">
                <div class="youzify-filter-content<?php if ( $filter['type'] == $default_type ) echo ' youzify-current-filter'; ?>" <?php if ( isset( $args['user_id'] ) ) $filter['user_id'] = $args['user_id']; if ( isset( $args['box'] ) ) $filter['box'] = $args['box']; if ( isset( $args['group_id'] ) ) $filter['group_id'] = $args['group_id']; echo youzify_get_tag_attributes( $filter ); ?> ><i class="<?php echo $filter['icon']; ?>"></i><span><?php echo $filter['title']; ?></span></div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
        <div class="youzify-media-widget youzify-media-<?php echo esc_attr( sanitize_text_field( $args['box'] ) ); ?>-box">
            <div class="youzify-media-group-<?php echo esc_attr( $default_type ); ?>" data-active="true">

                <div class="youzify-media-widget-content">
                <?php
                    switch ( $default_type ) {
                        case 'photos':
                            $item = __( 'Photos', 'youzify' );
                            $args['limit'] = $args['photos_number'];
                            $media->get_photos_items( $args );
                            break;
                        case 'videos':
                            $item = __( 'Videos', 'youzify' );
                            $args['limit'] = $args['videos_number'];
                            $media->get_videos_items( $args );
                            break;
                        case 'audios':
                            $item = __( 'Audios', 'youzify' );
                            $args['limit'] = $args['audios_number'];
                            $media->get_audios_items( $args );
                            break;
                        case 'files':
                            $item = __( 'Files', 'youzify' );
                            $args['limit'] = $args['files_number'];
                            $media->get_files_items( $args );
                            break;

                    }
                ?>
                </div>

                <?php $total = $media->get_media( youzify_array_merge( $args, array( 'query' => 'count' ) ) ); ?>
                <?php if ( ( isset( $args['user_id'] ) || isset( $args['group_id'] ) ) && $total > $available_filters[ $default_type ]['limit'] ) : ?>
                <a class="youzify-media-view-all" href="<?php echo esc_url( $media->get_media_by_type_slug( $args ) ); ?>"><?php echo sprintf( __( 'View All %1s ( %2d )', 'youzify' ), $available_filters[ $default_type ]['title'], $total ); ?></a>
                <?php endif; ?>
                </div>


        </div>

    </div>

    <?php

}

/**
 * Media Slug
 */
function youzify_profile_media_slug() {
    $slug = function_exists( 'is_rtmedia_page' ) ? 'user-media' : 'media';
    return apply_filters( 'youzify_profile_media_slug', $slug );
}

/**
 * Widgets List
 */
function youzify_profile_widgets() {

    // Widget Arguments
    $widgets = array(
        'post'                   =>  array( 'class' => 'Youzify_Profile_Post_Widget', 'file' => 'post' ),
        'link'                   =>  array( 'class' => 'Youzify_Profile_Link_Widget', 'file' => 'link' ),
        'quote'                  =>  array( 'class' => 'Youzify_Profile_Quote_Widget', 'file' => 'quote' ),
        'video'                  =>  array( 'class' => 'Youzify_Profile_Video_Widget', 'file' => 'video' ),
        'flickr'                 =>  array( 'class' => 'Youzify_Profile_Flickr_Widget', 'file' => 'flickr' ),
        'skills'                 =>  array( 'class' => 'Youzify_Profile_Skills_Widget', 'file' => 'skills' ),
        'groups'                 =>  array( 'class' => 'Youzify_Profile_Groups_Widget', 'file' => 'groups' ),
        'friends'                =>  array( 'class' => 'Youzify_Profile_Friends_Widget', 'file' => 'friends' ),
        'project'                =>  array( 'class' => 'Youzify_Profile_Project_Widget', 'file' => 'project' ),
        'reviews'                =>  array( 'class' => 'Youzify_Profile_Reviews_Widget', 'file' => 'reviews' ),
        'about_me'               =>  array( 'class' => 'Youzify_Profile_About_Me_Widget', 'file' => 'about-me' ),
        'services'               =>  array( 'class' => 'Youzify_Profile_Services_Widget', 'file' => 'services' ),
        'user_tags'              =>  array( 'class' => 'Youzify_Profile_User_Tags_Widget', 'file' => 'user-tags' ),
        'portfolio'              =>  array( 'class' => 'Youzify_Profile_Portfolio_Widget', 'file' => 'portfolio' ),
        'slideshow'              =>  array( 'class' => 'Youzify_Profile_Slideshow_Widget', 'file' => 'slideshow' ),
        'instagram'              =>  array( 'class' => 'Youzify_Profile_Instagram_Widget', 'file' => 'instagram' ),
        'wall_media'             =>  array( 'class' => 'Youzify_Profile_Media_Widget', 'file' => 'media' ),
        'user_badges'            =>  array( 'class' => 'Youzify_Profile_User_Badges_Widget', 'file' => 'user-badges' ),
        'user_balance'           =>  array( 'class' => 'Youzify_Profile_User_Balance_Widget', 'file' => 'user-balance' ),
        'gamipress_user_badges'  =>  array( 'class' => 'Youzify_Gamipress_Profile_User_Badges_Widget', 'file' => 'gamipress-user-badges' ),
        'gamipress_user_balance' =>  array( 'class' => 'Youzify_Gamipress_Profile_User_Balance_Widget', 'file' => 'gamipress-user-balance' ),
        'recent_posts'           =>  array( 'class' => 'Youzify_Profile_Recent_Posts_Widget', 'file' => 'recent-posts' ),
        'social_networks'        =>  array( 'class' => 'Youzify_Profile_Networks_Widget', 'file' => 'social-networks' ),
        'login'                  =>  array( 'class' => 'Youzify_Profile_Login_Button_Widget', 'file' => 'login' ),
        'phone'                  =>  array( 'class' => 'Youzify_Profile_Phone_Info_Box_Widget', 'file' => 'phone' ),
        'email'                  =>  array( 'class' => 'Youzify_Profile_Email_Info_Box_Widget', 'file' => 'email' ),
        'website'                =>  array( 'class' => 'Youzify_Profile_Website_Info_Box_Widget', 'file' => 'website' ),
        'address'                =>  array( 'class' => 'Youzify_Profile_Address_Info_Box_Widget', 'file' => 'address' )
    );

    return apply_filters( 'youzify_profile_widgets', $widgets );
}

/**
 * Set Default Profile Avatar.
 */
function youzify_set_default_profile_avatar( $avatar, $params ) {

    // Get Default Avatar.
    $default_avatar = youzify_option( 'youzify_default_profiles_avatar' );

    if ( empty( $default_avatar ) ) {
        $default_avatar = $avatar;
    }

    return apply_filters( 'youzify_set_default_profile_avatar', $default_avatar, $params );

}

add_filter( 'bp_core_default_avatar_user', 'youzify_set_default_profile_avatar', 10, 2 );