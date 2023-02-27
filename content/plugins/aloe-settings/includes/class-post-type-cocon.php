<?php
/**
 * @package Aloe
 */

 class Post_Type_Cocon
 {
     /**
     * @var string
        */
     public const NAME = 'cocon';

     public function __construct()   {
      add_action( 'init', [ $this, 'register_post_type' ] );          
  }

  public function register_post_type()  {
    $labels = [
      'name'                                        => _x( 'Page de guide', 'Post Type General Name', 'text_domain' ),
      'singular_name'                       => _x( 'Page de guide', 'Post Type Singular Name', 'text_domain' ),
      'menu_name'                           => __( 'Page de guide', 'text_domain' ),
      'name_admin_bar'                  => __( 'Page de guide', 'text_domain' ),
      'archives'                                  => __( 'Archives des pages de guide', 'text_domain' ),
      'attributes'                                => __( 'Attributs des pages de guide', 'text_domain' ),
      'parent_item_colon'                => __( 'Parent Item:', 'text_domain' ),
      'all_items'                                 => __( 'Toutes les pages de guide', 'text_domain' ),
      'add_new_item'                       => __( 'Créer une nouvelle page de guide', 'text_domain' ),
      'add_new'                                => __( 'Créer une nouvelle', 'text_domain' ),
      'new_item'                               => __( 'Nouvelle page de guide', 'text_domain' ),
      'edit_item'                               => __( 'Modifier le page de guide', 'text_domain' ),
      'update_item'                         => __( 'Mettre à jour la page de guide', 'text_domain' ),
      'view_item'                              => __( 'Voir le page de guide', 'text_domain' ),
      'view_items'                            => __( 'Voir les pages de guide', 'text_domain' ),
      'search_items'                        => __( 'Rechercher une page de guide', 'text_domain' ),
      'not_found'                              => __( 'Aucun résultat', 'text_domain' ),
      'not_found_in_trash'              => __( 'Aucun résultat dans la corbeille', 'text_domain' ),
      'featured_image'                    => __( 'Image principale de la page de guide', 'text_domain' ),
      'set_featured_image'             => __( 'Définir l\'image principale de la page de guide', 'text_domain' ),
      'remove_featured_image'     => __( 'Supprimer l\'image mise en avant', 'text_domain' ),
      'use_featured_image'            => __( 'Utiliser comme image mise en avant', 'text_domain' ),
      'insert_into_item'                    => __( 'Insérer dans la page de guide', 'text_domain' ),
      'uploaded_to_this_item'        => __( 'Téléverser sur cette page de guide', 'text_domain' ),
      'items_list'                                => __( 'Liste des pages de guide', 'text_domain' ),
      'items_list_navigation'           => __( 'Navigatuer dans la liste des pages de guide', 'text_domain' ),
      'filter_items_list'                      => __( 'Filtrer la liste des pages de guide', 'text_domain' ),
  ];

  $capabilities = [
    'edit_others_posts'           => 'edit_others_'.self::NAME,
    'delete_others_posts'       => 'delete_others_'.self::NAME,
    'delete_private_posts'      => 'delete_private_'.self::NAME,
    'edit_private_posts'          => 'edit_private_'.self::NAME,
    'read_private_posts'         => 'read_private_'.self::NAME,
    'edit_published_posts'     => 'edit_published_'.self::NAME,
    'publish_posts'                   => 'publish_'.self::NAME,
    'delete_published_posts' => 'delete_published_'.self::NAME,
    'edit_posts'                          => 'edit_'.self::NAME   ,
    'delete_posts'                      => 'delete_'.self::NAME,
    'edit_post'                            => 'edit_'.self::NAME,
    'read_post'                           => 'read_'.self::NAME,
    'delete_post'                        => 'delete_'.self::NAME,
  ];
  $args = [
    'label'                               => __( 'Info', 'text_domain' ),
    'description'                   => __( 'Pages d\'informations', 'text_domain' ),
    'labels'                             => $labels,
    'supports'                        => [ 
        'title', 
        'editor', 
        'thumbnail', 
        'comments', 
        'trackbacks', 
        'revisions', 
        'custom-fields', 
        'page-attributes', 
        'post-formats' 
      ],
    //'capabilities'                    => $capabilities,
    'hierarchical'                   => true,
    'public'                             => true,
    'show_ui'                          => true,
    'show_in_menu'              => true,
    'menu_position'              => 4,
    'menu_icon'                     => 'dashicons-cart',
    'show_in_admin_bar'      => true,
    'show_in_nav_menus'     => true,
    'can_export'                     => true,
    'has_archive'                    => true,
    'exclude_from_search'   => false,
    'publicly_queryable'        => true,
    'capability_type'               => 'post',
    'show_in_rest'                    => true,
    'rewrite'                            => [
      'slug' => 'guide',
      'with_front' => true,
    ]
   ];

   register_post_type(
    self::NAME,
    $args
  );
  }

 }