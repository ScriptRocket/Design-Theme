<?php

get_header(); ?>
	
	<!-- site-content -->
	<div class="site-content clearfix">

	<h1><?php bloginfo('name'); ?></h1>

	<h5><?php bloginfo('description'); ?> <?php if (is_page('portfolio')) { ?>
				- Thank you for viewing our work
			<?php }?></h5>

	</div><!-- /site-content -->
