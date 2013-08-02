<?php
/**
 * @package web2feel
 * @since web2feel 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('cf'); ?>>
	
	<div class="product-single-top cf">
		<div class="prod-image">
					<?php
						$thumb = get_post_thumbnail_id();
						$img_url = wp_get_attachment_url( $thumb,'full' ); //get full URL to image (use "large" or "medium" if the images too big)
						$image = aq_resize( $img_url, 220, 180, false ); //resize & crop the image
					?>
					<?php if($image) : ?> <a class="fancybox" href="<?php echo $img_url?>"><img src="<?php echo $image ?>"/></a> <?php endif; ?>
		</div>
		
		<header class="entry-header">
			<h1 class="entry-title"><?php the_title(); ?></h1>

			<div class="entry-meta">
				 <?php echo get_the_term_list( $post->ID, 'department', 'Department: ', ', ', '' ); ?> 
			 </div><!-- .entry-meta -->
			 <p><?php echo get_post_meta($post->ID,'_product_info_product_description', true); ?></p>
			 <div class="the-price cf">
				 <h3>Price: <?php echo get_post_meta($post->ID,'_product_info_product_price', true); ?></h3> 
				 <a href="<?php echo get_post_meta($post->ID,'_product_info_product_link', true); ?>" class="buy-button">Purchase now </a>
			 </div>
		</header><!-- .entry-header -->



	</div>

	<div class="product-single-bottom">
	
	<div class="entry-content">
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'web2feel' ), 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->

	</div>
</article><!-- #post-<?php the_ID(); ?> -->
