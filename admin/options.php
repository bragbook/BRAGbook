<?php // jQuery
wp_enqueue_script( 'jquery' );
// This will enqueue the Media Uploader script
wp_enqueue_media();
?>
<script type="text/javascript">
jQuery(document).ready(function($){
	
	
	$( '.postbox h2' ).on( 'click', function( e ) {
		$( this ).closest( '.postbox' ).toggleClass( 'closed' );
		e.preventDefault();
	} );
	
    $('#upload-btn1').click(function(e) {
        e.preventDefault();
        var image = wp.media({ 
            title: 'Upload Image',
            // mutiple: true if you want to upload multiple files at once
            multiple: false
        }).open()
        .on('select', function(e){
            // This will return the selected image from the Media Uploader, the result is an object
            var uploaded_image = image.state().get('selection').first();
            // We convert uploaded_image to a JSON object to make accessing it easier
            // Output to the console uploaded_image
            console.log(uploaded_image);
            var image_url = uploaded_image.toJSON().url;
            // Let's assign the url value to the input field
            $('#revFaceMenuImage').val(image_url);
        });
    });
	
	$('#upload-btn2').click(function(e) {
        e.preventDefault();
        var image = wp.media({ 
            title: 'Upload Image',
            // mutiple: true if you want to upload multiple files at once
            multiple: false
        }).open()
        .on('select', function(e){
            // This will return the selected image from the Media Uploader, the result is an object
            var uploaded_image = image.state().get('selection').first();
            // We convert uploaded_image to a JSON object to make accessing it easier
            // Output to the console uploaded_image
            console.log(uploaded_image);
            var image_url = uploaded_image.toJSON().url;
            // Let's assign the url value to the input field
            $('#revBreastMenuImage').val(image_url);
        });
    });
	
	$('#upload-btn3').click(function(e) {
        e.preventDefault();
        var image = wp.media({ 
            title: 'Upload Image',
            // mutiple: true if you want to upload multiple files at once
            multiple: false
        }).open()
        .on('select', function(e){
            // This will return the selected image from the Media Uploader, the result is an object
            var uploaded_image = image.state().get('selection').first();
            // We convert uploaded_image to a JSON object to make accessing it easier
            // Output to the console uploaded_image
            console.log(uploaded_image);
            var image_url = uploaded_image.toJSON().url;
            // Let's assign the url value to the input field
            $('#revBodyMenuImage').val(image_url);
        });
    });
	
	$('#upload-btn4').click(function(e) {
        e.preventDefault();
        var image = wp.media({ 
            title: 'Upload Image',
            // mutiple: true if you want to upload multiple files at once
            multiple: false
        }).open()
        .on('select', function(e){
            // This will return the selected image from the Media Uploader, the result is an object
            var uploaded_image = image.state().get('selection').first();
            // We convert uploaded_image to a JSON object to make accessing it easier
            // Output to the console uploaded_image
            console.log(uploaded_image);
            var image_url = uploaded_image.toJSON().url;
            // Let's assign the url value to the input field
            $('#revSkinMenuImage').val(image_url);
        });
    });

	// Add Color Picker to all inputs that have 'color-field' class
	$('.revColor-picker').wpColorPicker();

});
</script>
<style>
	.postbox-header .sortable-handle{
	cursor: pointer;
		flex-grow: 1;
		display: flex;
		justify-content:space-between;
		align-items: center;
	}
