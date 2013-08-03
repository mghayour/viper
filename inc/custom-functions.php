<?php

/* Adds the Product post type */
$products  = new Cuztom_Post_Type( 'Products', array(
    'has_archive' => true,
    'supports' => array( 'title', 'editor', 'thumbnail' )
) );


/* Get list of products from Cart66 Cloud */
if(CLOUD) {
  $cloud_product_names = array('' => __('No product selected'));
  try {
    $lib = new CC_Library();
    $cloud_products = $lib->get_products();
    if(is_array($cloud_products) && count($cloud_products)) {
      foreach($cloud_products as $p) {
        $sku = $p['sku'];
        $name = $p['name'];
        $cloud_product_names[$sku] = $name;
      }
    }
  }
  catch(CC_Exception $e) {
    CC_Log::write('Unable to retrieve Cart66 Cloud products for Viper meta box');
  }

  // Change the way the meta box works if Cart66 Cloud is installed
  $products->add_meta_box(
     'Product info',
      array(

        array(
          'name' => 'product_sku',
          'label' => 'Product',
          'description' => 'Select a product',
          'type' => 'select',
          'options' => $cloud_product_names,
          'default_value' => ''
        ),
      
        array(
            'name'          => 'product_link',
            'label'         => 'Product url',
            'description'   => 'Link to product',
            'type'          => 'hidden',
        ),

       array(
            'name'          => 'product_description',
            'label'         => 'Product description',
            'description'   => 'One line description of product',
            'type'          => 'textarea',
        ),

       array(
            'name'          => 'product_price',
            'label'         => 'Product price',
            'description'   => 'Price of the product',
            'type'          => 'hidden',
        )
         
      
   ));
}
else {

  /* Adds metaboxes to products */

  $products->add_meta_box(
     'Product info',
     array(
      
        array(
            'name'          => 'product_link',
            'label'         => 'Product url',
            'description'   => 'Link to product',
            'type'          => 'text',
        ),

       array(
            'name'          => 'product_description',
            'label'         => 'Product description',
            'description'   => 'One line description of product',
            'type'          => 'textarea',
        ),

       array(
            'name'          => 'product_price',
            'label'         => 'Product price',
            'description'   => 'Price of the product',
            'type'          => 'text',
        )
      
     )
   );
} 
    
    
function add_custom_taxonomies() {

	register_taxonomy('department', 'products', array(
		// Hierarchical taxonomy (like categories)
		'hierarchical' => true,
		// This array of options controls the labels displayed in the WordPress Admin UI
		'labels' => array(
			'name' => _x( 'Department', 'taxonomy general name' ),
			'singular_name' => _x( 'Department', 'taxonomy singular name' ),
			'search_items' =>  __( 'Search Department' ),
			'all_items' => __( 'All Department' ),
			'parent_item' => __( 'Parent Department' ),
			'parent_item_colon' => __( 'Parent Department:' ),
			'edit_item' => __( 'Edit Department' ),
			'update_item' => __( 'Update Department' ),
			'add_new_item' => __( 'Add New Department' ),
			'new_item_name' => __( 'New Department Name' ),
			'menu_name' => __( 'Department' ),
		),
		// Control the slugs used for this taxonomy
		'rewrite' => array(
			'slug' => 'department', // This controls the base slug that will display before each term
			'with_front' => false, // Don't display the category base before "/locations/"
			'hierarchical' => true // This will allow URL's like "/locations/boston/cambridge/"
		),
	));
}
add_action( 'init', 'add_custom_taxonomies', 0 );    
