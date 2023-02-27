<?php
/**
 * @package Aloe
 * Plugin Name: Aloe Settings
 * Description: Aloe post types, taxonomies, ...
 */

if ( ! function_exists( 'add_action' ) ) {
    http_response_code( 404 );
    exit;
}

define (
    'PLUGIN_DIR_PATH_ALOE_SETTINGS',
    plugin_dir_path( __FILE__ )
);


//Post Types
require PLUGIN_DIR_PATH_ALOE_SETTINGS . 'includes/class-post-type-product.php';
require PLUGIN_DIR_PATH_ALOE_SETTINGS . 'includes/class-post-type-distributor.php';
require PLUGIN_DIR_PATH_ALOE_SETTINGS . 'includes/class-post-type-cocon.php';

//Custom fields
require PLUGIN_DIR_PATH_ALOE_SETTINGS . 'includes/custom-fields-product.php';
require PLUGIN_DIR_PATH_ALOE_SETTINGS . 'includes/custom-fields-taxo-category.php';
require PLUGIN_DIR_PATH_ALOE_SETTINGS . 'includes/custom-fields-taxo-label.php';
require PLUGIN_DIR_PATH_ALOE_SETTINGS . 'includes/custom-fields-taxo-ingredient.php';
require PLUGIN_DIR_PATH_ALOE_SETTINGS . 'includes/custom-fields-taxo-location.php';
require PLUGIN_DIR_PATH_ALOE_SETTINGS . 'includes/custom-fields-taxo-badge.php';
require PLUGIN_DIR_PATH_ALOE_SETTINGS . 'includes/custom-fields-blog-post.php';
require PLUGIN_DIR_PATH_ALOE_SETTINGS . 'includes/custom-fields-page.php';
require PLUGIN_DIR_PATH_ALOE_SETTINGS . 'includes/custom-fields-option-page.php';

require PLUGIN_DIR_PATH_ALOE_SETTINGS . 'includes/blocks/custom-fields-product-block.php';
require PLUGIN_DIR_PATH_ALOE_SETTINGS . 'includes/blocks/custom-fields-carousel-product-block.php';

require PLUGIN_DIR_PATH_ALOE_SETTINGS . 'includes/blocks/construct/custom-fields-construct-block-buttonCustom.php';
require PLUGIN_DIR_PATH_ALOE_SETTINGS . 'includes/blocks/construct/custom-fields-construct-block-feature.php';
require PLUGIN_DIR_PATH_ALOE_SETTINGS . 'includes/blocks/construct/custom-fields-construct-block-dubbleSection.php';
require PLUGIN_DIR_PATH_ALOE_SETTINGS . 'includes/blocks/construct/custom-fields-construct-block-section.php';
require PLUGIN_DIR_PATH_ALOE_SETTINGS . 'includes/blocks/construct/custom-fields-construct-block-imageFull.php';
require PLUGIN_DIR_PATH_ALOE_SETTINGS . 'includes/blocks/construct/custom-fields-construct-block-video.php';




$post_type_product = new Post_Type_Product;
$post_type_distributor = new Post_Type_Distributor;
$post_type_cocon = new Post_Type_Cocon;

$aloe_settings_activation = function() use (
  $post_type_product,
  $post_type_distributor, $post_type_cocon)  {
  
    $post_type_product->register_taxonomies();
    $post_type_product->register_post_type();

    $post_type_distributor->register_taxonomies();
    $post_type_distributor->register_post_type();

    $post_type_cocon->register_post_type();
    

  flush_rewrite_rules();
};

register_activation_hook( __FILE__, 'aloe_settings_activation' );

function aloe_settings_deactivation()   {
    
  unregister_post_type( Post_Type_Product::NAME );
  unregister_post_type( Post_Type_Distributor::NAME );
  unregister_post_type( Post_Type_Cocon::NAME );
  
  // remove_role(Role_Member::NAME);
  // update_option(Role_Member::OPTION_NAME, 0);
  flush_rewrite_rules();

};

register_deactivation_hook( __FILE__, 'aloe_settings_deactivation' );
