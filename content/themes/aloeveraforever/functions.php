<?php
//Theme Version
define( 'ALLOYOGI_THEME_VERSION', '1.0' );
// Main Menu URL and Slug
define('BLOG_SLUG','blog' );
define('BLOG_URL', get_home_url().'/'.BLOG_SLUG.'/');
define('ALOE_VERA_SLUG','guide/aloe-vera' );
define('ALOE_VERA_URL', get_home_url().'/'.ALOE_VERA_SLUG);
define('JOIN_US_SLUG','rejoignez-nous' );
define('JOIN_US_URL', get_home_url().'/'.JOIN_US_SLUG.'/');
define('ORDER_SLUG','commander' );
define('ORDER_URL', get_home_url().'/'.ORDER_SLUG.'/');
define('ALL_PRODUCTS_SLUG','produits-forever' );
define('ALL_PRODUCTS_URL', get_home_url().'/'.ALL_PRODUCTS_SLUG.'/');
define('FOREVER_LIVING_SLUG','forever-living-products-france' );
define('FOREVER_LIVING_URL', get_home_url().'/'.FOREVER_LIVING_SLUG.'/');
// Theme support
function alloyogi_setup() {
    //Gestion des titres par Wordpress
    add_theme_support( 'title-tag' );
    //Activation de la gestion des images de mise en avant
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
        'header-text' => array( 'site-title', 'site-description' ),
    ) );
}
add_action( 'after_setup_theme', 'alloyogi_setup' );
//Menu
function register_my_menu() {
    register_nav_menu('main-menu',__( 'Menu principal' ));
  }
  add_action( 'init', 'register_my_menu' );
// //changement des li
//   function add_additional_class_on_li($classes, $item, $args) {
//     if(isset($args->add_li_class)) {
//         $classes[] = $args->add_li_class;
//     }
//     return $classes;
// }
// add_filter('nav_menu_css_class', 'add_additional_class_on_li', 1, 3);
// changement sub menu
function new_submenu_class($menu) {    
    $menu = preg_replace('/ class="sub-menu"/','/ class="mainmenu__list__item__sublist" /',$menu);        
    return $menu;      
}
add_filter('wp_nav_menu','new_submenu_class'); 
// Script
function alloyogi_enqueue_scripts(){
    wp_enqueue_style(
        'alloyogi-style', 
        get_theme_file_uri( 'public/css/style.css' ), 
        [], 
        ALLOYOGI_THEME_VERSION 
    );
    wp_enqueue_script(
        'alloyogi-script', 
        get_theme_file_uri( 'public/js/app.js' ),
        [],
        ALLOYOGI_THEME_VERSION,
        true 
    );
}
add_action( 'wp_enqueue_scripts', 'alloyogi_enqueue_scripts');
add_action( 'admin_enqueue_scripts', 'alloyogi_enqueue_scripts' );
function remove_dashboard_meta(){
    remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );            // WordPress blog
    remove_action( 'welcome_panel', 'wp_welcome_panel' );                   // Remove WordPress Welcome Panel
    if (!current_user_can('manage_options')){
        remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );    // Quick Press
        remove_meta_box( 'dashboard_secondary', 'dashboard', 'side' );          // Other WordPress News    
    }

}
add_action( 'admin_init', 'remove_dashboard_meta' );
//Remove unused wp functions
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'wlwmanifest_link' );

//shortcode page title
function page_title_sc( ){
  return get_the_title();
}
add_shortcode( 'page_title', 'page_title_sc' );

//Shortcode Option Page

function joinForeverLink_func($atts){
  $linkText = $atts['text'];
  $linkTitle = $atts['title'];
  $classTitle = $atts['class'];
  $linkUrl = get_field('option_page_joinURL_field', 'option');
  $FBONum = get_field('FBONum_field', 'option');
  $link = '<a href="'.$linkUrl.$FBONum.'" title="'.$linkTitle.'" class="'.$classTitle.'" target="_blank" rel="no-follow">'.$linkText.'</a>';
 return $link;
  
}
add_shortcode( 'JoinLink', 'joinForeverLink_func' );

