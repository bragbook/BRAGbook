<?php
/*
Plugin Name: BRAG book Gallery
Plugin URI: https://github.com/bragbook/BRAGbook/releases/latest
Description: Installs necessary components to allow for easy implementation of the BRAG book before and after gallery from Candace Crowe Design.
Version: 1.7.3.1
Author: Candace Crowe Design
Author URI: https://www.candacecrowe.com/
License: GPL2
*/
 
//SETUP
function bragbook_plugin_install(){
    //Do some installation work
             
              
}
register_activation_hook(__FILE__,'bragbook_plugin_install');
 
 
//SCRIPTS
 
function bragbook_plugin_styles(){
 if(get_option( 'revClickToZoomActive',0) == 1){
    wp_register_style('photoswipe_style',plugin_dir_url( __FILE__ ).'assets/photoswipe.min.css',array());
    wp_enqueue_style('photoswipe_style');

    wp_register_style('photoswipe_skin_style',plugin_dir_url( __FILE__ ).'assets/default-skin/default-skin.min.css',array());
    wp_enqueue_style('photoswipe_skin_style');
  }
     wp_register_style('bragbook_plugin_style',plugin_dir_url( __FILE__ ).'assets/BRAGbook.min.css');
     wp_enqueue_style('bragbook_plugin_style');
  
      
  
}
add_action('wp_footer','bragbook_plugin_styles');



function bragbook_plugin_scripts(){
   
  if(get_option( 'revClickToZoomActive',0) == 1){
    wp_register_script('photoswipe_script',plugin_dir_url( __FILE__ ).'assets/photoswipe.min.js',array( 'jquery' ), '1.0', true );
    wp_enqueue_script('photoswipe_script');

    wp_register_script('photoswipe_ui_script',plugin_dir_url( __FILE__ ).'assets/photoswipe-ui-default.min.js',array( 'jquery' ), '1.0', true );
    wp_enqueue_script('photoswipe_ui_script');
    
    wp_register_script('photoswipe_init_script',plugin_dir_url( __FILE__ ).'assets/photoswipe-init.min.js',array( 'jquery' ), '1.0', true );
    wp_enqueue_script('photoswipe_init_script');

    }
  
  wp_register_script('bragbook_plugin_script',plugin_dir_url( __FILE__ ).'assets/BRAGbook.min.js',array( 'jquery' ), '1.0', true );
  $wp_vars = array(
      'ajax_url' => admin_url( 'admin-ajax.php' ) ,
    );
  wp_localize_script( 'bragbook_plugin_script', 'wp_vars', $wp_vars );
    wp_enqueue_script('bragbook_plugin_script');
  
}

//add color picker scripts
function wpse_80236_Colorpicker(){
  wp_enqueue_style( 'wp-color-picker');
  wp_enqueue_script( 'wp-color-picker');
}
add_action('admin_enqueue_scripts', 'wpse_80236_Colorpicker');

//Add query variables
function add_query_vars($new_var) {
              $new_var[] = "revCatname";
              $new_var[] = "revStart";
              return $new_var;
}
 
add_filter('query_vars', 'add_query_vars');
 
function add_rewrite_rules($rules) {
              $new_rules = array('^'.get_option( 'revBaseUrl', 'gallery' ).'/([^/]*)/([^/]*)/?' => ''.get_option( 'revBaseUrl', 'gallery' ).'?pagename='.get_option( 'revBaseUrl', 'gallery' ).'&revCatname=$matches[1]&revStart=$matches[2]','^'.get_option( 'revBaseUrl', 'gallery' ).'/([^/]*)/?' => ''.get_option( 'revBaseUrl', 'gallery' ).'?pagename='.get_option( 'revBaseUrl', 'gallery' ).'&revCatname=$matches[1]', '^'.get_option( 'revBaseUrl2', 'revgallery' ).'/([^/]*)/([^/]*)/?' => ''.get_option( 'revBaseUrl2', 'revgallery' ).'?pagename='.get_option( 'revBaseUrl2', 'revgallery' ).'&revCatname=$matches[1]&revStart=$matches[2]','^'.get_option( 'revBaseUrl2', 'revgallery' ).'/([^/]*)/?' => ''.get_option( 'revBaseUrl2', 'revgallery' ).'?pagename='.get_option( 'revBaseUrl2', 'revgallery' ).'&revCatname=$matches[1]', '^'.get_option( 'revBaseUrl3', 'revgallery' ).'/([^/]*)/([^/]*)/?' => ''.get_option( 'revBaseUrl3', 'revgallery' ).'?pagename='.get_option( 'revBaseUrl3', 'revgallery' ).'&revCatname=$matches[1]&revStart=$matches[2]','^'.get_option( 'revBaseUrl3', 'revgallery' ).'/([^/]*)/?' => ''.get_option( 'revBaseUrl3', 'revgallery' ).'?pagename='.get_option( 'revBaseUrl3', 'revgallery' ).'&revCatname=$matches[1]', '^'.get_option( 'revBaseUrl4', 'revgallery' ).'/([^/]*)/([^/]*)/?' => ''.get_option( 'revBaseUrl4', 'revgallery' ).'?pagename='.get_option( 'revBaseUrl4', 'revgallery' ).'&revCatname=$matches[1]&revStart=$matches[2]','^'.get_option( 'revBaseUrl4', 'revgallery' ).'/([^/]*)/?' => ''.get_option( 'revBaseUrl4', 'revgallery' ).'?pagename='.get_option( 'revBaseUrl4', 'revgallery' ).'&revCatname=$matches[1]', '^'.get_option( 'revBaseUrl5', 'revgallery' ).'/([^/]*)/([^/]*)/?' => ''.get_option( 'revBaseUrl5', 'revgallery' ).'?pagename='.get_option( 'revBaseUrl5', 'revgallery' ).'&revCatname=$matches[1]&revStart=$matches[2]','^'.get_option( 'revBaseUrl5', 'revgallery' ).'/([^/]*)/?' => ''.get_option( 'revBaseUrl5', 'revgallery' ).'?pagename='.get_option( 'revBaseUrl5', 'revgallery' ).'&revCatname=$matches[1]', '^'.get_option( 'revBaseUrl6', 'revgallery' ).'/([^/]*)/([^/]*)/?' => ''.get_option( 'revBaseUrl6', 'revgallery' ).'?pagename='.get_option( 'revBaseUrl6', 'revgallery' ).'&revCatname=$matches[1]&revStart=$matches[2]','^'.get_option( 'revBaseUrl6', 'revgallery' ).'/([^/]*)/?' => ''.get_option( 'revBaseUrl6', 'revgallery' ).'?pagename='.get_option( 'revBaseUrl6', 'revgallery' ).'&revCatname=$matches[1]');
              $rules = $new_rules + $rules;
              return $rules;
}
add_filter('rewrite_rules_array', 'add_rewrite_rules');
 
function flush_rewrites(){
              global $wp_rewrite;
              $wp_rewrite->flush_rules();
}
 
//HOOKS
add_action('init','bragbook_plugin_init');
 
/********************************************************/
/* FUNCTIONS
********************************************************/
function bragbook_plugin_init(){
    //do work
             if (class_exists('revGallery')) {} else{
        include('assets/BRAGbook.php');
        }
}
 
 function bragbook_activate() {
    $role = get_role( 'editor' );
   $role->add_cap( 'manage_options' ); // capability
   
   
    // register taxonomies/post types here
  add_filter('rewrite_rules_array', 'add_rewrite_rules');
  global $wp_rewrite;
  //$wp_rewrite->generate_rewrite_rules();
  $wp_rewrite->flush_rules();
  
  //add default options
   add_option('revMyFavsActive', 1);
   add_option('revThumbnailsActive', 1);
   add_option('revClickToZoomActive', 0);
   add_option('revUrlRewrite', 1);
   add_option('revThumbLimit', 10);
    add_option('revGalNavHighlightColor', "#ffffff");
   add_option('revNotFound', "/404");  
   add_option('revEnableSitemap', 0 );
   
   //delete options that are no longer used
   delete_option( 'revThumbButStyleBorderColor' );
   delete_option( 'revThumbButStyleColor' );
   delete_option( 'revThumbButStyleBackground' );
   delete_option('revThumbButStyleHoverBorderColor' );
   delete_option( 'revThumbButStyleHoverColor' );
   delete_option( 'revThumbButStyleHoverBackground' );
 
   delete_option( 'revFavButStyleBorderColor' );
   delete_option( 'revFavButStyleColor' );
   delete_option( 'revFavButStyleBackground' );
   delete_option( 'revFavButStyleHoverBorderColor' );
   delete_option( 'revFavButStyleHoverColor' );
   delete_option( 'revFavButStyleHoverBackground' );
   
   //make sure old sitemaps have been flushed 
   disable_bragbook_sitemap();
   
   //check if sitemap is enable and set a cron event to build sitemap
   bragbook_sitemap_toggle();
  
}

register_activation_hook( __FILE__, 'bragbook_activate' );

function bragbook_upgrade() {
  disable_bragbook_sitemap();
  //check if sitemap is enable and set a cron event to build sitemap
   bragbook_sitemap_toggle();
}
add_action('upgrader_process_complete', 'bragbook_upgrade', 10, 2);



function bragbook_deactivate() {
  global $wp_rewrite;
  
  $role = get_role( 'editor' );
    $role->remove_cap( 'manage_options' ); // capability
  
  disable_bragbook_sitemap();
  //update_option('revEnableSitemap', 0);
  
  remove_filter('rewrite_rules_array', 'add_rewrite_rules');
  //$wp_rewrite->generate_rewrite_rules();
  $wp_rewrite->flush_rules();
}
register_deactivation_hook( __FILE__, 'bragbook_deactivate' ); 
 
//admin section
function bragbook_plugin_menu(){
   add_menu_page( 'BRAG book Gallery', 'BRAG book', 'nosuchcapability', 'bragbook-gallery'  );
   add_submenu_page( 'bragbook-gallery', 'BRAG book General Settings', 'BRAG book Settings', 'edit_others_posts', 'bragbook-gallery-settings', 'bragbook_plugin_options');
  
  
              //add_options_page('BRAGbook Plugin Options', 'BRAGbook Plugin', 'manage_options', 'bragbook-plugin-menu', 'bragbook_plugin_options');
                            
                             //call register settings function
add_action( 'admin_init', 'register_mysettings' );
}
 
add_action('admin_init', 'bragbook_plugin_settings_flush_rewrite');
function bragbook_plugin_settings_flush_rewrite() {
    if ( get_option('bragbook_settings_have_changed') == true ) {
                add_filter('rewrite_rules_array', 'add_rewrite_rules');
    global $wp_rewrite;
          //$wp_rewrite->generate_rewrite_rules();
    $wp_rewrite->flush_rules();
        update_option('bragbook_settings_have_changed', false);
    }
  
}
 
