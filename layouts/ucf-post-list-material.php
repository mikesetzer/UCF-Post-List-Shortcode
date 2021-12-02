<?php

/**
 * The default functions for the card layout
 **/

if ( ! function_exists( 'ucf_post_list_display_material_before' ) ) {
	function ucf_post_list_display_material_before( $content, $posts, $atts ) {
		ob_start();
	?>
		<div class="ucf-post-list card-layout" id="post-list-<?php echo $atts['list_id']; ?>">
	<?php
		return ob_get_clean();
	}

	add_filter( 'ucf_post_list_display_material_before', 'ucf_post_list_display_material_before', 10, 3 );
}


if ( !function_exists( 'ucf_post_list_display_material_title' ) ) {

	function ucf_post_list_display_material_title( $content, $posts, $atts ) {
		$formatted_title = '';

		if ( $list_title = $atts['list_title'] ) {
			$formatted_title = '<h2 class="ucf-post-list-title">' . $list_title . '</h2>';
		}

		return $formatted_title;
	}

	add_filter( 'ucf_post_list_display_material_title', 'ucf_post_list_display_material_title', 10, 3 );

}

if ( ! function_exists( 'ucf_post_list_display_material' ) ) {
	function ucf_post_list_display_material( $content, $posts, $atts ) {
		if ( $posts && ! is_array( $posts ) ) { $posts = array( $posts ); }
		ob_start();
?>
		<?php if ( $posts ): ?>
			<div class="ucf-post-list-material-deck ucf-post-list-card-deck">

			<?php
			foreach( $posts as $index=>$item ) :
				$date = date( "M d", strtotime( $item->post_date ) );
				if( $atts['show_image'] ) {
					$item_img        = UCF_Post_List_Common::get_image_or_fallback( $item );
					$item_img_srcset = UCF_Post_List_Common::get_image_srcset( $item );
				}

				if( $atts['posts_per_row'] > 0 && $index !== 0 && ( $index % $atts['posts_per_row'] ) === 0 ) {
					echo '</div><div class="ucf-post-list-card-deck">';
				}

				if( $atts['show_excerpt'] ) {
					$char_limit = $atts['excerpt_length'];
					$item_excerpt	 = UCF_Post_List_Common::get_excerpt( $item, $char_limit );
				}
			?>
				<div class="ucf-post-list-material ucf-post-list-card">
					<a class="ucf-post-list-material-link ucf-post-list-card-link" href="<?php echo get_permalink( $item->ID ); ?>">
						<?php if( $atts['show_image'] && $item_img ) : ?>
				<div style="background-image: url(' <?php echo $item_img; ?> ')" srcset="<?php echo $item_img_srcset; ?>" class="ucf-post-list-thumbnail-image-material ucf-post-list-thumbnail-image" alt="<?php echo $item->post_title; ?>"></div>
						<?php endif; ?>
						<div class="ucf-post-list-material-block ucf-post-list-card-block">
							<h6 class="ucf-post-list-material-title"><?php echo $item->post_title; ?></h6>
							<?php if( $atts['show_excerpt'] ) : ?>
								<div class="ucf-post-list-excerpt-text ucf-post-list-material-text"><?php echo $item_excerpt; ?></div>
							<?php endif; ?>
							<p class="ucf-post-list-material-date ucf-post-list-card-text"><?php echo $date; ?></p>
						</div>
					</a>
				</div>
			<?php endforeach; ?>

			</div>

		<?php else: ?>
			<div class="ucf-post-list-error">No results found.</div>
		<?php endif;

		return ob_get_clean();
	}

	add_filter( 'ucf_post_list_display_material', 'ucf_post_list_display_material', 10, 3 );
}

if ( ! function_exists( 'ucf_post_list_display_material_after' ) ) {
	function ucf_post_list_display_material_after( $content, $posts, $atts ) {
		ob_start();
	?>
		</div>
	<?php
		return ob_get_clean();
	}

	add_filter( 'ucf_post_list_display_material_after', 'ucf_post_list_display_material_after', 10, 3 );
}