function orderForeverLink_func($atts){
  $linkText = $atts['text'];
  $linkTitle = $atts['title'];
  $classTitle = $atts['class'];
  $linkUrl = get_field('option_page_shopURL_field', 'option');
  $FBONum = get_field('FBONum_field', 'option');
  $link = '<a href="'.$linkUrl.$FBONum.'" title="'.$linkTitle.'" class="'.$classTitle.'" target="_blank" rel="no-follow">'.$linkText.'</a>';
 return $link;
  
}
add_shortcode( 'OrderLink', 'orderForeverLink_func' );

function phoneLink_func($atts){
  $linkText = $atts['text'];
  $classTitle = $atts['class'];
  $TelNum = get_field('telNum_field', 'option');
  $linkText = ($linkText == 'teltext') ?  $TelNum : $linkText;
  $link = '<a href="tel:+33'.substr(str_replace(' ', '', $TelNum), 1).'" title="Joindre Aloe Vera Forever par téléphone" class="'.$classTitle.'">'.$linkText.'</a>';
 return $link;
  
}
add_shortcode( 'PhoneLink', 'phoneLink_func' );

function mailLink_func($atts){
  $linkText = $atts['text'];
  $classTitle = $atts['class'];
  $Mail = get_field('option_page_Mail_field', 'option');
  $linkText = ($linkText == 'mailtext' ) ? str_replace('@','{@}',$Mail ) : $linkText;
  $link = '<a href="mailto:'.$Mail.'" title="Joindre Aloe Vera Forever par mail" class="'.$classTitle.'">'.$linkText.'</a>';
 return $link;
  
}
add_shortcode( 'MailLink', 'mailLink_func' );


//shortcode catégories button 
function page_cat_button_func($atts){
  $catName = $atts['cat'];
  $linkText = $atts['text'];
  $termLink = get_term_link($catName,'product_category');
  $link ='<a href="'.$termLink.'" class="button">'.$linkText.'.</a>';
  return $link ;
}
add_shortcode( 'CatButton', 'page_cat_button_func' );



//Sort image srcset
function getSrcSet($id) {
    $img_srcset   = wp_get_attachment_image_srcset($id, 'full');
    $srcset_array = explode(", ", $img_srcset);
    $images  = array();
    $x = 0;
    foreach ($srcset_array as $set) :
      $split = explode(" ",$set );
      if (!isset($split[0], $split[1])) continue;
      $images[$x]['src'] = $split[0];
      $images[$x]['width'] = str_replace('w', '', $split[1]);
      $x++;
    endforeach;
    // sort the array, ordered by width
    usort($images, function($a, $b) {
      return $a['width'] <=> $b['width'];
    });
    return $images;
  }
  /**
 * Filter to add custom variables
 */
add_filter( 'rank_math/vars/replacements', function( $vars ) {
    return $vars;
   });


  // Option page
  add_action('acf/init', 'my_acf_op_init');
function my_acf_op_init() {
    // Check function exists.
    if( function_exists('acf_add_options_page') ) {
        // Add parent.
        $parent = acf_add_options_page(array(
            'page_title'  => __('Réglages généraux'),
            'menu_title'  => __('Options'),
            'redirect'    => false,
            'autoload' => true,
        ));
    }
}
?>
<?php
if( ! function_exists( 'better_comments' ) ):
    //better comment
function better_comments($comment, $args, $depth) {
    ?>
   <article class="review" <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
   <main class="review__text">
            <p><?php $rates = get_field('note', $comment); ?></p>            
            <ul class="ratingStars">
                <?php 
                    for ($i = 1; $i <=$rates ; $i++){
                        echo('<li class="ratingStars__star"><i class="fa fa-star" aria-hidden="true"></i></li>');
                    }               
                ?>
            </ul>
            <span class="date float-right">le <?=  get_comment_date() ?></span>
            <p class="review__text__content"><?php comment_text() ?></p>
            <?php if ($comment->comment_approved == '0') : ?>
                    <strong><?php esc_html_e('Votre commentaire est en attente de modération.','5balloons_theme') ?></strong>
                    <br />
                <?php endif; ?>                    
          </main>
          <footer class="review__footer">
            <?php 
            echo get_avatar(
                $comment,$size='80',$default='', null ,  array( 'class' => array( 'review__footer__picture' ) ) ); ?>
            <p class="review__footer__userName"><?php echo get_comment_author() ?></p>
          </footer>
   </article>
<?php
        }
endif;