function register_mysettings() {
//register our settings
              register_setting( 'bragbook-settings-group', 'bragbook_settings_have_changed' );
        register_setting( 'bragbook-settings-group', 'revSecretKey' );
              register_setting( 'bragbook-settings-group', 'revClientId' );
              register_setting( 'bragbook-settings-group', 'revBaseUrl' );
              register_setting( 'bragbook-settings-group', 'revPageId' );
        
        register_setting( 'bragbook-settings-group', 'revSecretKey2' );
              register_setting( 'bragbook-settings-group', 'revClientId2' );
              register_setting( 'bragbook-settings-group', 'revBaseUrl2' );
              register_setting( 'bragbook-settings-group', 'revPageId2' );
        
        register_setting( 'bragbook-settings-group', 'revSecretKey3' );
              register_setting( 'bragbook-settings-group', 'revClientId3' );
              register_setting( 'bragbook-settings-group', 'revBaseUrl3' );
              register_setting( 'bragbook-settings-group', 'revPageId3' );
        
        register_setting( 'bragbook-settings-group', 'revSecretKey4' );
              register_setting( 'bragbook-settings-group', 'revClientId4' );
              register_setting( 'bragbook-settings-group', 'revBaseUrl4' );
              register_setting( 'bragbook-settings-group', 'revPageId4' );
        
        register_setting( 'bragbook-settings-group', 'revSecretKey5' );
              register_setting( 'bragbook-settings-group', 'revClientId5' );
              register_setting( 'bragbook-settings-group', 'revBaseUrl5' );
              register_setting( 'bragbook-settings-group', 'revPageId5' );
        
        register_setting( 'bragbook-settings-group', 'revSecretKey6' );
              register_setting( 'bragbook-settings-group', 'revClientId6' );
              register_setting( 'bragbook-settings-group', 'revBaseUrl6' );
              register_setting( 'bragbook-settings-group', 'revPageId6' );
        
              register_setting( 'bragbook-settings-group', 'revUrlRewrite' );
              register_setting( 'bragbook-settings-group', 'revDefaultDescription' );
              register_setting( 'bragbook-settings-group', 'revDefaultDescription2' );
              register_setting( 'bragbook-settings-group', 'revDefaultDescription3' );
              register_setting( 'bragbook-settings-group', 'revDefaultDescription4' );
              register_setting( 'bragbook-settings-group', 'revDefaultDescription5' );
              register_setting( 'bragbook-settings-group', 'revDefaultDescription6' );
              register_setting( 'bragbook-settings-group', 'revNotFound' );
              register_setting( 'bragbook-settings-group', 'revThumbLimit' );
              register_setting( 'bragbook-settings-group', 'revLandingHeadline' );
              register_setting( 'bragbook-settings-group', 'revLandingIntro' );
              register_setting( 'bragbook-settings-group', 'revLandingDescription' );
              register_setting( 'bragbook-settings-group', 'revNudityWarning' );
        register_setting( 'bragbook-settings-group', 'revMyFavsActive' );
        register_setting( 'bragbook-settings-group', 'revThumbnailsActive' );
        register_setting( 'bragbook-settings-group', 'revClickToZoomActive' );
        register_setting( 'bragbook-settings-group', 'revThumbLimit' );
              register_setting( 'bragbook-settings-group', 'revLandingTitle' );
              register_setting( 'bragbook-settings-group', 'revLandingTitle2' );
              register_setting( 'bragbook-settings-group', 'revLandingTitle3' );
              register_setting( 'bragbook-settings-group', 'revLandingTitle4' );
              register_setting( 'bragbook-settings-group', 'revLandingTitle5' );
              register_setting( 'bragbook-settings-group', 'revLandingTitle6' );
              register_setting( 'bragbook-settings-group', 'revRevisionActive' );
        register_setting( 'bragbook-settings-group', 'revMenActive' );
        register_setting( 'bragbook-settings-group', 'revShowCatSetDetails' );  
            register_setting( 'bragbook-settings-group', 'revEnableSitemap' );
              register_setting( 'bragbook-settings-group', 'revUseWPseo' );
             
              register_setting( 'bragbook-settings-group', 'revCategoryLandingPageIntro' );
              register_setting( 'bragbook-settings-group', 'revCategoryLandingTitle' );
              register_setting( 'bragbook-settings-group', 'revCategoryLandingDescription' );
        
         register_setting( 'bragbook-settings-group', 'revCustomCSS' );
         
        register_setting( 'bragbook-settings-group', 'revHideJumpMenu' );
          register_setting( 'bragbook-settings-group', 'revHideMainMenu' );
 

 
 register_setting( 'bragbook-settings-group', 'revFourCol' );
 register_setting( 'bragbook-settings-group', 'revFaceMenuImage' );
 register_setting( 'bragbook-settings-group', 'revBreastMenuImage' );
 register_setting( 'bragbook-settings-group', 'revBodyMenuImage' );
 register_setting( 'bragbook-settings-group', 'revSkinMenuImage' );
 register_setting( 'bragbook-settings-group', 'revFaceMenuImageAlt' );
 register_setting( 'bragbook-settings-group', 'revBreastMenuImageAlt' );
 register_setting( 'bragbook-settings-group', 'revBodyMenuImageAlt' );
 register_setting( 'bragbook-settings-group', 'revSkinMenuImageAlt' );
 
 register_setting( 'bragbook-settings-group', 'revGalNavStyleBorderColor' );
 register_setting( 'bragbook-settings-group', 'revGalNavStyleColor' );
 register_setting( 'bragbook-settings-group', 'revGalNavStyleBackground' );
 register_setting( 'bragbook-settings-group', 'revGalNavStyleHoverBorderColor' );
 register_setting( 'bragbook-settings-group', 'revGalNavStyleHoverColor' );
 register_setting( 'bragbook-settings-group', 'revGalNavStyleHoverBackground' );
 register_setting( 'bragbook-settings-group', 'revGalNavHighlightBackground' );
 register_setting( 'bragbook-settings-group', 'revGalNavHighlightColor' );
 register_setting( 'bragbook-settings-group', 'revGalNavHighlightBorderColor' );
 
 register_setting( 'bragbook-settings-group', 'revLandingIntro2' );
 register_setting( 'bragbook-settings-group', 'revLandingDescription2' );
 register_setting( 'bragbook-settings-group', 'revCategoryLandingPageIntro2' );
 register_setting( 'bragbook-settings-group', 'revCategoryLandingTitle2' );
 register_setting( 'bragbook-settings-group', 'revCategoryLandingDescription2' );
 
 register_setting( 'bragbook-settings-group', 'revLandingIntro3' );
 register_setting( 'bragbook-settings-group', 'revLandingDescription3' );
 register_setting( 'bragbook-settings-group', 'revCategoryLandingPageIntro3' );
 register_setting( 'bragbook-settings-group', 'revCategoryLandingTitle3' );
 register_setting( 'bragbook-settings-group', 'revCategoryLandingDescription3' );
 
 register_setting( 'bragbook-settings-group', 'revLandingIntro4' );
 register_setting( 'bragbook-settings-group', 'revLandingDescription4' );
 register_setting( 'bragbook-settings-group', 'revCategoryLandingPageIntro4' );
 register_setting( 'bragbook-settings-group', 'revCategoryLandingTitle4' );
 register_setting( 'bragbook-settings-group', 'revCategoryLandingDescription4' );
 
 register_setting( 'bragbook-settings-group', 'revLandingIntro5' );
 register_setting( 'bragbook-settings-group', 'revLandingDescription5' );
 register_setting( 'bragbook-settings-group', 'revCategoryLandingPageIntro5' );
 register_setting( 'bragbook-settings-group', 'revCategoryLandingTitle5' );
 register_setting( 'bragbook-settings-group', 'revCategoryLandingDescription5' );
 
 register_setting( 'bragbook-settings-group', 'revLandingIntro6' );
 register_setting( 'bragbook-settings-group', 'revLandingDescription6' );
 register_setting( 'bragbook-settings-group', 'revCategoryLandingPageIntro6' );
 register_setting( 'bragbook-settings-group', 'revCategoryLandingTitle6' );
 register_setting( 'bragbook-settings-group', 'revCategoryLandingDescription6' );

////Advanced Settings
register_setting( 'bragbook-settings-group', 'revFaceMenuLabel');
register_setting( 'bragbook-settings-group', 'revBreastMenuLabel');
register_setting( 'bragbook-settings-group', 'revBodyMenuLabel');
register_setting( 'bragbook-settings-group', 'revSkinMenuLabel');

register_setting( 'bragbook-settings-group', 'revFaceMenuLabel2');
register_setting( 'bragbook-settings-group', 'revBreastMenuLabel2');
register_setting( 'bragbook-settings-group', 'revBodyMenuLabel2');
register_setting( 'bragbook-settings-group', 'revSkinMenuLabel2');

register_setting( 'bragbook-settings-group', 'revFaceMenuLabel3');
register_setting( 'bragbook-settings-group', 'revBreastMenuLabel3');
register_setting( 'bragbook-settings-group', 'revBodyMenuLabel3');
register_setting( 'bragbook-settings-group', 'revSkinMenuLabel3');

register_setting( 'bragbook-settings-group', 'revFaceMenuLabel4');
register_setting( 'bragbook-settings-group', 'revBreastMenuLabel4');
register_setting( 'bragbook-settings-group', 'revBodyMenuLabel4');
register_setting( 'bragbook-settings-group', 'revSkinMenuLabel4');

register_setting( 'bragbook-settings-group', 'revFaceMenuLabel5');
register_setting( 'bragbook-settings-group', 'revBreastMenuLabel5');
register_setting( 'bragbook-settings-group', 'revBodyMenuLabel5');
register_setting( 'bragbook-settings-group', 'revSkinMenuLabel5');
 
register_setting( 'bragbook-settings-group', 'revFaceMenuLabel6');
register_setting( 'bragbook-settings-group', 'revBreastMenuLabel6');
register_setting( 'bragbook-settings-group', 'revBodyMenuLabel6');
register_setting( 'bragbook-settings-group', 'revSkinMenuLabel6');
 
              register_setting( 'bragbook-settings-group', 'revImageSetWrapOpen');
              register_setting( 'bragbook-settings-group', 'revImageSetWrapClose');
              register_setting( 'bragbook-settings-group', 'revLandingMenuWrapOpen');
              register_setting( 'bragbook-settings-group', 'revLandingMenuWrapClose');
              register_setting( 'bragbook-settings-group', 'revFaceMenuWrapOpen');
              register_setting( 'bragbook-settings-group', 'revFaceMenuWrapClose');
              register_setting( 'bragbook-settings-group', 'revBreastMenuWrapOpen');
              register_setting( 'bragbook-settings-group', 'revBreastMenuWrapClose');
              register_setting( 'bragbook-settings-group', 'revBodyMenuWrapOpen');
              register_setting( 'bragbook-settings-group', 'revBodyMenuWrapClose');
              register_setting( 'bragbook-settings-group', 'revSkinMenuWrapOpen');
              register_setting( 'bragbook-settings-group', 'revSkinMenuWrapClose');
              register_setting( 'bragbook-settings-group', 'revCategoryLandingPageWrapOpen');
              register_setting( 'bragbook-settings-group', 'revCategoryLandingPageWrapClose');
              register_setting( 'bragbook-settings-group', 'revSetDetails');    
        register_setting( 'bragbook-settings-group', 'revDetailsLimit' );
        
 }
 
 
add_action('admin_menu','bragbook_plugin_menu');
 
//load BRAGbook general settings admin
function bragbook_plugin_options(){
              include('admin/options.php');
}
 
function wpseo_129955_admin_scripts($suffix) {
    if($suffix == 'bragbook_page_bragbook-gallery-settings'){
        wp_enqueue_script( 'postbox' );
        wp_enqueue_script( 'postbox-edit', plugin_dir_url( __FILE__ ).'/admin/postbox-edit.min.js', array('jquery', 'postbox') );
    }
}
add_action( 'admin_enqueue_scripts', 'wpseo_129955_admin_scripts' );


add_action('init', 'cyb_start_session', 1);
add_action('wp_logout', 'cyb_end_session');
add_action('wp_login', 'cyb_end_session');

function cyb_start_session() {
    if( !session_id() ) {
         session_start( [
        'read_and_close' => true,
    ] );
        // now you can use $_SESSION
       // $_SESSION['test'] = "test";
    }
}

