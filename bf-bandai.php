<?php
/*
Plugin Name:  BREAKFIELD BANDAI PRODUCTS MANAGEMENT
Plugin URI:   https://developer.wordpress.org/plugins/the-basics/
Description:  Manage BANDAI products
Version:      20160911
Author:       BreakField Vietnam
Author URI:   http://breakfield.com.vn
License:      GPL2
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
Text Domain:  bfbandai
Domain Path:  /languages
*/

require_once("define.php");

$bfbandai = new BF_Bandai();

class BF_Bandai {
  // activation
  function __construct() {

    // set up cpt and taxonomy
    add_action( 'init', array( $this, 'setup_post_type') );
    add_action( 'init', array( $this, 'setup_taxonomies') );

    // add menu
		add_action( 'admin_menu', array( $this, 'admin_menu') );

    // load script and add_css
    add_action( 'admin_init', array( $this, 'load_script_css' ) );

    // create a blank option
    add_option('_jan_code_data', array());

    // ajax functions
    add_action( 'wp_ajax_add_new_jan_cd', array( $this, 'add_new_jan_cd' ));
  }

  function admin_menu()
	{
    add_menu_page(
        'BANDAI Products',
        'BANDAI Products',
        'manage_options',
        'bf-bandai-settings',
        array( $this, 'include_main_page'),
        'dashicons-share-alt',
        20
    );

    add_submenu_page(
        'bf-bandai-settings',
        'Add product by JAN code',
        'Add product by JAN code',
        'manage_options',
        'add-jan-code',
        array( $this, 'include_jan_code_page')
    );

    add_submenu_page(
        'bf-bandai-settings',
        'Get products manually',
        'Get products manually',
        'manage_options',
        'manually-get-product',
        array( $this, 'include_manually_get_page')
    );

    add_submenu_page(
        'bf-bandai-settings',
        'Add new JAN code',
        'Add new JAN code',
        'manage_options',
        'list-jan-code',
        array( $this, 'include_store_jan_code')
    );
	}


	function include_main_page()
	{
		require BFBANDAI_DIR.'admin/main.php';
	}

  function include_jan_code_page() {
    require BFBANDAI_DIR.'admin/jan-code.php';
  }

  function include_store_jan_code() {
    require BFBANDAI_DIR.'admin/store-jan.php';
  }

  function include_manually_get_page() {
    require BFBANDAI_DIR.'admin/manually-get-product.php';
  }

  function load_script_css()
	{
			wp_enqueue_script( 'jquery' );
			wp_enqueue_script( 'jquery-ui-sortable' );

      wp_enqueue_script( 'uikit', BFBANDAI_URL.'/js/uikit.min.js', array( 'jquery' ), null, true );
      wp_enqueue_script( 'uikit-icon', BFBANDAI_URL.'/js/uikit-icons.min.js', array( 'jquery' ), null, true );
      wp_enqueue_script( 'xml2json', BFBANDAI_URL.'/js/xml2json.js', null, true );
			wp_enqueue_script( 'bfjs', BFBANDAI_URL.'/js/bf.js', array( 'jquery' ), null, true );

      $bfbandai_nonce = wp_create_nonce( 'bfbandai_nonce' );
      wp_localize_script( 'bfjs', 'bf_ajax_obj', array(
         'ajax_url'   => admin_url( 'admin-ajax.php' ),
         'nonce'      => $bfbandai_nonce,
         'jan_codes'  => wp_json_encode(get_option('_jan_code_data'))
      ) );

      wp_enqueue_style( 'uikit', BFBANDAI_URL.'/css/uikit.min.css', array(), null );
			wp_enqueue_style( 'bfcss', BFBANDAI_URL.'/css/bf.css', array(), null );
	}

  // Register custom post type
  function setup_post_type() {
      // register the "product" custom post type
      $labels = array(
  		'name'               => _x( 'Products', 'bfbandai' ),
  		'singular_name'      => _x( 'Product', 'bfbandai' ),
  		'menu_name'          => _x( 'Products', 'bfbandai' ),
  		'name_admin_bar'     => _x( 'Product', 'bfbandai' ),
  		'add_new'            => _x( 'Add New', 'bfbandai' ),
  		'add_new_item'       => __( 'Add New Product', 'bfbandai' ),
  		'new_item'           => __( 'New Product', 'bfbandai' ),
  		'edit_item'          => __( 'Edit Product', 'bfbandai' ),
  		'view_item'          => __( 'View Product', 'bfbandai' ),
  		'all_items'          => __( 'All Products', 'bfbandai' ),
  		'search_items'       => __( 'Search Products', 'bfbandai' ),
  		'parent_item_colon'  => __( 'Parent Products:', 'bfbandai' ),
  		'not_found'          => __( 'No products found.', 'bfbandai' ),
  		'not_found_in_trash' => __( 'No products found in trash.', 'bfbandai' )
  	);

  	$args = array(
  		'labels'             => $labels,
      'description'        => __( 'Description.', 'bfbandai' ),
  		'public'             => true,
  		'publicly_queryable' => true,
  		'show_ui'            => true,
  		'show_in_menu'       => true,
  		'query_var'          => true,
  		'rewrite'            => array( 'slug' => 'product' ),
  		'capability_type'    => 'post',
  		'has_archive'        => true,
  		'hierarchical'       => false,
  		'menu_position'      => null,
  		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
  	);

  	register_post_type( 'product', $args );
  }

  // Register custom taxonomy
  function setup_taxonomies() {
    $labels = array(
  		'name'              => _x( 'Product Categories', 'bfbandai' ),
  		'singular_name'     => _x( 'Product Category', 'bfbandai' ),
  		'search_items'      => __( 'Search Product Categories', 'bfbandai' ),
  		'all_items'         => __( 'All Product Categories', 'bfbandai' ),
  		'parent_item'       => __( 'Parent Product Category', 'bfbandai' ),
  		'parent_item_colon' => __( 'Parent Product Category:', 'bfbandai' ),
  		'edit_item'         => __( 'Edit Product Category', 'bfbandai' ),
  		'update_item'       => __( 'Update Product Category', 'bfbandai' ),
  		'add_new_item'      => __( 'Add New Product Category', 'bfbandai' ),
  		'new_item_name'     => __( 'New Product Category Name', 'bfbandai' ),
  		'menu_name'         => __( 'Product Category', 'bfbandai' ),
  	);

  	$args = array(
  		'hierarchical'      => true,
  		'labels'            => $labels,
  		'show_ui'           => true,
  		'show_admin_column' => true,
  		'query_var'         => true,
  		'rewrite'           => array( 'slug' => 'product-category' ),
  	);

  	register_taxonomy( 'product-category', array( 'product' ), $args );
  }

  function add_new_jan_cd() {
      // check_ajax_referer( 'bfbandai_nonce' );
      $new_code = $_POST['jan_cd'];
      $jan_codes = get_option('_jan_code_data');
      if(!in_array($new_code, $jan_codes)) {
        array_push($jan_codes, $new_code);
        update_option('_jan_code_data', $jan_codes);
        $number_of_code = count(get_option('_jan_code_data'));
        echo $number_of_code;
      }
      else {
        echo 'duplicated';
      }
      wp_die(); // All ajax handlers die when finished
  }
}