// Acf return numeric fild as number and not a string
add_filter('acf/format_value/type=number', 'acf_number_str_to_number', 20, 3);
function acf_number_str_to_number($value, $post_id, $field) {
  if (empty($value)) {
    return 0;
  }
  $int = (int)$value;
  $float = (float)$value;
  if ($int == $float) {
    return $int;
  } else {
    return $float;
  }
}
// Responsive background images
function write_src_set_image($img_id, $CSSclass,  $size= 'full'  ){
    $image_src = wp_get_attachment_image_url($img_id,$size);
    $image_srcset = wp_get_attachment_image_srcset($img_id,$size);
    $sizes = wp_get_attachment_image_sizes($img_id);
    $css = '';
    $srcset = getSrcSet($img_id);
    foreach ($srcset as $set){
      if ($set['width'] > 1600) continue;
      if ($set['width'] < 768) continue;
      if ($set['width'] < 769) {
        $css .= '@media only screen and (min-width: ' . 150 . 'px) {
          '.$CSSclass.' { background-image: url(' . $set['src'] . '); } }';
        };
        $css .= '@media only screen and (min-width: ' . $set['width'] . 'px) {
          '.$CSSclass.' { background-image: url(' . $set['src'] . '); } }';
    }
   $css = !empty($css) ? '<style>'. $css .'</style>' : ''; echo $css;
    return $css;
  }  
//Write responsive image
  function write_responsive_image($attachment_id, $size = 'full',  $class ='', $responsive=1, $width='', $height= ''){
    $image_alt = get_post_meta($attachment_id, '_wp_attachment_image_alt', TRUE);
    $src = wp_get_attachment_image_url( $attachment_id, $size);
    $srcset = wp_get_attachment_image_srcset( $attachment_id, $size ) ;?>
    <img 
    src="<?= wp_get_attachment_image_url( $attachment_id, $size ); ?>" 
    <?php if($responsive): ?>
    srcset="<?= wp_get_attachment_image_srcset( $attachment_id, $size ) ?>" 
    <?php endif; ?>
    alt="<?=$image_alt?>" 
    width="<?=$width?>"
    height= "<?=$height?>"
    class="<?=$class?>"
    loading="lazy"
    >
    <?php }
if ( function_exists('register_sidebar') )
register_sidebar( array(
 'name'       => __( 'Footer 2', 'virtue' ),
 'id'     => 'footer-2',
 'description'    => __( 'Ajoute un widget dans la colonne 2 du footer', 'virtue' ),
 'before_widget' => '',
 'after_widget'  => '',
 'before_title'  => '',
 'after_title'   => '',
)
);

/* CALCUL TEMPS ESTIME LECTURE ARTICLES */
function temps_lecture($post) {
  $content = get_post_field( 'post_content', $post->ID );
  $word_count = str_word_count( strip_tags( $content ) );
  $readingtime = ceil($word_count / 200);
  if ($readingtime == 1) {
    $timer = " min";
  } else {
    $timer = " min";
  }
  $totalreadingtime = $readingtime . $timer;
  return $totalreadingtime;
}


/* post count*/
function gt_get_post_view() {
  $count = get_post_meta( get_the_ID(), 'post_views_count', true );
  return "$count vues";
}

function gt_set_post_view() {
  $key = 'post_views_count';
  $post_id = get_the_ID();
  $count = (int) get_post_meta( $post_id, $key, true );
  $count++;
  update_post_meta( $post_id, $key, $count );
}


function gt_posts_column_views( $columns ) {
  $columns['post_views'] = 'Views';
  return $columns;
}

function gt_posts_custom_column_views( $column ) {
  if ( $column === 'post_views') {
      echo gt_get_post_view();
  }
}
add_filter( 'manage_posts_columns', 'gt_posts_column_views' );
add_action( 'manage_posts_custom_column', 'gt_posts_custom_column_views' );

// calcule la distance entre deux points gps
function distance($lat1, $lng1, $lat2, $lng2, $unit = 'k') {
  $earth_radius = 6378137;   // Terre = sphère de 6378km de rayon
  $rlo1 = deg2rad($lng1);
  $rla1 = deg2rad($lat1);
  $rlo2 = deg2rad($lng2);
  $rla2 = deg2rad($lat2);
  $dlo = ($rlo2 - $rlo1) / 2;
  $dla = ($rla2 - $rla1) / 2;
  $a = (sin($dla) * sin($dla)) + cos($rla1) * cos($rla2) * (sin($dlo) * sin($dlo));
  $d = 2 * atan2(sqrt($a), sqrt(1 - $a));
  //
  $meter = ($earth_radius * $d);
  if ($unit == 'k') {
      return $meter / 1000;
  }
  return $meter;
}

