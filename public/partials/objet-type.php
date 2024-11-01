<?php
$args = array( 'post_type' => 'tipi_objet', 'posts_per_page' => - 1, 'orderby' => 'menu_order', 'order' => 'ASC' );
$loop = new WP_Query( $args );
if ( $loop->have_posts() ) {
	?>
    <div class="form-group">
        <label class="control-label col-sm-2"><?php _e('Type', 'wp-tipi') ?></label>
        <div class="col-sm-10">
            <select class="form-control" name="objet" id="objet" data-validate="true" required="required">
                <option value="" selected disabled><?php _e('Choose a type', 'wp-tipi') ?></option>
				<?php

				while ( $loop->have_posts() ) {
					$loop->the_post();
					?>
                    <option value="<?php echo get_post_meta( get_the_ID(),
						'reference_reference',
						true ); ?>"><?php the_title() ?></option>
					<?php
				}

				?>
            </select>
        </div>
    </div>
	<?php
}
wp_reset_postdata(); // reset to the original page data
?>