function cyb_end_session() {
    session_destroy();
}




 
//shortcodes
function bragbook_start(){
  session_start();
  
        global $wp_query;
    global $revTitle;
    global $revDesc;
    global $revCustomCSS;
    global $revGalleryOutput;
  
  bragbook_plugin_scripts();
  
       $curURL = explode("/", $_SERVER['REQUEST_URI']);
              if(isset($_REQUEST['page_id'])){
                             $curPageid = $_REQUEST['page_id'];
              } else {
              $curPageid = "x";
              }
             
              if(isset($curURL[1])){$curURL1 = $curURL[1];} else {$curURL1 = "revnone";}
              if(isset($curURL[2])){$curURL2 = $curURL[2];} else {$curURL2 = "revnone";}
    if (get_option( 'revBaseUrl2', '' ) != "" && ($curURL1 == get_option( 'revBaseUrl2', 'gallery' ) || $curURL2 == get_option( 'revBaseUrl2', 'gallery' ) || $curPageid == get_option( 'revPageId2'))){
    $galNum = "2";
  }else if (get_option( 'revBaseUrl3', '' ) != "" && ($curURL1 == get_option( 'revBaseUrl3', 'gallery' ) || $curURL2 == get_option( 'revBaseUrl3', 'gallery' ) || $curPageid == get_option( 'revPageId3'))){
    $galNum = "3";
  }else if(get_option( 'revBaseUrl4', '' ) != "" && ($curURL1 == get_option( 'revBaseUrl4', 'gallery' ) || $curURL2 == get_option( 'revBaseUrl4', 'gallery' ) || $curPageid == get_option( 'revPageId4'))){
    $galNum = "4";
  }else if(get_option( 'revBaseUrl5', '' ) != "" && ($curURL1 == get_option( 'revBaseUrl5', 'gallery' ) || $curURL2 == get_option( 'revBaseUrl5', 'gallery' ) || $curPageid == get_option( 'revPageId5'))) {
    $galNum = "5";
  }else if(get_option( 'revBaseUrl6', '' ) != "" && ($curURL1 == get_option( 'revBaseUrl6', 'gallery' ) || $curURL2 == get_option( 'revBaseUrl6', 'gallery' ) || $curPageid == get_option( 'revPageId6'))) {
    $galNum = "6";

  } else{
    $galNum = "";
  }
  
  
  
              global $wp_query;
             
              $revGallery = new revGallery;
        
         //get query variables
        $queryURL = @parse_url( html_entity_decode( esc_url( add_query_arg( $arr_params ) ) ) );
        parse_str( @$queryURL['query'], $getVar );
        $var_revCatname = @$getVar['revCatname'];
        $var_getCategorySets = @$getVar['getCategorySets'];
        $var_categorySetsStart = @$getVar['categorySetsStart'];
        $var_patientlogout = @$getVar['patientlogout'];
        $var_sig = @$getVar['sig'];
        $var_patientsig = @$getVar['patientSig'];
        $var_patientid = @$getVar['patientid'];
        $var_username = @$getVar['username'];
        $var_favid = @$getVar['favid'];
        $var_getFavButton = @$getVar['getFavButton'];
        $var_getLoginButton = @$getVar['getLoginButton'];
        $var_getLoginText = @$getVar['getLoginText'];
        $var_getThumbnails = @$getVar['getThumbnails'];
        $var_thumbStart = @$getVar['thumbStart'];
  
      
 
              //Global Gallery Variables
             
              //Set validation key
              $revGallery->MySecretKey = get_option( 'revSecretKey'.$galNum, 'R3v3n3zBR@Gbook57');
              //Set Client ID
              $revGallery->clientid = get_option( 'revClientId'.$galNum, 'demo' );
  
  //if(md5($var_patientid.$var_username.get_option( 'revSecretKey'.$galNum, 'R3v3n3zBR@Gbook57')) == $var_patientsig) {
    
    if(isset($var_patientsig)){$_SESSION['patientsig'] = $patientsig;}
    if(isset($patientid)){$_SESSION['patientid'] = $patientid;}
    if(isset($username)){$_SESSION['patientUser'] = $username;}
    //}

              //The directory the gallery resides at relative to the home. Be sure to include forward slash at beginning and end.
              //if (substr($_SERVER['HTTP_HOST'], 0, 4) == "www."){$addwww = "";} else {$addwww = "www.";}
        $pageURL = 'http';
        if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
         $pageURL .= "://";
              $revGallery->baseUrl = $pageURL.$_SERVER['HTTP_HOST']."/".get_option( 'revBaseUrl'.$galNum, 'gallery' )."/";
       
              //Determines if URL rewrites are on or not. Set true or false.
              $revGallery->urlRewrite = get_option( 'revUrlRewrite', 1 );
              //Default page description if custom description not used
              $revGallery->defaultDescription = get_option( 'revDefaultDescription'.$galNum, 'Plastic surgery before and after images');
              //URL for 404 not found page
              $revGallery->notFoundPage = get_option( 'revNotFound', '/404' );
              //Number of thumbnail sets to display at one time. Leave blank if you want to show all
              $revGallery->thumbLimit = get_option( 'revThumbLimit', '20' );
              //Headline for gallery landing page
              $revGallery->landingHeadline = get_option( 'revLandingHeadline', '' );
              //Intro text for gallery landing page
              $revGallery->landingIntro = wpautop(get_option( 'revLandingIntro'.$galNum, "<p>Welcome to our Before and After gallery. To improve the communication between us, we encourage you to use the MyFavorites feature to create a collection of images that reflect your surgical goals. When looking at a set of images, simply click the \"Add to Favorites\" button to begin your collection. During our consultation, we'll review this collection together so we can discuss your specific goals and concerns.</p>" ));
              //Text for title tag on landing page
              $revGallery->revLandingTitle = get_option( 'revLandingTitle'.$galNum, 'Plastic surgery before and after gallery');
              //Text for description meta tag on landing page
              $revGallery->revLandingDescription = get_option( 'revLandingDescription'.$galNum,'Plastic surgery before and after images');
             
              //turns on nudity warning on landing page for breast and body categories
              $revGallery->nudityWarning = get_option( 'revNudityWarning',true);
              //Sets variable to remove sets with revision option selected from the main categories so they can be placed in revision categories
        $revGallery->myFavsActive = get_option( 'revMyFavsActive',1);
        $revGallery->clickToZoomActive = get_option( 'revClickToZoomActive',1);
        $revGallery->thumbnailsActive = get_option( 'revThumbnailsActive',1);
              $revGallery->revisionActive = get_option( 'revRevisionActive', false);
        $revGallery->menActive = get_option( 'revMenActive', false);
        $revGallery->showCatSetDetails = get_option( 'revShowCatSetDetails', false);
             
       
              $revGallery->faceMenuLabel = get_option( 'revFaceMenuLabel'.$galNum, ''); //change the h2 text label on the landing page menu for face procedures column
              $revGallery->breastMenuLabel = get_option( 'revBreastMenuLabel'.$galNum, ''); //change the h2 text label on the landing page menu for breast procedures column
              $revGallery->bodyMenuLabel = get_option( 'revBodyMenuLabel'.$galNum, ''); //change the h2 text label on the landing page menu for body procedures column
              $revGallery->skinMenuLabel = get_option( 'revSkinMenuLabel'.$galNum, ''); //change the h2 text label on the landing page menu for non-surgical procedures column
              $revGallery->imageSetWrapOpen = get_option( 'revImageSetWrapOpen', ''); //html tags to place before the image set pages 
              $revGallery->imageSetWrapClose = get_option( 'revImageSetWrapClose', ''); //html tags to place after the image set pages  
              
        $fourColMenu = get_option( 'revFourCol', '' );
        if($fourColMenu == 1){
          
          $faceMenuImage = get_option( 'revFaceMenuImage', '');
          $breastMenuImage = get_option( 'revBreastMenuImage', '');
          $bodyMenuImage = get_option( 'revBodyMenuImage', '');
          $skinMenuImage = get_option( 'revSkinMenuImage', '');
          
          $faceMenuImageAlt = get_option( 'revFaceMenuImageAlt', '');
          $breastMenuImageAlt = get_option( 'revBreastMenuImageAlt', '');
          $bodyMenuImageAlt = get_option( 'revBodyMenuImageAlt', '');
          $skinMenuImageAlt = get_option( 'revSkinMenuImageAlt', '');
          
          if(isset($faceMenuImage) && $faceMenuImage != ''){$faceMenuImage = '<img alt="'.$faceMenuImageAlt.'" src="'.$faceMenuImage.'" />';}
          if(isset($breastMenuImage) && $breastMenuImage != ''){$breastMenuImage = '<img alt="'.$breastMenuImageAlt.'" src="'.$breastMenuImage.'" />';}
          if(isset($bodyMenuImage) && $bodyMenuImage != ''){$bodyMenuImage = '<img alt="'.$bodyMenuImageAlt.'" src="'.$bodyMenuImage.'" />';}
          if(isset($skinMenuImage) && $skinMenuImage != ''){$skinMenuImage = '<img alt="'.$skinMenuImageAlt.'" src="'.$skinMenuImage.'" />';}
          
          
              $revGallery->landingMenuWrapOpen = '<div id="bbmenu">'; //html tags to place before the landing page menu on the landing page
              $revGallery->landingMenuWrapClose = '</div>'; //html tags to place after the landing page menu on the landing page
              $revGallery->faceMenuWrapOpen = '<div id="bbface">'.$faceMenuImage; //html tags to place before the face category menu on the landing page
              $revGallery->faceMenuWrapClose = '</div>'; //html tags to place after the face category menu on the landing page
              $revGallery->breastMenuWrapOpen = '<div id="bbbreast">'.$breastMenuImage; //html tags to place before the breast category menu on the landing page
              $revGallery->breastMenuWrapClose = '</div>'; //html tags to place after the breast category menu on the landing page
              $revGallery->bodyMenuWrapOpen = '<div id="bbbody">'.$bodyMenuImage; //html tags to place before the body category menu on the landing page
              $revGallery->bodyMenuWrapClose = '</div>'; //html tags to place after the body category menu on the landing page
              $revGallery->skinMenuWrapOpen = '<div id="bbskin">'.$skinMenuImage; //html tags to place before the skin / non-surgical category menu on the landing page
              $revGallery->skinMenuWrapClose = '</div>'; //html tags to place after the skin / non-surgical category menu on the landing page
          
        } else{
        
        $revGallery->landingMenuWrapOpen = get_option( 'revLandingMenuWrapOpen', '<div id="revFullMenu">' ); //html tags to place before the landing page menu on the landing page
              $revGallery->landingMenuWrapClose = get_option( 'revLandingMenuWrapClose', '</div>'); //html tags to place after the landing page menu on the landing page
              $revGallery->faceMenuWrapOpen = get_option( 'revFaceMenuWrapOpen', ''); //html tags to place before the face category menu on the landing page
              $revGallery->faceMenuWrapClose = get_option( 'revFaceMenuWrapClose', ''); //html tags to place after the face category menu on the landing page
              $revGallery->breastMenuWrapOpen = get_option( 'revBreastMenuWrapOpen', ''); //html tags to place before the breast category menu on the landing page
              $revGallery->breastMenuWrapClose = get_option( 'revBreastMenuWrapClose', ''); //html tags to place after the breast category menu on the landing page
              $revGallery->bodyMenuWrapOpen = get_option( 'revBodyMenuWrapOpen', ''); //html tags to place before the body category menu on the landing page
              $revGallery->bodyMenuWrapClose = get_option( 'revBodyMenuWrapClose', ''); //html tags to place after the body category menu on the landing page
              $revGallery->skinMenuWrapOpen = get_option( 'revSkinMenuWrapOpen', ''); //html tags to place before the skin / non-surgical category menu on the landing page
              $revGallery->skinMenuWrapClose = get_option( 'revSkinMenuWrapClose', ''); //html tags to place after the skin / non-surgical category menu on the landing page
        
        }
        
              $revGallery->categoryLandingPageWrapOpen = get_option( 'revCategoryLandingPageWrapOpen', ''); //html tags to place after the category landing page
              $revGallery->categoryLandingPageWrapClose = get_option( 'revCategoryLandingPageWrapClose', ''); //html tags to place after the category landing page
              $revGallery->setDetails = get_option( 'revSetDetails', ''); //Choose the details field used for image sets that have information specific to this website in the bragbook dashboard. By default the basic details field will be used for all sets if this is not defined. Enter "1" if you used "details for website 1", "2" if you used "details for website 2", etc.
              $revGallery->hideJumpMenu = get_option( 'revHideJumpMenu', ''); //variable to hide jump menu
              $revGallery->hideMainMenu = get_option( 'revHideMainMenu', ''); //variable to hide main menu
             
              $revGallery->categoryLandingPageIntro = wpautop(get_option( 'revCategoryLandingPageIntro'.$galNum, '<p>Click on the before and after sets below to get more details on each case.</p>'));
//Adds text to the beginning of auto-generated category landing titles
$revGallery->revCategoryLandingTitle = get_option( 'revCategoryLandingTitle'.$galNum, '');
//Adds text after auto-generated category landing descriptions
$revGallery->revCategoryLandingDescription = get_option( 'revCategoryLandingDescription'.$galNum, '');
  
             
              //check for logout request (do not modify)
              if(isset($var_patientlogout)){
                
                             $revGallery->patientLogout();
               exit();
              }
             
              //set login information for MyFavs (do not modify)
              if(isset($var_sig)){
                             $revGallery->patientLogin($var_sig,$var_patientid,$var_username,$var_favid);
               exit();
              }
             
             //Get Image Sets for Category Landing Page (do not modify)
        if(isset($var_getCategorySets) && $var_getCategorySets == "1"){
          $revGallery->getCatFeed();
          $revGallery->revDefaultSection();
          $var_revCatname = ucwords(str_replace('-', ' ', $var_revCatname));
          $revGallery->revSetProcedureID($var_revCatname);
          $revGallery->getImageFeed();
          echo $revGallery->revCategoryLandingPageImageSets($var_revCatname, $var_categorySetsStart);
          exit();
        }
              
             
              //URL Variables (do not modify)
              $revGallery->getCatFeed();
$revGallery->revDefaultSection();
if(isset($wp_query->query_vars['revCatname'])){$revCatname = $wp_query->query_vars['revCatname'];} else { $revCatname = "home";};
if(isset($wp_query->query_vars['revStart'])){$revID = $wp_query->query_vars['revStart'];} else { $revID = 999999; };
$revGallery->revDefaultProcedureName();
$revCatname = ucwords(str_replace('-', ' ', $revCatname));
$revGallery->revSetProcedureID($revCatname);
if($revCatname == "Home" && $revGallery->revisionActive == 0 && $revGallery->menActive == 0){}else{$revGallery->getImageFeed();}
if($revGallery->revisionActive ==1 || $revGallery->menActive ==1){$revGallery->revCheckRevision();}
             
             
             
              //Get Favorites button (do not modify)
              if(isset($var_getFavButton)){
          
                             echo $revGallery->revFavoriteButton($revID);
                             exit();
              }
              //Get Login button (do not modify)
              if(isset($var_getLoginButton)){
                             echo $revGallery->revLoginButton($revIDF);
                             exit();
              }
              //Get Login Text (do not modify)
              if(isset($var_getLoginText)){
                             echo $revGallery->revFavoriteText($revID);
                             exit();
              }
              //Get Thumbnails (do not modify)
              if(isset($var_getThumbnails)){
                             if(isset($var_thumbStart)){$thumbStart = $var_thumbStart;} else {$thumbStart = 0;}
                             echo $revGallery->revThumbnails($var_revCatname, $thumbStart);
                             exit();
              }
                          
                          
             
$revGalleryOutput = @$revGallery->revenezBAgallery($revCatname, $revID);  
$revTitle = $revGallery->revTitleReturn($revCatname,$revID);
$revDesc = $revGallery->revDescriptionReturn($revCatname,$revID);
$revCustomCSS = get_option( 'revCustomCSS', '');
}

