<?php 
class revCorporateGallery extends revGallery {
    var $thermiTightActive = false; // activate thermiTight cateory
	var $thermiSmoothActive = false; // activate thermiSmooth category
	var $thermiRaseActive = false; // activate thermiRase category
  
    //create jump menu to navigate corporate gallery categories
	function revCorporateCategoryNavJumpMenu($revCatname){
		
		echo '<form name="rev_gallery_list" method="get" action="" id="revgallerychooser">';
			echo '<p><strong>Choose a Gallery: </strong>';
				if($this->urlRewrite){
					echo '<select name="revCatname" id="revCatname" class="revJumpMenu" onchange="revenez_jump_menu_procedure()">';
				} else {
					echo '<select name="revCatname" id="revCatname" class="revJumpMenu" onchange="revenez_jump_menu_procedure_norewrite()">';
				}
				if(!isset($revCatname)){
					echo '<option>Select Category</option>';
				}
					for ($x=0; $x<count($this->baCats['cat_set']); $x++){
						
							// check for ThermiSmooth category
							if(ucwords($this->cleanCat($this->baCats['cat_set'][$x]['category_name'])) == ucwords("thermismooth") && $this->thermiSmoothActive == 1){
								//check if selcted category
								if($this->cleanCat($revCatname) == $this->cleanCat($this->baCats['cat_set'][$x]['category_name'])){
									$thermiSelected = ' selected="selected"';
								} else {$thermiSelected = '';}
								
								echo '<option value="'.$this->baseUrl.'|'.$this->cleanCat($this->baCats['cat_set'][$x]['category_name']).'|'.str_replace(' ', '-', $this->baCats['cat_set'][$x]['category_name']).'" '.$thermiSelected.'>'. $this->baCats['cat_set'][$x]['category_name'].'</option>';
							}
							//check for ThermiTight
							if(ucwords($this->cleanCat($this->baCats['cat_set'][$x]['category_name'])) == ucwords("thermitight") && $this->thermiTightActive == 1){
								if($this->cleanCat($revCatname) == $this->cleanCat($this->baCats['cat_set'][$x]['category_name'])){
									$thermiSelected = ' selected="selected"';
								} else {$thermiSelected = '';}
								
								echo '<option value="'.$this->baseUrl.'|'.$this->cleanCat($this->baCats['cat_set'][$x]['category_name']).'|'.str_replace(' ', '-', $this->baCats['cat_set'][$x]['category_name']).'" '.$thermiSelected.'>'. $this->baCats['cat_set'][$x]['category_name'].'</option>';
							}
							
						
					}
				echo '</select>';
			echo '</p>';
		echo '</form>';

	}
	
	
	
	
	//Create corporate Landing page
	function corporateLandingPage(){
		echo  '<div id="thermiLandingPage">';
		echo "<p class='thermiIntroText'>ThermiRF: Applying the \"Science of Heat\" to treat a variety of aesthetic soft tissue and nerve conditions.</p>";
		//check if one or both procedures are active and set column size
		if($this->thermiSmoothActive == 1 && $this->thermiTightActive == 1){
			$thermiColClass = 'thermiHalfCol';
		} else{
			$thermiColClass = 'thermiFullCol';
		}
		// echo thermi smooth menu item
		if($this->thermiSmoothActive == 1){
			if($this->urlRewrite == 1){$thermiSmoothUrl = "thermismooth/";} else{$thermiSmoothUrl = "?revCatname=thermismooth";}
			echo '<div id="thermiSmoothContainerDiv" class="'.$thermiColClass.'">
        		<a href="'.$this->baseUrl.$thermiSmoothUrl.'"><img src="https://www.bragbook.gallery/thermi/assets/images/thermiSmoothHeader.jpg" class="thermiHeaderImage" /></a>
         		<div class="thermiContentCol">
        		<h2><a href="'.$this->baseUrl.$thermiSmoothUrl.'"><img src="https://www.bragbook.gallery/thermi/assets/images/thermiSmooth.png" /></a></h2>
         <h3>A non-invasive solution for smoothing skin texture.</h3>
         <p>From cellulite to facial wrinkles, ThermiSmooth improves the appearance of lax skin with no surgery or downtime. A simple series of quick, once a week treatments over four weeks can improve skin texture, even during your lunch break. Whether you have wrinkles around the eyes, crepe texture hands or lax skin around the abdomen, ThermiSmooth is the simple, non-invasive solution for skin laxity. <a href="'.$this->baseUrl.$thermiSmoothUrl.'">Click here to see real results...</a></p>
         	</div>
        </div>';
		} 
		// echo thermitight menu item
		if ($this->thermiTightActive == 1){
			if($this->urlRewrite == 1){$thermiTightUrl = "thermitight/";} else{$thermiTightUrl = "?revCatname=thermitight";}
			echo '<div id="thermiTightContainerDiv" class="'.$thermiColClass.'">
            <a href="'.$this->baseUrl.$thermiTightUrl.'"><img src="https://www.bragbook.gallery/thermi/assets/images/thermiTightHeader.jpg" class="thermiHeaderImage" /></a>
             <div class="thermiContentCol">
            <h2><a href="'.$this->baseUrl.$thermiTightUrl.'"><img src="https://www.bragbook.gallery/thermi/assets/images/thermiTight.png" /></a></h2>
             <h3>A single treatment solution for skin laxity.</h3>
             <p>How you can treat your sagging neck, quickly and without the downtime associated with major surgery? ThermiTight is the answer. ThermiTight is a RF treatment that tightens lax skin just about anywhere on your body. Only local anesthetic is required to keep you comfortable during the short procedure. Your results will resolve gradually over 4-6 weeks, and may improve for up to a year! <a href="'.$this->baseUrl.$thermiTightUrl.'">Click here to see real results...</a>
</p>
			</div>
        </div>';
		}
		
		echo '</div>';
	}
	
	
	
