<?php
/**
 * BuddyPress - Groups
 */

/**
 * Fires at the top of the groups directory template file.
 *
 * @since 1.5.0
 */
do_action( 'bp_before_directory_groups_page' ); ?>

<?php $icons_style = youzify_option( 'youzify_tabs_list_icons_style', 'youzify-tabs-list-gradient' ); ?>

<div id="youzify">

<div id="<?php echo apply_filters( 'youzify_group_template_id', 'youzify-bp' ); ?>" class="youzify <?php echo youzify_groups_directory_class(); ?>">
	<?php do_action( 'youzify_before_directory_groups_main_content' ); ?>

	<main class="youzify-page-main-content">

		<div id="youzify-groups-directory">

		<?php

		/**
		 * Fires before the display of the groups.
		 *
		 * @since 1.1.0
		 */
		do_action( 'bp_before_directory_groups' ); ?>

		<?php

		/**
		 * Fires before the display of the groups content.
		 *
		 * @since 1.1.0
		 */
		do_action( 'bp_before_directory_groups_content' ); ?>

		<?php if ( apply_filters( 'youzify_display_groups_directory_filter', true )  ) : ?>
		<div class="youzify-mobile-nav">
			<div id="directory-show-menu" class="youzify-mobile-nav-item"><div class="youzify-mobile-nav-container"><i class="fas fa-bars"></i><a><?php _e( 'Menu', 'youzify' ); ?></a></div></div>
			<div id="directory-show-search" class="youzify-mobile-nav-item"><div class="youzify-mobile-nav-container"><i class="fas fa-search"></i><a><?php _e( 'Search', 'youzify' ); ?></a></div></div>
			<div id="directory-show-filter" class="youzify-mobile-nav-item"><div class="youzify-mobile-nav-container"><i class="fas fa-sliders-h"></i><a><?php _e( 'Filter', 'youzify' ); ?></a></div></div>
		</div>

		<div class="youzify-directory-filter">

		<div class="item-list-tabs" aria-label="<?php esc_attr_e( 'Groups directory main navigation', 'youzify' ); ?>">
			<ul>
				<li class="selected" id="groups-all"><a href="<?php bp_groups_directory_url(); ?>"><?php printf( __( 'All Groups %s', 'youzify' ), '<span>' . bp_get_total_group_count() . '</span>' ); ?></a></li>

				<?php if ( is_user_logged_in() && bp_get_total_group_count_for_user( bp_loggedin_user_id() ) ) : ?>
					<li id="groups-personal"><a href="<?php echo esc_url( bp_loggedin_user_domain()  . bp_get_groups_slug() . '/my-groups/' ); ?>"><?php printf( __( 'My Groups %s', 'youzify' ), '<span>' . bp_get_total_group_count_for_user( bp_loggedin_user_id() ) . '</span>' ); ?></a></li>
				<?php endif; ?>

				<?php

				/**
				 * Fires inside the groups directory group filter input.
				 *
				 * @since 1.5.0
				 */
				do_action( 'bp_groups_directory_group_filter' ); ?>

			</ul>
		</div><!-- .item-list-tabs -->

		<div id="directory-show-search"><a><?php _e( 'Search', 'youzify' ); ?></a></div>
		<div id="directory-show-filter"><a><?php _e( 'Filter', 'youzify' ); ?></a></div>

			<div class="item-list-tabs" id="subnav" aria-label="<?php esc_attr_e( 'Groups directory secondary navigation', 'youzify' ); ?>" role="navigation">
				<ul>
				<?php

				/**
				 * Fires inside the groups directory group types.
				 *
				 * @since 1.2.0
				 */
				do_action( 'bp_groups_directory_group_types' ); ?>

				<li id="groups-order-select" class="last filter">

					<label for="groups-order-by"><?php _e( 'Order By:', 'youzify' ); ?></label>

					<select id="groups-order-by">
						<option value="active"><?php _e( 'Last Active', 'youzify' ); ?></option>
						<option value="popular"><?php _e( 'Most Members', 'youzify' ); ?></option>
						<option value="newest"><?php _e( 'Newly Created', 'youzify' ); ?></option>
						<option value="alphabetical"><?php _e( 'Alphabetical', 'youzify' ); ?></option>

						<?php

						/**
						 * Fires inside the groups directory group order options.
						 *
						 * @since 1.2.0
						 */
						do_action( 'bp_groups_directory_order_options' ); ?>
					</select>
				</li>
				<li id="youzify-directory-search-box">
					<div id="group-dir-search" class="dir-search" role="search">
						<?php bp_directory_groups_search_form(); ?>
					</div><!-- #group-dir-search -->
				</li>
				</ul>
			</div>
		</div>

		<?php endif; ?>

		<form action="" method="post" id="groups-directory-form" class="dir-form">

			<div id="template-notices" role="alert" aria-atomic="true">
				<?php

				/** This action is documented in bp-templates/bp-legacy/buddypress/activity/index.php */
				do_action( 'template_notices' ); ?>

			</div>

			<div id="groups-dir-list" class="groups dir-list">
				<?php bp_get_template_part( 'groups/groups-loop' ); ?>
			</div><!-- #groups-dir-list -->

			<?php

			/**
			 * Fires and displays the group content.
			 *
			 * @since 1.1.0
			 */
			do_action( 'bp_directory_groups_content' ); ?>

			<?php wp_nonce_field( 'directory_groups', '_wpnonce-groups-filter' ); ?>

			<?php

			/**
			 * Fires after the display of the groups content.
			 *
			 * @since 1.1.0
			 */
			do_action( 'bp_after_directory_groups_content' ); ?>

		</form><!-- #groups-directory-form -->

		<?php

		/**
		 * Fires after the display of the groups.
		 *
		 * @since 1.1.0
		 */
		do_action( 'bp_after_directory_groups' ); ?>

		</div><!-- #buddypress -->

	</main>

</div>

</div>
<?php

/**
 * Fires at the bottom of the groups directory template file.
 *
 * @since 1.5.0
 */
do_action( 'bp_after_directory_groups_page' );