//ajax calls to get thumbnails, login buttons, etc
function bragbook_ajax_start(){
  session_start();
  
  if (class_exists('revGallery')) {} else{
        include('assets/BRAGbook.php');
        }
  
        global $wp_query;
    global $revTitle;
    global $revDesc;
    global $revCustomCSS;
    global $revGalleryOutput;
  
  
   $queryURL = @parse_url( html_entity_decode( esc_url( add_query_arg( $arr_params ) ) ) );
        parse_str( @$queryURL['query'], $getVar );
             $curURL = urldecode(@$getVar['revCurURL']);
       $curURL = explode("/", $curURL);
  

              if(isset($_REQUEST['page_id'])){
                             $curPageid = $_REQUEST['page_id'];
              } else {
              $curPageid = "x";
              }
             
              if(isset($curURL[3])){$curURL1 = $curURL[3];} else {$curURL1 = "revnone";}
              if(isset($curURL[4])){$curURL2 = $curURL[4];} else {$curURL2 = "revnone";}
    if (get_option( 'revBaseUrl2', '' ) != "" && ($curURL1 == get_option( 'revBaseUrl2', 'gallery' ) || $curURL2 == get_option( 'revBaseUrl2', 'gallery' ) || $curPageid == get_option( 'revPageId2'))){
    $galNum = "2";
  }else if (get_option( 'revBaseUrl3', '' ) != "" && ($curURL1 == get_option( 'revBaseUrl3', 'gallery' ) || $curURL2 == get_option( 'revBaseUrl3', 'gallery' ) || $curPageid == get_option( 'revPageId3'))){
    $galNum = "3";
  }else if(get_option( 'revBaseUrl4', '' ) != "" && ($curURL1 == get_option( 'revBaseUrl4', 'gallery' ) || $curURL2 == get_option( 'revBaseUrl4', 'gallery' ) || $curPageid == get_option( 'revPageId4'))){
    $galNum = "4";
  }else if(get_option( 'revBaseUrl5', '' ) != "" && ($curURL1 == get_option( 'revBaseUrl5', 'gallery' ) || $curURL2 == get_option( 'revBaseUrl5', 'gallery' ) || $curPageid == get_option( 'revPageId5'))) {
    $galNum = "5";
  }else if(get_option( 'revBaseUrl6', '' ) != "" && ($curURL1 == get_option( 'revBaseUrl6', 'gallery' ) || $curURL2 == get_option( 'revBaseUrl6', 'gallery' ) || $curPageid == get_option( 'revPageId6'))) {
    $galNum = "6";
  
  } else{
    $galNum = "";
  }
  
  
  
              global $wp_query;
             
              $revGallery = new revGallery;
        
         //get query variables
       
        $var_revCatname = @$getVar['revCatname'];
        $var_getCategorySets = @$getVar['getCategorySets'];
        $var_categorySetsStart = @$getVar['categorySetsStart'];
        $var_patientlogout = @$getVar['patientlogout'];
        $var_sig = @$getVar['sig'];
  
        if(isset($getVar['patientSig']) && $getVar['patientSig'] != ""){$var_patientsig = @$getVar['patientSig'];} else if(isset($_SESSION['patientsig'])){$var_patientsig = $_SESSION['patientsig'];}else{$var_patientsig = "";}
  
  if(isset($getVar['username']) && $getVar['username'] != ""){$var_username = @$getVar['username'];} else if(isset($_SESSION['username'])){$var_username = $_SESSION['username'];}else{$var_username = "";}
  
  if(isset($getVar['patientid']) && $getVar['patientid'] != ""){$var_patientid = @$getVar['patientid'];} else if(isset($_SESSION['patientid'])){$var_patientid = $_SESSION['patientid'];}else{$var_patientid = "";}
        
        
        $var_favid = @$getVar['favid'];
        $var_getFavButton = @$getVar['getFavButton'];
        $var_getLoginButton = @$getVar['getLoginButton'];
        $var_getLoginText = @$getVar['getLoginText'];
        $var_getThumbnails = @$getVar['getThumbnails'];
        $var_thumbStart = @$getVar['thumbStart'];
  
      
 
              //Global Gallery Variables
             
              //Set validation key
              $revGallery->MySecretKey = get_option( 'revSecretKey'.$galNum, 'R3v3n3zBR@Gbook57');
              //Set Client ID
              $revGallery->clientid = get_option( 'revClientId'.$galNum, 'demo' );
  
  
  
  //if(md5($var_patientid.$var_username.get_option( 'revSecretKey'.$galNum, 'R3v3n3zBR@Gbook57')) == $var_patientsig) {
    
    if(isset($var_patientsig)){$_SESSION['patientsig'] = $var_patientsig;}
    if(isset($var_patientid)){$_SESSION['patientid'] = $var_patientid;}
    if(isset($var_username)){$_SESSION['patientUser'] = $var_username;}
    //}
  

              //The directory the gallery resides at relative to the home. Be sure to include forward slash at beginning and end.
              //if (substr($_SERVER['HTTP_HOST'], 0, 4) == "www."){$addwww = "";} else {$addwww = "www.";}
        $pageURL = 'http';
        if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
         $pageURL .= "://";
              $revGallery->baseUrl = $pageURL.$_SERVER['HTTP_HOST']."/".get_option( 'revBaseUrl'.$galNum, 'gallery' )."/";
      
              //Determines if URL rewrites are on or not. Set true or false.
              $revGallery->urlRewrite = get_option( 'revUrlRewrite', 1 );
              //Default page description if custom description not used
              $revGallery->defaultDescription = get_option( 'revDefaultDescription'.$galNum, 'Plastic surgery before and after images');
              //URL for 404 not found page
              $revGallery->notFoundPage = get_option( 'revNotFound', '/404' );
              //Number of thumbnail sets to display at one time. Leave blank if you want to show all
              $revGallery->thumbLimit = get_option( 'revThumbLimit', '20' );
              //Headline for gallery landing page
              $revGallery->landingHeadline = get_option( 'revLandingHeadline', '' );
              //Intro text for gallery landing page
              $revGallery->landingIntro = wpautop(get_option( 'revLandingIntro'.$galNum, "<p>Welcome to our Before and After gallery. To improve the communication between us, we encourage you to use the MyFavorites feature to create a collection of images that reflect your surgical goals. When looking at a set of images, simply click the \"Add to Favorites\" button to begin your collection. During our consultation, we'll review this collection together so we can discuss your specific goals and concerns.</p>" ));
              //Text for title tag on landing page
              $revGallery->revLandingTitle = get_option( 'revLandingTitle'.$galNum, 'Plastic surgery before and after gallery');
              //Text for description meta tag on landing page
              $revGallery->revLandingDescription = get_option( 'revLandingDescription'.$galNum,'Plastic surgery before and after images');
             
              //turns on nudity warning on landing page for breast and body categories
              $revGallery->nudityWarning = get_option( 'revNudityWarning',true);
              //Sets variable to remove sets with revision option selected from the main categories so they can be placed in revision categories
        $revGallery->myFavsActive = get_option( 'revMyFavsActive',1);
        $revGallery->clickToZoomActive = get_option( 'revClickToZoomActive',1);
        $revGallery->thumbnailsActive = get_option( 'revThumbnailsActive',1);
              $revGallery->revisionActive = get_option( 'revRevisionActive', false);
        $revGallery->menActive = get_option( 'revMenActive', false);
        $revGallery->showCatSetDetails = get_option( 'revShowCatSetDetails', false);
             
       
              $revGallery->faceMenuLabel = get_option( 'revFaceMenuLabel'.$galNum, ''); //change the h2 text label on the landing page menu for face procedures column
              $revGallery->breastMenuLabel = get_option( 'revBreastMenuLabel'.$galNum, ''); //change the h2 text label on the landing page menu for breast procedures column
              $revGallery->bodyMenuLabel = get_option( 'revBodyMenuLabel'.$galNum, ''); //change the h2 text label on the landing page menu for body procedures column
              $revGallery->skinMenuLabel = get_option( 'revSkinMenuLabel'.$galNum, ''); //change the h2 text label on the landing page menu for non-surgical procedures column
              $revGallery->imageSetWrapOpen = get_option( 'revImageSetWrapOpen', ''); //html tags to place before the image set pages 
              $revGallery->imageSetWrapClose = get_option( 'revImageSetWrapClose', ''); //html tags to place after the image set pages  
              
        $fourColMenu = get_option( 'revFourCol', '' );
        if($fourColMenu == 1){
          
          $faceMenuImage = get_option( 'revFaceMenuImage', '');
          $breastMenuImage = get_option( 'revBreastMenuImage', '');
          $bodyMenuImage = get_option( 'revBodyMenuImage', '');
          $skinMenuImage = get_option( 'revSkinMenuImage', '');
          
          if(isset($faceMenuImage) && $faceMenuImage != ''){$faceMenuImage = '<img src="'.$faceMenuImage.'" />';}
          if(isset($breastMenuImage) && $breastMenuImage != ''){$breastMenuImage = '<img src="'.$breastMenuImage.'" />';}
          if(isset($bodyMenuImage) && $bodyMenuImage != ''){$bodyMenuImage = '<img src="'.$bodyMenuImage.'" />';}
          if(isset($skinMenuImage) && $skinMenuImage != ''){$skinMenuImage = '<img src="'.$skinMenuImage.'" />';}
          
          
              $revGallery->landingMenuWrapOpen = '<div id="bbmenu">'; //html tags to place before the landing page menu on the landing page
              $revGallery->landingMenuWrapClose = '</div>'; //html tags to place after the landing page menu on the landing page
              $revGallery->faceMenuWrapOpen = '<div id="bbface">'.$faceMenuImage; //html tags to place before the face category menu on the landing page
              $revGallery->faceMenuWrapClose = '</div>'; //html tags to place after the face category menu on the landing page
              $revGallery->breastMenuWrapOpen = '<div id="bbbreast">'.$breastMenuImage; //html tags to place before the breast category menu on the landing page
              $revGallery->breastMenuWrapClose = '</div>'; //html tags to place after the breast category menu on the landing page
              $revGallery->bodyMenuWrapOpen = '<div id="bbbody">'.$bodyMenuImage; //html tags to place before the body category menu on the landing page
              $revGallery->bodyMenuWrapClose = '</div>'; //html tags to place after the body category menu on the landing page
              $revGallery->skinMenuWrapOpen = '<div id="bbskin">'.$skinMenuImage; //html tags to place before the skin / non-surgical category menu on the landing page
              $revGallery->skinMenuWrapClose = '</div>'; //html tags to place after the skin / non-surgical category menu on the landing page
          
        } else{
        
        $revGallery->landingMenuWrapOpen = get_option( 'revLandingMenuWrapOpen', '<div id="revFullMenu">' ); //html tags to place before the landing page menu on the landing page
              $revGallery->landingMenuWrapClose = get_option( 'revLandingMenuWrapClose', '</div>'); //html tags to place after the landing page menu on the landing page
              $revGallery->faceMenuWrapOpen = get_option( 'revFaceMenuWrapOpen', ''); //html tags to place before the face category menu on the landing page
              $revGallery->faceMenuWrapClose = get_option( 'revFaceMenuWrapClose', ''); //html tags to place after the face category menu on the landing page
              $revGallery->breastMenuWrapOpen = get_option( 'revBreastMenuWrapOpen', ''); //html tags to place before the breast category menu on the landing page
              $revGallery->breastMenuWrapClose = get_option( 'revBreastMenuWrapClose', ''); //html tags to place after the breast category menu on the landing page
              $revGallery->bodyMenuWrapOpen = get_option( 'revBodyMenuWrapOpen', ''); //html tags to place before the body category menu on the landing page
              $revGallery->bodyMenuWrapClose = get_option( 'revBodyMenuWrapClose', ''); //html tags to place after the body category menu on the landing page
              $revGallery->skinMenuWrapOpen = get_option( 'revSkinMenuWrapOpen', ''); //html tags to place before the skin / non-surgical category menu on the landing page
              $revGallery->skinMenuWrapClose = get_option( 'revSkinMenuWrapClose', ''); //html tags to place after the skin / non-surgical category menu on the landing page
        
        }
        
              $revGallery->categoryLandingPageWrapOpen = get_option( 'revCategoryLandingPageWrapOpen', ''); //html tags to place after the category landing page
              $revGallery->categoryLandingPageWrapClose = get_option( 'revCategoryLandingPageWrapClose', ''); //html tags to place after the category landing page
              $revGallery->setDetails = get_option( 'revSetDetails', ''); //Choose the details field used for image sets that have information specific to this website in the bragbook dashboard. By default the basic details field will be used for all sets if this is not defined. Enter "1" if you used "details for website 1", "2" if you used "details for website 2", etc.
              $revGallery->hideJumpMenu = get_option( 'revHideJumpMenu', ''); //variable to hide jump menu
              $revGallery->hideMainMenu = get_option( 'revHideMainMenu', ''); //variable to hide main menu
             
              $revGallery->categoryLandingPageIntro = wpautop(get_option( 'revCategoryLandingPageIntro'.$galNum, '<p>Click on the before and after sets below to get more details on each case.</p>'));
//Adds text to the beginning of auto-generated category landing titles
$revGallery->revCategoryLandingTitle = get_option( 'revCategoryLandingTitle'.$galNum, '');
//Adds text after auto-generated category landing descriptions
$revGallery->revCategoryLandingDescription = get_option( 'revCategoryLandingDescription'.$galNum, '');
  
             
              //check for logout request (do not modify)
              if(isset($var_patientlogout)){
                $_SESSION['patientsig'] = "";
              $_SESSION['patientid'] = "";
              $_SESSION['patientUser'] = "";
                             //$revGallery->patientLogout();
               exit();
              }
             
              //set login information for MyFavs (do not modify)
              if(isset($var_sig)){
                             $revGallery->patientLogin($var_sig,$var_patientid,$var_username,$var_favid);
               exit();
              }
             
             //Get Image Sets for Category Landing Page (do not modify)
        if(isset($var_getCategorySets) && $var_getCategorySets == "1"){
          $revGallery->getCatFeed();
          $revGallery->revDefaultSection();
          $var_revCatname = ucwords(str_replace('-', ' ', $var_revCatname));
          $revGallery->revSetProcedureID($var_revCatname);
          $revGallery->getImageFeed();
          echo $revGallery->revCategoryLandingPageImageSets($var_revCatname, $var_categorySetsStart);
          exit();
        }
              
             
              //URL Variables (do not modify)
              $revGallery->getCatFeed();
$revGallery->revDefaultSection();
  
  //count exploded url array to find cat name and start
  $urlCount = count($curURL);
  
$revCatname = $curURL[$urlCount - 3];
$revID = $curURL[$urlCount - 2];
$revGallery->revDefaultProcedureName();
$revCatname = ucwords(str_replace('-', ' ', $revCatname));
$revGallery->revSetProcedureID($revCatname);
if($revCatname == "Home" && $revGallery->revisionActive == 0 && $revGallery->menActive == 0){}else{$revGallery->getImageFeed();}
if($revGallery->revisionActive ==1 || $revGallery->menActive ==1){$revGallery->revCheckRevision();}
             
             
              //Get Favorites button (do not modify)
              if(isset($var_getFavButton)){
                            echo $revGallery->revFavoriteButton($revID);
                             exit();
              }
              //Get Login button (do not modify)
              if(isset($var_getLoginButton)){
                             echo $revGallery->revLoginButton($revID);
                             exit();
              }
              //Get Login Text (do not modify)
              if(isset($var_getLoginText)){
                             echo $revGallery->revFavoriteText($revID);
                             exit();
              }
              //Get Thumbnails (do not modify)
              if(isset($var_getThumbnails)){
                             if(isset($var_thumbStart)){$thumbStart = $var_thumbStart;} else {$thumbStart = 0;}
                             echo $revGallery->revThumbnails($var_revCatname, $thumbStart);
                             exit();
              }
                          
                          
             
$revGalleryOutput = @$revGallery->revenezBAgallery($revCatname, $revID); 
$revTitle = $revGallery->revTitleReturn($revCatname,$revID);
$revDesc = $revGallery->revDescriptionReturn($revCatname,$revID);
$revCustomCSS = get_option( 'revCustomCSS', '');
}

  
function bragbook_slider_list($catID, $limit, $start, $title, $details){
  
  if( isset($curGallery) && $curGallery > "1" ) {
    $galNum = $curGallery;
  
  } else{
    $galNum = "";
  }
  
  $var_revCatname = $catID;
        $var_categorySetsStart = $start;
  if(isset($title) && $title == 1){$var_revHead = $title;} else {$var_revHead = "";}
  
  $revGallery = new revGallery;
  
  //Global Gallery Variables
             
              //Set validation key
              $revGallery->MySecretKey = get_option( 'revSecretKey'.$galNum, 'R3v3n3zBR@Gbook57');
              //Set Client ID
              $revGallery->clientid = get_option( 'revClientId'.$galNum, 'demo' );
      if(isset($limit)){$revGallery->categoryImageSetLimit = $limit;}
      if(isset($details) && $details == 1){$revGallery->showCatSetDetails = $details;}
  

              //The directory the gallery resides at relative to the home. Be sure to include forward slash at beginning and end.
              //if (substr($_SERVER['HTTP_HOST'], 0, 4) == "www."){$addwww = "";} else {$addwww = "www.";}
        $pageURL = 'http';
        if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
         $pageURL .= "://";
              $revGallery->baseUrl = $pageURL.$_SERVER['HTTP_HOST']."/".get_option( 'revBaseUrl'.$galNum, 'gallery' )."/";
       
              //Determines if URL rewrites are on or not. Set true or false.
              $revGallery->urlRewrite = get_option( 'revUrlRewrite', 1 );
              //URL for 404 not found page
              $revGallery->notFoundPage = get_option( 'revNotFound', '/404' );
      $revGallery->revisionActive = get_option( 'revRevisionActive', false);
        $revGallery->menActive = get_option( 'revMenActive', false);
  
  //Get Image Sets for Category Landing Page (do not modify)
          $revGallery->getCatFeed();
          $revGallery->revDefaultSection();
  
          $var_revCatname = ucwords(str_replace('-', ' ', $var_revCatname));
          $catSet = $revGallery->revSetProcedureID($var_revCatname, 1);
          if($catSet == 1){
            return '<p class="bbCarouselError"><strong>BRAG book Carousel Error:</strong> Gallery category is empty or does not exist</p>';
          } 
            
          
          $revGallery->getImageFeed();
  
          return $revGallery->revCategorySliderOutput($var_revCatname, $var_categorySetsStart, $var_revHead);
  
          
          
}