</style>
<div class="wrap">
  <h2>BRAGbook Before &amp; After Gallery</h2>
  <p>To install the BRAGbook create a page that you would like to use as the base URL and place the following shortcode on it: <span style="color:red">[bragbook_shortcode]</span> </p>
  <p>Configure the options below to meet the needs of your gallery installation. <a href="https://www.bragbook.gallery/web-assets/downloads/BRAGbook-Wordpress-Plugin-Guide-v1.3.8.pdf">Click here for the full install manual.</a></p>
  <form method="post" action="options.php">
    <?php settings_fields( 'bragbook-settings-group' ); ?>
    <?php do_settings_sections( 'bragbook-settings-group' ); ?>
    <?php
    //add_action('updated_option', function( $option_name, $old_value, $value ) {
    //if( get_option('revEnableSitemap') == 1){
    //	enable_bragbook_sitemap();
    //} else{
    //	disable_bragbook_sitemap();
    //}

    //}, 10, 3); ?>
    <div id="poststuff">
      <div id="postbox-container" class="postbox-container">
        <div class="meta-box-sortables ui-sortable" id="normal-sortables">
          <div class="postbox " id="basicOptions">
			  
            <div class="postbox-header">
              <h2 class="sortable-handle"><span>BRAGbook Basic Options <small>(required)</small></span></h2>
              <div class="handle-actions hide-if-no-js">
                <button type="button" class="handlediv" aria-expanded="true"><span class="screen-reader-text">Toggle panel: Excerpt</span><span class="toggle-indicator" aria-hidden="true"></span></button>
              </div>
            </div>
			  
            <div class="inside">
              <p>The API key and client ID can be found in the BRAGbook dashboard under "developer tools." Gallery page name and ID should match the page that you placed the shortcode on. </p>
              <table class="form-table">
                <tr valign="top">
                  <th scope="row">API Key</th>
                  <td><input type="text" name="revSecretKey" value="<?php echo get_option('revSecretKey'); ?>"  style="width:100%;" /></td>
                </tr>
                <tr valign="top">
                  <th scope="row">Client ID</th>
                  <td><input type="text" name="revClientId" value="<?php echo get_option('revClientId'); ?>"  style="width:100%;" /></td>
                </tr>
                <tr valign="top">
                  <th scope="row">Gallery Page Name</th>
                  <td><input type="text" name="revBaseUrl" value="<?php echo get_option('revBaseUrl'); ?>"  style="width:100%;" /></td>
                </tr>
                <tr valign="top">
                  <th scope="row">Gallery Page ID Number</th>
                  <td><input type="text" name="revPageId" value="<?php echo get_option('revPageId'); ?>"  style="width:100%;" /></td>
                </tr>
                <tr valign="top">
                  <th scope="row">Pretty URLs</th>
                  <td><input name="revUrlRewrite" type="checkbox" id="revUrlRewrite" value="1" <?php if( get_option('revUrlRewrite') == 1){echo 'checked="checked"';} ?> /></td>
                </tr>
                <tr valign="top">
                  <th scope="row">Nudity Warning</th>
                  <td><input name="revNudityWarning" type="checkbox" id="revNudityWarning" value="1" <?php if( get_option('revNudityWarning') == 1){echo 'checked="checked"';} ?> /></td>
                </tr>
                <tr valign="top">
                  <th scope="row">"Revision" Categories</th>
                  <td><input name="revRevisionActive" type="checkbox" id="revRevisionActive" value="1" <?php if( get_option('revRevisionActive') == 1){echo 'checked="checked"';} ?> /></td>
                </tr>
                <tr valign="top">
                  <th scope="row">"For Men" Categories</th>
                  <td><input name="revMenActive" type="checkbox" id="revMenActive" value="1" <?php if( get_option('revMenActive') == 1){echo 'checked="checked"';} ?> /></td>
                </tr>
                <tr valign="top">
                  <th scope="row">My Favorites active?</th>
                  <td><input name="revMyFavsActive" type="checkbox" id="revMyFavsActive" value="1" <?php if( get_option('revMyFavsActive') == 1){echo 'checked="checked"';} ?> /></td>
                </tr>
                <tr valign="top">
                  <th scope="row">Click to Zoom active?</th>
                  <td><input name="revClickToZoomActive" type="checkbox" id="revClickToZoomActive" value="1" <?php if( get_option('revClickToZoomActive') == 1){echo 'checked="checked"';} ?> /></td>
                </tr>
                <tr valign="top">
                  <th scope="row">Thumbnails active?</th>
                  <td><input name="revThumbnailsActive" type="checkbox" id="revThumbnailsActive" value="1" <?php if( get_option('revThumbnailsActive') == 1){echo 'checked="checked"';} ?> /></td>
                </tr>
                <tr valign="top">
                  <th scope="row">Show details preview on Category Page?</th>
                  <td><input name="revShowCatSetDetails" type="checkbox" id="revShowCatSetDetails" value="1" <?php if( get_option('revShowCatSetDetails') == 1){echo 'checked="checked"';} ?> /></td>
                </tr>
                <tr valign="top">
                  <th scope="row">Details Selection </th>
                  <td><select name="revSetDetails" id="revSetDetails">
                      <option value="" <?php if(get_option('revSetDetails') == ""){ echo 'selected="selected"'; } ?>>Default / Website 1</option>
                      <option value="1" <?php if(get_option('revSetDetails') == "1"){ echo 'selected="selected"'; } ?>>Website 2</option>
                      <option value="2" <?php if(get_option('revSetDetails') == "2"){ echo 'selected="selected"'; } ?>>Website 3</option>
                      <option value="3" <?php if(get_option('revSetDetails') == "3"){ echo 'selected="selected"'; } ?>>Website 4</option>
                      <option value="4" <?php if(get_option('revSetDetails') == "4"){ echo 'selected="selected"'; } ?>>Website 5</option>
                    </select></td>
                </tr>
                <tr valign="top">
                  <th scope="row">Thumbnail Limit </th>
                  <td><select name="revThumbLimit" id="revThumbLimit">
                      <option value="0" <?php if(get_option('revThumbLimit') == "" || get_option('revThumbLimit') == "0"){ echo 'selected="selected"'; } ?>>Unlimited</option>
                      <option value="10" <?php if(get_option('revThumbLimit') == "10"){ echo 'selected="selected"'; } ?>>10</option>
                      <option value="20" <?php if(get_option('revThumbLimit') == "20"){ echo 'selected="selected"'; } ?>>20</option>
                      <option value="30" <?php if(get_option('revThumbLimit') == "30"){ echo 'selected="selected"'; } ?>>30</option>
                      <option value="40" <?php if(get_option('revThumbLimit') == "40"){ echo 'selected="selected"'; } ?>>40</option>
                      <option value="50" <?php if(get_option('revThumbLimit') == "50"){ echo 'selected="selected"'; } ?>>50</option>
                      <option value="60" <?php if(get_option('revThumbLimit') == "60"){ echo 'selected="selected"'; } ?>>60</option>
                      <option value="70" <?php if(get_option('revThumbLimit') == "70"){ echo 'selected="selected"'; } ?>>70</option>
                      <option value="80" <?php if(get_option('revThumbLimit') == "80"){ echo 'selected="selected"'; } ?>>80</option>
                      <option value="90" <?php if(get_option('revThumbLimit') == "90"){ echo 'selected="selected"'; } ?>>90</option>
                      <option value="100" <?php if(get_option('revThumbLimit') == "100"){ echo 'selected="selected"'; } ?>>100</option>
                    </select></td>
                </tr>
				<tr valign="top">
                  <th scope="row">Not Found Page</th>
                  <td><input type="text" name="revNotFound" value="<?php echo get_option('revNotFound'); ?>"  style="width:100%;" /></td>
                </tr>
              </table>
            </div>
          </div>
          <div class="postbox closed" id="secondaryinstalls">
            <div class="postbox-header">
              <h2 class="sortable-handle"><span>BRAGbook Secondary Installs<small> (optional)</small></span></h2>
              <div class="handle-actions hide-if-no-js">
                <button type="button" class="handlediv" aria-expanded="true"><span class="screen-reader-text">Toggle panel: Excerpt</span><span class="toggle-indicator" aria-hidden="true"></span></button>
              </div>
            </div>
            <div class="inside">
              <p>This section allows for the creation of multiple galleries within your site if you have been setup with multiple doctor accounts.</p>
              <hr />
              <h3>Gallery 2</h3>
              <hr />
              <table class="form-table">
                <tr valign="top">
                  <th scope="row">API Key</th>
                  <td><input type="text" name="revSecretKey2" value="<?php echo get_option('revSecretKey2'); ?>"  style="width:100%;" /></td>
                </tr>
                <tr valign="top">
                  <th scope="row">Client ID</th>
                  <td><input type="text" name="revClientId2" value="<?php echo get_option('revClientId2'); ?>"  style="width:100%;" /></td>
                </tr>
                <tr valign="top">
                  <th scope="row">Gallery Page Name</th>
                  <td><input type="text" name="revBaseUrl2" value="<?php echo get_option('revBaseUrl2'); ?>"  style="width:100%;" /></td>
                </tr>
                <tr valign="top">
                  <th scope="row">Gallery Page ID Number</th>
                  <td><input type="text" name="revPageId2" value="<?php echo get_option('revPageId2'); ?>"  style="width:100%;" /></td>
                </tr>
              </table>
              <hr />
              <h3>Gallery 3</h3>
              <hr />
              <table class="form-table">
                <tr valign="top">
                  <th scope="row">API Key</th>
                  <td><input type="text" name="revSecretKey3" value="<?php echo get_option('revSecretKey3');  ?>"  style="width:100%;" /></td>
                </tr>
                <tr valign="top">
                  <th scope="row">Client ID</th>
                  <td><input type="text" name="revClientId3" value="<?php echo get_option('revClientId3'); ?>"  style="width:100%;" /></td>
                </tr>
                <tr valign="top">
                  <th scope="row">Gallery Page Name</th>
                  <td><input type="text" name="revBaseUrl3" value="<?php echo get_option('revBaseUrl3'); ?>"  style="width:100%;" /></td>
                </tr>
                <tr valign="top">
                  <th scope="row">Gallery Page ID Number</th>
                  <td><input type="text" name="revPageId3" value="<?php echo get_option('revPageId3'); ?>"  style="width:100%;" /></td>
                </tr>
              </table>
              <hr />
              <h3>Gallery 4</h3>
              <hr />
              <table class="form-table">
                <tr valign="top">
                  <th scope="row">API Key</th>
                  <td><input type="text" name="revSecretKey4" value="<?php echo get_option('revSecretKey4'); ?>"  style="width:100%;" /></td>
                </tr>
                <tr valign="top">
                  <th scope="row">Client ID</th>
                  <td><input type="text" name="revClientId4" value="<?php echo get_option('revClientId4'); ?>"  style="width:100%;" /></td>
                </tr>
                <tr valign="top">
                  <th scope="row">Gallery Page Name</th>
                  <td><input type="text" name="revBaseUrl4" value="<?php echo get_option('revBaseUrl4'); ?>"  style="width:100%;" /></td>
                </tr>
                <tr valign="top">
                  <th scope="row">Gallery Page ID Number</th>
                  <td><input type="text" name="revPageId4" value="<?php echo get_option('revPageId4'); ?>"  style="width:100%;" /></td>
                </tr>
              </table>
              <hr />
              <h3>Gallery 5</h3>
              <hr />
              <table class="form-table">
                <tr valign="top">
                  <th scope="row">API Key</th>
                  <td><input type="text" name="revSecretKey5" value="<?php echo get_option('revSecretKey5'); ?>"  style="width:100%;" /></td>
                </tr>
                <tr valign="top">
                  <th scope="row">Client ID</th>
                  <td><input type="text" name="revClientId5" value="<?php echo get_option('revClientId5'); ?>" style="width:100%;" /></td>
                </tr>
                <tr valign="top">
                  <th scope="row">Gallery Page Name</th>
                  <td><input type="text" name="revBaseUrl5" value="<?php echo get_option('revBaseUrl5'); ?>"  style="width:100%;" /></td>
                </tr>
                <tr valign="top">
                  <th scope="row">Gallery Page ID Number</th>
                  <td><input type="text" name="revPageId5" value="<?php echo get_option('revPageId5'); ?>"  style="width:100%;" /></td>
                </tr>
              </table>
            </div>
          </div>
          <div class="postbox closed" id="test2">
            <div class="postbox-header">
              <h2 class="sortable-handle"><span>Landing Pages Content <small>(optional)</small></span></h2>
              <div class="handle-actions hide-if-no-js">
                <button type="button" class="handlediv" aria-expanded="true"><span class="screen-reader-text">Toggle panel: Excerpt</span><span class="toggle-indicator" aria-hidden="true"></span></button>
              </div>
            </div>
            <div class="inside">
              <p>This content will appear at the top of the specified pages.</p>
              <table class="form-table">
                <tr valign="top">
                  <th scope="row">Gallery Home Page Intro Text</th>
                  <td><?php wp_editor( get_option('revLandingIntro'), 'revLandingIntro' ); ?></td>
                </tr>
                <tr valign="top">
                  <th scope="row">Category Landing Page Intro Text</th>
                  <?php if(get_option('revCategoryLandingPageIntro')){$catLandingPageIntro = get_option('revCategoryLandingPageIntro');} else{$catLandingPageIntro = '<p>Click on the before and after sets below to get more details on each case.</p>';} ?>
                  <td><?php wp_editor($catLandingPageIntro , 'revCategoryLandingPageIntro' ); ?></td>
                </tr>
              </table>
              <p>This will change the default titles for each  of the four categorized procedure columns in the landing page menu.</p>
              <table class="form-table">
                <tr valign="top">
                  <th scope="row">Face Menu Label</th>
                  <td><input type="text" name="revFaceMenuLabel" value="<?php echo get_option('revFaceMenuLabel'); ?>"  style="width:100%;" /></td>
                </tr>
                <tr valign="top">
                  <th scope="row">Breast Menu Label</th>
                  <td><input type="text" name="revBreastMenuLabel" value="<?php echo get_option('revBreastMenuLabel'); ?>"  style="width:100%;" /></td>
                </tr>
                <tr valign="top">
                  <th scope="row">Body Menu Label</th>
                  <td><input type="text" name="revBodyMenuLabel" value="<?php echo get_option('revBodyMenuLabel'); ?>"  style="width:100%;" /></td>
                </tr>
                <tr valign="top">
                  <th scope="row">Non-Surgical Menu Label</th>
                  <td><input type="text" name="revSkinMenuLabel" value="<?php echo get_option('revSkinMenuLabel'); ?>"  style="width:100%;" /></td>
                </tr>
              </table>
              <p>The following options will put the gallery landing page menu in a side-by-side four column configuration.</p>
              <table class="form-table">
                <tr valign="top">
                  <th scope="row">Enable Four Column Display?</th>
                  <td><input name="revFourCol" type="checkbox" id="revFourCol" value="1" <?php if( get_option('revFourCol') == 1){echo 'checked="checked"';} ?> /></td>
                </tr>
                <tr valign="top">
                  <th scope="row">Face Menu Image</th>
                  <td><input type="text" name="revFaceMenuImage" id="revFaceMenuImage" class="regular-text"  value="<?php echo get_option('revFaceMenuImage'); ?>">
                    <input type="button" name="upload-btn" id="upload-btn1" class="button-secondary upload-btn" value="Select Image"></td>
                </tr>
                <tr valign="top">
                  <th scope="row">Breast Menu Image</th>
                  <td><input type="text" name="revBreastMenuImage" id="revBreastMenuImage" class="regular-text"  value="<?php echo get_option('revBreastMenuImage'); ?>">
                    <input type="button" name="upload-btn" id="upload-btn2" class="button-secondary upload-btn" value="Select Image"></td>
                </tr>
                <tr valign="top">
                  <th scope="row">Body Menu Image</th>
                  <td><input type="text" name="revBodyMenuImage" id="revBodyMenuImage" class="regular-text"  value="<?php echo get_option('revBodyMenuImage'); ?>">
                    <input type="button" name="upload-btn" id="upload-btn3" class="button-secondary upload-btn" value="Select Image"></td>
                </tr>
                <tr valign="top">
                  <th scope="row">Non-Surgical Menu Image</th>
                  <td><input type="text" name="revSkinMenuImage" id="revSkinMenuImage" class="regular-text"  value="<?php echo get_option('revSkinMenuImage'); ?>">
                    <input type="button" name="upload-btn" id="upload-btn4" class="button-secondary upload-btn" value="Select Image"></td>
                </tr>
              </table>
              <p>&nbsp;</p>
            </div>
          </div>
          <div class="postbox closed" id="test2">
             <div class="postbox-header">
              <h2 class="sortable-handle"><span>Secondary Landing Pages Content<small> (optional)</small></span></h2>
              <div class="handle-actions hide-if-no-js">
                <button type="button" class="handlediv" aria-expanded="true"><span class="screen-reader-text">Toggle panel: Excerpt</span><span class="toggle-indicator" aria-hidden="true"></span></button>
              </div>
            </div>
			  
            <div class="inside">
              <p>This content will appear at the top of the specified pages.</p>
              <hr />
              <h3>Gallery 2</h3>
              <hr />
              <table class="form-table">
                <tr valign="top">
                  <th scope="row">Gallery Home Page Intro Text</th>
                  <td><?php wp_editor( get_option('revLandingIntro2'), 'revLandingIntro2' ); ?></td>
                </tr>
                <tr valign="top">
                  <th scope="row">Category Landing Page Intro Text</th>
                  <?php if(get_option('revCategoryLandingPageIntro2')){$catLandingPageIntro2 = get_option('revCategoryLandingPageIntro2');} else{$catLandingPageIntro2 = '<p>Click on the before and after sets below to get more details on each case.</p>';} ?>
                  <td><?php wp_editor($catLandingPageIntro2 , 'revCategoryLandingPageIntro2' ); ?></td>
                </tr>
              </table>
              <table class="form-table">
                <tr valign="top">
                  <th scope="row">Face Menu Label</th>
                  <td><input type="text" name="revFaceMenuLabel2" value="<?php echo get_option('revFaceMenuLabel2'); ?>"  style="width:100%;" /></td>
                </tr>
                <tr valign="top">
                  <th scope="row">Breast Menu Label</th>
                  <td><input type="text" name="revBreastMenuLabel2" value="<?php echo get_option('revBreastMenuLabel2'); ?>"  style="width:100%;" /></td>
                </tr>
                <tr valign="top">
                  <th scope="row">Body Menu Label</th>
                  <td><input type="text" name="revBodyMenuLabel2" value="<?php echo get_option('revBodyMenuLabel2'); ?>"  style="width:100%;" /></td>
                </tr>
                <tr valign="top">
                  <th scope="row">Non-Surgical Menu Label</th>
                  <td><input type="text" name="revSkinMenuLabel2" value="<?php echo get_option('revSkinMenuLabel2'); ?>"  style="width:100%;" /></td>
                </tr>
              </table>
              <hr />
              <h3>Gallery 3</h3>
              <hr />
              <table class="form-table">
                <tr valign="top">
                  <th scope="row">Gallery Home Page Intro Text</th>
                  <td><?php wp_editor( get_option('revLandingIntro3'), 'revLandingIntro3' ); ?></td>
                </tr>
                <tr valign="top">
                  <th scope="row">Category Landing Page Intro Text</th>
                  <?php if(get_option('revCategoryLandingPageIntro3')){$catLandingPageIntro3 = get_option('revCategoryLandingPageIntro3');} else{$catLandingPageIntro3 = '<p>Click on the before and after sets below to get more details on each case.</p>';} ?>
                  <td><?php wp_editor($catLandingPageIntro3 , 'revCategoryLandingPageIntro3' ); ?></td>
                </tr>
              </table>
              <table class="form-table">
                <tr valign="top">
                  <th scope="row">Face Menu Label</th>
                  <td><input type="text" name="revFaceMenuLabel3" value="<?php echo get_option('revFaceMenuLabel3'); ?>"  style="width:100%;" /></td>
                </tr>
                <tr valign="top">
                  <th scope="row">Breast Menu Label</th>
                  <td><input type="text" name="revBreastMenuLabel3" value="<?php echo get_option('revBreastMenuLabel3'); ?>"  style="width:100%;" /></td>
                </tr>
                <tr valign="top">
                  <th scope="row">Body Menu Label</th>
                  <td><input type="text" name="revBodyMenuLabel3" value="<?php echo get_option('revBodyMenuLabel3'); ?>"  style="width:100%;" /></td>
                </tr>
                <tr valign="top">
                  <th scope="row">Non-Surgical Menu Label</th>
                  <td><input type="text" name="revSkinMenuLabel3" value="<?php echo get_option('revSkinMenuLabel3'); ?>"  style="width:100%;" /></td>
                </tr>
              </table>
              <hr />
              <h3>Gallery 4</h3>
              <hr />
              <table class="form-table">
                <tr valign="top">
                  <th scope="row">Gallery Home Page Intro Text</th>
                  <td><?php wp_editor( get_option('revLandingIntro4'), 'revLandingIntro4' ); ?></td>
                </tr>
                <tr valign="top">
                  <th scope="row">Category Landing Page Intro Text</th>
                  <?php if(get_option('revCategoryLandingPageIntro4')){$catLandingPageIntro4 = get_option('revCategoryLandingPageIntro4');} else{$catLandingPageIntro4 = '<p>Click on the before and after sets below to get more details on each case.</p>';} ?>
                  <td><?php wp_editor($catLandingPageIntro4 , 'revCategoryLandingPageIntro4' ); ?></td>
                </tr>
              </table>
              <table class="form-table">
                <tr valign="top">
                  <th scope="row">Face Menu Label</th>
                  <td><input type="text" name="revFaceMenuLabel4" value="<?php echo get_option('revFaceMenuLabel4'); ?>"  style="width:100%;" /></td>
                </tr>
                <tr valign="top">
                  <th scope="row">Breast Menu Label</th>
                  <td><input type="text" name="revBreastMenuLabel4" value="<?php echo get_option('revBreastMenuLabel4'); ?>"  style="width:100%;" /></td>
                </tr>
                <tr valign="top">
                  <th scope="row">Body Menu Label</th>
                  <td><input type="text" name="revBodyMenuLabel4" value="<?php echo get_option('revBodyMenuLabel4'); ?>"  style="width:100%;" /></td>
                </tr>
                <tr valign="top">
                  <th scope="row">Non-Surgical Menu Label</th>
                  <td><input type="text" name="revSkinMenuLabel4" value="<?php echo get_option('revSkinMenuLabel4'); ?>"  style="width:100%;" /></td>
                </tr>
              </table>
              <hr />
              <h3>Gallery 5</h3>
              <hr />
              <table class="form-table">
                <tr valign="top">
                  <th scope="row">Gallery Home Page Intro Text</th>
                  <td><?php wp_editor( get_option('revLandingIntro5'), 'revLandingIntro5' ); ?></td>
                </tr>
                <tr valign="top">
                  <th scope="row">Category Landing Page Intro Text</th>
                  <?php if(get_option('revCategoryLandingPageIntro5')){$catLandingPageIntro5 = get_option('revCategoryLandingPageIntro5');} else{$catLandingPageIntro5 = '<p>Click on the before and after sets below to get more details on each case.</p>';} ?>
                  <td><?php wp_editor($catLandingPageIntro5 , 'revCategoryLandingPageIntro5' ); ?></td>
                </tr>
              </table>
              <table class="form-table">
                <tr valign="top">
                  <th scope="row">Face Menu Label</th>
                  <td><input type="text" name="revFaceMenuLabel5" value="<?php echo get_option('revFaceMenuLabel5'); ?>"  style="width:100%;" /></td>
                </tr>
                <tr valign="top">
                  <th scope="row">Breast Menu Label</th>
                  <td><input type="text" name="revBreastMenuLabel5" value="<?php echo get_option('revBreastMenuLabel5'); ?>"  style="width:100%;" /></td>
                </tr>
                <tr valign="top">
                  <th scope="row">Body Menu Label</th>
                  <td><input type="text" name="revBodyMenuLabel5" value="<?php echo get_option('revBodyMenuLabel5'); ?>"  style="width:100%;" /></td>
                </tr>
                <tr valign="top">
                  <th scope="row">Non-Surgical Menu Label</th>
                  <td><input type="text" name="revSkinMenuLabel5" value="<?php echo get_option('revSkinMenuLabel5'); ?>"  style="width:100%;" /></td>
                </tr>
              </table>
            </div>
          </div>
          <div class="postbox closed" id="test2">
            <div class="postbox-header">
              <h2 class="sortable-handle"><span>SEO Settings <small>(optional)</small></span></h2>
              <div class="handle-actions hide-if-no-js">
                <button type="button" class="handlediv" aria-expanded="true"><span class="screen-reader-text">Toggle panel: Excerpt</span><span class="toggle-indicator" aria-hidden="true"></span></button>
              </div>
            </div>
            <div class="inside">
              <table class="form-table">
                <tr valign="top">
                  <th scope="row">Default Description Tag</th>
                  <td><input type="text" name="revDefaultDescription" value="<?php echo get_option('revDefaultDescription'); ?>"  style="width:100%;" /></td>
                </tr>
                <tr valign="top">
                  <th scope="row">Gallery Landing Page Title Tag</th>
                  <td><input type="text" name="revLandingTitle" value="<?php echo get_option('revLandingTitle'); ?>"  style="width:100%;" /></td>
                </tr>
                <tr valign="top">
                  <th scope="row">Gallery Landing Page Description Tag</th>
                  <td><input type="text" name="revLandingDescription" value="<?php echo get_option('revLandingDescription'); ?>"  style="width:100%;" /></td>
                </tr>
                <tr valign="top">
                  <th scope="row">Category Landing Page Title Tag</th>
                  <td><input type="text" name="revCategoryLandingTitle" value="<?php echo get_option('revCategoryLandingTitle'); ?>"  style="width:100%;" /></td>
                </tr>
                <tr valign="top">
                  <th scope="row">Category Landing Page Description Tag</th>
                  <td><input type="text" name="revCategoryLandingDescription" value="<?php echo get_option('revCategoryLandingDescription'); ?>"  style="width:100%;" /></td>
                </tr>
                <tr valign="top">
                  <th scope="row">Enable sitemaps?</th>
                  <td><input name="revEnableSitemap" type="checkbox" id="revEnableSitemap" value="1" <?php if( get_option('revEnableSitemap') == 1){echo 'checked="checked"';} ?> /></td>
                </tr>
                <tr valign="top">
                  <th scope="row">Yoast WP SEO Plugin in use?</th>
                  <td><input name="revUseWPseo" type="checkbox" id="revUseWPseo" value="1" <?php if( get_option('revUseWPseo') == 1){echo 'checked="checked"';} ?> /></td>
                </tr>
              </table>
            </div>
          </div>
          <div class="postbox closed" id="test2">
            <div class="postbox-header">
              <h2 class="sortable-handle"><span>Secondary Install SEO Settings<small> (optional)</small></span></h2>
              <div class="handle-actions hide-if-no-js">
                <button type="button" class="handlediv" aria-expanded="true"><span class="screen-reader-text">Toggle panel: Excerpt</span><span class="toggle-indicator" aria-hidden="true"></span></button>
              </div>
            </div>
            <div class="inside">
              <hr />
              <h3>Gallery 2</h3>
              <hr />
              <table class="form-table">
                <tr valign="top">
                  <th scope="row">Default Description Tag</th>
                  <td><input type="text" name="revDefaultDescription2" value="<?php echo get_option('revDefaultDescription2'); ?>"  style="width:100%;" /></td>
                </tr>
                <tr valign="top">
                  <th scope="row">Gallery Landing Page Title Tag</th>
                  <td><input type="text" name="revLandingTitle2" value="<?php echo get_option('revLandingTitle2'); ?>"  style="width:100%;" /></td>
                </tr>
                <tr valign="top">
                  <th scope="row">Gallery Landing Page Description Tag</th>
                  <td><input type="text" name="revLandingDescription2" value="<?php echo get_option('revLandingDescription2'); ?>"  style="width:100%;" /></td>
                </tr>
                <tr valign="top">
                  <th scope="row">Category Landing Page Title Tag</th>
                  <td><input type="text" name="revCategoryLandingTitle2" value="<?php echo get_option('revCategoryLandingTitle2'); ?>"  style="width:100%;" /></td>
                </tr>
                <tr valign="top">
                  <th scope="row">Category Landing Page Description Tag</th>
                  <td><input type="text" name="revCategoryLandingDescription2" value="<?php echo get_option('revCategoryLandingDescription2'); ?>"  style="width:100%;" /></td>
                </tr>
              </table>
              <hr />
              <h3>Gallery 3</h3>
              <hr />
              <table class="form-table">
                <tr valign="top">
                  <th scope="row">Default Description Tag</th>
                  <td><input type="text" name="revDefaultDescription3" value="<?php echo get_option('revDefaultDescription3'); ?>"  style="width:100%;" /></td>
                </tr>
                <tr valign="top">
                  <th scope="row">Gallery Landing Page Title Tag</th>
                  <td><input type="text" name="revLandingTitle3" value="<?php echo get_option('revLandingTitle3'); ?>"  style="width:100%;" /></td>
                </tr>
                <tr valign="top">
                  <th scope="row">Gallery Landing Page Description Tag</th>
                  <td><input type="text" name="revLandingDescription3" value="<?php echo get_option('revLandingDescription3'); ?>"  style="width:100%;" /></td>
                </tr>
                <tr valign="top">
                  <th scope="row">Category Landing Page Title Tag</th>
                  <td><input type="text" name="revCategoryLandingTitle3" value="<?php echo get_option('revCategoryLandingTitle3'); ?>"  style="width:100%;" /></td>
                </tr>
                <tr valign="top">
                  <th scope="row">Category Landing Page Description Tag</th>
                  <td><input type="text" name="revCategoryLandingDescription3" value="<?php echo get_option('revCategoryLandingDescription3'); ?>"  style="width:100%;" /></td>
                </tr>
              </table>
              <hr />
              <h3>Gallery 4</h3>
              <hr />
              <table class="form-table">
                <tr valign="top">
                  <th scope="row">Default Description Tag</th>
                  <td><input type="text" name="revDefaultDescription4" value="<?php echo get_option('revDefaultDescription4'); ?>"  style="width:100%;" /></td>
                </tr>
                <tr valign="top">
                  <th scope="row">Gallery Landing Page Title Tag</th>
                  <td><input type="text" name="revLandingTitle4" value="<?php echo get_option('revLandingTitle4'); ?>"  style="width:100%;" /></td>
                </tr>
                <tr valign="top">
                  <th scope="row">Gallery Landing Page Description Tag</th>
                  <td><input type="text" name="revLandingDescription4" value="<?php echo get_option('revLandingDescription4'); ?>"  style="width:100%;" /></td>
                </tr>
                <tr valign="top">
                  <th scope="row">Category Landing Page Title Tag</th>
                  <td><input type="text" name="revCategoryLandingTitle4" value="<?php echo get_option('revCategoryLandingTitle4'); ?>"  style="width:100%;" /></td>
                </tr>
                <tr valign="top">
                  <th scope="row">Category Landing Page Description Tag</th>
                  <td><input type="text" name="revCategoryLandingDescription4" value="<?php echo get_option('revCategoryLandingDescription4'); ?>"  style="width:100%;" /></td>
                </tr>
              </table>
              <hr />
              <h3>Gallery 5</h3>
              <hr />
              <table class="form-table">
                <tr valign="top">
                  <th scope="row">Default Description Tag</th>
                  <td><input type="text" name="revDefaultDescription5" value="<?php echo get_option('revDefaultDescription5'); ?>"  style="width:100%;" /></td>
                </tr>
                <tr valign="top">
                  <th scope="row">Gallery Landing Page Title Tag</th>
                  <td><input type="text" name="revLandingTitle5" value="<?php echo get_option('revLandingTitle5'); ?>"  style="width:100%;" /></td>
                </tr>
                <tr valign="top">
                  <th scope="row">Gallery Landing Page Description Tag</th>
                  <td><input type="text" name="revLandingDescription5" value="<?php echo get_option('revLandingDescription5'); ?>"  style="width:100%;" /></td>
                </tr>
                <tr valign="top">
                  <th scope="row">Category Landing Page Title Tag</th>
                  <td><input type="text" name="revCategoryLandingTitle5" value="<?php echo get_option('revCategoryLandingTitle5'); ?>"  style="width:100%;" /></td>
                </tr>
                <tr valign="top">
                  <th scope="row">Category Landing Page Description Tag</th>
                  <td><input type="text" name="revCategoryLandingDescription5" value="<?php echo get_option('revCategoryLandingDescription5'); ?>"  style="width:100%;" /></td>
                </tr>
              </table>
            </div>
          </div>
          <div class="postbox closed" id="test2">
            <div class="postbox-header">
              <h2 class="sortable-handle"><span>Basic Styling<small> (optional)</small></span></h2>
              <div class="handle-actions hide-if-no-js">
                <button type="button" class="handlediv" aria-expanded="true"><span class="screen-reader-text">Toggle panel: Excerpt</span><span class="toggle-indicator" aria-hidden="true"></span></button>
              </div>
            </div>
            <div class="inside">
              <p>Change colors of various gallery components</p>
              <table class="form-table">
                <tr valign="top">
                  <th scope="row">Image Set Navigation: <br />
                    Border Color</th>
                  <td><input type="text" name="revGalNavStyleBorderColor" value="<?php echo get_option('revGalNavStyleBorderColor'); ?>" class="revColor-picker"   /></td>
                </tr>
                <tr valign="top">
                  <th scope="row">Image Set Navigation: <br />
                    Text Color</th>
                  <td><input type="text" name="revGalNavStyleColor" value="<?php echo get_option('revGalNavStyleColor'); ?>" class="revColor-picker" /></td>
                </tr>
                <tr valign="top">
                  <th scope="row">Image Set Navigation: <br />
                    Background Color</th>
                  <td><input type="text" name="revGalNavStyleBackground" value="<?php echo get_option('revGalNavStyleBackground'); ?>" class="revColor-picker" /></td>
                </tr>
                <tr valign="top">
                  <th scope="row">&nbsp;</th>
                  <td>&nbsp;</td>
                </tr>
                <tr valign="top">
                  <th scope="row">Image Set Navigation: <br />
                    Hover Border Color</th>
                  <td><input type="text" name="revGalNavStyleHoverBorderColor" value="<?php echo get_option('revGalNavStyleHoverBorderColor'); ?>" class="revColor-picker"  /></td>
                </tr>
                <tr valign="top">
                  <th scope="row">Image Set Navigation: <br />
                    Hover Text Color</th>
                  <td><input type="text" name="revGalNavStyleHoverColor" value="<?php echo get_option('revGalNavStyleHoverColor'); ?>" class="revColor-picker"  /></td>
                </tr>
                <tr valign="top">
                  <th scope="row">Image Set Navigation: <br />
                    Hover Background Color</th>
                  <td><input type="text" name="revGalNavStyleHoverBackground" value="<?php echo get_option('revGalNavStyleHoverBackground'); ?>" class="revColor-picker" /></td>
                </tr>
                <tr valign="top">
                  <th scope="row">&nbsp;</th>
                  <td>&nbsp;</td>
                </tr>
                <tr valign="top">
                  <th scope="row">Image Set Navigation: <br />
                    Highlight Border Color</th>
                  <td><input type="text" name="revGalNavHighlightBorderColor" value="<?php echo get_option('revGalNavHighlightBorderColor'); ?>" class="revColor-picker"  /></td>
                </tr>
                <tr valign="top">
                  <th scope="row">Image Set Navigation: <br />
                    Highlight Text Color</th>
                  <td><input type="text" name="revGalNavHighlightColor" value="<?php echo get_option('revGalNavHighlightColor'); ?>" class="revColor-picker"  /></td>
                </tr>
                <tr valign="top">
                  <th scope="row">Image Set Navigation: <br />
                    Highlight Background Color</th>
                  <td><input type="text" name="revGalNavHighlightBackground" value="<?php echo get_option('revGalNavHighlightBackground'); ?>" class="revColor-picker"  /></td>
                </tr>
                <tr valign="top">
                  <th scope="row">&nbsp;</th>
                  <td>&nbsp;</td>
                </tr>
                <tr valign="top">
                  <th scope="row">Thumbnail Button: <br />
                    Border Color</th>
                  <td><input type="text" name="revThumbButStyleBorderColor" value="<?php echo get_option('revThumbButStyleBorderColor'); ?>" class="revColor-picker"  /></td>
                </tr>
                <tr valign="top">
                  <th scope="row">Thumbnail Button: <br />
                    Text Color</th>
                  <td><input type="text" name="revThumbButStyleColor" value="<?php echo get_option('revThumbButStyleColor'); ?>" class="revColor-picker"  /></td>
                </tr>
                <tr valign="top">
                  <th scope="row">Thumbnail Button: <br />
                    Background Color</th>
                  <td><input type="text" name="revThumbButStyleBackground" value="<?php echo get_option('revThumbButStyleBackground'); ?>" class="revColor-picker"  /></td>
                </tr>
                <tr valign="top">
                  <th scope="row">&nbsp;</th>
                  <td>&nbsp;</td>
                </tr>
                <tr valign="top">
                  <th scope="row">Thumbnail Button: <br />
                    Hover Border Color</th>
                  <td><input type="text" name="revThumbButStyleHoverBorderColor" value="<?php echo get_option('revThumbButStyleHoverBorderColor'); ?>" class="revColor-picker"  /></td>
                </tr>
                <tr valign="top">
                  <th scope="row">Thumbnail Button: <br />
                    Hover Text Color</th>
                  <td><input type="text" name="revThumbButStyleHoverColor" value="<?php echo get_option('revThumbButStyleHoverColor'); ?>" class="revColor-picker"  /></td>
                </tr>
                <tr valign="top">
                  <th scope="row">Thumbnail Button: <br />
                    Hover Background Color</th>
                  <td><input type="text" name="revThumbButStyleHoverBackground" value="<?php echo get_option('revThumbButStyleHoverBackground'); ?>" class="revColor-picker"  /></td>
                </tr>
                <tr valign="top">
                  <th scope="row">&nbsp;</th>
                  <td>&nbsp;</td>
                </tr>
                <tr valign="top">
                  <th scope="row">My Favorites Button: <br />
                    Border Color</th>
                  <td><input type="text" name="revFavButStyleBorderColor" value="<?php echo get_option('revFavButStyleBorderColor'); ?>" class="revColor-picker"  /></td>
                </tr>
                <tr valign="top">
                  <th scope="row">My Favorites Button: <br />
                    Text Color</th>
                  <td><input type="text" name="revFavButStyleColor" value="<?php echo get_option('revFavButStyleColor'); ?>" class="revColor-picker"  /></td>
                </tr>
                <tr valign="top">
                  <th scope="row">My Favorites Button: <br />
                    Background Color</th>
                  <td><input type="text" name="revFavButStyleBackground" value="<?php echo get_option('revFavButStyleBackground'); ?>" class="revColor-picker"  /></td>
                </tr>
                <tr valign="top">
                  <th scope="row">&nbsp;</th>
                  <td>&nbsp;</td>
                </tr>
                <tr valign="top">
                  <th scope="row">My Favorites Button: <br />
                    Hover Border Color</th>
                  <td><input type="text" name="revFavButStyleHoverBorderColor" value="<?php echo get_option('revFavButStyleHoverBorderColor'); ?>" class="revColor-picker"  /></td>
                </tr>
                <tr valign="top">
                  <th scope="row">My Favorites Button: <br />
                    Hover Text Color</th>
                  <td><input type="text" name="revFavButStyleHoverColor" value="<?php echo get_option('revFavButStyleHoverColor'); ?>" class="revColor-picker"  /></td>
                </tr>
                <tr valign="top">
                  <th scope="row">My Favorites Button: <br />
                    Hover Background Color</th>
                  <td><input type="text" name="revFavButStyleHoverBackground" value="<?php echo get_option('revFavButStyleHoverBackground'); ?>" class="revColor-picker"  /></td>
                </tr>
              </table>
            </div>
          </div>
          <div class="postbox closed" id="test2">
           <div class="postbox-header">
              <h2 class="sortable-handle"><span>Custom CSS<small> (optional)</small></span></h2>
              <div class="handle-actions hide-if-no-js">
                <button type="button" class="handlediv" aria-expanded="true"><span class="screen-reader-text">Toggle panel: Excerpt</span><span class="toggle-indicator" aria-hidden="true"></span></button>
              </div>
            </div>
            <div class="inside">
              <p>Enter custom CSS styles for modifying gallery layout below</p>
              <table class="form-table">
                <tr valign="top">
                  <th scope="row"> <textarea name="revCustomCSS" style="width:100%" cols="" rows="10" id="revCustomCSS"><?php echo get_option('revCustomCSS'); ?></textarea>
                  </th>
                </tr>
              </table>
            </div>
          </div>
          <div class="postbox closed" id="test2">
            <div class="postbox-header">
              <h2 class="sortable-handle"><span>BRAGbook Advanced Options<small> (optional)</small></span></h2>
              <div class="handle-actions hide-if-no-js">
                <button type="button" class="handlediv" aria-expanded="true"><span class="screen-reader-text">Toggle panel: Excerpt</span><span class="toggle-indicator" aria-hidden="true"></span></button>
              </div>
            </div>
            <div class="inside">
              <p>These options provide the ability to wrap various elements of the gallery in extra html tags so  advanced custom styling can be added.</p>
				<table class="form-table">
                <tr valign="top">
                  <th scope="row">Landing Menu Wrap Open Tags</th>
                  <td><input type="text" name="revLandingMenuWrapOpen" value='<?php echo get_option('revLandingMenuWrapOpen'); ?>'  style="width:100%;" /></td>
                </tr>
                <tr valign="top">
                  <th scope="row">Landing Menu Wrap Close Tags</th>
                  <td><input type="text" name="revLandingMenuWrapClose" value='<?php echo get_option('revLandingMenuWrapClose'); ?>'  style="width:100%;" /></td>
                </tr>
                <tr valign="top">
                  <th scope="row">Face Menu Wrap Open Tags</th>
                  <td><input type="text" name="revFaceMenuWrapOpen" value='<?php echo get_option('revFaceMenuWrapOpen'); ?>'  style="width:100%;" /></td>
                </tr>
                <tr valign="top">
                  <th scope="row">Face Menu Wrap Close Tags</th>
                  <td><input type="text" name="revFaceMenuWrapClose" value='<?php echo get_option('revFaceMenuWrapClose'); ?>'  style="width:100%;" /></td>
                </tr>
                <tr valign="top">
                  <th scope="row">Breast Menu Wrap Open Tags</th>
                  <td><input type="text" name="revBreastMenuWrapOpen" value='<?php echo get_option('revBreastMenuWrapOpen'); ?>'  style="width:100%;" /></td>
                </tr>
                <tr valign="top">
                  <th scope="row">Breast Menu Wrap Close Tags</th>
                  <td><input type="text" name="revBreastMenuWrapClose" value='<?php echo get_option('revBreastMenuWrapClose'); ?>'  style="width:100%;" /></td>
                </tr>
                <tr valign="top">
                  <th scope="row">Body Menu Wrap Open Tags</th>
                  <td><input type="text" name="revBodyMenuWrapOpen" value='<?php echo get_option('revBodyMenuWrapOpen'); ?>'  style="width:100%;" /></td>
                </tr>
                <tr valign="top">
                  <th scope="row">Body Menu Wrap Close Tags</th>
                  <td><input type="text" name="revBodyMenuWrapClose" value='<?php echo get_option('revBodyMenuWrapClose'); ?>'  style="width:100%;" /></td>
                </tr>
                <tr valign="top">
                  <th scope="row">Non-Surgical Menu Wrap Open Tags</th>
                  <td><input type="text" name="revSkinMenuWrapOpen" value='<?php echo get_option('revSkinMenuWrapOpen'); ?>'  style="width:100%;" /></td>
                </tr>
                <tr valign="top">
                  <th scope="row">Non-Surgical Menu Wrap Close Tags</th>
                  <td><input type="text" name="revSkinMenuWrapClose" value='<?php echo get_option('revSkinMenuWrapClose'); ?>' style="width:100%;" /></td>
                </tr>
                <tr valign="top">
                  <th scope="row">Category Landing Page Wrap Open Tags</th>
                  <td><input type="text" name="revCategoryLandingPageWrapOpen" value='<?php echo get_option('revCategoryLandingPageWrapOpen'); ?>'  style="width:100%;" /></td>
                </tr>
                <tr valign="top">
                  <th scope="row">Category Landing Page Wrap Close Tags</th>
                  <td><input type="text" name="revCategoryLandingPageWrapClose" value='<?php echo get_option('revCategoryLandingPageWrapClose'); ?>'  style="width:100%;" /></td>
                </tr>
                <tr valign="top">
                  <th scope="row">Image Set Page Wrap Open Tags</th>
                  <td><input type="text" name="revImageSetWrapOpen" value='<?php echo get_option('revImageSetWrapOpen'); ?>'  style="width:100%;" /></td>
                </tr>
                <tr valign="top">
                  <th scope="row">Image Set Page Wrap Close Tags</th>
                  <td><input type="text" name="revImageSetWrapClose" value='<?php echo get_option('revImageSetWrapClose'); ?>'  style="width:100%;" /></td>
                </tr>
                <tr valign="top">
                  <th scope="row">Turn Off Main Menu?</th>
                  <td><input name="revHideMainMenu" type="checkbox" id="revHideMainMenu" value="1" <?php if( get_option('revHideMainMenu') == 1){echo 'checked="checked"';} ?> /></td>
                </tr>
                <tr valign="top">
                  <th scope="row">Turn Off Jump Menu?</th>
                  <td><input name="revHideJumpMenu" type="checkbox" id="revHideJumpMenu" value="1" <?php if( get_option('revHideJumpMenu') == 1){echo 'checked="checked"';} ?> /></td>
                </tr>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <input name="bragbook_settings_have_changed" type="hidden" value="1" />
    <?php submit_button(); ?>
  </form>
</div>