	//create full default gallery
	function revenezCorporateBAgallery($revCatname, $revID){
		//print_r($this->fullGallery);
		echo '<div id="revGalleryWrap">';
		if($revCatname == "Home"){
				$this->corporateLandingPage();
		} else {
			if($revID == '999999'){
				echo $this->categoryLandingPageWrapOpen;
				if(isset($this->hideJumpMenu) && $this->hideJumpMenu == 1){}else{$this->revCorporateCategoryNavJumpMenu($revCatname);}
				echo '<h1 id="revCategoryHeadline">';
				$fullCat = $this->fullCatName($revCatname);
				echo str_replace('Revision', '- Revision',ucwords($fullCat)).' Before &amp; After Gallery';
				echo ' </h1>';  
				echo $this->categoryLandingPageIntro;
				$this->revCategoryLandingPage($revCatname);
				echo $this->categoryLandingPageWrapClose;
			} else{
			echo $this->imageSetWrapOpen;
		echo '<a id="ba" name="ba"></a>';
		if(isset($this->hideJumpMenu) && $this->hideJumpMenu == 1){}else{$this->revCorporateCategoryNavJumpMenu($revCatname);}
		echo '<div id="revGalleryHeader">';
		echo '<h1 id="revPatientHeadline">';
        $this->revHeadline($revCatname, $revID);
        echo ' </h1>';  		
		$this->revImageSetNav($revCatname, $revID);
		echo '<div class="clearfixer"></div>';
		echo '</div>';
		echo '<div class="revThumbLaunchCon">';
		$this->revThumbnailButton();
		if($this->myFavsActive == 1){$this->revFavoriteButton($revID);}
		echo '</div>';
		$this->revImageSet($revID);
		$this->revPatientInfo($revID);
		echo '<div class="revThumbLaunchCon">';
		$this->revThumbnailButton();
		if($this->myFavsActive == 1){$this->revFavoriteButton($revID);}
		echo '</div>';
		if(isset($this->thumbLimit)){
		$this->revHiddenThumbnails($revCatname, 0);
		} else{
		$this->revHiddenThumbnails($revCatname);	
		}
		$this->revSocialSharing();
		$this->revCopyright();
		echo $this->imageSetWrapClose;
			}
		}
		echo $this->addAnalytics();
		echo '</div>';
	}
	
	
}
?>