function bragbook_category_list($catID, $limit, $start, $title, $details){
  
  if( isset($curGallery) && $curGallery > "1" ) {
    $galNum = $curGallery;
  
  } else{
    $galNum = "";
  }
  
  $var_revCatname = $catID;
        $var_categorySetsStart = $start;
  if(isset($title) && $title == 1){$var_revHead = $title;} else {$var_revHead = "";}
  
  $revGallery = new revGallery;
  
  //Global Gallery Variables
             
              //Set validation key
              $revGallery->MySecretKey = get_option( 'revSecretKey'.$galNum, 'R3v3n3zBR@Gbook57');
              //Set Client ID
              $revGallery->clientid = get_option( 'revClientId'.$galNum, 'demo' );
      if(isset($limit)){$revGallery->categoryImageSetLimit = $limit;}
      if(isset($details) && $details == 1){$revGallery->showCatSetDetails = $details;}
  

              //The directory the gallery resides at relative to the home. Be sure to include forward slash at beginning and end.
              //if (substr($_SERVER['HTTP_HOST'], 0, 4) == "www."){$addwww = "";} else {$addwww = "www.";}
        $pageURL = 'http';
        if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
         $pageURL .= "://";
              $revGallery->baseUrl = $pageURL.$_SERVER['HTTP_HOST']."/".get_option( 'revBaseUrl'.$galNum, 'gallery' )."/";
       
              //Determines if URL rewrites are on or not. Set true or false.
              $revGallery->urlRewrite = get_option( 'revUrlRewrite', 1 );
              //URL for 404 not found page
              $revGallery->notFoundPage = get_option( 'revNotFound', '/404' );
      $revGallery->revisionActive = get_option( 'revRevisionActive', false);
        $revGallery->menActive = get_option( 'revMenActive', false);
  
  //Get Image Sets for Category Landing Page (do not modify)
          $revGallery->getCatFeed();
          $revGallery->revDefaultSection();
          $var_revCatname = ucwords(str_replace('-', ' ', $var_revCatname));  
          $catSet = $revGallery->revSetProcedureID($var_revCatname, 1);
          if($catSet == 1){
            return '<p class="bbCarouselError"><strong>BRAG book Category Error:</strong> Gallery category is empty or does not exist</p>';
          } 
          $revGallery->getImageFeed();
          return $revGallery->revCategoryList($var_revCatname, $var_categorySetsStart, $var_revHead);
          
        
  
  

}