// load more function
function weichie_load_more() {
  
if($_POST['postType']==='post' ){
  $ajaxposts = new WP_Query([
    'post_type' => 'post',
    'posts_per_page' => 10,
    'orderby' => 'date',
    'order' => 'DESC',
    'post_status' => 'publish',
    'paged' => $_POST['paged'],
    'cat' => $_POST['category']
  ]);
}else{
  $ajaxposts = new WP_Query([
    'post_type' => ['post','product'],
    's' => $_POST['searchKeyword'],
    'posts_per_page' => 10,
    'orderby' => 'date',
    'order' => 'DESC',
    'post_status' => 'publish',
    'paged' => $_POST['paged'],
    'cat' => $_POST['category']
  ]);
}



  

  $response = '';
  $max_pages = $ajaxposts->max_num_pages;

  if($ajaxposts->have_posts()) {
    ob_start();
    while($ajaxposts->have_posts()) : $ajaxposts->the_post();
        $response .= get_post_type()=='post' ? get_template_part('template-parts/posts/blogPostExerpt/blogPostExerpt') : get_template_part('template-parts/product/product-card');
    endwhile;
    $output = ob_get_contents();
    ob_end_clean();
  } else {
    $response = '';
  }

  $result = [
    'max' => $max_pages,
    'html' => $output,
  ];

  echo json_encode($result);
  exit;
}
add_action('wp_ajax_weichie_load_more', 'weichie_load_more');
add_action('wp_ajax_nopriv_weichie_load_more', 'weichie_load_more');



function register_my_menus() {
  register_nav_menus(
    array(
      'footer-menu' => __( 'Footer Menu' ),
      'footer-line-menu' => __( 'Footer Line Menu' )
     )
   );
 }
 add_action( 'init', 'register_my_menus' );


 
function get_child_pages_by_parent_title($pageId,$limit = -1)
{
    // needed to use $post
    global $post;
    // used to store the result
    $pages = array();

    // What to select
    $args = array(
        'post_type' => 'cocon',
        'post_parent' => $pageId,
        'posts_per_page' => $limit
    );
    $the_query = new WP_Query( $args );

    while ( $the_query->have_posts() ) {
        $the_query->the_post();
        $pages[] = $post->ID;
    }
    wp_reset_postdata();
    return $pages;
}



//  function delete_post_type(){
//   unregister_post_type( Post_Type_Distributor::NAME );
//   unregister_taxonomy(Post_Type_Distributor::TAXONOMY_NAME_LOCATION);
// }
// add_action('init','delete_post_type');

// function robots_meta_aloevera(){

//   if(is_tax(Post_Type_Distributor::TAXONOMY_NAME_LOCATION)){
//     $location = get_queried_object();
//     $location_type = get_field('location_type_field', 'location_' . $location->term_id);
//     if ($location_type === 'Ville'){
//       if(!get_field('big_city')){
//         echo '<meta name="robots" content="noindex, follow, nocache">';
//     }
//   }
//   }
// }
// add_action( 'wp_head', 'robots_meta_aloevera' );
 
//require_once(dirname(__FILE__) . '/includes/smtp.php'); 
// Inclusion des fichiers de configuration
//Post Type
//require_once(dirname(__FILE__) . '/includes/post_type_teacher.php'); 
//require_once(dirname(__FILE__) . '/includes/post_type_course.php'); 
//require_once(dirname(__FILE__) . '/includes/custom_fields_post_type_course.php'); 
//require_once(dirname(__FILE__) . '/includes/custom_fields_post_type_teacher.php'); 
//require_once(dirname(__FILE__) . '/includes/display_fix_post_type.php'); 
//Taxonomies
//require_once(dirname(__FILE__) . '/includes/custom_taxonomy.php');
//require_once(dirname(__FILE__) . '/includes/custom_fields_taxonomy_location.php');
//require_once(dirname(__FILE__) . '/includes/custom_fields_taxonomy_style.php'); 
//Permalink
//require_once(dirname(__FILE__) . '/includes/custom_permalink_structure.php');
//user roles
//require_once(dirname(__FILE__) . '/includes/role.php'); 
//remove_role('member');