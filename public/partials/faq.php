<div class="clearfix"></div>
<hr />
<div class="col-md-12">
	<h3 class="text-center"><?php _e('Help and frequently asked questions', 'wp-tipi') ?></h3>
	<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
		<?php
		$args = array( 'post_type' => 'tipi_faq', 'posts_per_page' => -1,'orderby' => 'menu_order','order'   => 'ASC' );
		$x=1;
		$loop = new WP_Query( $args );
		if ( $loop->have_posts() ) {
			while ( $loop->have_posts() ) {
				$loop->the_post();
				if($x==1) $exp='true';
				else $exp='false';
				?>
				<div class="panel panel-default">
					<div class="panel-heading" role="tab" id="heading<?php echo $x ?>">
						<h4 class="panel-title">
							<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $x ?>" aria-expanded="<?php echo $exp ?>">
								<?php the_title() ?>
							</a>
						</h4>
					</div>
					<div id="collapse<?php echo $x ?>" class="panel-collapse collapse <?php if($x==1) echo 'in' ?>" role="tabpanel" aria-labelledby="heading<?php echo $x ?>">
						<div class="panel-body">
							<?php the_content() ?>
						</div>
					</div>
				</div>
				<?php
				$x++;
			}
		}
		wp_reset_postdata(); // reset to the original page data
		?>
	</div>