//get a single set
function bragbook_single_set($caseid){
  
  
  $revGallery = new revGallery;
  
  //Global Gallery Variables
             
            //Set Client ID
            $revGallery->clientid = get_option( 'revClientId'.$galNum, 'demo' );
      $revGallery->getImageFeed();
      return $revGallery->revGetFirstAngle($caseid);
          
}

//get main menu
function bragbook_home_menu_fetch($galNum=""){
  session_start();
  
  if (class_exists('revGallery')) {} else{
        include('assets/BRAGbook.php');
        }
  
        global $wp_query;
    global $revTitle;
    global $revDesc;
    global $revCustomCSS;
    global $revGalleryOutput;
  
  
  
   $queryURL = @parse_url( html_entity_decode( esc_url( add_query_arg( $arr_params ) ) ) );
        parse_str( @$queryURL['query'], $getVar );
             $curURL = urldecode(@$getVar['revCurURL']);
       $curURL = explode("/", $curURL);
  

              if(isset($_REQUEST['page_id'])){
                             $curPageid = $_REQUEST['page_id'];
              } else {
              $curPageid = "x";
              }
             
             
  
  
  
              global $wp_query;
             
              $revGallery = new revGallery;
        
         //get query variables
       
        $var_revCatname = @$getVar['revCatname'];
        $var_getCategorySets = @$getVar['getCategorySets'];
        $var_categorySetsStart = @$getVar['categorySetsStart'];
        $var_patientlogout = @$getVar['patientlogout'];
        $var_sig = @$getVar['sig'];
  
        if(isset($getVar['patientSig']) && $getVar['patientSig'] != ""){$var_patientsig = @$getVar['patientSig'];} else if(isset($_SESSION['patientsig'])){$var_patientsig = $_SESSION['patientsig'];}else{$var_patientsig = "";}
  
  if(isset($getVar['username']) && $getVar['username'] != ""){$var_username = @$getVar['username'];} else if(isset($_SESSION['username'])){$var_username = $_SESSION['username'];}else{$var_username = "";}
  
  if(isset($getVar['patientid']) && $getVar['patientid'] != ""){$var_patientid = @$getVar['patientid'];} else if(isset($_SESSION['patientid'])){$var_patientid = $_SESSION['patientid'];}else{$var_patientid = "";}
        
        
        $var_favid = @$getVar['favid'];
        $var_getFavButton = @$getVar['getFavButton'];
        $var_getLoginButton = @$getVar['getLoginButton'];
        $var_getLoginText = @$getVar['getLoginText'];
        $var_getThumbnails = @$getVar['getThumbnails'];
        $var_thumbStart = @$getVar['thumbStart'];
  
      
 
              //Global Gallery Variables
             
              //Set validation key
              $revGallery->MySecretKey = get_option( 'revSecretKey'.$galNum, 'R3v3n3zBR@Gbook57');
              //Set Client ID
              $revGallery->clientid = get_option( 'revClientId'.$galNum, 'demo' );
  
  
  
  //if(md5($var_patientid.$var_username.get_option( 'revSecretKey'.$galNum, 'R3v3n3zBR@Gbook57')) == $var_patientsig) {
    
    if(isset($var_patientsig)){$_SESSION['patientsig'] = $var_patientsig;}
    if(isset($var_patientid)){$_SESSION['patientid'] = $var_patientid;}
    if(isset($var_username)){$_SESSION['patientUser'] = $var_username;}
    //}
  

              //The directory the gallery resides at relative to the home. Be sure to include forward slash at beginning and end.
              //if (substr($_SERVER['HTTP_HOST'], 0, 4) == "www."){$addwww = "";} else {$addwww = "www.";}
        $pageURL = 'http';
        if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
         $pageURL .= "://";
              $revGallery->baseUrl = $pageURL.$_SERVER['HTTP_HOST']."/".get_option( 'revBaseUrl'.$galNum, 'gallery' )."/";
      
              //Determines if URL rewrites are on or not. Set true or false.
              $revGallery->urlRewrite = get_option( 'revUrlRewrite', 1 );
              //Default page description if custom description not used
              $revGallery->defaultDescription = get_option( 'revDefaultDescription'.$galNum, 'Plastic surgery before and after images');
              //URL for 404 not found page
              $revGallery->notFoundPage = get_option( 'revNotFound', '/404' );
              //Number of thumbnail sets to display at one time. Leave blank if you want to show all
              $revGallery->thumbLimit = get_option( 'revThumbLimit', '20' );
              //Headline for gallery landing page
              $revGallery->landingHeadline = get_option( 'revLandingHeadline', '' );
              //Intro text for gallery landing page
              $revGallery->landingIntro = wpautop(get_option( 'revLandingIntro'.$galNum, "<p>Welcome to our Before and After gallery. To improve the communication between us, we encourage you to use the MyFavorites feature to create a collection of images that reflect your surgical goals. When looking at a set of images, simply click the \"Add to Favorites\" button to begin your collection. During our consultation, we'll review this collection together so we can discuss your specific goals and concerns.</p>" ));
              //Text for title tag on landing page
              $revGallery->revLandingTitle = get_option( 'revLandingTitle'.$galNum, 'Plastic surgery before and after gallery');
              //Text for description meta tag on landing page
              $revGallery->revLandingDescription = get_option( 'revLandingDescription'.$galNum,'Plastic surgery before and after images');
             
              //turns on nudity warning on landing page for breast and body categories
              $revGallery->nudityWarning = get_option( 'revNudityWarning',true);
              //Sets variable to remove sets with revision option selected from the main categories so they can be placed in revision categories
        $revGallery->myFavsActive = get_option( 'revMyFavsActive',1);
        $revGallery->clickToZoomActive = get_option( 'revClickToZoomActive',1);
        $revGallery->thumbnailsActive = get_option( 'revThumbnailsActive',1);
              $revGallery->revisionActive = get_option( 'revRevisionActive', false);
        $revGallery->menActive = get_option( 'revMenActive', false);
        $revGallery->showCatSetDetails = get_option( 'revShowCatSetDetails', false);
            
       
              $revGallery->faceMenuLabel = get_option( 'revFaceMenuLabel'.$galNum, ''); //change the h2 text label on the landing page menu for face procedures column
              $revGallery->breastMenuLabel = get_option( 'revBreastMenuLabel'.$galNum, ''); //change the h2 text label on the landing page menu for breast procedures column
              $revGallery->bodyMenuLabel = get_option( 'revBodyMenuLabel'.$galNum, ''); //change the h2 text label on the landing page menu for body procedures column
              $revGallery->skinMenuLabel = get_option( 'revSkinMenuLabel'.$galNum, ''); //change the h2 text label on the landing page menu for non-surgical procedures column
              $revGallery->imageSetWrapOpen = get_option( 'revImageSetWrapOpen', ''); //html tags to place before the image set pages 
              $revGallery->imageSetWrapClose = get_option( 'revImageSetWrapClose', ''); //html tags to place after the image set pages  
              
        $fourColMenu = get_option( 'revFourCol', '' );
        if($fourColMenu == 1){
          
          $faceMenuImage = get_option( 'revFaceMenuImage', '');
          $breastMenuImage = get_option( 'revBreastMenuImage', '');
          $bodyMenuImage = get_option( 'revBodyMenuImage', '');
          $skinMenuImage = get_option( 'revSkinMenuImage', '');
          
          if(isset($faceMenuImage) && $faceMenuImage != ''){$faceMenuImage = '<img src="'.$faceMenuImage.'" />';}
          if(isset($breastMenuImage) && $breastMenuImage != ''){$breastMenuImage = '<img src="'.$breastMenuImage.'" />';}
          if(isset($bodyMenuImage) && $bodyMenuImage != ''){$bodyMenuImage = '<img src="'.$bodyMenuImage.'" />';}
          if(isset($skinMenuImage) && $skinMenuImage != ''){$skinMenuImage = '<img src="'.$skinMenuImage.'" />';}
          
          
              $revGallery->landingMenuWrapOpen = '<div id="bbmenu">'; //html tags to place before the landing page menu on the landing page
              $revGallery->landingMenuWrapClose = '</div>'; //html tags to place after the landing page menu on the landing page
              $revGallery->faceMenuWrapOpen = '<div id="bbface">'.$faceMenuImage; //html tags to place before the face category menu on the landing page
              $revGallery->faceMenuWrapClose = '</div>'; //html tags to place after the face category menu on the landing page
              $revGallery->breastMenuWrapOpen = '<div id="bbbreast">'.$breastMenuImage; //html tags to place before the breast category menu on the landing page
              $revGallery->breastMenuWrapClose = '</div>'; //html tags to place after the breast category menu on the landing page
              $revGallery->bodyMenuWrapOpen = '<div id="bbbody">'.$bodyMenuImage; //html tags to place before the body category menu on the landing page
              $revGallery->bodyMenuWrapClose = '</div>'; //html tags to place after the body category menu on the landing page
              $revGallery->skinMenuWrapOpen = '<div id="bbskin">'.$skinMenuImage; //html tags to place before the skin / non-surgical category menu on the landing page
              $revGallery->skinMenuWrapClose = '</div>'; //html tags to place after the skin / non-surgical category menu on the landing page
          
        } else{
        
        $revGallery->landingMenuWrapOpen = get_option( 'revLandingMenuWrapOpen', '<div id="revFullMenu">' ); //html tags to place before the landing page menu on the landing page
              $revGallery->landingMenuWrapClose = get_option( 'revLandingMenuWrapClose', '</div>'); //html tags to place after the landing page menu on the landing page
              $revGallery->faceMenuWrapOpen = get_option( 'revFaceMenuWrapOpen', ''); //html tags to place before the face category menu on the landing page
              $revGallery->faceMenuWrapClose = get_option( 'revFaceMenuWrapClose', ''); //html tags to place after the face category menu on the landing page
              $revGallery->breastMenuWrapOpen = get_option( 'revBreastMenuWrapOpen', ''); //html tags to place before the breast category menu on the landing page
              $revGallery->breastMenuWrapClose = get_option( 'revBreastMenuWrapClose', ''); //html tags to place after the breast category menu on the landing page
              $revGallery->bodyMenuWrapOpen = get_option( 'revBodyMenuWrapOpen', ''); //html tags to place before the body category menu on the landing page
              $revGallery->bodyMenuWrapClose = get_option( 'revBodyMenuWrapClose', ''); //html tags to place after the body category menu on the landing page
              $revGallery->skinMenuWrapOpen = get_option( 'revSkinMenuWrapOpen', ''); //html tags to place before the skin / non-surgical category menu on the landing page
              $revGallery->skinMenuWrapClose = get_option( 'revSkinMenuWrapClose', ''); //html tags to place after the skin / non-surgical category menu on the landing page
        
        }
        
              $revGallery->categoryLandingPageWrapOpen = get_option( 'revCategoryLandingPageWrapOpen', ''); //html tags to place after the category landing page
              $revGallery->categoryLandingPageWrapClose = get_option( 'revCategoryLandingPageWrapClose', ''); //html tags to place after the category landing page
              $revGallery->setDetails = get_option( 'revSetDetails', ''); //Choose the details field used for image sets that have information specific to this website in the bragbook dashboard. By default the basic details field will be used for all sets if this is not defined. Enter "1" if you used "details for website 1", "2" if you used "details for website 2", etc.
              $revGallery->hideJumpMenu = get_option( 'revHideJumpMenu', ''); //variable to hide jump menu
              $revGallery->hideMainMenu = get_option( 'revHideMainMenu', ''); //variable to hide main menu
             
              $revGallery->categoryLandingPageIntro = wpautop(get_option( 'revCategoryLandingPageIntro'.$galNum, '<p>Click on the before and after sets below to get more details on each case.</p>'));
//Adds text to the beginning of auto-generated category landing titles
$revGallery->revCategoryLandingTitle = get_option( 'revCategoryLandingTitle'.$galNum, '');
//Adds text after auto-generated category landing descriptions
$revGallery->revCategoryLandingDescription = get_option( 'revCategoryLandingDescription'.$galNum, '');             
                        
              
              //URL Variables (do not modify)
              $revGallery->getCatFeed();
$revGallery->revDefaultSection();
  
  //count exploded url array to find cat name and start
  $urlCount = count($curURL);
  
//$revCatname = $curURL[$urlCount - 3];
//$revID = $curURL[$urlCount - 2];
//$revGallery->revDefaultProcedureName();
//$revCatname = ucwords(str_replace('-', ' ', $revCatname));
$revGallery->revSetProcedureID("Home");
if($revCatname == "Home" && $revGallery->revisionActive == 0 && $revGallery->menActive == 0){}else{$revGallery->getImageFeed();}
if($revGallery->revisionActive ==1 || $revGallery->menActive ==1){$revGallery->revCheckRevision();}
         

$revCustomCSS = get_option( 'revCustomCSS', '');

  //Set Client ID
            return $revGallery->revLandingPage();
          
}


function enable_bragbook_sitemap(){
  //create_bragbook_sitemap();
  add_initial_bragbook_sitemap_cron();
  add_bragbook_sitemap_cron();
  
}

function disable_bragbook_sitemap(){
  delete_bragbook_sitemap();
  remove_bragbook_sitemap_wpseo();
  remove_bragbook_sitemap_cron();
}

add_action('update_option_revEnableSitemap', 'bragbook_sitemap_toggle', 10, 3);

function bragbook_sitemap_toggle() {
   if(get_option('revEnableSitemap') == 1 ){
     enable_bragbook_sitemap();
   } else{
    disable_bragbook_sitemap();
   }
  
  
}

//creates a new bragbook sitemap on server
function create_bragbook_sitemap(){
  //bragbook_plugin_init();

  $revGallery = new revGallery;

  //check to make sure a gallery has been created
  $bbGalleryList = array();
  
  if(get_option( 'revClientId', 'demo' ) != "" && get_option( 'revBaseUrl', 'demo' ) != ""){
    $bbGalleryList[] = array(get_option( 'revClientId', 'demo' ), get_option( 'revBaseUrl', 'demo' ));
  }
  for($x = 2; $x <= 6; $x++) {
    if(get_option( 'revClientId'.$x, 'demo' ) != "" && get_option( 'revBaseUrl'.$x, 'demo' ) != ""){
      $bbGalleryList[] = array(get_option( 'revClientId'.$x, 'demo' ), get_option( 'revBaseUrl'.$x, 'demo' ));
    }
  }
  
  //if gallery created start loops
  if(isset($bbGalleryList) && $bbGalleryList != ""){
    
    $revXmlSitemapOutput;
    
    $pageURL = 'http';
        if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
         $pageURL .= "://";
              $revGallery->baseUrl = $pageURL.$_SERVER['HTTP_HOST']."/".get_option( 'revBaseUrl'.$galNum, 'gallery' )."/";
    
    $pluginURL = plugins_url( 'assets/bragbook-sitemap-style.xsl', __FILE__ );
    
    
    $revXmlSitemapOutput = '<?xml version="1.0" encoding="UTF-8"?><?xml-stylesheet type="text/xsl" href="'.$pluginURL.'"?>
<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd http://www.google.com/schemas/sitemap-image/1.1 http://www.google.com/schemas/sitemap-image/1.1/sitemap-image.xsd" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
    
      //loop array of galleries - $bbCurGal[0] = $revClientId & $bbCurGal[1] = revBaseUrl
      foreach($bbGalleryList as $bbCurGal){
        
        //set base url
        
                $curBaseUrl = $pageURL.$_SERVER['HTTP_HOST']."/".$bbCurGal[1]."/";
        
        //get categories for current gallery
        $curCatList = bragbook_get_cats_sitemap($bbCurGal[0]);
        foreach($curCatList as $curCat){
          //write category URL
          $revXmlSitemapOutput .= '<url>
              <loc>'.$curBaseUrl.$curCat.'/</loc>
          </url>';
          
            //loop through current category to pull sets
            $curCatSetList = bragbook_get_cat_sets_sitemap($curCat, $bbCurGal[0]);
            foreach($curCatSetList as $curCatSet){
              $revXmlSitemapOutput .= '<url>
              <loc>'.$curBaseUrl.$curCat.'/'.$curCatSet['setid'].'/</loc>
              <lastmod>'.substr($curCatSet['datemod'], 0, 10).'</lastmod>
            </url>';
            }
          
        }
  
      }
  
  
    //end loops - close out xml
    $revXmlSitemapOutput .=  '</urlset>';

    //Save sitemap to server
    delete_bragbook_sitemap();
    $dom = new DOMDocument;
    $dom->preserveWhiteSpace = FALSE;
    $dom->loadXML($revXmlSitemapOutput);
    $dom->save($_SERVER['DOCUMENT_ROOT'].'/bragbook-sitemap.xml');
  return $revXmlSitemapOutput;  
  } //end of gallery check
  
}

//deletes existing bragbook sitemap from server
function delete_bragbook_sitemap(){
  $sitemapfile = $_SERVER['DOCUMENT_ROOT'].'/bragbook-sitemap.xml';
  if (file_exists($sitemapfile)) {
    unlink($sitemapfile);
    } else {}
}

//add sitemap to WP SEO
function add_sitemap_wpseo(){
     /* Add External Sitemap to WP SEO Sitemap Index
    * Please note that changes will be applied upon next sitemap update.
    * To manually refresh the sitemap, please disable and enable the sitemaps within Yoast WP SEO. 
    */
    add_filter( 'wpseo_sitemap_index', 'add_sitemap_custom_items' );
}

//create custom items to be inserted in WP SEO index by add_sitemap_wpseo function
if(get_option('revUseWPseo') == 1 ){add_filter( 'wpseo_sitemap_index', 'add_sitemap_custom_items' );} else{remove_filter( 'wpseo_sitemap_index', 'add_sitemap_custom_items' );}

function add_sitemap_custom_items( $sitemap_custom_items ) {
   
        
        $host = $_SERVER['HTTP_HOST'];
        $protocol=$_SERVER['PROTOCOL'] = isset($_SERVER['HTTPS']) && !empty($_SERVER['HTTPS']) ? 'https' : 'http';
        $sitemapURL = "$protocol://$host/bragbook-sitemap.xml";
  
        //get mod date
        $sitemapfile = $_SERVER['DOCUMENT_ROOT'].'/bragbook-sitemap.xml';
        if (file_exists($sitemapfile)) {
          $lastModifiedTimestamp = date( 'c', filectime($sitemapfile) );
        } else {
          //$date = new DateTime();
          //$lastModifiedTimestamp = $date->getTimestamp();
        }
        $lastModifiedTimestamp = date( 'c', filectime($sitemapfile) );
        
        
         $sitemap_custom_items .=  '
      <sitemap>
      <loc>'.$sitemapURL.'</loc>
      <lastmod>'.$lastModifiedTimestamp.'</lastmod>
      </sitemap>';

      return $sitemap_custom_items;
  }

//remove sitemap from WP SEO
function remove_bragbook_sitemap_wpseo(){
  remove_filter( 'wpseo_sitemap_index', 'add_sitemap_custom_items' );
}

//setup cron job to update sitemap
function add_bragbook_sitemap_cron(){
  
  if( !wp_next_scheduled( 'bragbook_sitemap_cron_hook' ) ) {
    wp_schedule_event( time(), 'weekly', 'bragbook_sitemap_cron_hook' );
  }
  
   
}
add_action( 'bragbook_sitemap_cron_hook', 'create_bragbook_sitemap' );

//remove cron job to update sitemap
function remove_bragbook_sitemap_cron(){
  wp_clear_scheduled_hook( 'bragbook_sitemap_cron_hook');
}   
  
//setup cron job to generate initial sitemap
function add_initial_bragbook_sitemap_cron(){
  
  if( !wp_next_scheduled( 'bragbook_initial_sitemap_cron_hook' ) ) {
    wp_schedule_single_event( time() + 60, 'bragbook_initial_sitemap_cron_hook' );
  }
  
   
}
add_action( 'bragbook_initial_sitemap_cron_hook', 'create_bragbook_sitemap' );
      
//get XML sitemap categories
function bragbook_get_cats_sitemap($curGallery){
    
  $revGallery = new revGallery;
  
    //Global Gallery Variables

    //Set Client ID
    $revGallery->clientid = $curGallery;
       
        //Determines if URL rewrites are on or not. Set true or false.
        $revGallery->urlRewrite = get_option( 'revUrlRewrite', 1 );
    $revGallery->revisionActive = get_option( 'revRevisionActive', false);
    $revGallery->menActive = get_option( 'revMenActive', false);
  
    //Get Image Sets for Category Landing Page (do not modify)
          $revGallery->getCatFeed();
          $revGallery->revDefaultSection();
          $revGallery->getImageFeed();
  if($revGallery->revisionActive ==1 || $revGallery->menActive ==1){$revGallery->revCheckRevision();}
          return $revGallery->revGetCatsSitemap();
}

//get XML sitemap category sets
function bragbook_get_cat_sets_sitemap($catID, $curGallery){
  
  
  $var_revCatname = $catID;
  
  $revGallery = new revGallery;
  
    //Global Gallery Variables

    //Set Client ID
    $revGallery->clientid = $curGallery;
       
        //Determines if URL rewrites are on or not. Set true or false.
        $revGallery->urlRewrite = get_option( 'revUrlRewrite', 1 );
    $revGallery->revisionActive = get_option( 'revRevisionActive', false);
    $revGallery->menActive = get_option( 'revMenActive', false);
  
    //Get Image Sets for Category Landing Page (do not modify)
          $revGallery->getCatFeed();
          $revGallery->revDefaultSection();
          $var_revCatname = ucwords(str_replace('-', ' ', $var_revCatname));  
          $catSet = $revGallery->revSetProcedureID($var_revCatname, 1);
          if($catSet == 1){
            return '';
          } 
          $revGallery->getImageFeed();
          return $revGallery->revCategorySetsList($var_revCatname);
}



//add actions to make ajax calls for thumbnails and my favs
add_action( 'wp_ajax_bragbook_ajax_start', 'bragbook_ajax_start' );
add_action( 'wp_ajax_nopriv_bragbook_ajax_start', 'bragbook_ajax_start' );
add_action( 'wp_ajax_bragbook_test', 'bragbook_test' );
add_action( 'wp_ajax_nopriv_bragbook_test', 'bragbook_test' );
function bragbook_test(){
  global $wpdb;
  $whatever = intval( $_POST['whatever'] );
  $whatever = "this works";
        echo $whatever;
  wp_die();
}

//add_action( 'wp_ajax_my_action', 'my_action' );
//function my_action() {
//  global $wpdb;
//  $whatever = intval( $_POST['whatever'] );
//  $whatever += 10;
//        echo $whatever;
//  wp_die();
//}

//check to make sure this is the gallery page
add_action('init', 'plugin_is_page');
function plugin_is_page() {
              $curURL = explode("/", $_SERVER['REQUEST_URI']);
              if(isset($_REQUEST['page_id']) && $_REQUEST['page_id'] != ""){
                             $curPageid = $_REQUEST['page_id'];
              } else {
              $curPageid = "x";
              }
             
              if(isset($curURL[1])  && $curURL[1] != ""){$curURL1 = $curURL[1];} else {$curURL1 = "revnone";}
              if(isset($curURL[2])  && $curURL[2] != ""){$curURL2 = $curURL[2];} else {$curURL2 = "revnone";}
    if ($curURL1 == get_option( 'revBaseUrl', 'gallery' ) || $curURL2 == get_option( 'revBaseUrl', 'gallery' ) || $curPageid == get_option( 'revPageId')|| $curURL1 == get_option( 'revBaseUrl2', 'gallery' ) || $curURL2 == get_option( 'revBaseUrl2', 'gallery' ) || $curPageid == get_option( 'revPageId2') ||  $curURL1 == get_option( 'revBaseUrl3', 'gallery' ) || $curURL2 == get_option( 'revBaseUrl3', 'gallery' ) || $curPageid == get_option( 'revPageId3') || $curURL1 == get_option( 'revBaseUrl4', 'gallery' ) || $curURL2 == get_option( 'revBaseUrl4', 'gallery' ) || $curPageid == get_option( 'revPageId4') || $curURL1 == get_option( 'revBaseUrl5', 'gallery' ) || $curURL2 == get_option( 'revBaseUrl5', 'gallery' ) || $curPageid == get_option( 'revPageId5') || $curURL1 == get_option( 'revBaseUrl6', 'gallery' ) || $curURL2 == get_option( 'revBaseUrl6', 'gallery' ) || $curPageid == get_option( 'revPageId6')) {
             add_action('wp', 'bragbook_start');
        add_action('wp_loaded', 'bragbook_SEO');
    
    
    } 
             
}
 

 
function bragbook_SEO(){
              //Customize SEO settings for Wordpress
if(get_option( 'revUseWPseo') == 1 || get_option( 'thermiUseWPseo') == 1){
              add_filter( 'wpseo_canonical', 'getCurrentURL' );
              add_filter( 'wpseo_title', 'GetCustomBragbookTitle');
              add_filter( 'wpseo_metadesc', 'GetCustomBragbookDescription');
        add_action( 'wp_head', 'printCustomCSS' );
  
} else if(get_option( 'revUseWPseo') == 2 || get_option( 'thermiUseWPseo') == 2){
              add_filter( 'aioseo_canonical_url', 'getCurrentURL' );
              add_filter( 'aioseo_title', 'GetCustomBragbookTitle');
              add_filter( 'aioseo_description', 'GetCustomBragbookDescription');
        add_action( 'wp_head', 'printCustomCSS' );
  
} else if(get_option( 'revUseWPseo') == 3 || get_option( 'thermiUseWPseo') == 3){
              add_filter( 'rank_math/frontend/canonical', 'getCurrentURL' );
              add_filter( 'rank_math/frontend/title', 'GetCustomBragbookTitle');
              add_filter( 'rank_math/frontend/description', 'GetCustomBragbookDescription');
        add_action( 'wp_head', 'printCustomCSS' );
  
} else {
              add_filter( 'wp_title', 'GetCustomBragbookTitle' );         
              add_action( 'wp_head', 'printCustomBragbookDescription' );
              remove_action ('wp_head', 'rel_canonical');
              remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
              add_action( 'wp_head', 'printCanonical' );
        add_action( 'wp_head', 'printCustomCSS' );
}
 
 
function printCustomCSS(){
              echo '<style id="bragbookCustomCSS">';  
        echo '#revGalleryNav li a, #revThumbGalleryNav li a{';
        if(get_option( 'revGalNavStyleBorderColor', '') != ''){echo 'border-color: '.get_option( 'revGalNavStyleBorderColor', '').' !important;';}
        if(get_option( 'revGalNavStyleColor', '') != ''){echo 'color: '.get_option( 'revGalNavStyleColor', '').' !important;';}
        if(get_option( 'revGalNavStyleBackground', '') != ''){echo 'background: '.get_option( 'revGalNavStyleBackground', '').' !important;';}
        echo '}';
        echo '#revGalleryNav li a.baNavHighlight, #revThumbGalleryNav li a.baNavHighlight{';
        if(get_option( 'revGalNavHighlightBorderColor', '') != ''){echo 'border-color: '.get_option( 'revGalNavHighlightBorderColor', '').' !important;';}
        if(get_option( 'revGalNavHighlightColor', '') != ''){echo 'color: '.get_option( 'revGalNavHighlightColor', '').' !important;';}
        if(get_option( 'revGalNavHighlightBackground', '') != ''){echo 'background: '.get_option( 'revGalNavHighlightBackground', '').' !important;';}
        echo '}';
        echo '#revGalleryNav li a:hover, #revThumbGalleryNav li a:hover{';
        if(get_option( 'revGalNavStyleHoverBorderColor', '') != ''){echo 'border-color: '.get_option( 'revGalNavStyleHoverBorderColor', '').' !important;';}
        if(get_option( 'revGalNavStyleHoverColor', '') != ''){echo 'color: '.get_option( 'revGalNavStyleHoverColor', '').' !important;';}
        if(get_option( 'revGalNavStyleHoverBackground', '') != ''){echo 'background: '.get_option( 'revGalNavStyleHoverBackground', '').' !important;';}
        echo '}';
          echo '.revThumbLaunch{';
        if(get_option( 'revThumbButStyleBorderColor', '') != ''){echo 'border-color: '.get_option( 'revThumbButStyleBorderColor', '').' !important;';}
        if(get_option( 'revThumbButStyleColor', '') != ''){echo 'color: '.get_option( 'revThumbButStyleColor', '').' !important;';}
        if(get_option( 'revThumbButStyleBackground', '') != ''){echo 'background: '.get_option( 'revThumbButStyleBackground', '').' !important;';}
        echo '}';
        echo '.revThumbLaunch:hover{';
        if(get_option( 'revThumbButStyleHoverBorderColor', '') != ''){echo 'border-color: '.get_option( 'revThumbButStyleHoverBorderColor', '').' !important;';}
        if(get_option( 'revThumbButStyleHoverColor', '') != ''){echo 'color: '.get_option( 'revThumbButStyleHoverColor', '').' !important;';}
        if(get_option( 'revThumbButStyleHoverBackground', '') != ''){echo 'background: '.get_option( 'revThumbButStyleHoverBackground', '').' !important;';}
        echo '}';
         echo '.revFavLaunch{';
        if(get_option( 'revFavButStyleBorderColor', '') != ''){echo 'border-color: '.get_option( 'revFavButStyleBorderColor', '').' !important;';}
        if(get_option( 'revFavButStyleColor', '') != ''){echo 'color: '.get_option( 'revFavButStyleColor', '').' !important;';}
        if(get_option( 'revFavButStyleBackground', '') != ''){echo 'background: '.get_option( 'revFavButStyleBackground', '').' !important;';}
        echo '}';
        echo '.revFavLaunch:hover{';
        if(get_option( 'revFavButStyleHoverBorderColor', '') != ''){echo 'border-color: '.get_option( 'revFavButStyleHoverBorderColor', '').' !important;';}
        if(get_option( 'revFavButStyleHoverColor', '') != ''){echo 'color: '.get_option( 'revFavButStyleHoverColor', '').' !important;';}
        if(get_option( 'revFavButStyleHoverBackground', '') != ''){echo 'background: '.get_option( 'revFavButStyleHoverBackground', '').' !important;';}
        echo '}';
        
        echo getCustomCSS() ;
        echo '</style>';
}
 
function getCurrentURL(){
  $current_link = 'http';
 if ($_SERVER["HTTPS"] == "on") {$current_link .= "s";}
 $current_link .= "://";
              $current_link .= "$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
              return $current_link;    
}
 
function printCanonical(){
              echo '<link rel="canonical" href="'.getCurrentURL().'">';
}
 
function GetCustomBragbookTitle() {
             global $revTitle;
              return $revTitle;
}

function getCustomCSS() {
             global $revCustomCSS;
              return $revCustomCSS;
}

 
function GetCustomBragbookDescription() {
              global $revDesc;
              return $revDesc;
             
}
 
function printCustomBragbookDescription(){
              echo '<meta name="description" content="'.GetCustomBragbookDescription().'">';
}            
}
 
function bragbook_process_shortcode($atts){
  bragbook_plugin_scripts();
  $a = shortcode_atts( array(
        'lang' => 'en',
        'gallery' => '',
    'facemenu' => '',
    'breastmenu' => '',
    'bodymenu' => '',
    'skinmenu' => '',
    ), $atts );
  
  global $revGalleryOutput;
  
  return $revGalleryOutput;
  
}

function bragbook_carousel_shortcode($atts){
  bragbook_plugin_scripts();
  $a = shortcode_atts( array(
        'category' => '',
        'limit' => '10',
    'start' => '0',
    'title' => '1',
    'details' => '0',
    ), $atts, 'bragbook_carousel' );
  

  
  
  $slideList = bragbook_slider_list($atts['category'], $atts['limit'], $atts['start'], $atts['title'], $atts['details']);
  
  
  return $slideList;
  
}

function bragbook_category_shortcode($atts){
  bragbook_plugin_scripts();
  $a = shortcode_atts( array(
        'category' => '',
        'limit' => '10',
    'start' => '0',
    'title' => '0',
    'details' => '0',
    ), $atts, 'bragbook_category' );
  
  $catList = bragbook_category_list($atts['category'], $atts['limit'],$atts['start'],$atts['title'],$atts['details']);
  
  return $catList;
  
}

function bragbook_set_shortcode($atts){
  bragbook_plugin_scripts();
  $a = shortcode_atts( array(
        'caseid' => '',
    ), $atts, 'bragbook_set' );
  
  //global $revGalleryOutput;
  
  $selectedSet = bragbook_single_set($atts['caseid']);
  
  return $selectedSet;
}

function bragbook_home_menu_shortcode($atts){
  bragbook_plugin_scripts();
  $a = shortcode_atts( array(
        'galnum' => '',
    ), $atts, 'bragbook_home_menu' );
  
  //global $revGalleryOutput;
  
  $selectedMenu = bragbook_home_menu_fetch($atts['galnum']);
  return $selectedMenu;
  
}
 
add_shortcode('bragbook_shortcode', 'bragbook_process_shortcode'); 
add_shortcode('bragbook_carousel', 'bragbook_carousel_shortcode');
add_shortcode('bragbook_category', 'bragbook_category_shortcode');
add_shortcode('bragbook_set', 'bragbook_set_shortcode');
add_shortcode('sitemap_test', 'create_bragbook_sitemap');
add_shortcode('bragbook_home_menu', 'bragbook_home_menu_shortcode');

if( ! class_exists( 'Bragbook_Updater' ) ){
  include_once( plugin_dir_path( __FILE__ ) . 'updater.php' );
}

$updater = new Bragbook_Updater( __FILE__ );
$updater->set_username( 'bragbook' );
$updater->set_repository( 'BRAGbook' );
/*
  $updater->authorize( 'abcdefghijk1234567890' ); // Your auth code goes here for private repos
*/
$updater->initialize();
?>
