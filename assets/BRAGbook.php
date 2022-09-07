<?php
//BRAGbook™ 1.4.3.5
//Copyright © 2013-2022 | Candace Crowe Design | All Rights Reserved | Patent Pending

//Licensee acknowledges that the Software is entitled to protection under the copyright laws of the United States, and agrees that it shall not remove any copyright or other proprietary notices from the Software. Licensee further acknowledges that the existence or lack of a copyright notice shall not cause the Software to be in the public domain or to be other than an unpublished work with all rights reserved under the copyright laws.

	
//session_start();
class revGallery{
	
	//Default Variables
	var $baseUrl = "/gallery/"; //the directory the gallery resides at relative to the home page
	var $MySecretKey = ""; //Set validation key
	var $clientid = "demo"; //Unique identifier for each clienttru
	var $groupclientid = ""; //Unique identifier for clients that have multiple doctors grouped under one master account
	var $galleryAnchor = ""; //set an anchor tag to jump to between URL jumps
	var $urlRewrite = true; //Determines if URL rewrites are on or not
	var $defaultDescription = "Plastic surgery before and after images"; //default page description if custom description not used	
	var $defaultSection = ""; //set default category if someone lands at the base URL
	var $procedureName = ""; //set default procedure Name
	var $revProcedure = ""; //procedure Name of current set
	var $categoryID = ""; //Category ID # for current set
	var $revStart = 0; //start number of record in table
	var $notFoundPage = "/404"; //URL for 404 not found page
	var $thumbLimit = ""; //Number of thumbnail sets to display at one time
	var $categoryImageSetLimit = "10"; //Sets initial number of image sets to display on Category landing page
	var $baCats = ""; //array of before and after categories
	var $baGallery = ""; //array of before and after images
	var $baGallery2 = ""; //array of before and after images for category in case revision images are excluded from it
	var $fullGallery = ""; //full array of before and after images in case revision images are excluded
	var $landingHeadline = "<h1>Welcome!</h1>"; //Headline for gallery landing page
	var $landingIntro = "<p>Welcome to our Before and After gallery. To improve the communication between us, we encourage you to use the MyFavorites feature to create a collection of images that reflect your surgical goals. When looking at a set of images, simply click the \"Add to Favorites\" button to begin your collection. During our consultation, we'll review this collection together so we can discuss your specific goals and concerns./p>"; //Intro text for gallery landing page
	var $revLandingTitle = "Plastic surgery before and after gallery";
	var $revLandingDescription = "Plastic surgery before and after";
	var $categoryLandingPageIntro = "<p>Click on the before and after sets below to get more details on each case.</p>"; //Intro text for category landing pages
	var $revCategoryLandingTitle = ""; //Adds text to the beginning of auto-generated category landing titles
	var $revCategoryLandingDescription = ""; //Adds text after auto-generated category landing descriptions
	var $revisionActive = 0; //variable to turn on seperating revisions from main categories
	var $revisionSets = array(); //array of before and after images with revision option set
	var $revisionSetsFull = array(); //array of all before and after images across all categories with revision option set
	var $revisionSetsOnly = 0; // variable to determine if only revision sets should be pulled (set by code - do not modify)
	var $menActive = 0; //variable to turn on seperating men from main categories
	var $menSets = array(); //array of before and after images with men option set
	var $menRevisionSets = array(); //array of before and after images with men option set
	var $menSetsFull = array(); //array of all before and after images across all categories with male option set
	var $menRevisionSetsFull = array(); //array of all before and after images across all categories with male option set
	var $menSetsOnly = 0; // variable to determine if only men sets should be pulled (set by code - do not modify)
	var $nudityWarning = 0;
	var $nudityWarningText = 'CAUTION: This gallery may contain nudity. If you are not at least 18 years of age or are offended by such material, please click the CANCEL button now.';
	var $detailsLimit = ""; //id of div tag to use from the details field of a BA set. Leave blank to use the entire details field.
	var $patientAutoNumber = "1"; //variable to determine if an auto generated patient number should be applied to BA set based on its placement within a category
	var $imageSetWrapOpen = ""; //html tags to place before the image set pages  
	var $imageSetWrapClose = ""; //html tags to place after the image set pages   
	var $landingMenuWrapOpen = '<div id="revFullMenu">'; //html tags to place before the landing page menu on the landing page 
	var $landingMenuWrapClose = "</div>"; //html tags to place after the landing page menu on the landing page 
	var $faceMenuWrapOpen = ""; //html tags to place before the face category menu on the landing page 
	var $faceMenuWrapClose = ""; //html tags to place after the face category menu on the landing page 
	var $breastMenuWrapOpen = ""; //html tags to place before the breast category menu on the landing page 
	var $breastMenuWrapClose = ""; //html tags to place after the breast category menu on the landing page 
	var $bodyMenuWrapOpen = ''; //html tags to place before the body category menu on the landing page 
	var $bodyMenuWrapClose = ''; //html tags to place after the body category menu on the landing page 
	var $skinMenuWrapOpen = ""; //html tags to place before the skin / non-surgical category menu on the landing page 
	var $skinMenuWrapClose = ""; //html tags to place after the skin / non-surgical category menu on the landing page 
	var $categoryLandingPageWrapOpen = ""; //html tags to place before the category landing page
	var $categoryLandingPageWrapClose = ""; //html tags to place after the category landing page
	
	var $printFullMenu = "0"; //enable this variable to print a list of all categories on landing page instead of the default four column sorted category menus
	var $fullMenuWrapOpen = ""; //html tags to place before the category menu on the landing page when "$printFullMenu" is anabled
	var $fullMenuWrapClose = ""; //html tags to place after category menu on the landing page  when "$printFullMenu" is anabled
	var $faceMenuLabel = ""; //Label for non-surgical menu on landing page
	var $breastMenuLabel = ""; //Label for non-surgical menu on landing page
	var $bodyMenuLabel = ""; //Label for non-surgical menu on landing page
	var $skinMenuLabel = ""; //Label for non-surgical menu on landing page
	var $setDetails = ""; //Choose the details field used for image sets that have information specific to this website in the bragbook dashboard. By default the basic details field will be used for all sets if this is not defined. Enter "1" if you used "details for website 1", "2" if you used "details for website 2", etc.
	var $myFavsActive = "1"; //enable this variable to print my favorites buttons on the "revenezBAgallery" function
	var $thumbnailsActive = "1"; //enable this variable to print my favorites buttons on the "revenezBAgallery" function
	var $clickToZoomActive = 0; //enable this variable to turn on click to zoom function on BA sets
	var $landingMenuListItemCustomTags = ""; //adds a set of custom tags to the beginning of each list item in the landing page menus
		
	var $analyticsID = "UA-64971966-1"; // set an analytics id 
	var $hideJumpMenu = ""; //variable to hide jump menu
	var $hideMainMenu = ""; //variable to hide main menu
	var $showCatSetDetails = ""; //variable to show details on category page
	
//	patch for file_get contents - D.S 8/4/2022
	function get_data($url)
	{
	  $ch = curl_init();
	  $timeout = 5;
	  curl_setopt($ch,CURLOPT_URL,$url);
	  curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
	  curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
	  $data = curl_exec($ch);
	  curl_close($ch);
	  return $data;
	}		
	
//	log patient in to system
 	function patientLogin($sig,$patientid,$username,$favid){

if($patientid) // Someone trying to log in?
{
  // See if they have the right signature
  if(md5($patientid.$username.$this->MySecretKey) == $sig) {
	  
    $_SESSION['patientid'] = $patientid;
    $_SESSION['patientUser'] = $username;
	$_SESSION['patientsig'] = $sig;
	
	header("Location: https://www.bragbook.gallery/myfavs/?favid=".$favid."&patientsig=".$sig."&freshlogin=true");
  }
}else{
header("Location: https://www.bragbook.gallery/myfavs/?pid=patientlogout");
}
//exit(); 
 }
 
  //log patient in to system
 function patientLogout(){
	 
		session_destroy();
		//header("Location: https://www.bragbook.gallery/myfavs/?clientlogout=true");
		//exit(); 
 }

//get json file for category feed
	function getCatFeed(){
		//get the JSON feed for the categories and decode them to a php array
				$catsJson =  $this->get_data('https://www.bragbook.gallery/myfavs/ba_cat_feed/'.$this->clientid.'/');
				$this->baCats = json_decode($catsJson, true);
	}
	
	//get json file for category feed
	function getImageFeed(){
				if(isset($_SESSION['patientid']) && $_SESSION['patientid']!= ""){
		$imagesJson =  $this->get_data('https://www.bragbook.gallery/myfavs/ba_feed/'.$this->clientid.'/'.$this->categoryID.'/'.$_SESSION['patientid'].'/');
		} else if(isset($this->categoryID)){
					$imagesJson =  $this->get_data('https://www.bragbook.gallery/myfavs/ba_feed/'.$this->clientid.'/'.$this->categoryID.'/');
				} else{
					$imagesJson =  $this->get_data('https://www.bragbook.gallery/myfavs/ba_feed/'.$this->clientid.'/');
				}		
				$this->baGallery = json_decode($imagesJson, true);
				$this->baGallery2 = json_decode($imagesJson, true);
				
				//check if is "for men" category and drop items that are not for men from array
				if($this->menSetsOnly == 1){
					
					$setsToRemove = array();
					
					for ($x=0; $x<count($this->baGallery['ba_set']); $x++){
					if(($this->baGallery['ba_set'][$x]['gender'] != "Male" || ($this->baGallery['ba_set'][$x]['category'] == 18))){
						$setsToRemove[] =$x;
					} 
					
				}
				
				for ($x=0; $x<count($setsToRemove); $x++){
					unset($this->baGallery['ba_set'][$setsToRemove[$x]]);
				}
				
				$this->baGallery['ba_set'] = array_values($this->baGallery['ba_set']);
				}

				//check if is revision category and drop non revision items from array
				if($this->revisionSetsOnly == 1){
					
					$setsToRemove = array();
					
					for ($x=0; $x<count($this->baGallery['ba_set']); $x++){
					if(($this->baGallery['ba_set'][$x]['revision_surgery'] != 1)){
						$setsToRemove[] =$x;
					} 
				}
				
				for ($x=0; $x<count($setsToRemove); $x++){
					unset($this->baGallery['ba_set'][$setsToRemove[$x]]);
				}
				
				$this->baGallery['ba_set'] = array_values($this->baGallery['ba_set']);
				}
				
				
				//check if "for men" is active and remove them from main categories
				if($this->menActive == 1 && $this->menSetsOnly != 1){
					
				
					
					$setsToRemove = array();
					
					for ($x=0; $x<count($this->baGallery['ba_set']); $x++){
					if(($this->baGallery['ba_set'][$x]['gender'] == "Male") && ($this->baGallery['ba_set'][$x]['category'] != 18)){
						$setsToRemove[] = $x;
					} 
				}
				
				for ($x=0; $x<count($setsToRemove); $x++){
					unset($this->baGallery['ba_set'][$setsToRemove[$x]]);
				}
				
				$this->baGallery['ba_set'] = array_values($this->baGallery['ba_set']);
				}
				
				
				
								//check if revisions are active and remove them from main categories
				if($this->revisionActive == 1 && $this->revisionSetsOnly != 1){
					
				
					
					$setsToRemove = array();
					
					for ($x=0; $x<count($this->baGallery['ba_set']); $x++){
					if(($this->baGallery['ba_set'][$x]['revision_surgery'] == 1)){
						$setsToRemove[] = $x;
					} 
				}
				
				for ($x=0; $x<count($setsToRemove); $x++){
					unset($this->baGallery['ba_set'][$setsToRemove[$x]]);
				}
				
				$this->baGallery['ba_set'] = array_values($this->baGallery['ba_set']);
				}
				
				
				if($this->revisionActive == 1 || $this->menActive == 1){
				//create list of all images so drop down nav with revision categories can be properly generated
					$imagesJson2 =  $this->get_data('https://www.bragbook.gallery/myfavs/ba_feed/'.$this->clientid.'/');
					$this->fullGallery = json_decode($imagesJson2, true);
				}

					
								//print_r($this->fullGallery['ba_set']);

	}

	//check if section is set and if not set a default
	function revDefaultSection(){
			if($this->defaultSection){
				
			} else{
				$this->defaultSection = str_replace('-', ' ', $this->baCats['cat_set'][0]['category_name']);
			}
	}
	
	//check if procedure name is set and if not set a default
	function revDefaultProcedureName(){
			if($this->procedureName){
				
			} else{
								
				for ($x=0; $x<count($this->baCats['cat_set']); $x++){
					if($this->baCats['cat_set'][$x]['category_name'] == $this->defaultSection){
						$this->revProcedure = $this->baCats['cat_set'][$x]['category_id'];
					}
				}
				
				
				
			}
	}
	
	//Strip special characters from categories
	function cleanCat($string) {
   $string = strtolower(str_replace(' ', '-', $string)); // Replaces all spaces with hyphens.
   $unwanted_array = array(    'Š'=>'S', 'š'=>'s', 'Ž'=>'Z', 'ž'=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E',
                            'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U',
                            'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss', 'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a', 'ç'=>'c',
                            'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o',
                            'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y' );
$string = strtr( $string, $unwanted_array );
   return preg_replace('/[^A-Za-z0-9\-_]/', '', $string); // Removes special chars.
}
	
	function checkRevisionCat($revCatname){
			//check if revision category and set variable to only show revisions
			if($this->cleanCat($revCatname) != "scar-revision" && $this->cleanCat($revCatname) != "breast-revision"){
				if(substr($this->cleanCat($revCatname), -9) == "-revision"){
					$this->revisionSetsOnly = 1;
				}
			
			//strip "-revision" from category name to get category id
			$revCatnameStripped = str_replace("-revision","",$this->cleanCat($revCatname));
			
				//check if is "for men" category
				if(substr($revCatnameStripped, -8) == "-for-men"){
					$this->menSetsOnly = 1;
					$revCatnameStripped = str_replace("-for-men","",$revCatnameStripped);
				}
				
				return $revCatnameStripped;
			
			} else {
				 $revCatnameStripped = $this->cleanCat($revCatname);
				
				if(substr($revCatnameStripped, -8) == "-for-men"){
					$this->menSetsOnly = 1;
					$revCatnameStripped = str_replace("-for-men","",$revCatnameStripped);
				}
				
				return $revCatnameStripped;
				
			}
		}
	
	
	

	
	
	//get procedure category id by category name
	function revSetProcedureID($revCatname, $redirectionOff = 0){
		
		
		$revCatname = $this->checkRevisionCat($revCatname);
		
		if($this->cleanCat($revCatname) == "home"){
			$recordExists = 1;
		} else{
			$recordExists = 0;
		}
				for ($x=0; $x<count($this->baCats['cat_set']); $x++){
					if($this->cleanCat($this->baCats['cat_set'][$x]['category_name']) == $this->cleanCat($revCatname)){
						$this->categoryID = $this->baCats['cat_set'][$x]['category_id'];
						$recordExists = 1;
					}
				}
				if($recordExists != 1){
					if($redirectionOff == 1){
						return 1;
					}else{
						header("Location: $this->notFoundPage"); /* Redirect browser */
					exit();
					}
					
				}
	}
	
	
	
	
	
	//get start number of record in selected data set
	function revGetStart($revID){
			
				if($revID == "0"){
					$this->revStart = 0;

					$recordExists = 1;
				} else {
				for ($x=0; $x<count($this->baGallery['ba_set']); $x++){
					if(($this->baGallery['ba_set'][$x]['oid'] == $revID) || ($this->baGallery['ba_set'][$x]['permalink'] == $revID)){
						$this->revStart = $x;
						$recordExists = 1;
					} 
				}
				if($recordExists != 1){
					header("Location: $this->notFoundPage"); /* Redirect browser */
					exit();
				}
				}
	}
	
	
	//check for BA sets with revision option
	function revCheckRevision(){
			
				if($this->revisionActive == 1  && $this->menActive != 1){
				for ($x=0; $x<count($this->baGallery2['ba_set']); $x++){
					if($this->baGallery2['ba_set'][$x]['revision_surgery'] == 1){
						$this->revisionSets[] = array($this->baGallery2['ba_set'][$x]['oid'],$this->baGallery2['ba_set'][$x]['category']);
					} 
				}
				} else if($this->revisionActive == 1  && $this->menActive == 1){
				for ($x=0; $x<count($this->baGallery2['ba_set']); $x++){
					if($this->baGallery2['ba_set'][$x]['revision_surgery'] == 1 && $this->baGallery2['ba_set'][$x]['gender'] != "Male"){
						$this->revisionSets[] = array($this->baGallery2['ba_set'][$x]['oid'],$this->baGallery2['ba_set'][$x]['category']);
					} else if($this->baGallery2['ba_set'][$x]['revision_surgery'] == 1 && $this->baGallery2['ba_set'][$x]['gender'] == "Male"){
						$this->menRevisionSets[] = array($this->baGallery2['ba_set'][$x]['oid'],$this->baGallery2['ba_set'][$x]['category']);
					}
				}	
				} else if($this->revisionActive != 1  && $this->menActive == 1){
				for ($x=0; $x<count($this->baGallery2['ba_set']); $x++){
					if($this->baGallery2['ba_set'][$x]['gender'] == "Male"){
						$this->menSets[] = array($this->baGallery2['ba_set'][$x]['oid'],$this->baGallery2['ba_set'][$x]['category']);
					} 
				}
				}
				
				
				
				if($this->revisionActive == 1 && $this->menActive != 1){
				for ($x=0; $x<count($this->fullGallery['ba_set']); $x++){
					if($this->fullGallery['ba_set'][$x]['revision_surgery'] == 1){
						$this->revisionSetsFull[] = array($this->fullGallery['ba_set'][$x]['oid'],$this->fullGallery['ba_set'][$x]['category']);
						
					} 
				}
				} else if($this->revisionActive == 1  && $this->menActive == 1){
				for ($x=0; $x<count($this->fullGallery['ba_set']); $x++){
					if($this->fullGallery['ba_set'][$x]['revision_surgery'] == 1 && $this->fullGallery['ba_set'][$x]['gender'] != "Male"){
						$this->revisionSetsFull[] = array($this->fullGallery['ba_set'][$x]['oid'],$this->fullGallery['ba_set'][$x]['category']);
						
					} else if($this->fullGallery['ba_set'][$x]['revision_surgery'] == 1 && $this->fullGallery['ba_set'][$x]['gender'] == "Male"){
						$this->menRevisionSetsFull[] = array($this->fullGallery['ba_set'][$x]['oid'],$this->fullGallery['ba_set'][$x]['category']);
					} 
					if($this->fullGallery['ba_set'][$x]['gender'] == "Male" && $this->fullGallery['ba_set'][$x]['revision_surgery'] != 1){
						$this->menSetsFull[] = array($this->fullGallery['ba_set'][$x]['oid'],$this->fullGallery['ba_set'][$x]['category']);
						
					}
				}
				} else if($this->revisionActive != 1  && $this->menActive == 1){
				for ($x=0; $x<count($this->fullGallery['ba_set']); $x++){
					if($this->fullGallery['ba_set'][$x]['gender'] == "Male"){
					$this->menSetsFull[] = array($this->fullGallery['ba_set'][$x]['oid'],$this->fullGallery['ba_set'][$x]['category']);
					}
				}
				}
				
	}
	
	

	//create jump menu to navigate gallery categories
	function revCategoryNavJumpMenu($revCatname){
		
		$revJumpMenuOutput;
		
		$revJumpMenuOutput = '<form name="rev_gallery_list" method="get" action="" id="revgallerychooser">';
			$revJumpMenuOutput .= '<p><label for="revCatname"><strong>Choose a Gallery: </strong></label>';
				if($this->urlRewrite){
					$revJumpMenuOutput .=  '<select name="revCatname" id="revCatname" class="revJumpMenu" onchange="revenez_jump_menu_procedure()">';
				} else {
					$revJumpMenuOutput .=  '<select name="revCatname" id="revCatname" class="revJumpMenu" onchange="revenez_jump_menu_procedure_norewrite()">';
				}
				if(!isset($revCatname)){
					$revJumpMenuOutput .=  '<option>Select Category</option>';
				}
					for ($x=0; $x<count($this->baCats['cat_set']); $x++){
						
						if($this->cleanCat($revCatname) == $this->cleanCat($this->baCats['cat_set'][$x]['category_name'])){
							$revJumpMenuOutput .=  '<option value="#" data-baseurl="'.$this->baseUrl.'" data-sectionvar="'.$this->cleanCat($this->baCats['cat_set'][$x]['category_name']).'" data-procedurevar="'.str_replace(' ', '-', $this->baCats['cat_set'][$x]['category_name']).'" selected="selected">'. $this->baCats['cat_set'][$x]['category_name'].'</option>';
							
								//check if a set for this category revision has a revision and create second category
			$currentCatID = $this->baCats['cat_set'][$x]['category_id'];
			
			for ($i=0; $i<count($this->revisionSetsFull); $i++){
				if($this->revisionSetsFull[$i][1] == $currentCatID){
					$revJumpMenuOutput .=  '<option value="#" data-baseurl="'.$this->baseUrl.'" data-sectionvar="'.$this->cleanCat($this->baCats['cat_set'][$x]['category_name']).'-revision">'.$this->baCats['cat_set'][$x]['category_name'].' - Revision</option>';
					break;
				}
			}
			
			//check if a set for this category has a male and create second category
			for ($i=0; $i<count($this->menSetsFull); $i++){
				if($this->menSetsFull[$i][1] == $currentCatID && $currentCatID != 18){
					//print_r($this->menSetsFull);
					$revJumpMenuOutput .=  '<option value="#" data-baseurl="'.$this->baseUrl.'" data-sectionvar="'.$this->cleanCat($this->baCats['cat_set'][$x]['category_name']).'-for-men">'.$this->baCats['cat_set'][$x]['category_name'].' For Men</option>';
					break;
				}
			}
			
			//check if a set for this category has a male revision and create second category
			for ($i=0; $i<count($this->menRevisionSetsFull); $i++){
				if($this->menRevisionSetsFull[$i][1] == $currentCatID && $currentCatID != 18){
					$revJumpMenuOutput .=  '<option value="#" data-baseurl="'.$this->baseUrl.'" data-sectionvar="'.$this->cleanCat($this->baCats['cat_set'][$x]['category_name']).'-for-men-revision">'.$this->baCats['cat_set'][$x]['category_name'].' For Men - Revision</option>';
					break;
				}
			}
							
						} else {
							if($this->revisionActive == 1){
							$revsNum = 0;
							$currentCatID = $this->baCats['cat_set'][$x]['category_id'];
							$mainCatCount = 0;
							for ($i=0; $i<count($this->fullGallery['ba_set']); $i++){
								if($this->fullGallery['ba_set'][$i]['category'] == $currentCatID){
									$mainCatCount++;
								}
							}
							for ($i=0; $i<count($this->revisionSetsFull); $i++){
				if($this->revisionSetsFull[$i][1] == $currentCatID){
					$revsNum++;
					}
				}
							}
							
							if($this->menActive == 1){
							$menNum = 0;
							$currentCatID = $this->baCats['cat_set'][$x]['category_id'];
							$mainCatCount2 = 0;
							for ($i=0; $i<count($this->fullGallery['ba_set']); $i++){
								if($this->fullGallery['ba_set'][$i]['category'] == $currentCatID && $currentCatID != 18){
									$mainCatCount2++;
								}
							}
							for ($i=0; $i<count($this->menSetsFull); $i++){
				if($this->menSetsFull[$i][1] == $currentCatID){
					$menNum++;
					}
				}
							}
							
							if($this->menActive == 1 && $this->revisionActive == 1){
							$menRevsNum = 0;
							$currentCatID = $this->baCats['cat_set'][$x]['category_id'];
							$mainCatCount3 = 0;
							for ($i=0; $i<count($this->fullGallery['ba_set']); $i++){
								if($this->fullGallery['ba_set'][$i]['category'] == $currentCatID && $currentCatID != 18){
									$mainCatCount3++;
								}
							}
							for ($i=0; $i<count($this->menRevisionSetsFull); $i++){
				if($this->menRevisionSetsFull[$i][1] == $currentCatID){
					$menRevsNum++;
					}
					
				}
							}
							
							
							if(($revsNum == 1 && $mainCatCount == 1) || ($menNum == 1 && $mainCatCount2 == 1)|| ($menRevsNum == 1 && $mainCatCount3 == 1)){
								$revJumpMenuOutput .=  $this->cleanCat($this->baCats['cat_set'][$x]['category_name']);
							}else{
							$revJumpMenuOutput .=  '<option value="#" data-baseurl="'.$this->baseUrl.'" data-sectionvar="'.$this->cleanCat($this->baCats['cat_set'][$x]['category_name']).'">'.$this->baCats['cat_set'][$x]['category_name'].'</option>';
							}
							
							//check if a set for this category revision has a revision and create second category
			
			for ($i=0; $i<count($this->revisionSetsFull); $i++){
				if($this->revisionSetsFull[$i][1] == $currentCatID){
					if($this->cleanCat($revCatname) == $this->cleanCat($this->baCats['cat_set'][$x]['category_name'].'-revision')){ $selectThis = ' selected="selected"';}else{$selectThis = '';}
					
					$revJumpMenuOutput .=  '<option value="#" '.$selectThis.' data-baseurl="'.$this->baseUrl.'" data-sectionvar="'.$this->cleanCat($this->baCats['cat_set'][$x]['category_name']).'-revision">'.$this->baCats['cat_set'][$x]['category_name'].' - Revision</option>';
					break;
				}
			}
			
			//check if for men for current category
			for ($i=0; $i<count($this->menSetsFull); $i++){
				if($this->menSetsFull[$i][1] == $currentCatID && $currentCatID != 18) {
					if($this->cleanCat($revCatname) == $this->cleanCat($this->baCats['cat_set'][$x]['category_name'].'-for-men')){ $selectThis = ' selected="selected"';}else{$selectThis = '';}
					
					$revJumpMenuOutput .=  '<option value="#" data-baseurl="'.$this->baseUrl.'" data-sectionvar="'.$this->cleanCat($this->baCats['cat_set'][$x]['category_name']).'-for-men" '.$selectThis.'>'.$this->baCats['cat_set'][$x]['category_name'].' For Men</option>';
					break;
				}
			}
			
			//check if for men revision for current category
			for ($i=0; $i<count($this->menRevisionSetsFull); $i++){
				if($this->menRevisionSetsFull[$i][1] == $currentCatID && $currentCatID != 18){
					if($this->cleanCat($revCatname) == $this->cleanCat($this->baCats['cat_set'][$x]['category_name'].'-for-men-revision')){ $selectThis = ' selected="selected"';}else{$selectThis = '';}
					
					$revJumpMenuOutput .=  '<option value="#"  data-baseurl="'.$this->baseUrl.'" data-sectionvar="'.$this->cleanCat($this->baCats['cat_set'][$x]['category_name']).'-for-men-revision" '.$selectThis.'>'.$this->baCats['cat_set'][$x]['category_name'].' For Men - Revision</option>';
					break;
				}
			}
							
							
						}
						
					}
				$revJumpMenuOutput .=  '</select>';
			$revJumpMenuOutput .=  '</p>';
		$revJumpMenuOutput .=  '</form>';
		
		return $revJumpMenuOutput;

	}
	
	//Create landing page for categories
	function revCategoryLandingPage($revCatname){
		$revCatname = $this->cleanCat($revCatname);
		
		$revCatLandingPageOutput;
		
		$revCatLandingPageOutput = "<div id=\"revCategoryPageConDiv\">";
		

		
		if(isset($this->categoryImageSetLimit) && $this->categoryImageSetLimit != 0 && $this->categoryImageSetLimit != "" ){
			if($this->categoryImageSetLimit < count($this->baGallery['ba_set'])){
			$recordLimit = $this->categoryImageSetLimit;
			} else{
			$recordLimit = count($this->baGallery['ba_set']);	
			}
		} else {
			$recordLimit = count($this->baGallery['ba_set']);
		}
		
		

		$revCatLandingPageOutput = '<div><ul id="revCategoryImageSets">';
			for ($x=0; $x<$recordLimit; $x++){
				if(isset($this->baGallery['ba_set'][$x]['oid'])){
					if($this->urlRewrite == true){  
						if(isset($this->baGallery['ba_set'][$x]['permalink'])){
							$revLink = $this->baGallery['ba_set'][$x]['permalink'];
						} else {
							$revLink = $this->baGallery['ba_set'][$x]['oid'];
						}
						
						if(isset($this->baGallery['ba_set'][$x]['image_after_2_xl']) && $this->baGallery['ba_set'][$x]['image_after_2_xl'] != ""){
							$catAfterIm = $this->baGallery['ba_set'][$x]['image_after_2_xl'];	
						} else{
							$catAfterIm = $this->baGallery['ba_set'][$x]['image_after_xl'];	
						}
						
						if(isset($this->baGallery['ba_set'][$x]['angle1_combo_xl']) && $this->baGallery['ba_set'][$x]['angle1_combo_xl'] != ""){
							$catComboIm = $this->baGallery['ba_set'][$x]['angle1_combo_xl'];
						} else{$catComboIm = "";}
						
						//get headline string for Alts
						$curCatname = $this->revGetHeadline($revCatname, $this->baGallery['ba_set'][$x]['oid']);
		
						//set custom ALT tags

						if(isset($catAfterIm) && $catAfterIm !=""){
							if($this->baGallery['ba_set'][$x]['custom_alttag'] == ""){$altB1 = $curCatname . " - " . "Before ";}else{${'altB1'} = $this->baGallery['ba_set'][$x]['custom_alttag']." - Before";}
						} else{
							if($this->baGallery['ba_set'][$x]['custom_alttag'] == ""){$altB1 = $curCatname . " - " . "Before and After  ";}else{${'altB1'} = $this->baGallery['ba_set'][$x]['custom_alttag']." - Before and After";}
						}
						
						if($this->baGallery['ba_set'][$x]['custom_alttag'] == ""){$altCombo1 = $curCatname . " - " . "Before and After  ";}else{${'altCombo1'} = $this->baGallery['ba_set'][$x]['custom_alttag']." - Before and After";}

						if($this->baGallery['ba_set'][$x]['custom_alttag'] == ""){$altA1 = $curCatname . " - " . "After  ";}else{${'altA1'} = $this->baGallery['ba_set'][$x]['custom_alttag']." - After " ;}
						
						$revHead = '<h2>'.str_replace('Revision', '- Revision',ucwords(str_replace('-', ' ', $this->revGetHeadline($revCatname, $this->baGallery['ba_set'][$x]['oid'])))).' </h2>';
						
						if($this->showCatSetDetails == 1){
							if(isset($catComboIm) && $catComboIm != "") {
								$revCatLandingPageOutput .=  '<li class="revCatImageSet revSingleCol"><div class="revCatCol1"><a href="'.$this->baseUrl.$revCatname.'/'.$revLink.'/'.$this->galleryAnchor.'"><span class="revCatImageSetCenter"><img alt="'.$altCombo1.'" src="'.$this->baGallery['ba_set'][$x]['angle1_combo_xl'].'"></span></a></div><div class="revCatCol2">'.$revHead.'<p>'.$this->truncate($this->revPatientDetailPreview($this->baGallery['ba_set'][$x]['oid']), 150).'</p><a href="'.$this->baseUrl.$revCatname.'/'.$revLink.'/'.$this->galleryAnchor.'" class="revCaseViewLink">View More</a></div></li>';
							} else if(isset($catAfterIm) && $catAfterIm !=""){
								$revCatLandingPageOutput .=  '<li class="revCatImageSet revSingleCol"><div class="revCatCol1"><a href="'.$this->baseUrl.$revCatname.'/'.$revLink.'/'.$this->galleryAnchor.'"><span class="revCatImageSetLeft"><img alt="'.$altB1.'" alt="'.$altA1.'" src="'.$this->baGallery['ba_set'][$x]['image_before_xl'].'"></span><span  class="revCatImageSetRight"><img  alt="'.$altA1.'" src="'.$catAfterIm.'"></span></a></div><div class="revCatCol2">'.$revHead.'<p>'.$this->truncate($this->revPatientDetailPreview($this->baGallery['ba_set'][$x]['oid']), 150).'</p><a href="'.$this->baseUrl.$revCatname.'/'.$revLink.'/'.$this->galleryAnchor.'" class="revCaseViewLink">View More</a></div></li>';
							}else {
								$revCatLandingPageOutput .=  '<li class="revCatImageSet revSingleCol"><div class="revCatCol1"><a href="'.$this->baseUrl.$revCatname.'/'.$revLink.'/'.$this->galleryAnchor.'"><span class="revCatImageSetCenter"><img alt="'.$altB1.'" src="'.$this->baGallery['ba_set'][$x]['image_before_single'].'"></span></a></div><div class="revCatCol2">'.$revHead.'<p>'.$this->truncate($this->revPatientDetailPreview($this->baGallery['ba_set'][$x]['oid']), 150).'</p><a href="'.$this->baseUrl.$revCatname.'/'.$revLink.'/'.$this->galleryAnchor.'" class="revCaseViewLink">View More</a></div></li>';
							}
						} else{
							if(isset($catComboIm) && $catComboIm != "") {
								$revCatLandingPageOutput .=  '<li class="revCatImageSet revDoubleCol">'.$revHead.'<a href="'.$this->baseUrl.$revCatname.'/'.$revLink.'/'.$this->galleryAnchor.'"><span class="revCatImageSetCenter"><img alt="'.$altCombo1.'" src="'.$this->baGallery['ba_set'][$x]['angle1_combo_xl'].'"></span></a></li>';
							} else if(isset($catAfterIm) && $catAfterIm !=""){
								$revCatLandingPageOutput .=  '<li class="revCatImageSet revDoubleCol">'.$revHead.'<a href="'.$this->baseUrl.$revCatname.'/'.$revLink.'/'.$this->galleryAnchor.'"><span class="revCatImageSetLeft"><img alt="'.$altB1.'" src="'.$this->baGallery['ba_set'][$x]['image_before_xl'].'"></span><span  class="revCatImageSetRight"><img alt="'.$altA1.'" src="'.$catAfterIm.'"></span></a></li>';
							}else {
								$revCatLandingPageOutput .=  '<li class="revCatImageSet revDoubleCol">'.$revHead.'<a href="'.$this->baseUrl.$revCatname.'/'.$revLink.'/'.$this->galleryAnchor.'"><span class="revCatImageSetCenter"><img alt="'.$altB1.'" src="'.$this->baGallery['ba_set'][$x]['image_before_single'].'"></span></a></li>';
							}
							
						}
						
						} else {
							if(isset($this->baGallery['ba_set'][$x]['permalink'])){
							$revLink = $this->baGallery['ba_set'][$x]['permalink'];
						} else {
							$revLink = $this->baGallery['ba_set'][$x]['oid'];
						}
						
						if(isset($this->baGallery['ba_set'][$x]['image_after_2_xl']) && $this->baGallery['ba_set'][$x]['image_after_2_xl'] != ""){
							$catAfterIm = $this->baGallery['ba_set'][$x]['image_after_2_xl'];	
						} else{
							$catAfterIm = $this->baGallery['ba_set'][$x]['image_after_xl'];	
						}	
						
						if(isset($this->baGallery['ba_set'][$x]['angle1_combo_xl']) && $this->baGallery['ba_set'][$x]['angle1_combo_xl'] != ""){
							$catComboIm = $this->baGallery['ba_set'][$x]['angle1_combo_xl'];
						}else{$catComboIm = "";}
						
						//get headline string for Alts
						$curCatname = $this->revGetHeadline($revCatname, $this->baGallery['ba_set'][$x]['oid']);
		
						//set custom ALT tags

						if(isset($catAfterIm) && $catAfterIm !=""){
							if($this->baGallery['ba_set'][$x]['custom_alttag'] == ""){$altB1 = $curCatname . " - " . "Before ";}else{${'altB1'} = $this->baGallery['ba_set'][$x]['custom_alttag']." - Before";}
						} else{
							if($this->baGallery['ba_set'][$x]['custom_alttag'] == ""){$altB1 = $curCatname . " - " . "Before and After ";}else{${'altB1'} = $this->baGallery['ba_set'][$x]['custom_alttag']." - Before and After";}
						}
						
						if($this->baGallery['ba_set'][$x]['custom_alttag'] == ""){$altCombo1 = $curCatname . " - " . "Before and After  ";}else{${'altCombo1'} = $this->baGallery['ba_set'][$x]['custom_alttag']." - Before and After";}

						if($this->baGallery['ba_set'][$x]['custom_alttag'] == ""){$altA1 = $curCatname . " - " . "After ";}else{${'altA1'} = $this->baGallery['ba_set'][$x]['custom_alttag']." - After" ;}
						
						if($showCatSetDetails == 1){	
							if(isset($catComboIm) && $catComboIm != "") {
								$revCatLandingPageOutput .=  '<li class="revCatImageSet  revSingleCol"><div class="revCatCol1"><a href="'.$this->baseUrl.'?revCatname='.$revCatname.'&revStart='.$revLink.$this->galleryAnchor.'"><span class="revCatImageSetCenter"><img alt="'.$altCombo1.'" src="'.$this->baGallery['ba_set'][$x]['angle1_combo_xl'].'"></span></a></div><div class="revCatCol2">'.$revHead.'<p>'.$this->truncate($this->revPatientDetailPreview($this->baGallery['ba_set'][$x]['oid']), 150).'</p><a href="'.$this->baseUrl.'?revCatname='.$revCatname.'&revStart='.$revLink.$this->galleryAnchor.'" class="revCaseViewLink">View More</a></div></li>';
							} else if(isset($catAfterIm) && $catAfterIm !=""){
							$revCatLandingPageOutput .=  '<li class="revCatImageSet  revSingleCol"><div class="revCatCol1"><a href="'.$this->baseUrl.'?revCatname='.$revCatname.'&revStart='.$revLink.$this->galleryAnchor.'"><span class="revCatImageSetLeft"><img alt="'.$altB1.'" src="'.$this->baGallery['ba_set'][$x]['image_before_xl'].'"></span><span class="revCatImageSetRight"><img alt="'.$altA1.'" src="'.$catAfterIm.'"></span></a></div><div class="revCatCol2">'.$revHead.'<p>'.$this->truncate($this->revPatientDetailPreview($this->baGallery['ba_set'][$x]['oid']), 150).'</p><a href="'.$this->baseUrl.'?revCatname='.$revCatname.'&revStart='.$revLink.$this->galleryAnchor.'" class="revCaseViewLink">View More</a></div></li>';
							}else {
								$revCatLandingPageOutput .=  '<li class="revCatImageSet  revSingleCol"><div class="revCatCol1"><a href="'.$this->baseUrl.'?revCatname='.$revCatname.'&revStart='.$revLink.$this->galleryAnchor.'"><span class="revCatImageSetCenter"><img alt="'.$altB1.'" src="'.$this->baGallery['ba_set'][$x]['image_before_single'].'"></span></a></div><div class="revCatCol2">'.$revHead.'<p>'.$this->truncate($this->revPatientDetailPreview($this->baGallery['ba_set'][$x]['oid']), 150).'</p><a href="'.$this->baseUrl.'?revCatname='.$revCatname.'&revStart='.$revLink.$this->galleryAnchor.'" class="revCaseViewLink">View More</a></div></li>';
							}
						} else{
							if(isset($catComboIm) && $catComboIm != "") {
								$revCatLandingPageOutput .=  '<li class="revCatImageSet revDoubleCol">'.$revHead.'<a href="'.$this->baseUrl.'?revCatname='.$revCatname.'&revStart='.$revLink.$this->galleryAnchor.'"><span class="revCatImageSetCenter"><img alt="'.$altCombo1.'"  src="'.$this->baGallery['ba_set'][$x]['angle1_combo_xl'].'"></span></a></li>';
							} else if(isset($catAfterIm) && $catAfterIm !=""){
							$revCatLandingPageOutput .=  '<li class="revCatImageSet revDoubleCol">'.$revHead.'<a href="'.$this->baseUrl.'?revCatname='.$revCatname.'&revStart='.$revLink.$this->galleryAnchor.'"><span class="revCatImageSetLeft"><img alt="'.$altB1.'" src="'.$this->baGallery['ba_set'][$x]['image_before_xl'].'"></span><span class="revCatImageSetRight"><img alt="'.$altA1.'" src="'.$catAfterIm.'"></span></a></li>';
							}else {
								$revCatLandingPageOutput .=  '<li class="revCatImageSet revDoubleCol">'.$revHead.'<a href="'.$this->baseUrl.'?revCatname='.$revCatname.'&revStart='.$revLink.$this->galleryAnchor.'"><span class="revCatImageSetCenter"><img alt="'.$altB1.'"  src="'.$this->baGallery['ba_set'][$x]['image_before_single'].'"></span></a></li>';
							}
						}
						
						
						
						}
					}
				}	
				
				$revCatLandingPageOutput .=  '<li class="revCatImageSet" style="display:none"><a class="revJscroll-next" href="'.$this->baseUrl.'?revCatname='.$revCatname.'&getCategorySets=1&categorySetsStart=1" rel="nofollow">More</a></li>';
				
	
  		$revCatLandingPageOutput .=  '</ul><div class="clearfixer"></div></div>';
		return $revCatLandingPageOutput;
	}
	
	function revCategoryLandingPageImageSets($revCatname, $categorySetsStart){
		$revCatname = $this->cleanCat($revCatname);
		$catStart = $categorySetsStart +1;
		
		$revCategoryLandingPageImageSetsOutput;
		
		if(isset($categorySetsStart) && isset($categorySetsStart) != ""){
			$categorySetsStart = $this->categoryImageSetLimit*$categorySetsStart;
		}else{
		$categorySetsStart = 0;
		}

		if(isset($this->categoryImageSetLimit) && $this->categoryImageSetLimit != 0 && $this->categoryImageSetLimit != "" ){
			if($this->categoryImageSetLimit < count($this->baGallery['ba_set'])){
			$recordLimit = $categorySetsStart+$this->categoryImageSetLimit;
			} else{
			$recordLimit = count($this->baGallery['ba_set']);	
			}
		} else {
			$recordLimit = count($this->baGallery['ba_set']);
		}

		for ($x=$categorySetsStart; $x<$recordLimit; $x++){
				if(isset($this->baGallery['ba_set'][$x]['oid'])){
					if($this->urlRewrite == true){  
						if(isset($this->baGallery['ba_set'][$x]['permalink'])){
							$revLink = $this->baGallery['ba_set'][$x]['permalink'];
						} else {
							$revLink = $this->baGallery['ba_set'][$x]['oid'];
						}
						
						if(isset($this->baGallery['ba_set'][$x]['image_after_2_xl']) && $this->baGallery['ba_set'][$x]['image_after_2_xl'] != ""){
							$catAfterIm = $this->baGallery['ba_set'][$x]['image_after_2_xl'];	
						} else{
							$catAfterIm = $this->baGallery['ba_set'][$x]['image_after_xl'];	
						}
						
						if(isset($this->baGallery['ba_set'][$x]['angle1_combo_xl']) && $this->baGallery['ba_set'][$x]['angle1_combo_xl'] != ""){
							$catComboIm = $this->baGallery['ba_set'][$x]['angle1_combo_xl'];
						} else{$catComboIm = "";}
						
						//get headline string for Alts
						$curCatname = $this->revGetHeadline($revCatname, $this->baGallery['ba_set'][$x]['oid']);
		
						//set custom ALT tags

						if(isset($catAfterIm) && $catAfterIm !=""){
							if($this->baGallery['ba_set'][$x]['custom_alttag'] == ""){$altB1 = $curCatname . " - " . "Before ";}else{${'altB1'} = $this->baGallery['ba_set'][$x]['custom_alttag']." - Before";}
						} else{
							if($this->baGallery['ba_set'][$x]['custom_alttag'] == ""){$altB1 = $curCatname . " - " . "Before and After ";}else{${'altB1'} = $this->baGallery['ba_set'][$x]['custom_alttag']." - Before and After";}
						}
						
						if($this->baGallery['ba_set'][$x]['custom_alttag'] == ""){$altCombo1 = $curCatname . " - " . "Before and After  ";}else{${'altCombo1'} = $this->baGallery['ba_set'][$x]['custom_alttag']." - Before and After";}

						if($this->baGallery['ba_set'][$x]['custom_alttag'] == ""){$altA1 = $curCatname . " - " . "After ";}else{${'altA1'} = $this->baGallery['ba_set'][$x]['custom_alttag']." - After" ;}
						
						
						$revHead = '<h2>'.$this->revGetHeadline($revCatname, $this->baGallery['ba_set'][$x]['oid']).' </h2>';
						
						
						if($this->showCatSetDetails == 1){
							if(isset($catComboIm) && $catComboIm != "") {
								$revCategoryLandingPageImageSetsOutput .=  '<li class="revCatImageSet  revSingleCol"><div class="revCatCol1"><a href="'.$this->baseUrl.$revCatname.'/'.$revLink.'/'.$this->galleryAnchor.'"><span class="revCatImageSetCenter"><img alt="'.$altCombo1.'" src="'.$this->baGallery['ba_set'][$x]['angle1_combo_xl'].'"></span></a></div><div class="revCatCol2">'.$revHead.'<p>'.$this->truncate($this->revPatientDetailPreview($this->baGallery['ba_set'][$x]['oid']), 150).'</p><a href="'.$this->baseUrl.$revCatname.'/'.$revLink.'/'.$this->galleryAnchor.'" class="revCaseViewLink">View More</a></div></li>';
							} else if(isset($catAfterIm) && $catAfterIm !=""){
								$revCategoryLandingPageImageSetsOutput .=  '<li class="revCatImageSet revSingleCol"><div class="revCatCol1"><a href="'.$this->baseUrl.$revCatname.'/'.$revLink.'/'.$this->galleryAnchor.'"><span class="revCatImageSetLeft"><img alt="'.$altB1.'" src="'.$this->baGallery['ba_set'][$x]['image_before_xl'].'"></span><span  class="revCatImageSetRight"><img alt="'.$altA1.'"  src="'.$catAfterIm.'"></span></a></div><div class="revCatCol2">'.$revHead.'<p>'.$this->truncate($this->revPatientDetailPreview($this->baGallery['ba_set'][$x]['oid']), 150).'</p><a href="'.$this->baseUrl.$revCatname.'/'.$revLink.'/'.$this->galleryAnchor.'" class="revCaseViewLink">View More</a></div></li>';
							}else {
								$revCategoryLandingPageImageSetsOutput .=  '<li class="revCatImageSet  revSingleCol"><div class="revCatCol1"><a href="'.$this->baseUrl.$revCatname.'/'.$revLink.'/'.$this->galleryAnchor.'"><span class="revCatImageSetCenter"><img alt="'.$altB1.'" src="'.$this->baGallery['ba_set'][$x]['image_before_single'].'"></span></a></div><div class="revCatCol2">'.$revHead.'<p>'.$this->truncate($this->revPatientDetailPreview($this->baGallery['ba_set'][$x]['oid']), 150).'</p><a href="'.$this->baseUrl.$revCatname.'/'.$revLink.'/'.$this->galleryAnchor.'" class="revCaseViewLink">View More</a></div></li>';
							}
						} else{
							if(isset($catComboIm) && $catComboIm != "") {
								$revCategoryLandingPageImageSetsOutput .=  '<li class="revCatImageSet revDoubleCol">'.$revHead.'<a href="'.$this->baseUrl.$revCatname.'/'.$revLink.'/'.$this->galleryAnchor.'"><span class="revCatImageSetCenter"><img alt="'.$altCombo1.'" src="'.$this->baGallery['ba_set'][$x]['angle1_combo_xl'].'"></span></a></li>';
							} else if(isset($catAfterIm) && $catAfterIm !=""){
								$revCategoryLandingPageImageSetsOutput .=  '<li class="revCatImageSet revDoubleCol">'.$revHead.'<a href="'.$this->baseUrl.$revCatname.'/'.$revLink.'/'.$this->galleryAnchor.'"><span class="revCatImageSetLeft"><img alt="'.$altB1.'" src="'.$this->baGallery['ba_set'][$x]['image_before_xl'].'"></span><span  class="revCatImageSetRight"><img alt="'.$altA1.'" src="'.$catAfterIm.'"></span></a></li>';
							}else {
								$revCategoryLandingPageImageSetsOutput .=  '<li class="revCatImageSet revDoubleCol">'.$revHead.'<a href="'.$this->baseUrl.$revCatname.'/'.$revLink.'/'.$this->galleryAnchor.'"><span class="revCatImageSetCenter"><img alt="'.$altB1.'" src="'.$this->baGallery['ba_set'][$x]['image_before_single'].'"></span></a></li>';
							}
							
						}
						
						
						} else {
							if(isset($this->baGallery['ba_set'][$x]['permalink'])){
							$revLink = $this->baGallery['ba_set'][$x]['permalink'];
						} else {
							$revLink = $this->baGallery['ba_set'][$x]['oid'];
						}
							
							if(isset($this->baGallery['ba_set'][$x]['image_after_2_xl']) && $this->baGallery['ba_set'][$x]['image_after_2_xl'] != ""){
							$catAfterIm = $this->baGallery['ba_set'][$x]['image_after_2_xl'];	
						} else{
							$catAfterIm = $this->baGallery['ba_set'][$x]['image_after_xl'];	
						}	
						
						if(isset($this->baGallery['ba_set'][$x]['angle1_combo_xl']) && $this->baGallery['ba_set'][$x]['angle1_combo_xl'] != ""){
							$catComboIm = $this->baGallery['ba_set'][$x]['angle1_combo_xl'];
						} else{$catComboIm = "";}
						
						//get headline string for Alts
						$curCatname = $this->revGetHeadline($revCatname, $this->baGallery['ba_set'][$x]['oid']);
		
						//set custom ALT tags

						
						if(isset($catAfterIm) && $catAfterIm !=""){
							if($this->baGallery['ba_set'][$x]['custom_alttag'] == ""){$altB1 = $curCatname . " - " . "Before ";}else{${'altB1'} = $this->baGallery['ba_set'][$x]['custom_alttag']." - Before";}
						} else{
							if($this->baGallery['ba_set'][$x]['custom_alttag'] == ""){$altB1 = $curCatname . " - " . "Before and After ";}else{${'altB1'} = $this->baGallery['ba_set'][$x]['custom_alttag']." - Before and After";}
						}
						
						if($this->baGallery['ba_set'][$x]['custom_alttag'] == ""){$altCombo1 = $curCatname . " - " . "Before and After  ";}else{${'altCombo1'} = $this->baGallery['ba_set'][$x]['custom_alttag']." - Before and After";}

						if($this->baGallery['ba_set'][$x]['custom_alttag'] == ""){$altA1 = $curCatname . " - " . "After ";}else{${'altA1'} = $this->baGallery['ba_set'][$x]['custom_alttag']." - After" ;}
						
						
						if($this->showCatSetDetails == 1){	
							if(isset($catComboIm) && $catComboIm != ""){
								$revCategoryLandingPageImageSetsOutput .=  '<li class="revCatImageSet revSingleCol"><div class="revCatCol1"><a href="'.$this->baseUrl.'?revCatname='.$revCatname.'&revStart='.$revLink.$this->galleryAnchor.'"><span class="revCatImageSetCenter"><img alt="'.$altCombo1.'" src="'.$this->baGallery['ba_set'][$x]['angle1_combo_xl'].'"></span></a></div><div class="revCatCol2">'.$revHead.'<p>'.$this->truncate($this->revPatientDetailPreview($this->baGallery['ba_set'][$x]['oid']), 150).'</p><a href="'.$this->baseUrl.'?revCatname='.$revCatname.'&revStart='.$revLink.$this->galleryAnchor.'" class="revCaseViewLink">View More</a></div></li>';
							} else if(isset($catAfterIm) && $catAfterIm !=""){
								$revCategoryLandingPageImageSetsOutput .=  '<li class="revCatImageSet revSingleCol"><div class="revCatCol1"><a href="'.$this->baseUrl.'?revCatname='.$revCatname.'&revStart='.$revLink.$this->galleryAnchor.'"><span class="revCatImageSetLeft"><img alt="'.$altB1.'" src="'.$this->baGallery['ba_set'][$x]['image_before_xl'].'"></span><span class="revCatImageSetRight"><img alt="'.$altA1.'" src="'.$catAfterIm.'"></span></a></div><div class="revCatCol2">'.$revHead.'<p>'.$this->truncate($this->revPatientDetailPreview($this->baGallery['ba_set'][$x]['oid']), 150).'</p><a href="'.$this->baseUrl.'?revCatname='.$revCatname.'&revStart='.$revLink.$this->galleryAnchor.'" class="revCaseViewLink">View More</a></div></li>';
							}else {
								$revCategoryLandingPageImageSetsOutput .=  '<li class="revCatImageSet revSingleCol"><div class="revCatCol1"><a href="'.$this->baseUrl.'?revCatname='.$revCatname.'&revStart='.$revLink.$this->galleryAnchor.'"><span class="revCatImageSetCenter"><img alt="'.$altB1.'" src="'.$this->baGallery['ba_set'][$x]['image_before_single'].'"></span></a></div><div class="revCatCol2">'.$revHead.'<p>'.$this->truncate($this->revPatientDetailPreview($this->baGallery['ba_set'][$x]['oid']), 150).'</p><a href="'.$this->baseUrl.'?revCatname='.$revCatname.'&revStart='.$revLink.$this->galleryAnchor.'" class="revCaseViewLink">View More</a></div></li>';
							}
						} else{
							if(isset($catComboIm) && $catComboIm != ""){
								$revCategoryLandingPageImageSetsOutput .=  '<li class="revCatImageSet revDoubleCol">'.$revHead.'<a href="'.$this->baseUrl.'?revCatname='.$revCatname.'&revStart='.$revLink.$this->galleryAnchor.'"><span class="revCatImageSetCenter"><img alt="'.$altCombo1.'" src="'.$this->baGallery['ba_set'][$x]['angle1_combo_xl'].'"></span></a></li>';
							}if(isset($catAfterIm) && $catAfterIm !=""){
								$revCategoryLandingPageImageSetsOutput .=  '<li class="revCatImageSet revDoubleCol">'.$revHead.'<a href="'.$this->baseUrl.'?revCatname='.$revCatname.'&revStart='.$revLink.$this->galleryAnchor.'"><span class="revCatImageSetLeft"><img alt="'.$altB1.'" src="'.$this->baGallery['ba_set'][$x]['image_before_xl'].'"></span><span class="revCatImageSetRight"><img alt="'.$altA1.'" src="'.$catAfterIm.'"></span></a></li>';
							}else {
								$revCategoryLandingPageImageSetsOutput .=  '<li class="revCatImageSet revDoubleCol">'.$revHead.'<a href="'.$this->baseUrl.'?revCatname='.$revCatname.'&revStart='.$revLink.$this->galleryAnchor.'"><span class="revCatImageSetCenter"><img alt="'.$altB1.'" src="'.$this->baGallery['ba_set'][$x]['image_before_single'].'"></span></a></li>';
							}
						}
						
						
						}
					}
				}	
				if(($this->categoryImageSetLimit*$catStart) < count($this->baGallery['ba_set'])){
				$revCategoryLandingPageImageSetsOutput .=  '<li class="revCatImageSet" style="display:none"><a class="revJscroll-next" href="'.$this->baseUrl.'?revCatname='.$revCatname.'&getCategorySets=1&categorySetsStart='.$catStart.'" rel="nofollow">More</a></li>';
				}

				return $revCategoryLandingPageImageSetsOutput;
		}
	
	
	//get first set of each set from a category as a list
	function revCategoryList($revCatname, $categorySetsStart, $revShowHeadline){
		$revCatname = $this->cleanCat($revCatname);
		$catStart = $categorySetsStart +1;
		
		$revCategoryLandingPageImageSetsOutput = "<ul id='revCategoryImageSets'>";
		
		if(isset($categorySetsStart)){
			$categorySetsStart = $this->categoryImageSetLimit*$categorySetsStart;
		}else{
		$categorySetsStart = 0;
		}

		if(isset($this->categoryImageSetLimit) && $this->categoryImageSetLimit != 0 && $this->categoryImageSetLimit != "" ){
			if($this->categoryImageSetLimit < count($this->baGallery['ba_set'])){
			$recordLimit = $categorySetsStart+$this->categoryImageSetLimit;
			} else{
			$recordLimit = count($this->baGallery['ba_set']);	
			}
		} else {
			$recordLimit = count($this->baGallery['ba_set']);
		}

		for ($x=$categorySetsStart; $x<$recordLimit; $x++){
				if(isset($this->baGallery['ba_set'][$x]['oid'])){
					if($this->urlRewrite == true){  
						if(isset($this->baGallery['ba_set'][$x]['permalink'])){
							$revLink = $this->baGallery['ba_set'][$x]['permalink'];
						} else {
							$revLink = $this->baGallery['ba_set'][$x]['oid'];
						}
						
						if(isset($this->baGallery['ba_set'][$x]['image_after_2_xl']) && $this->baGallery['ba_set'][$x]['image_after_2_xl'] != ""){
							$catAfterIm = $this->baGallery['ba_set'][$x]['image_after_2_xl'];	
						} else{
							$catAfterIm = $this->baGallery['ba_set'][$x]['image_after_xl'];	
						}
						
						//get headline string for Alts
						$curCatname = $this->revGetHeadline($revCatname, $this->baGallery['ba_set'][$x]['oid']);
		
						//set custom ALT tags

						if(isset($catAfterIm) && $catAfterIm !=""){
							if($this->baGallery['ba_set'][$x]['custom_alttag'] == ""){$altB1 = $curCatname . " - " . "Before ";}else{${'altB1'} = $this->baGallery['ba_set'][$x]['custom_alttag']." - Before";}
						} else{
							if($this->baGallery['ba_set'][$x]['custom_alttag'] == ""){$altB1 = $curCatname . " - " . "Before and After ";}else{${'altB1'} = $this->baGallery['ba_set'][$x]['custom_alttag']." - Before and After";}
						}
						
						if($this->baGallery['ba_set'][$x]['custom_alttag'] == ""){$altCombo1 = $curCatname . " - " . "Before and After  ";}else{${'altCombo1'} = $this->baGallery['ba_set'][$x]['custom_alttag']." - Before and After";}
						
						if(isset($this->baGallery['ba_set'][$x]['angle1_combo_xl']) && $this->baGallery['ba_set'][$x]['angle1_combo_xl'] != ""){
							$catComboIm = $this->baGallery['ba_set'][$x]['angle1_combo_xl'];
						} else{$catComboIm = "";}

						if($this->baGallery['ba_set'][$x]['custom_alttag'] == ""){$altA1 = $curCatname . " - " . "After ";}else{${'altA1'} = $this->baGallery['ba_set'][$x]['custom_alttag']." - After" ;}
						
						if($revShowHeadline != ""){$revHead = '<h2>'.$this->revGetHeadline($revCatname, $this->baGallery['ba_set'][$x]['oid']).' </h2>';} else{$revHead = ""; };
						
						
						if($this->showCatSetDetails == 1){
							if(isset($catComboIm) && $catComboIm != ""){
								$revCategoryLandingPageImageSetsOutput .=  '<li class="revCatImageSet  revSingleCol"><div class="revCatCol1"><a href="'.$this->baseUrl.$revCatname.'/'.$revLink.'/'.$this->galleryAnchor.'"><span class="revCatImageSetCenter"><img alt="'.$altCombo1.'" src="'.$this->baGallery['ba_set'][$x]['angle1_combo_xl'].'"></span></a></div><div class="revCatCol2">'.$revHead.'<p>'.$this->truncate($this->revPatientDetailPreview($this->baGallery['ba_set'][$x]['oid']), 150).'</p><a href="'.$this->baseUrl.$revCatname.'/'.$revLink.'/'.$this->galleryAnchor.'" class="revCaseViewLink">View More</a></div></li>';
							} else if(isset($catAfterIm) && $catAfterIm !=""){
								$revCategoryLandingPageImageSetsOutput .=  '<li class="revCatImageSet revSingleCol"><div class="revCatCol1"><a href="'.$this->baseUrl.$revCatname.'/'.$revLink.'/'.$this->galleryAnchor.'"><span class="revCatImageSetLeft"><img alt="'.$altB1.'" src="'.$this->baGallery['ba_set'][$x]['image_before_xl'].'"></span><span  class="revCatImageSetRight"><img alt="'.$altA1.'" src="'.$catAfterIm.'"></span></a></div><div class="revCatCol2">'.$revHead.'<p>'.$this->truncate($this->revPatientDetailPreview($this->baGallery['ba_set'][$x]['oid']), 150).'</p><a href="'.$this->baseUrl.$revCatname.'/'.$revLink.'/'.$this->galleryAnchor.'" class="revCaseViewLink">View More</a></div></li>';
							}else {
								$revCategoryLandingPageImageSetsOutput .=  '<li class="revCatImageSet  revSingleCol"><div class="revCatCol1"><a href="'.$this->baseUrl.$revCatname.'/'.$revLink.'/'.$this->galleryAnchor.'"><span class="revCatImageSetCenter"><img alt="'.$altB1.'" src="'.$this->baGallery['ba_set'][$x]['image_before_single'].'"></span></a></div><div class="revCatCol2">'.$revHead.'<p>'.$this->truncate($this->revPatientDetailPreview($this->baGallery['ba_set'][$x]['oid']), 150).'</p><a href="'.$this->baseUrl.$revCatname.'/'.$revLink.'/'.$this->galleryAnchor.'" class="revCaseViewLink">View More</a></div></li>';
							}
						} else{
							if(isset($catComboIm) && $catComboIm != ""){
								$revCategoryLandingPageImageSetsOutput .=  '<li class="revCatImageSet revDoubleCol">'.$revHead.'<a href="'.$this->baseUrl.$revCatname.'/'.$revLink.'/'.$this->galleryAnchor.'"><span class="revCatImageSetCenter"><img alt="'.$altCombo1.'" src="'.$this->baGallery['ba_set'][$x]['angle1_combo_xl'].'"></span></a></li>';
							} else if(isset($catAfterIm) && $catAfterIm !=""){
								$revCategoryLandingPageImageSetsOutput .=  '<li class="revCatImageSet revDoubleCol">'.$revHead.'<a href="'.$this->baseUrl.$revCatname.'/'.$revLink.'/'.$this->galleryAnchor.'"><span class="revCatImageSetLeft"><img alt="'.$altB1.'" src="'.$this->baGallery['ba_set'][$x]['image_before_xl'].'"></span><span  class="revCatImageSetRight"><img alt="'.$altA1.'" src="'.$catAfterIm.'"></span></a></li>';
							}else {
								$revCategoryLandingPageImageSetsOutput .=  '<li class="revCatImageSet revDoubleCol">'.$revHead.'<a href="'.$this->baseUrl.$revCatname.'/'.$revLink.'/'.$this->galleryAnchor.'"><span class="revCatImageSetCenter"><img alt="'.$altB1.'" src="'.$this->baGallery['ba_set'][$x]['image_before_single'].'"></span></a></li>';
							}
							
						}
						
						
						} else {
							if(isset($this->baGallery['ba_set'][$x]['permalink'])){
							$revLink = $this->baGallery['ba_set'][$x]['permalink'];
						} else {
							$revLink = $this->baGallery['ba_set'][$x]['oid'];
						}
							
							if(isset($this->baGallery['ba_set'][$x]['image_after_2_xl']) && $this->baGallery['ba_set'][$x]['image_after_2_xl'] != ""){
							$catAfterIm = $this->baGallery['ba_set'][$x]['image_after_2_xl'];	
						} else{
							$catAfterIm = $this->baGallery['ba_set'][$x]['image_after_xl'];	
						}	
						
						if(isset($this->baGallery['ba_set'][$x]['angle1_combo_xl']) && $this->baGallery['ba_set'][$x]['angle1_combo_xl'] != ""){
							$catComboIm = $this->baGallery['ba_set'][$x]['angle1_combo_xl'];
						} else{$catComboIm = "";}
						
						//get headline string for Alts
						$curCatname = $this->revGetHeadline($revCatname, $this->baGallery['ba_set'][$x]['oid']);
		
						//set custom ALT tags

						if(isset($catAfterIm) && $catAfterIm !=""){
							if($this->baGallery['ba_set'][$x]['custom_alttag'] == ""){$altB1 = $curCatname . " - " . "Before ";}else{${'altB1'} = $this->baGallery['ba_set'][$x]['custom_alttag']." - Before";}
						} else{
							if($this->baGallery['ba_set'][$x]['custom_alttag'] == ""){$altB1 = $curCatname . " - " . "Before and After ";}else{${'altB1'} = $this->baGallery['ba_set'][$x]['custom_alttag']." - Before and After";}
						}
						
						if($this->baGallery['ba_set'][$x]['custom_alttag'] == ""){$altCombo1 = $curCatname . " - " . "Before and After  ";}else{${'altCombo1'} = $this->baGallery['ba_set'][$x]['custom_alttag']." - Before and After";}

						if($this->baGallery['ba_set'][$x]['custom_alttag'] == ""){$altA1 = $curCatname . " - " . "After ";}else{${'altA1'} = $this->baGallery['ba_set'][$x]['custom_alttag']." - After" ;}
						
						
						if($this->showCatSetDetails == 1){	
							if(isset($catComboIm) && $catComboIm != ""){
								$revCategoryLandingPageImageSetsOutput .=  '<li class="revCatImageSet revSingleCol"><div class="revCatCol1"><a href="'.$this->baseUrl.'?revCatname='.$revCatname.'&revStart='.$revLink.$this->galleryAnchor.'"><span class="revCatImageSetCenter"><img alt="'.$altCombo1.'" src="'.$this->baGallery['ba_set'][$x]['angle1_combo_xl'].'"></span></a></div><div class="revCatCol2">'.$revHead.'<p>'.$this->truncate($this->revPatientDetailPreview($this->baGallery['ba_set'][$x]['oid']), 150).'</p><a href="'.$this->baseUrl.'?revCatname='.$revCatname.'&revStart='.$revLink.$this->galleryAnchor.'" class="revCaseViewLink">View More</a></div></li>';
							} else if(isset($catAfterIm) && $catAfterIm !=""){
							$revCategoryLandingPageImageSetsOutput .=  '<li class="revCatImageSet revSingleCol"><div class="revCatCol1"><a href="'.$this->baseUrl.'?revCatname='.$revCatname.'&revStart='.$revLink.$this->galleryAnchor.'"><span class="revCatImageSetLeft"><img alt="'.$altB1.'" src="'.$this->baGallery['ba_set'][$x]['image_before_xl'].'"></span><span class="revCatImageSetRight"><img alt="'.$altA1.'" src="'.$catAfterIm.'"></span></a></div><div class="revCatCol2">'.$revHead.'<p>'.$this->truncate($this->revPatientDetailPreview($this->baGallery['ba_set'][$x]['oid']), 150).'</p><a href="'.$this->baseUrl.'?revCatname='.$revCatname.'&revStart='.$revLink.$this->galleryAnchor.'" class="revCaseViewLink">View More</a></div></li>';
							}else {
								$revCategoryLandingPageImageSetsOutput .=  '<li class="revCatImageSet revSingleCol"><div class="revCatCol1"><a href="'.$this->baseUrl.'?revCatname='.$revCatname.'&revStart='.$revLink.$this->galleryAnchor.'"><span class="revCatImageSetCenter"><img alt="'.$altB1.'" src="'.$this->baGallery['ba_set'][$x]['image_before_single'].'"></span></a></div><div class="revCatCol2">'.$revHead.'<p>'.$this->truncate($this->revPatientDetailPreview($this->baGallery['ba_set'][$x]['oid']), 150).'</p><a href="'.$this->baseUrl.'?revCatname='.$revCatname.'&revStart='.$revLink.$this->galleryAnchor.'" class="revCaseViewLink">View More</a></div></li>';
							}
						} else{
							if(isset($catComboIm) && $catComboIm != ""){
								$revCategoryLandingPageImageSetsOutput .=  '<li class="revCatImageSet revDoubleCol">'.$revHead.'<a href="'.$this->baseUrl.'?revCatname='.$revCatname.'&revStart='.$revLink.$this->galleryAnchor.'"><span class="revCatImageSetCenter"><img alt="'.$altCombo1.'" src="'.$this->baGallery['ba_set'][$x]['angle1_combo_xl'].'"></span></a></li>';
							} else if(isset($catAfterIm) && $catAfterIm !=""){
								$revCategoryLandingPageImageSetsOutput .=  '<li class="revCatImageSet revDoubleCol">'.$revHead.'<a href="'.$this->baseUrl.'?revCatname='.$revCatname.'&revStart='.$revLink.$this->galleryAnchor.'"><span class="revCatImageSetLeft"><img alt="'.$altB1.'" src="'.$this->baGallery['ba_set'][$x]['image_before_xl'].'"></span><span class="revCatImageSetRight"><img alt="'.$altA1.'" src="'.$catAfterIm.'"></span></a></li>';
							}else {
								$revCategoryLandingPageImageSetsOutput .=  '<li class="revCatImageSet revDoubleCol">'.$revHead.'<a href="'.$this->baseUrl.'?revCatname='.$revCatname.'&revStart='.$revLink.$this->galleryAnchor.'"><span class="revCatImageSetCenter"><img alt="'.$altB1.'" src="'.$this->baGallery['ba_set'][$x]['image_before_single'].'"></span></a></li>';
							}
						}
						
						
						}
					}
				}	
		
				$revCategoryLandingPageImageSetsOutput .= "</ul>";

				return $revCategoryLandingPageImageSetsOutput;
		}
	
	//create random name sequence
	function create_random_name($len){
			$s="";
			$i=0;
			do {
				switch(mt_rand(1,3)) {
					// get number - ASCII characters (0:48 through 9:57)
					case 1:
						$s .= chr(mt_rand(48,57));
						$i++;
						break;
		
					// get uppercase letter - ASCII characters (a:65 through z:90)
					case 2:
						$s .= chr(mt_rand(65,90));
						$i++;
						break;
		
					// get lowercase letter - ASCII characters (A:97 through Z:122)
					case 3:
						$s .= chr(mt_rand(97,122));
						$i++;
						break;
				}
			} while ($i<$len);
			return $s;
		}
	
	//get first set of each set from a category as a list
	function revCategorySliderOutput($revCatname, $categorySetsStart, $revTitle){
		$revCatname = $this->cleanCat($revCatname);
		$catStart = $categorySetsStart +1;
		
		$randomName= $this->create_random_name(6);
		
		$revCategoryLandingPageImageSetsOutput = "<div id='bragbookSlider".$randomName."' class='bragSlider'>";
		
				if(isset($categorySetsStart) && $categorySetsStart != "" && isset($this->categoryImageSetLimit) && $this->categoryImageSetLimit != 0 && $this->categoryImageSetLimit != "" ){
			$categorySetsStart = $this->categoryImageSetLimit*$categorySetsStart;
		}else{
			$categorySetsStart = 0;
		}

		if(isset($this->categoryImageSetLimit) && $this->categoryImageSetLimit != 0 && $this->categoryImageSetLimit != "" ){
			if($this->categoryImageSetLimit < count($this->baGallery['ba_set'])){
			$recordLimit = $categorySetsStart+$this->categoryImageSetLimit;
			} else{
			$recordLimit = count($this->baGallery['ba_set']);	
			}
		} else {
			$recordLimit = count($this->baGallery['ba_set']);
		}

		for ($x=$categorySetsStart; $x<$recordLimit; $x++){
				if(isset($this->baGallery['ba_set'][$x]['oid'])){
					if($this->urlRewrite == true){  
						if(isset($this->baGallery['ba_set'][$x]['permalink'])){
							$revLink = $this->baGallery['ba_set'][$x]['permalink'];
						} else {
							$revLink = $this->baGallery['ba_set'][$x]['oid'];
						}
						
						if(isset($this->baGallery['ba_set'][$x]['image_after_2_sm']) && $this->baGallery['ba_set'][$x]['image_after_2_sm'] != ""){
							$catAfterIm = $this->baGallery['ba_set'][$x]['image_after_2_sm'];	
						} else{
							$catAfterIm = $this->baGallery['ba_set'][$x]['image_after_sm'];	
						}
						
						//get headline string for Alts
						$curCatname = $this->revGetHeadline($revCatname, $this->baGallery['ba_set'][$x]['oid']);
		
						//set custom ALT tags

						if(isset($catAfterIm) && $catAfterIm !=""){
							if($this->baGallery['ba_set'][$x]['custom_alttag'] == ""){$altB1 = $curCatname . " - " . "Before ";}else{${'altB1'} = $this->baGallery['ba_set'][$x]['custom_alttag']." - Before";}
						} else{
							if($this->baGallery['ba_set'][$x]['custom_alttag'] == ""){$altB1 = $curCatname . " - " . "Before and After ";}else{${'altB1'} = $this->baGallery['ba_set'][$x]['custom_alttag']." - Before and After";}
						}
						
						if($this->baGallery['ba_set'][$x]['custom_alttag'] == ""){$altCombo1 = $curCatname . " - " . "Before and After  ";}else{${'altCombo1'} = $this->baGallery['ba_set'][$x]['custom_alttag']." - Before and After";}
						
						if(isset($this->baGallery['ba_set'][$x]['angle1_combo_xl']) && $this->baGallery['ba_set'][$x]['angle1_combo_xl'] != ""){
							$catComboIm = $this->baGallery['ba_set'][$x]['angle1_combo_xl'];
						} else{$catComboIm = "";}

						if($this->baGallery['ba_set'][$x]['custom_alttag'] == ""){$altA1 = $curCatname . " - " . "After ";}else{${'altA1'} = $this->baGallery['ba_set'][$x]['custom_alttag']." - After" ;}
						
						if($revTitle == 1){$revHead = '<h2>'.$this->revGetHeadline($revCatname, $this->baGallery['ba_set'][$x]['oid']).' </h2>';} else{$revHead = "";};
						
						
						if($this->showCatSetDetails == 1){
							if(isset($catComboIm) && $catComboIm != ""){
								$revCategoryLandingPageImageSetsOutput .=  '<div class="revSlideImageSet  revSlideSingleCol"><div class="revDetailsDiv"><a href="'.$this->baseUrl.$revCatname.'/'.$revLink.'/'.$this->galleryAnchor.'"><span class="revSlideImageSetCenter"><img loading="lazy"  alt="'.$altCombo1.'" src="'.$this->baGallery['ba_set'][$x]['angle1_combo_xl'].'"></span></a>'.$revHead.'<p>'.$this->truncate($this->revPatientDetailPreview($this->baGallery['ba_set'][$x]['oid']), 150).'</p><a href="'.$this->baseUrl.$revCatname.'/'.$revLink.'/'.$this->galleryAnchor.'" class="revSlideCaseViewLink">View More</a></div></div>';
							} else if(isset($catAfterIm) && $catAfterIm !=""){
								$revCategoryLandingPageImageSetsOutput .=  '<div class="revSlideImageSet revSlideSingleCol"><div class="revDetailsDiv"><a href="'.$this->baseUrl.$revCatname.'/'.$revLink.'/'.$this->galleryAnchor.'"><span class="revSlideImageSetLeft"><img loading="lazy" alt="'.$altB1.'" src="'.$this->baGallery['ba_set'][$x]['image_before_sm'].'"></span><span  class="revSlideImageSetRight"><img loading="lazy" alt="'.$altA1.'" src="'.$catAfterIm.'"></span></a>'.$revHead.'<p>'.$this->truncate($this->revPatientDetailPreview($this->baGallery['ba_set'][$x]['oid']), 150).'</p><a href="'.$this->baseUrl.$revCatname.'/'.$revLink.'/'.$this->galleryAnchor.'" class="revSlideCaseViewLink">View More</a></div></div>';
							}else {
								$revCategoryLandingPageImageSetsOutput .=  '<div class="revSlideImageSet  revSlideSingleCol"><div class="revDetailsDiv"><a href="'.$this->baseUrl.$revCatname.'/'.$revLink.'/'.$this->galleryAnchor.'"><span class="revSlideImageSetCenter"><img loading="lazy"  alt="'.$altB1.'" src="'.$this->baGallery['ba_set'][$x]['image_before_single'].'"></span></a>'.$revHead.'<p>'.$this->truncate($this->revPatientDetailPreview($this->baGallery['ba_set'][$x]['oid']), 150).'</p><a href="'.$this->baseUrl.$revCatname.'/'.$revLink.'/'.$this->galleryAnchor.'" class="revSlideCaseViewLink">View More</a></div></div>';
							}
						} else{
							if(isset($catComboIm) && $catComboIm != ""){
								$revCategoryLandingPageImageSetsOutput .=  '<div class="revSlideImageSet"><a href="'.$this->baseUrl.$revCatname.'/'.$revLink.'/'.$this->galleryAnchor.'"><span class="revSlideImageSetCenter"><img loading="lazy" alt="'.$altCombo1.'" src="'.$this->baGallery['ba_set'][$x]['angle1_combo_xl'].'"></span></a></div>';
							} else if(isset($catAfterIm) && $catAfterIm !=""){
								$revCategoryLandingPageImageSetsOutput .=  '<div class="revSlideImageSet"><a href="'.$this->baseUrl.$revCatname.'/'.$revLink.'/'.$this->galleryAnchor.'"><span class="revSlideImageSetLeft"><img loading="lazy"  alt="'.$altB1.'" src="'.$this->baGallery['ba_set'][$x]['image_before_sm'].'"></span><span  class="revSlideImageSetRight"><img loading="lazy" alt="'.$altA1.'" src="'.$catAfterIm.'"></span></a></div>';
							}else {
								$revCategoryLandingPageImageSetsOutput .=  '<div class="revSlideImageSet"><a href="'.$this->baseUrl.$revCatname.'/'.$revLink.'/'.$this->galleryAnchor.'"><span class="revSlideImageSetCenter"><img loading="lazy" alt="'.$altB1.'" src="'.$this->baGallery['ba_set'][$x]['image_before_single'].'"></span></a></div>';
							}
							
						}
						
						
						} else {
							if(isset($this->baGallery['ba_set'][$x]['permalink'])){
							$revLink = $this->baGallery['ba_set'][$x]['permalink'];
						} else {
							$revLink = $this->baGallery['ba_set'][$x]['oid'];
						}
							
							if(isset($this->baGallery['ba_set'][$x]['image_after_2_sm']) && $this->baGallery['ba_set'][$x]['image_after_2_sm'] != ""){
							$catAfterIm = $this->baGallery['ba_set'][$x]['image_after_2_sm'];	
						} else{
							$catAfterIm = $this->baGallery['ba_set'][$x]['image_after_sm'];	
						}	
						
						//get headline string for Alts
						$curCatname = $this->revGetHeadline($revCatname, $this->baGallery['ba_set'][$x]['oid']);
		
						//set custom ALT tags

						if(isset($catAfterIm) && $catAfterIm !=""){
							if($this->baGallery['ba_set'][$x]['custom_alttag'] == ""){$altB1 = $curCatname . " - " . "Before ";}else{${'altB1'} = $this->baGallery['ba_set'][$x]['custom_alttag']." - Before";}
						} else{
							if($this->baGallery['ba_set'][$x]['custom_alttag'] == ""){$altB1 = $curCatname . " - " . "Before and After ";}else{${'altB1'} = $this->baGallery['ba_set'][$x]['custom_alttag']." - Before and After";}
						}
						
						if($this->baGallery['ba_set'][$x]['custom_alttag'] == ""){$altCombo1 = $curCatname . " - " . "Before and After  ";}else{${'altCombo1'} = $this->baGallery['ba_set'][$x]['custom_alttag']." - Before and After";}
						
						if(isset($this->baGallery['ba_set'][$x]['angle1_combo_xl']) && $this->baGallery['ba_set'][$x]['angle1_combo_xl'] != ""){
							$catComboIm = $this->baGallery['ba_set'][$x]['angle1_combo_xl'];
						} else{$catComboIm = "";}

						if($this->baGallery['ba_set'][$x]['custom_alttag'] == ""){$altA1 = $curCatname . " - " . "After ";}else{${'altA1'} = $this->baGallery['ba_set'][$x]['custom_alttag']." - After" ;}
						
						
						if($this->showCatSetDetails == 1){	
							if(isset($catComboIm) && $catComboIm != ""){
								$revCategoryLandingPageImageSetsOutput .=  '<div class="revSlideImageSet revSingleCol"><div class="revDetailsDiv"><div class="revCatCol1"><a href="'.$this->baseUrl.'?revCatname='.$revCatname.'&revStart='.$revLink.$this->galleryAnchor.'"><span class="revCatImageSetCenter"><img loading="lazy" alt="'.$altCombo1.'" src="'.$this->baGallery['ba_set'][$x]['angle1_combo_xl'].'"></span></a>'.$revHead.'<p>'.$this->truncate($this->revPatientDetailPreview($this->baGallery['ba_set'][$x]['oid']), 150).'</p><a href="'.$this->baseUrl.'?revCatname='.$revCatname.'&revStart='.$revLink.$this->galleryAnchor.'" class="revSlideCaseViewLink">View More</a></div></div>';
							} else if(isset($catAfterIm) && $catAfterIm !=""){
								$revCategoryLandingPageImageSetsOutput .=  '<div class="revSlideImageSet revSlideSingleCol"><div class="revDetailsDiv"><a href="'.$this->baseUrl.'?revCatname='.$revCatname.'&revStart='.$revLink.$this->galleryAnchor.'"><span class="revCatImageSetLeft"><img loading="lazy"  alt="'.$altB1.'" src="'.$this->baGallery['ba_set'][$x]['image_before_sm'].'"></span><span class="revCatImageSetRight"><img loading="lazy"  alt="'.$altA1.'" src="'.$catAfterIm.'"></span></a>'.$revHead.'<p>'.$this->truncate($this->revPatientDetailPreview($this->baGallery['ba_set'][$x]['oid']), 150).'</p><a href="'.$this->baseUrl.'?revCatname='.$revCatname.'&revStart='.$revLink.$this->galleryAnchor.'" class="revSlideCaseViewLink">View More</a></div></div>';
							}else {
								$revCategoryLandingPageImageSetsOutput .=  '<div class="revSlideImageSet revSingleCol"><div class="revDetailsDiv"><div class="revCatCol1"><a href="'.$this->baseUrl.'?revCatname='.$revCatname.'&revStart='.$revLink.$this->galleryAnchor.'"><span class="revCatImageSetCenter"><img loading="lazy" alt="'.$altB1.'" src="'.$this->baGallery['ba_set'][$x]['image_before_single'].'"></span></a>'.$revHead.'<p>'.$this->truncate($this->revPatientDetailPreview($this->baGallery['ba_set'][$x]['oid']), 150).'</p><a href="'.$this->baseUrl.'?revCatname='.$revCatname.'&revStart='.$revLink.$this->galleryAnchor.'" class="revSlideCaseViewLink">View More</a></div></div>';
							}
						} else{
							if(isset($catComboIm) && $catComboIm != ""){
								$revCategoryLandingPageImageSetsOutput .=  '<div class="revSlideImageSet"><a href="'.$this->baseUrl.'?revCatname='.$revCatname.'&revStart='.$revLink.$this->galleryAnchor.'"><span class="revSlideImageSetCenter"><img loading="lazy"  alt="'.$altCombo1.'" src="'.$this->baGallery['ba_set'][$x]['angle1_combo_xl'].'"></span></a></div>';
							} else if(isset($catAfterIm) && $catAfterIm !=""){
								$revCategoryLandingPageImageSetsOutput .=  '<div class="revSlideImageSet"><a href="'.$this->baseUrl.'?revCatname='.$revCatname.'&revStart='.$revLink.$this->galleryAnchor.'"><span class="revSlideImageSetLeft"><img loading="lazy"  alt="'.$altB1.'" src="'.$this->baGallery['ba_set'][$x]['image_before_sm'].'"></span><span class="revSlideImageSetRight"><img loading="lazy"  alt="'.$altA1.'" src="'.$catAfterIm.'"></span></a></div>';
							}else {
								$revCategoryLandingPageImageSetsOutput .=  '<div class="revSlideImageSet"><a href="'.$this->baseUrl.'?revCatname='.$revCatname.'&revStart='.$revLink.$this->galleryAnchor.'"><span class="revSlideImageSetCenter"><img loading="lazy"  alt="'.$altB1.'" src="'.$this->baGallery['ba_set'][$x]['image_before_single'].'"></span></a></div>';
							}
						}
						
						
						}
					}
				}
				
		
				$revCategoryLandingPageImageSetsOutput .= "</div>";

				return $revCategoryLandingPageImageSetsOutput;
		}
	
	
	//create page headline
	function revHeadline($revCatname, $revID){
		$this->revGetStart($revID);
		
		$revHeadlineOutput;
		
		//check if auto generated patient number should be shown patient number
		if($this->patientAutoNumber == TRUE){$patientnum = ": Patient ".($this->revStart+1);}else{$patientnum = "";}
		
		for ($x=0; $x<count($this->baCats['cat_set']); $x++){
						if($this->cleanCat($revCatname) == $this->cleanCat($this->baCats['cat_set'][$x]['category_name'])){
							$revCatname = $this->baCats['cat_set'][$x]['category_name'];
						}
		}
		
		if($this->baGallery['ba_set'][$this->revStart]['custom_headline']){
			$revHeadlineOutput = $this->baGallery['ba_set'][$this->revStart]['custom_headline'];
		} else {
			$revHeadlineOutput = ucwords($revCatname).$patientnum;
		}
		return $revHeadlineOutput;
	}
	
	//Get page headline
	function revGetHeadline($revCatname, $revID){
		$this->revGetStart($revID);
		
		//check if auto generated patient number should be shown patient number
		if($this->patientAutoNumber == TRUE){$patientnum = ": Patient ".($this->revStart+1);}else{$patientnum = "";}
		
		for ($x=0; $x<count($this->baCats['cat_set']); $x++){
						if($this->cleanCat($revCatname) == $this->cleanCat($this->baCats['cat_set'][$x]['category_name'])){
							$revCatname = $this->baCats['cat_set'][$x]['category_name'];
						}
		}
		
		if($this->baGallery['ba_set'][$this->revStart]['custom_headline']){
			return $this->baGallery['ba_set'][$this->revStart]['custom_headline'];
		} else {
			return ucwords($revCatname).$patientnum;
		}
	}
	
	
	
	
	//create page title
	function revTitle($revCatname, $revID){
		$revTitleOutput;
		
		if($revID != 999999){
		$this->revGetStart($revID);
		}
		$fullCat = $this->fullCatName($revCatname);
		//check if auto generated patient number should be shown patient number
		if($this->patientAutoNumber == TRUE){$patientnum = ": Patient ".($this->revStart+1);}else{$patientnum = "";}
		
		 if($this->revisionSetsOnly == 1){$revisionSet = " - Revision";}else{$revisionSet = "";}
		
		if($revCatname == "Home"){
			$revTitleOutput = $this->revLandingTitle;
		} else if($revID == 999999){
			$revTitleOutput = str_replace('Revision', '- Revision',$this->revCategoryLandingTitle.$fullCat)." Before &amp; After Gallery" ;
		} else {
		if($this->baGallery['ba_set'][$this->revStart]['title_tag']){
			$revTitleOutput = $this->baGallery['ba_set'][$this->revStart]['title_tag'];
		} else {
			$revTitleOutput = str_replace('Revision', '- Revision',str_replace('-', ' ', $fullCat)).' Before &amp; After Gallery'.$patientnum;
		}
		}
		return $revTitleOutput;
	}
	
	
	
	
	//create page description
	function revDescription($revCatname, $revID){
		$revDescriptionOutput;
		if($revID != 999999){
		$this->revGetStart($revID);
		}
		$fullCat = $this->fullCatName($revCatname);
		
		if($revCatname == "Home"){
			$revDescriptionOutput = '<meta name="description" content="'.$this->revLandingDescription.'" />';
		} else if($revID == 999999){
			$revDescriptionOutput = '<meta name="description" content="'.str_replace('Revision', '- Revision',$fullCat)." before and after image gallery. ".$this->revCategoryLandingDescription.'" />' ;
		} else {
		if($this->baGallery['ba_set'][$this->revStart]['description_tag']){
			$revDescriptionOutput = '<meta name="description" content="'.$this->baGallery['ba_set'][$this->revStart]['description_tag'].'" />';
		} else {
			$revDescriptionOutput = '<meta name="description" content="'.$this->defaultDescription.'" />';
		}
		}
		return $revDescriptionOutput;
	}
	
	
	
	//Return Value for page title
	function revTitleReturn($revCatname, $revID){
		if($revID != 999999){
		$this->revGetStart($revID);
		}
		$fullCat = $this->fullCatName($revCatname);
		
		if($this->patientAutoNumber == TRUE){$patientnum = ": Patient ".($this->revStart+1);}else{$patientnum = "";}
		
		
		if($revCatname == "Home"){
			$revTitle = $this->revLandingTitle;
		} else if($revID == 999999){
			$revTitle = str_replace('Revision', '- Revision',$this->revCategoryLandingTitle.$fullCat)." Before &amp; After Gallery";
		} else {
			if($this->baGallery['ba_set'][$this->revStart]['title_tag']){
				$revTitle = $this->baGallery['ba_set'][$this->revStart]['title_tag'];
			} else {
				$revTitle = str_replace('Revision', '- Revision',str_replace('-', ' ', $fullCat)).' Before &amp; After Gallery'.$patientnum;
			}
		}
		return $revTitle;
	}
	
	
	
	
	//create page description
	function revDescriptionReturn($revCatname, $revID){
		if($revID != 999999){
		$this->revGetStart($revID);
		}
		$fullCat = $this->fullCatName($revCatname);
		if($revCatname == "Home"){
			$revDescription =  $this->revLandingDescription;
		} else if($revID == 999999){
			$revDescription = str_replace('Revision', '- Revision',$fullCat)." before and after image gallery. ".$this->revCategoryLandingDescription;
		} else {
		if($this->baGallery['ba_set'][$this->revStart]['description_tag']){
			$revDescription = $this->baGallery['ba_set'][$this->revStart]['description_tag'];
		} else {
			$revDescription = $this->defaultDescription;
		}
		}
		return $revDescription;
	}
	
	
	
	//Create menu to navigate gallery image sets 
	function revImageSetNav($revCatname, $revID){
		$this->revGetStart($revID);
		$revCatname = $this->cleanCat($revCatname);

		$revImageSetNavOutput;

	$revImageSetNavOutput = '<ul id="revGalleryNav">';
	
	//write "previous" navigation item
	if($this->revStart >= 1){
		
		if(isset($this->baGallery['ba_set'][$this->revStart - 1]['permalink'])){
						$revLink = $this->baGallery['ba_set'][$this->revStart - 1]['permalink'];
					} else {
						$revLink = $this->baGallery['ba_set'][$this->revStart - 1]['oid'];
					}
		
		if($this->urlRewrite == true){
		$revImageSetNavOutput .= '<li><a href="'.$this->baseUrl.$revCatname.'/'.$revLink.'/'.$this->galleryAnchor.'">&lt; <span class="revPrevNav">Previous</span></a></li>';
		} else{ 
		$revImageSetNavOutput .= '<li><a href="'.$this->baseUrl.'?revCatname='.$revCatname.'&revStart='.$revLink.$this->galleryAnchor.'">&lt; <span class="revPrevNav">Previous</span></a></li>';
		}
	}
	
	//write navigation menu
	if($this->revStart <= 4){
		
		$i = 0;
		while ($i<5 && $i<(count($this->baGallery['ba_set'])))
		  {
			
			  //check if is current record to highlight it
			  if($i == $this->revStart){
				$highlighted = 'class="baNavHighlight"';
			  } else {
				  $highlighted = "";
			  }
			  if(isset($this->baGallery['ba_set'][$i]['permalink'])){
						$revLink = $this->baGallery['ba_set'][$i]['permalink'];
					} else {
						$revLink = $this->baGallery['ba_set'][$i]['oid'];
					}
			if($this->urlRewrite == true){  
			$revImageSetNavOutput .= '<li><a href="'.$this->baseUrl.$revCatname.'/'.$revLink.'/'.$this->galleryAnchor.'" '.$highlighted.'>'.($i+1).'</a></li>';
			}else {
			$revImageSetNavOutput .= '<li><a href="'.$this->baseUrl.'?revCatname='.$revCatname.'&revStart='.$revLink.$this->galleryAnchor.'" '.$highlighted.'>'.($i+1).'</a></li>';
			}		 
		  $i++;
		  }
		
	} else if($this->revStart >= (count($this->baGallery['ba_set']) -5)){
		
		$i = (count($this->baGallery['ba_set']) -5);
		while ($i<(count($this->baGallery['ba_set'])))
		  {
			  //check if is current record to highlight it
			  if($i == $this->revStart){
				$highlighted = 'class="baNavHighlight"';
			  } else {
				  $highlighted = "";
			  }
			  if(isset($this->baGallery['ba_set'][$i]['permalink'])){
						$revLink = $this->baGallery['ba_set'][$i]['permalink'];
					} else {
						$revLink = $this->baGallery['ba_set'][$i]['oid'];
					}
			  
			if($this->urlRewrite == true){   
			$revImageSetNavOutput .= '<li><a href="'.$this->baseUrl.$revCatname.'/'.$revLink.'/'.$this->galleryAnchor.'" '.$highlighted.'>'.($i+1).'</a></li>';
			} else {
				$revImageSetNavOutput .= '<li><a href="'.$this->baseUrl.'?revCatname='.$revCatname.'&revStart='.$revLink.$this->galleryAnchor.'" '.$highlighted.'>'.($i+1).'</a></li>';
			}
		  $i++;
		  }
		
	} else {
		
		$i = $this->revStart;
		while ($i<($this->revStart+5) && $i<(count($this->baGallery['ba_set'])))
		  {
			  //check if is current record to highlight it
			  if($i == $this->revStart){
				$highlighted = 'class="baNavHighlight"';
			  } else {
				  $highlighted = "";
			  }
			  if(isset($this->baGallery['ba_set'][$i]['permalink'])){
						$revLink = $this->baGallery['ba_set'][$i]['permalink'];
					} else {
						$revLink = $this->baGallery['ba_set'][$i]['oid'];
					}
			if($this->urlRewrite == true){   
			$revImageSetNavOutput .= '<li><a href="'.$this->baseUrl.$revCatname.'/'.$revLink.'/'.$this->galleryAnchor.'" '.$highlighted.'>'.($i+1).'</a></li>';
			} else {
				$revImageSetNavOutput .= '<li><a href="'.$this->baseUrl.'?revCatname='.$revCatname.'&revStart='.$revLink.$this->galleryAnchor.'" '.$highlighted.'>'.($i+1).'</a></li>';
			}
		  $i++;
		  }
		
	}
	
	//write "next" navigation item
	if($this->revStart < (count($this->baGallery['ba_set'])-1)){
		
		if(isset($this->baGallery['ba_set'][$this->revStart + 1]['permalink'])){
						$revLink = $this->baGallery['ba_set'][$this->revStart + 1]['permalink'];
					} else {
						$revLink = $this->baGallery['ba_set'][$this->revStart + 1]['oid'];
					}
		
		if($this->urlRewrite == true){   
		$revImageSetNavOutput .= '<li><a href="'.$this->baseUrl.$revCatname.'/'.$revLink.'/'.$this->galleryAnchor.'"><span class="revNextNav">Next</span> &gt;</a></li>';
		} else {
			$revImageSetNavOutput .=  '<li><a href="'.$this->baseUrl.'?revCatname='.$revCatname.'&revStart='.$revLink.$this->galleryAnchor.'"><span class="revNextNav">Next</span> &gt;</a></li>';
		}
	}

	$revImageSetNavOutput .= '</ul>';
	
	return $revImageSetNavOutput;
		
	}
	

	
	//create patient image set
	function revImageSet($revCatname,$revID){
		$this->revGetStart($revID);
		
		
		$revImageSetOutput;
		
		
		
		
		
		//get headline strinf for Alts
		$curCatname = $this->revGetHeadline($revCatname, $this->baGallery['ba_set'][$this->revStart]['oid']);
		
		
		//set custom ALT tags
		if(isset($this->baGallery['ba_set'][$this->revStart]['after1_timeframe'])){$time1 = $this->baGallery['ba_set'][$this->revStart]['after1_timeframe']." After";}
		
		if(isset($this->baGallery['ba_set'][$this->revStart]['after2_timeframe'])){$time2 = $this->baGallery['ba_set'][$this->revStart]['after2_timeframe']." After";}
		
		//set custom ALT tags
		for($i=1; $i<11; $i++){
		
			if($i == 1){$i2 = "";}else{$i2 = $i;}
			
		if(isset($this->baGallery['ba_set'][$this->revStart]['image_after'.$i2."_xl"])){
			if($this->baGallery['ba_set'][$this->revStart]['custom_alttag'] == ""){${'altB'.$i} = $curCatname . " - " . "Before ".$i;}else{${'altB'.$i} = $this->baGallery['ba_set'][$this->revStart]['custom_alttag']." - Before ".$i;}
		}else{
			if($this->baGallery['ba_set'][$this->revStart]['custom_alttag'] == ""){${'altB'.$i} = $curCatname . " - " . "Before and After ".$i;}else{${'altB'.$i} = $this->baGallery['ba_set'][$this->revStart]['custom_alttag']." - Before and After ".$i;}
		}
			
			if($this->baGallery['ba_set'][$this->revStart]['custom_alttag'] == ""){${'altCombo'.$i} = $curCatname . " - " . "Before and After ".$i;}else{${'altCombo'.$i} = $this->baGallery['ba_set'][$this->revStart]['custom_alttag']." - Before and After ".$i;}
		
		if($this->baGallery['ba_set'][$this->revStart]['custom_alttag'] == ""){${'altA'.$i} = $curCatname . " - " . "After ".$i;}else{${'altA'.$i} = $this->baGallery['ba_set'][$this->revStart]['custom_alttag']." - ".isset($time1)." After ".$i ;}
		
		if($this->baGallery['ba_set'][$this->revStart]['custom_alttag'] == ""){${'altA'.$i.'_2'} = $curCatname . " - " . "After ".$i;}else{${'altA'.$i.'_2'} = $this->baGallery['ba_set'][$this->revStart]['custom_alttag']." - ".isset($time2)." After ".$i ;}
		
}
					
		//before and after headlines
		if(isset($this->baGallery['ba_set'][$this->revStart]['image_after_2_xl'])){
			
			//$fullCat = $this->fullCatName($revCatname);
				//$fullCat .= str_replace('Revision', '- Revision',ucwords($fullCat));
			
			if(isset($time1) && isset($time2)){
				$revImageSetOutput .= '<div id="revPatientImages"><div class="revBArow"><div class="revBAcol1-3"><h2>Before<br><span>'.$curCatname.'</span></h2></div><div class="revBAcol2-3"><h2>'.$time1.'<span><br>'.$curCatname.'</span><br></h2></div><div class="revBAcol3-3"><h2>'.$time2.'<br><span>'.$curCatname.'</span></h2></div><div class="clearfixer"></div></div>';
				} else{
				$revImageSetOutput .= '<div id="revPatientImages"><div class="revBArow"><div class="revBAcol1-3"><h2>Before<br><span>'.$curCatname.'</span></h2></div><div class="revBAcol2-3"><h2>After<br><span>'.$curCatname.'</span></h2></div><div class="revBAcol3-3"><h2>After 2<br><span>'.$curCatname.'</span></h2></div><div class="clearfixer"></div></div>';
				}
		}else if(isset($this->baGallery['ba_set'][$this->revStart]['image_after_xl'])){
		 $revImageSetOutput .= '<div id="revPatientImages"><div class="revBArow"><div class="revBAcol1"><h2>Before<br><span>'.$curCatname.'</span></h2></div><div class="revBAcol2"><h2>After<br><span>'.$curCatname.'</span></h2></div><div class="clearfixer"></div></div>';
		} else {
			$revImageSetOutput .= '<div id="revPatientImages">';
		}
		
		if($this->clickToZoomActive == 1){
			
			$revImageSetOutput .= '<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="pswp__bg"></div>
    <div class="pswp__scroll-wrap">
        <div class="pswp__container">
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
        </div>
        <div class="pswp__ui pswp__ui--hidden">
            <div class="pswp__top-bar">
                <div class="pswp__counter"></div>
                <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>
                <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>
                <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>
                <div class="pswp__preloader">

                    <div class="pswp__preloader__icn">
                      <div class="pswp__preloader__cut">
                        <div class="pswp__preloader__donut"></div>
                      </div>
                    </div>
                </div>
            </div>
            <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                <div class="pswp__share-tooltip"></div> 
            </div>
            <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">
            </button>
            <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">
            </button>
            <div class="pswp__caption">
                <div class="pswp__caption__center"></div>
            </div>
        </div>
    </div>
</div>';
			
		//BA set 1
			if(isset($this->baGallery['ba_set'][$this->revStart]['angle1_combo_xl_x3'])){
				$widthB = $this->baGallery['ba_set'][$this->revStart]['image_combo_hr_width'];
				$heightB = $this->baGallery['ba_set'][$this->revStart]['image_combo_hr_height'];

				$revImageSetOutput .= '<div class="revBArow revBA-gallery" itemscope itemtype="http://schema.org/ImageGallery"><figure class="revBAcol" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject"><a href="'.$this->baGallery['ba_set'][$this->revStart]['angle1_combo_hr'].'" itemprop="contentUrl" data-size="'.$widthB.'x'.$heightB.'" class="psLink"><img alt="'.$altCombo1.'" src="'.$this->baGallery['ba_set'][$this->revStart]['angle1_combo_xl_x3'].'"></a><figcaption itemprop="caption description" style="display:none">Before / After Angle 1</figcaption></figure></div>'; 
			} else if(isset($this->baGallery['ba_set'][$this->revStart]['angle1_combo_xl'])){
				$widthB = $this->baGallery['ba_set'][$this->revStart]['image_combo_hr_width'];
				$heightB = $this->baGallery['ba_set'][$this->revStart]['image_combo_hr_height'];

				$revImageSetOutput .= '<div class="revBArow revBA-gallery" itemscope itemtype="http://schema.org/ImageGallery"><figure class="revBAcol" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject"><a href="'.$this->baGallery['ba_set'][$this->revStart]['angle1_combo_hr'].'" itemprop="contentUrl" data-size="'.$widthB.'x'.$heightB.'" class="psLink"><img alt="'.$altCombo1.'" src="'.$this->baGallery['ba_set'][$this->revStart]['angle1_combo_xl'].'"></a><figcaption itemprop="caption description" style="display:none">Before / After Angle 1</figcaption></figure></div>'; 
			}else if(isset($this->baGallery['ba_set'][$this->revStart]['image_after_2_xl'])){
			$widthB = $this->baGallery['ba_set'][$this->revStart]['image_before_hr_width'];
			$heightB = $this->baGallery['ba_set'][$this->revStart]['image_before_hr_height'];
			$widthA = $this->baGallery['ba_set'][$this->revStart]['image_after_hr_width'];
			$heightA = $this->baGallery['ba_set'][$this->revStart]['image_after_hr_height'];
			$widthA2 = $this->baGallery['ba_set'][$this->revStart]['image_after_2_hr_width'];
			$heightA2 = $this->baGallery['ba_set'][$this->revStart]['image_after_2_hr_height'];
			
			
			$revImageSetOutput .= '<div class="revBArow revBA-gallery" itemscope itemtype="http://schema.org/ImageGallery"><figure  class="revBAcol1-3"  itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject"><a href="'.$this->baGallery['ba_set'][$this->revStart]['image_before_hr'].'" itemprop="contentUrl" data-size="'.$widthB.'x'.$heightB.'" class="psLink"><img alt="'.$altB1.'" src="'.$this->baGallery['ba_set'][$this->revStart]['image_before_xl'].'"></a><figcaption itemprop="caption description" style="display:none">Before Angle 1</figcaption></figure><figure  class="revBAcol2-3"  itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject"><a href="'.$this->baGallery['ba_set'][$this->revStart]['image_after_hr'].'" itemprop="contentUrl" data-size="'.$widthA.'x'.$heightA.'" class="psLink"><img alt="'.$altA1.'" src="'.$this->baGallery['ba_set'][$this->revStart]['image_after_xl'].'"></a><figcaption itemprop="caption description" style="display:none">After Angle 1</figcaption></figure><figure  class="revBAcol3-3"  itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject"><a href="'.$this->baGallery['ba_set'][$this->revStart]['image_after_2_hr'].'" itemprop="contentUrl" data-size="'.$widthA2.'x'.$heightA2.'" class="psLink"><img alt="'.$altA1_2.'" src="'.$this->baGallery['ba_set'][$this->revStart]['image_after_2_xl'].'"></a><figcaption itemprop="caption description" style="display:none">After 2 Angle 1</figcaption></figure></div>'; 
		} else if($this->baGallery['ba_set'][$this->revStart]['image_after_xl']){
			$widthB = $this->baGallery['ba_set'][$this->revStart]['image_before_hr_width'];
			$heightB = $this->baGallery['ba_set'][$this->revStart]['image_before_hr_height'];
			$widthA = $this->baGallery['ba_set'][$this->revStart]['image_after_hr_width'];
			$heightA = $this->baGallery['ba_set'][$this->revStart]['image_after_hr_height'];
			
			$revImageSetOutput .= '<div class="revBArow revBA-gallery" itemscope itemtype="http://schema.org/ImageGallery"><figure  class="revBAcol1" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject"><a href="'.$this->baGallery['ba_set'][$this->revStart]['image_before_hr'].'" itemprop="contentUrl" data-size="'.$widthB.'x'.$heightB.'" class="psLink"><img alt="'.$altB1.'" src="'.$this->baGallery['ba_set'][$this->revStart]['image_before_xl'].'"></a><figcaption itemprop="caption description" style="display:none">Before Angle 1</figcaption></figure><figure  class="revBAcol2" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject"><a href="'.$this->baGallery['ba_set'][$this->revStart]['image_after_hr'].'" itemprop="contentUrl" data-size="'.$widthA.'x'.$heightA.'" class="psLink"><img alt="'.$altA1.'" src="'.$this->baGallery['ba_set'][$this->revStart]['image_after_xl'].'"></a><figcaption itemprop="caption description" style="display:none">After Angle 1</figcaption></figure></div>'; 
		} else {
			$widthB = $this->baGallery['ba_set'][$this->revStart]['image_before_hr_width'];
			$heightB = $this->baGallery['ba_set'][$this->revStart]['image_before_hr_height'];
			
			$revImageSetOutput .= '<div class="revBArow revBA-gallery" itemscope itemtype="http://schema.org/ImageGallery"><figure class="revBAcol" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject"><a href="'.$this->baGallery['ba_set'][$this->revStart]['image_before_hr'].'" itemprop="contentUrl" data-size="'.$widthB.'x'.$heightB.'" class="psLink"><img alt="'.$altB1.'" src="'.$this->baGallery['ba_set'][$this->revStart]['image_before_single'].'"></a><figcaption itemprop="caption description" style="display:none">Before / After Angle 1</figcaption></figure></div>'; 
		}
		
		for($i=1; $i<10; $i++){
			$curAngle = $i+1;
			if(isset($this->baGallery['ba_set'][$this->revStart]['angle'.$curAngle.'_combo_xl_x3'])){
				
					
					$widthB = $this->baGallery['ba_set'][$this->revStart]['image_combo'.$curAngle.'_hr_width'];
					$heightB = $this->baGallery['ba_set'][$this->revStart]['image_combo'.$curAngle.'_hr_height'];
					
					$revImageSetOutput .= '<div class="revBArow revBA-gallery" itemscope itemtype="http://schema.org/ImageGallery"><figure class="revBAcol" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject"><a href="'.$this->baGallery['ba_set'][$this->revStart]['angle'.$curAngle.'_combo_hr'].'" itemprop="contentUrl" data-size="'.$widthB.'x'.$heightB.'" class="psLink"><img alt="'.${'altCombo'.($i+1)}.'" src="'.$this->baGallery['ba_set'][$this->revStart]['angle'.$curAngle.'_xl_x3'].'"></a><figcaption itemprop="caption description" style="display:none">Before / After Angle '.($i+1).'</figcaption></figure></div>';
		 
			} else if(isset($this->baGallery['ba_set'][$this->revStart]['angle'.$curAngle.'_combo_xl'])){
				
					
					$widthB = $this->baGallery['ba_set'][$this->revStart]['image_combo'.$curAngle.'_hr_width'];
					$heightB = $this->baGallery['ba_set'][$this->revStart]['image_combo'.$curAngle.'_hr_height'];
					
					$revImageSetOutput .= '<div class="revBArow revBA-gallery" itemscope itemtype="http://schema.org/ImageGallery"><figure class="revBAcol" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject"><a href="'.$this->baGallery['ba_set'][$this->revStart]['angle'.$curAngle.'_combo_hr'].'" itemprop="contentUrl" data-size="'.$widthB.'x'.$heightB.'" class="psLink"><img alt="'.${'altCombo'.($i+1)}.'" src="'.$this->baGallery['ba_set'][$this->revStart]['angle'.$curAngle.'_combo_xl'].'"></a><figcaption itemprop="caption description" style="display:none">Before / After Angle '.($i+1).'</figcaption></figure></div>';
		 
			} else if(isset($this->baGallery['ba_set'][$this->revStart]['image_after'.$i.'_2_xl'])){
			if(isset($this->baGallery['ba_set'][$this->revStart]['image_before'.$i.'_xl'])){
				$widthB = $this->baGallery['ba_set'][$this->revStart]['image_before'.$i.'_hr_width'];
			$heightB = $this->baGallery['ba_set'][$this->revStart]['image_before'.$i.'_hr_height'];
			$widthA = $this->baGallery['ba_set'][$this->revStart]['image_after'.$i.'_hr_width'];
			$heightA = $this->baGallery['ba_set'][$this->revStart]['image_after'.$i.'_hr_height'];
			$widthA2 = $this->baGallery['ba_set'][$this->revStart]['image_after'.$i.'_2_hr_width'];
			$heightA2 = $this->baGallery['ba_set'][$this->revStart]['image_after'.$i.'_2_hr_height'];
				
				$revImageSetOutput .= '<div class="revBArow revBA-gallery" itemscope itemtype="http://schema.org/ImageGallery"><figure  class="revBAcol1-3"  itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject"><a href="'.$this->baGallery['ba_set'][$this->revStart]['image_before'.$i.'_hr'].'" itemprop="contentUrl" data-size="'.$widthB.'x'.$heightB.'" class="psLink"><img alt="'.${'altB'.($i+1)}.'" src="'.$this->baGallery['ba_set'][$this->revStart]['image_before'.$i.'_xl'].'"></a><figcaption itemprop="caption description" style="display:none">Before Angle '.($i+1).'</figcaption></figure><figure  class="revBAcol2-3"  itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject"><a href="'.$this->baGallery['ba_set'][$this->revStart]['image_after'.$i.'_hr'].'" itemprop="contentUrl" data-size="'.$widthA.'x'.$heightA.'" class="psLink"><img alt="'.${'altA'.($i+1)}.'" src="'.$this->baGallery['ba_set'][$this->revStart]['image_after'.$i.'_xl'].'"></a><figcaption itemprop="caption description" style="display:none">After Angle '.($i+1).'</figcaption></figure><figure  class="revBAcol3-3"  itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject"><a href="'.$this->baGallery['ba_set'][$this->revStart]['image_after'.$i.'_2_hr'].'" itemprop="contentUrl" data-size="'.$widthA2.'x'.$heightA2.'" class="psLink"><img alt="'.${'altA'.($i+1)}.'_2" src="'.$this->baGallery['ba_set'][$this->revStart]['image_after'.$i.'_2_xl'].'"></a><figcaption itemprop="caption description" style="display:none">After 2 Angle '.($i+1).'</figcaption></figure></div>'; 
		 }
			} else if($this->baGallery['ba_set'][$this->revStart]['image_after'.$i.'_xl']){
				if(isset($this->baGallery['ba_set'][$this->revStart]['image_before'.$i.'_xl'])){
					$widthB = $this->baGallery['ba_set'][$this->revStart]['image_before'.$i.'_hr_width'];
					$heightB = $this->baGallery['ba_set'][$this->revStart]['image_before'.$i.'_hr_height'];
					$widthA = $this->baGallery['ba_set'][$this->revStart]['image_after'.$i.'_hr_width'];
					$heightA = $this->baGallery['ba_set'][$this->revStart]['image_after'.$i.'_hr_height'];
			
					
					$revImageSetOutput .= '<div class="revBArow revBA-gallery" itemscope itemtype="http://schema.org/ImageGallery"><figure  class="revBAcol1" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject"><a href="'.$this->baGallery['ba_set'][$this->revStart]['image_before'.$i.'_hr'].'" itemprop="contentUrl" data-size="'.$widthB.'x'.$heightB.'" class="psLink"><img alt="'.${'altB'.($i+1)}.'" src="'.$this->baGallery['ba_set'][$this->revStart]['image_before'.$i.'_xl'].'"></a><figcaption itemprop="caption description" style="display:none">Before Angle '.($i+1).'</figcaption></figure><figure  class="revBAcol2" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject"><a href="'.$this->baGallery['ba_set'][$this->revStart]['image_after'.$i.'_hr'].'" itemprop="contentUrl" data-size="'.$widthA.'x'.$heightA.'" class="psLink"><img alt="'.${'altA'.($i+1)}.'" src="'.$this->baGallery['ba_set'][$this->revStart]['image_after'.$i.'_xl'].'"></a><figcaption itemprop="caption description" style="display:none">After Angle '.($i+1).'</a></figcaption></figure></div>'; 
		 }
			} else{
				if(isset($this->baGallery['ba_set'][$this->revStart]['image_before'.$i.'_xl'])){
					$widthB = $this->baGallery['ba_set'][$this->revStart]['image_before'.$i.'_hr_width'];
					$heightB = $this->baGallery['ba_set'][$this->revStart]['image_before'.$i.'_hr_height'];
					
					$revImageSetOutput .= '<div class="revBArow revBA-gallery" itemscope itemtype="http://schema.org/ImageGallery"><figure class="revBAcol" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject"><a href="'.$this->baGallery['ba_set'][$this->revStart]['image_before'.$i.'_hr'].'" itemprop="contentUrl" data-size="'.$widthB.'x'.$heightB.'" class="psLink"><img alt="'.${'altB'.($i+1)}.'" src="'.$this->baGallery['ba_set'][$this->revStart]['image_before'.$i.'_single'].'"></a><figcaption itemprop="caption description" style="display:none">Before / After Angle '.($i+1).'</figcaption></figure></div>';
		 }
			}
				
		 
		}
		
	} else{
		
			//BA set 1
			if(isset($this->baGallery['ba_set'][$this->revStart]['angle1_combo_xl_x3'])){
				$revImageSetOutput .= '<div class="revBArow revBA-gallery" itemscope itemtype="http://schema.org/ImageGallery"><figure class="revBAcol" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject"><img alt="'.$altCombo1.'" src="'.$this->baGallery['ba_set'][$this->revStart]['angle1_combo_xl_x3'].'"><figcaption itemprop="caption description" style="display:none">Before / After Angle 1</figcaption></figure></div>'; 
			} else if(isset($this->baGallery['ba_set'][$this->revStart]['angle1_combo_xl'])){
				$revImageSetOutput .= '<div class="revBArow revBA-gallery" itemscope itemtype="http://schema.org/ImageGallery"><figure class="revBAcol" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject"><img alt="'.$altCombo1.'" src="'.$this->baGallery['ba_set'][$this->revStart]['angle1_combo_xl'].'"><figcaption itemprop="caption description" style="display:none">Before / After Angle 1</figcaption></figure></div>'; 
			} else if(isset($this->baGallery['ba_set'][$this->revStart]['image_after_2_xl'])){
			$revImageSetOutput .= '<div class="revBArow revBA-gallery" itemscope itemtype="http://schema.org/ImageGallery"><figure  class="revBAcol1-3"  itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject"><img alt="'.$altB1.'" src="'.$this->baGallery['ba_set'][$this->revStart]['image_before_xl'].'"><figcaption itemprop="caption description" style="display:none">Before Angle 1</figcaption></figure><figure  class="revBAcol2-3"  itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject"><img alt="'.$altA1.'" src="'.$this->baGallery['ba_set'][$this->revStart]['image_after_xl'].'"><figcaption itemprop="caption description" style="display:none">After Angle 1</figcaption></figure><figure  class="revBAcol3-3"  itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject"><img alt="'.$altA1_2.'" src="'.$this->baGallery['ba_set'][$this->revStart]['image_after_2_xl'].'"><figcaption itemprop="caption description" style="display:none">After 2 Angle 1</figcaption></figure></div>'; 
		} else if($this->baGallery['ba_set'][$this->revStart]['image_after_xl']){
			$revImageSetOutput .= '<div class="revBArow revBA-gallery" itemscope itemtype="http://schema.org/ImageGallery"><figure  class="revBAcol1" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject"><img alt="'.$altB1.'" src="'.$this->baGallery['ba_set'][$this->revStart]['image_before_xl'].'"><figcaption itemprop="caption description" style="display:none">Before Angle 1</figcaption></figure><figure  class="revBAcol2" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject"><img alt="'.$altA1.'" src="'.$this->baGallery['ba_set'][$this->revStart]['image_after_xl'].'"><figcaption itemprop="caption description" style="display:none">After Angle 1</figcaption></figure></div>'; 
		} else {
			$revImageSetOutput .= '<div class="revBArow revBA-gallery" itemscope itemtype="http://schema.org/ImageGallery"><figure class="revBAcol" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject"><img alt="'.$altB1.'" src="'.$this->baGallery['ba_set'][$this->revStart]['image_before_single'].'"><figcaption itemprop="caption description" style="display:none">Before / After Angle 1</figcaption></figure></div>'; 
		}
		
		for($i=1; $i<10; $i++){
			
			$curAngle = $i+1;
			if(isset($this->baGallery['ba_set'][$this->revStart]['angle'.$curAngle.'_combo_xl_x3'])){
				list($widthB, $heightB) = getimagesize($this->baGallery['ba_set'][$this->revStart]['angle'.$curAngle.'_combo_hr']);
					
					$revImageSetOutput .= '<div class="revBArow revBA-gallery" itemscope itemtype="http://schema.org/ImageGallery"><figure class="revBAcol" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject"><img alt="'.${'altCombo'.($i+1)}.'" src="'.$this->baGallery['ba_set'][$this->revStart]['angle'.$curAngle.'_combo_xl_x3'].'"><figcaption itemprop="caption description" style="display:none">Before / After Angle '.($i+1).'</figcaption></figure></div>';
			} else if(isset($this->baGallery['ba_set'][$this->revStart]['angle'.$curAngle.'_combo_xl'])){
				list($widthB, $heightB) = getimagesize($this->baGallery['ba_set'][$this->revStart]['angle'.$curAngle.'_combo_hr']);
					
					$revImageSetOutput .= '<div class="revBArow revBA-gallery" itemscope itemtype="http://schema.org/ImageGallery"><figure class="revBAcol" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject"><img alt="'.${'altCombo'.($i+1)}.'" src="'.$this->baGallery['ba_set'][$this->revStart]['angle'.$curAngle.'_combo_xl'].'"><figcaption itemprop="caption description" style="display:none">Before / After Angle '.($i+1).'</figcaption></figure></div>';
			} else if(isset($this->baGallery['ba_set'][$this->revStart]['image_after'.$i.'_2_xl'])){
			if(isset($this->baGallery['ba_set'][$this->revStart]['image_before'.$i.'_xl'])){				
				$revImageSetOutput .= '<div class="revBArow revBA-gallery" itemscope itemtype="http://schema.org/ImageGallery"><figure  class="revBAcol1-3"  itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject"><img alt="'.${'altB'.($i+1)}.'" src="'.$this->baGallery['ba_set'][$this->revStart]['image_before'.$i.'_xl'].'"><figcaption itemprop="caption description" style="display:none">Before Angle '.($i+1).'</figcaption></figure><figure  class="revBAcol2-3"  itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject"><img alt="'.${'altA'.($i+1)}.'" src="'.$this->baGallery['ba_set'][$this->revStart]['image_after'.$i.'_xl'].'"><figcaption itemprop="caption description" style="display:none">After Angle '.($i+1).'</figcaption></figure><figure  class="revBAcol3-3"  itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject"><img alt="'.${'altA'.($i+1)}.'_2" src="'.$this->baGallery['ba_set'][$this->revStart]['image_after'.$i.'_2_xl'].'"><figcaption itemprop="caption description" style="display:none">After 2 Angle '.($i+1).'</figcaption></figure></div>'; 
		 }
			} else if($this->baGallery['ba_set'][$this->revStart]['image_after'.$i.'_xl']){
				if(isset($this->baGallery['ba_set'][$this->revStart]['image_before'.$i.'_xl'])){					
					$revImageSetOutput .= '<div class="revBArow revBA-gallery" itemscope itemtype="http://schema.org/ImageGallery"><figure  class="revBAcol1" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject"><img alt="'.${'altB'.($i+1)}.'" src="'.$this->baGallery['ba_set'][$this->revStart]['image_before'.$i.'_xl'].'"><figcaption itemprop="caption description" style="display:none">Before Angle '.($i+1).'</figcaption></figure><figure  class="revBAcol2" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject"><img alt="'.${'altA'.($i+1)}.'" src="'.$this->baGallery['ba_set'][$this->revStart]['image_after'.$i.'_xl'].'"><figcaption itemprop="caption description" style="display:none">After Angle '.($i+1).'</figcaption></figure></div>'; 
		 }
			} else{
				if(isset($this->baGallery['ba_set'][$this->revStart]['image_before'.$i.'_xl'])){
					list($widthB, $heightB) = getimagesize($this->baGallery['ba_set'][$this->revStart]['image_before'.$i.'_hr']);
					
					$revImageSetOutput .= '<div class="revBArow revBA-gallery" itemscope itemtype="http://schema.org/ImageGallery"><figure class="revBAcol" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject"><img alt="'.${'altB'.($i+1)}.'" src="'.$this->baGallery['ba_set'][$this->revStart]['image_before'.$i.'_single'].'"><figcaption itemprop="caption description" style="display:none">Before / After Angle '.($i+1).'</figcaption></figure></div>';
		 }
			}
				
		 
		}
			
			
			
	}
		
		 $revImageSetOutput .= '</div>';
		 
		 return $revImageSetOutput;
	}
	
		//get first angle of image set for shortcode
	function revGetFirstAngle($revID){
		$this->revGetStart($revID);
		
		$revImageSetOutput;
		
		//set custom ALT tags
		if(isset($this->baGallery['ba_set'][$this->revStart]['after1_timeframe'])){$time1 = $this->baGallery['ba_set'][$this->revStart]['after1_timeframe']." After";}
		
		if(isset($this->baGallery['ba_set'][$this->revStart]['after2_timeframe'])){$time2 = $this->baGallery['ba_set'][$this->revStart]['after2_timeframe']." After";}
		
		//set custom ALT tags
		for($i=1; $i<11; $i++){
		
		if($this->baGallery['ba_set'][$this->revStart]['custom_alttag'] == ""){${'altB'.$i} = "Before ".$i;}else{${'altB'.$i} = $this->baGallery['ba_set'][$this->revStart]['custom_alttag']." - Before ".$i;}
		
		if($this->baGallery['ba_set'][$this->revStart]['custom_alttag'] == ""){${'altA'.$i} = "After ".$i;}else{${'altA'.$i} = $this->baGallery['ba_set'][$this->revStart]['custom_alttag']." - ".isset($time1)." After ".$i ;}
		
		if($this->baGallery['ba_set'][$this->revStart]['custom_alttag'] == ""){${'altA'.$i.'_2'} = "After ".$i;}else{${'altA'.$i.'_2'} = $this->baGallery['ba_set'][$this->revStart]['custom_alttag']." - ".isset($time2)." After ".$i ;}
		
}
		if(isset($this->baGallery['ba_set'][$x]['angle1_combo_xl']) && $this->baGallery['ba_set'][$x]['angle1_combo_xl'] != ""){
							$catComboIm = $this->baGallery['ba_set'][$x]['angle1_combo_xl'];
						} else{$catComboIm = "";}
		
		if($this->baGallery['ba_set'][$this->revStart]['custom_alttag'] == ""){${'altCombo'.$i} = "Before and After".$i;}else{${'altCombo'.$i} = $this->baGallery['ba_set'][$this->revStart]['custom_alttag']." - Before and After".$i;}
				
		
		//BA set 1
		if(isset($catComboIm) && $catComboIm != "") {
			$revImageSetOutput .= '<div class="revBArow"><div class="revBAcol"><img alt="'.$altCombo1.'" src="'.$this->baGallery['ba_set'][$this->revStart]['angle1_combo_xl'].'"></div><div class="clearfixer"></div></div>'; 
		} else if(isset($this->baGallery['ba_set'][$this->revStart]['image_after_2_xl'])){
			$revImageSetOutput .= '<div class="revBArow"><div class="revBAcol1-3"><img alt="'.$altB1.'" src="'.$this->baGallery['ba_set'][$this->revStart]['image_before_xl'].'"></div><div class="revBAcol2-3"><img alt="'.$altA1.'" src="'.$this->baGallery['ba_set'][$this->revStart]['image_after_xl'].'"></div><div class="revBAcol3-3"><img alt="'.$altA1_2.'" src="'.$this->baGallery['ba_set'][$this->revStart]['image_after_2_xl'].'"></div><div class="clearfixer"></div></div>'; 
		} else if($this->baGallery['ba_set'][$this->revStart]['image_after_xl']){$revImageSetOutput .= '<div class="revBArow"><div class="revBAcol1"><img alt="'.$altB1.'" src="'.$this->baGallery['ba_set'][$this->revStart]['image_before_xl'].'"></div><div class="revBAcol2"><img alt="'.$altA1.'" src="'.$this->baGallery['ba_set'][$this->revStart]['image_after_xl'].'"></div><div class="clearfixer"></div></div>'; 
		} else {
			$revImageSetOutput .= '<div class="revBArow"><div class="revBAcol"><img alt="'.$altB1.'" src="'.$this->baGallery['ba_set'][$this->revStart]['image_before_single'].'"></div><div class="clearfixer"></div></div>'; 
		}
		
		 
		 return $revImageSetOutput;
	}
	
	//create thumbnail launch button
	function revThumbnailButton(){
		return '<a class="revThumbLaunch" href="#revThumbnailConDiv" rel="nofollow">View Thumbnails</a>';
	}
	
	
	
	//create "add to favorites" button
	function revFavoriteButton($revID){
		$revFavoriteButtonOutput;
	
		
		
		$this->revGetStart($revID);
		
		
						
		if($this->baGallery['ba_set'][$this->revStart]['favadded'] == "1"){
			if(isset($this->groupclientid) && $this->groupclientid != ""){
				$revFavoriteButtonOutput .= '<a class="revFavLaunch" href="https://www.bragbook.gallery/myfavs/?client='.$this->groupclientid.'&patientsig='.$_SESSION['patientsig'].'&baseurl='.$this->baseUrl.'" rel="nofollow">View MyFavorites</a>';
			} else {
				$revFavoriteButtonOutput .= '<a class="revFavLaunch" href="https://www.bragbook.gallery/myfavs/?client='.$this->clientid.'&patientsig='.$_SESSION['patientsig'].'&baseurl='.$this->baseUrl.'" rel="nofollow">View MyFavorites</a>';
			}
		} else {
			if(isset($this->groupclientid) && $this->groupclientid != ""){
				$revFavoriteButtonOutput .= '<a class="revFavLaunch" href="https://www.bragbook.gallery/myfavs/?client='.$this->groupclientid.'&favid='.$this->baGallery['ba_set'][$this->revStart]['oid'].'&patientsig='.$_SESSION['patientsig'].'&baseurl='.$this->baseUrl.'" rel="nofollow">Add to Favorites</a>';
			}else {
				$revFavoriteButtonOutput .= '<a class="revFavLaunch" href="https://www.bragbook.gallery/myfavs/?client='.$this->clientid.'&favid='.$this->baGallery['ba_set'][$this->revStart]['oid'].'&patientsig='.$_SESSION['patientsig'].'&baseurl='.$this->baseUrl.'" rel="nofollow">Add to Favorites</a>';
			}
		}
		return $revFavoriteButtonOutput;
	}
	
	//Create My favorites text
	function revFavoriteText($revID){
		$revFavoriteTextOutput;
		
		$this->revGetStart($revID);
		
		if($this->baGallery['ba_set'][$this->revStart]['favadded'] == "1"){
			if(isset($this->groupclientid) && $this->groupclientid != ""){
				$revFavoriteLink .= 'https://www.bragbook.gallery/myfavs/?client='.$this->groupclientid.'&patientsig='.$_SESSION['patientsig'].'&baseurl='.$this->baseUrl;
			} else {
				$revFavoriteLink .= 'https://www.bragbook.gallery/myfavs/?client='.$this->clientid.'&patientsig='.$_SESSION['patientsig'].'&baseurl='.$this->baseUrl;
			}
		} else {
			if(isset($this->groupclientid) && $this->groupclientid != ""){
				$revFavoriteLink .= 'https://www.bragbook.gallery/myfavs/?client='.$this->groupclientid.'&patientsig='.$_SESSION['patientsig'].'&baseurl='.$this->baseUrl;
			}else {
				$revFavoriteLink .= 'https://www.bragbook.gallery/myfavs/?client='.$this->clientid.'&patientsig='.$_SESSION['patientsig'].'&baseurl='.$this->baseUrl;
			}
		}
		
		if($_SESSION['patientsig'] != ""){
			$revFavoriteTextOutput = '<div id="myFavsHeader"><img id="myFavsLogo" alt="MyFavorites Logo" src="https://www.bragbook.gallery/myfavs/myfavs-logo.png"><p><a href="'.$revFavoriteLink.'" class="revLoginLaunch" rel="nofollow">View MyFavorites</a></p></div>';
		} else{
			$revFavoriteTextOutput = '<div id="myFavsHeader"><img id="myFavsLogo" alt="MyFavorites Logo" src="https://www.bragbook.gallery/myfavs/myfavs-logo.png"><p><a href="'.$revFavoriteLink.'" class="revLoginLaunch" rel="nofollow">Create a MyFavorites account</a> and save any before and afters you think you might like to use as examples to show us.</p></div>';
		}
		
		
		
		
		return $revFavoriteTextOutput;
	}
	
	//create login button
	function revLoginButton(){
				
		if(isset($_SESSION['patientsig'])){
			return '<span class="revLogin">Welcome '.$_SESSION['patientUser'].'! <a class="revLoginLaunch" href="https://www.bragbook.gallery/myfavs/?client='.$this->clientid.'&patientsig='.isset($_SESSION['patientsig']).'&baseurl='.$this->baseUrl.'" rel="nofollow">View Favorites</a></span>';

		} else {
			return '<span class="revLogin"><a class="revLoginLaunch" href="https://www.bragbook.gallery/myfavs/?client='.$this->clientid.'&patientsig='.isset($_SESSION['patientsig']).'&baseurl='.$this->baseUrl.'" rel="nofollow">Login to Favorites</a></span>';
		}
				
	}
	
	//shorten string to specified length
	function truncate($text, $length) {
		$text = strip_tags($text);
	   $length = abs((int)$length);
	   if(strlen($text) > $length) {
		  $text = preg_replace("/^(.{1,$length})(\s.*|$)/s", '\\1...', $text);
	   }
	   return($text);
	}
	
	//get Detail snippet 
	function revPatientDetailPreview($revID){
		$revPatientInfoOutput;
		$this->revGetStart($revID);
		
			//write contents of details attribute to "revPatientDetails" div
	if($this->baGallery['ba_set'][$this->revStart]['details']){
			
			if(isset($this->setDetails) && $this->setDetails != ""){
					$detailsToUse = 'details'.$this->setDetails;
					if(isset($this->baGallery['ba_set'][$this->revStart][$detailsToUse]) && $this->baGallery['ba_set'][$this->revStart][$detailsToUse] != ""){
					$revPatientInfoOutput .=  $this->baGallery['ba_set'][$this->revStart][$detailsToUse];
					}else{
					$revPatientInfoOutput .=  $this->baGallery['ba_set'][$this->revStart]['details'];
				}
			} else {
			if(isset($this->detailsLimit) && $this->detailsLimit != ""){
				
				$str = $this->baGallery['ba_set'][$this->revStart]['details'];
				$regex = '#\<div id="'.$this->detailsLimit.'"\>(.+?)\<\/div\>#s';
				preg_match($regex, $str, $matches);

				$details = $matches[0];
				if($details){
					$revPatientInfoOutput .=   $details;
				}
			} else {
				
				$revPatientInfoOutput .=  $this->baGallery['ba_set'][$this->revStart]['details'];
			}
			}
		}	 
		 return $revPatientInfoOutput;
	}
	
	//create list of patient details
	function revPatientInfo($revID){
		$revPatientInfoOutput;
		$this->revGetStart($revID);
		
		//write contents of details attribute to "revPatientDetails" div
	if($this->baGallery['ba_set'][$this->revStart]['details']){
			
			if(isset($this->setDetails) && $this->setDetails != ""){
					$detailsToUse = 'details'.$this->setDetails;
					if(isset($this->baGallery['ba_set'][$this->revStart][$detailsToUse]) && $this->baGallery['ba_set'][$this->revStart][$detailsToUse] != ""){
						$revPatientInfoOutput .= '<div id="revPatientDetails">';
					$revPatientInfoOutput .=  $this->baGallery['ba_set'][$this->revStart][$detailsToUse];
					$revPatientInfoOutput .=  '</div>';
					}else{
					$revPatientInfoOutput .=  '<div id="revPatientDetails">';
					$revPatientInfoOutput .=  $this->baGallery['ba_set'][$this->revStart]['details'];
					$revPatientInfoOutput .=  '</div>';
				}
			} else {
			if(isset($this->detailsLimit) && $this->detailsLimit != ""){
				
				$str = $this->baGallery['ba_set'][$this->revStart]['details'];
				$regex = '#\<div id="'.$this->detailsLimit.'"\>(.+?)\<\/div\>#s';
				preg_match($regex, $str, $matches);

				$details = $matches[0];
				if($details){
					$revPatientInfoOutput .=  '<div id="revPatientDetails">';
					$revPatientInfoOutput .=   $details;
					$revPatientInfoOutput .=  '</div>';
				}
			} else {
				
				$revPatientInfoOutput .=  '<div id="revPatientDetails">';
				$revPatientInfoOutput .=  $this->baGallery['ba_set'][$this->revStart]['details'];
				$revPatientInfoOutput .=  '</div>';
			}
			}
		}	 
		
		//create first column of patient details
		$details1 = array();
		if($this->baGallery['ba_set'][$this->revStart]['age']){array_push($details1, "<li><strong>Age: </strong>" . $this->baGallery['ba_set'][$this->revStart]['age'] . " years old</li>");}
		if($this->baGallery['ba_set'][$this->revStart]['weight']){array_push($details1, "<li><strong>Weight: </strong>" . $this->baGallery['ba_set'][$this->revStart]['weight'] . " pounds</li>");}
		if($this->baGallery['ba_set'][$this->revStart]['height']){array_push($details1, "<li><strong>Height: </strong>" . $this->baGallery['ba_set'][$this->revStart]['height'] . "</li>");}
		if($this->baGallery['ba_set'][$this->revStart]['gender']){array_push($details1, "<li><strong>Gender: </strong>" . $this->baGallery['ba_set'][$this->revStart]['gender'] . "</li>");}
		if($this->baGallery['ba_set'][$this->revStart]['timeframe']){array_push($details1, "<li><strong>Post-op Timeline: </strong>" . $this->baGallery['ba_set'][$this->revStart]['timeframe'] . "</li>");}

		
		if($details1){
			$revPatientInfoOutput .=  '<ul id="revPatientDetailsList">';
				for ($x=0; $x<count($details1); $x++){
					$revPatientInfoOutput .=  $details1[$x];
				}
			$revPatientInfoOutput .=  '</ul>';
		}
		
		//create second column of patient details
		$details2 = array();
		if($this->baGallery['ba_set'][$this->revStart]['implant']){array_push($details2, "<li><strong>Implant Type: </strong>" . $this->baGallery['ba_set'][$this->revStart]['implant'] . "</li>");}
		if($this->baGallery['ba_set'][$this->revStart]['implant_shape']){array_push($details2, "<li><strong>Implant Shape: </strong>" . $this->baGallery['ba_set'][$this->revStart]['implant_shape'] . "</li>");}
		if($this->baGallery['ba_set'][$this->revStart]['implant_incision']){array_push($details2, "<li><strong>Implant Incision: </strong>" . $this->baGallery['ba_set'][$this->revStart]['implant_incision'] . "</li>");}
		if($this->baGallery['ba_set'][$this->revStart]['implant_size']){array_push($details2, "<li><strong>Volume: </strong>" . $this->baGallery['ba_set'][$this->revStart]['implant_size'] . "</li>");}
		if($this->baGallery['ba_set'][$this->revStart]['implant_profile']){array_push($details2, "<li><strong>Implant Profile: </strong>" . $this->baGallery['ba_set'][$this->revStart]['implant_profile'] . "</li>");}
		if($this->baGallery['ba_set'][$this->revStart]['implant_projection']){array_push($details2, "<li><strong>Implant Projection: </strong>" . $this->baGallery['ba_set'][$this->revStart]['implant_projection'] . "</li>");}
		if($this->baGallery['ba_set'][$this->revStart]['implant_placement']){array_push($details2, "<li><strong>Implant Placement: </strong>" . $this->baGallery['ba_set'][$this->revStart]['implant_placement'] . "</li>");}
		if($this->baGallery['ba_set'][$this->revStart]['implant_height']){array_push($details2, "<li><strong>Implant Height: </strong>" . $this->baGallery['ba_set'][$this->revStart]['implant_height'] . "</li>");}
		if($this->baGallery['ba_set'][$this->revStart]['implant_base']){array_push($details2, "<li><strong>Implant Base: </strong>" . $this->baGallery['ba_set'][$this->revStart]['implant_base'] . "</li>");}
		if($this->baGallery['ba_set'][$this->revStart]['implant_texture']){array_push($details2, "<li><strong>Textured: </strong>Yes</li>");}
		if($this->baGallery['ba_set'][$this->revStart]['preop_weight']){array_push($details2, "<li><strong>Pre-op Weight: </strong>" . $this->baGallery['ba_set'][$this->revStart]['preop_weight'] . "</li>");}
		if($this->baGallery['ba_set'][$this->revStart]['postop_weight']){array_push($details2, "<li><strong>Post-op Weight: </strong>" . $this->baGallery['ba_set'][$this->revStart]['postop_weight'] . "</li>");}
		if($this->baGallery['ba_set'][$this->revStart]['preop_size']){array_push($details2, "<li><strong>Pre-Surgery Bra Size: </strong>" . $this->baGallery['ba_set'][$this->revStart]['preop_size'] . "</li>");}
		if($this->baGallery['ba_set'][$this->revStart]['postop_size']){array_push($details2, "<li><strong>Post-Surgery Bra Size: </strong>" . $this->baGallery['ba_set'][$this->revStart]['postop_size'] . "</li>");}
		if($this->baGallery['ba_set'][$this->revStart]['fat_removed']){array_push($details2, "<li><strong>Fat Removed: </strong>" . $this->baGallery['ba_set'][$this->revStart]['fat_removed'] . "</li>");}
		if($this->baGallery['ba_set'][$this->revStart]['filler_type']){array_push($details2, "<li><strong>Filler Type: </strong>" . $this->baGallery['ba_set'][$this->revStart]['filler_type'] . "</li>");}
		if($this->baGallery['ba_set'][$this->revStart]['technique']){array_push($details2, "<li><strong>Technique: </strong>" . $this->baGallery['ba_set'][$this->revStart]['technique'] . "</li>");}
		
		if($details2){
			$revPatientInfoOutput .=  '<ul id="revPatientDetailsList2">';
				for ($x=0; $x<count($details2); $x++){
					$revPatientInfoOutput .=  $details2[$x];
				}
			$revPatientInfoOutput .=  '</ul>';
		}
	 
	 $revPatientInfoOutput .=  '<div class="clearfixer"></div>';
	 
	 return $revPatientInfoOutput;
	 
	}
	
	
	
	
	//create a list of thumbnails
	function revThumbnails($revCatname, $thumbStart){
		$revCatname = $this->cleanCat($revCatname);
		
		$revThumbnailsOutput;
		
		$revThumbnailsOutput = "<div id=\"revThumbnailConDiv\">";
		
		if(isset($this->thumbLimit) && $this->thumbLimit != 0 && $this->thumbLimit != "" ){
			if(isset($thumbStart) && count($this->baGallery['ba_set']) > $this->thumbLimit){
		$revThumbnailsOutput .= $this->revThumbnailNav($revCatname, $thumbStart);
			}
		}
		
		if(isset($thumbStart)){
			$thumbStart = $this->thumbLimit*$thumbStart;
		}else{
		$thumbStart = 0;
		}
		
		if(isset($this->thumbLimit) && $this->thumbLimit != 0 && $this->thumbLimit != "" ){
			if($this->thumbLimit < count($this->baGallery['ba_set'])){
			$recordLimit = $thumbStart+$this->thumbLimit;
			} else{
			$recordLimit = count($this->baGallery['ba_set']);	
			}
		} else {
			$recordLimit = count($this->baGallery['ba_set']);
		}
		
		

		
		$revThumbnailsOutput .= '<div><ul id="revThumbnails">';
			for ($x=$thumbStart; $x<$recordLimit; $x++){
				if(isset($this->baGallery['ba_set'][$x]['oid'])){
					if($this->urlRewrite == true){  
					if(isset($this->baGallery['ba_set'][$x]['permalink'])){
						$revLink = $this->baGallery['ba_set'][$x]['permalink'];
					} else {
						$revLink = $this->baGallery['ba_set'][$x]['oid'];
					}
					
					
					$revThumbnailsOutput .=  '<li class="thumbSet"><a href="'.$this->baseUrl.$revCatname.'/'.$revLink.'/'.$this->galleryAnchor.'"><span><img class="skip-lazy" alt="Before '.$this->baGallery['ba_set'][$x]['oid'].'" src="'.$this->baGallery['ba_set'][$x]['image_before_tn'].'"></span>';
					if(isset($this->baGallery['ba_set'][$x]['image_after_xl'])){
					$revThumbnailsOutput .=  '<span><img class="skip-lazy" alt="After '.$this->baGallery['ba_set'][$x]['oid'].'" src="'.$this->baGallery['ba_set'][$x]['image_after_tn'].'"></span>';
					}
					$revThumbnailsOutput .=  '</a></li>';
					} else {
						if(isset($this->baGallery['ba_set'][$x]['permalink'])){
						$revLink = $this->baGallery['ba_set'][$x]['permalink'];
					} else {
						$revLink = $this->baGallery['ba_set'][$x]['oid'];
					}
						
						$revThumbnailsOutput .=  '<li class="thumbSet"><a href="'.$this->baseUrl.'?revCatname='.$revCatname.'&revStart='.$revLink.$this->galleryAnchor.'"><span><img class="skip-lazy" alt="Before '.$this->baGallery['ba_set'][$x]['oid'].'" src="'.$this->baGallery['ba_set'][$x]['image_before_tn'].'"></span>';
						if(isset($this->baGallery['ba_set'][$x]['image_after_xl'])){
						$revThumbnailsOutput .=  '<span><img class="skip-lazy" alt="After '.$this->baGallery['ba_set'][$x]['oid'].'" src="'.$this->baGallery['ba_set'][$x]['image_after_tn'].'"></span>';
						}
						$revThumbnailsOutput .=  '</a></li>';
					}
					}
				}	
	
  		$revThumbnailsOutput .=  '</ul></div></div>';
		
		return $revThumbnailsOutput;
	}
	
	
	
	
	//create hidden div of thumbnails for colorbox to launch
	function revHiddenThumbnails($revCatname, $thumbStart){
		$revHiddenThumbnailsOutput;
		
		$revHiddenThumbnailsOutput = '<div id="revThumbnailsDiv">';
		$revHiddenThumbnailsOutput .= $this->revThumbnails($revCatname, $thumbStart);
		$revHiddenThumbnailsOutput .= '</div>';
		
		return $revHiddenThumbnailsOutput;
	}
	
	
	//create hidden div for favorite management and login screen
	function revHiddenFavorites($revCatname){
		
		$revHiddenFavsOutput;
		
		$revHiddenFavsOutput = '<div id="revFavoritesDiv">';
		if ($_COOKIE['revUserName']){
				$revHiddenFavsOutput .= $this->revFavorites($revCatname);	
			}
			else {
				$revHiddenFavsOutput .= $this->revLogin($revCatname);
			}
		
		$revHiddenFavsOutput .= $this->revThumbnails($revCatname);
		$revHiddenFavsOutput .= '</div>';
		
		return $revHiddenFavsOutput;
	}
	
	
	
	
	
	//create copyright notice
	function revCopyright(){
		return "<div class=\"revCopyright\">Before and after gallery is powered by <a href=\"http://www.candacecrowe.com/bragbook/\">BRAG book&trade;</a></div>";
	}
	
	//create landing page
	function revLandingPage(){
		$revLandingPageOutput = $this->landingHeadline;
		$revLandingPageOutput .= $this->landingIntro;
		if(isset($this->hideMainMenu) && $this->hideMainMenu == 1){
		
		} else {
			$revLandingPageOutput .= $this->revLandingMenu();
		}
		$revLandingPageOutput .= $this->revCopyright();
		
		return $revLandingPageOutput;
	}


	//create landing page menu
		function revLandingMenu(){
		$revLandingMenuOutput;
		if($this->nudityWarning == 1){$warning = 'onclick="return confirm(\''.$this->nudityWarningText.'\')" ';}else{$warning = "";}
		
		$revLandingMenuOutput = $this->landingMenuWrapOpen;
				
				if($this->printFullMenu == 1){
					//Write Menu for all categories
					
					
						$revLandingMenuOutput .= $this->fullMenuWrapOpen;
						$revLandingMenuOutput .=  '<ul id="revfullMenuList">';
						for ($x=0; $x<count($this->baCats['cat_set']); $x++){
						//if($this->baCats['cat_set'][$x]['cat_sort'] == "3"){
							if($this->urlRewrite == true){
								if($this->revisionActive == 1){
								$revsNum = 0;
							$currentCatID = $this->baCats['cat_set'][$x]['category_id'];
							$mainCatCount = 0;
							for ($i=0; $i<count($this->fullGallery['ba_set']); $i++){
								if($this->fullGallery['ba_set'][$i]['category'] == $currentCatID){
									$mainCatCount++;
								}
							}
							for ($i=0; $i<count($this->revisionSetsFull); $i++){
				if($this->revisionSetsFull[$i][1] == $currentCatID){
					$revsNum++;
					}
				}
								} 
								
								if($this->menActive == 1){
							$menNum = 0;
							$currentCatID = $this->baCats['cat_set'][$x]['category_id'];
							$mainCatCount2 = 0;
							for ($i=0; $i<count($this->fullGallery['ba_set']); $i++){
								if($this->fullGallery['ba_set'][$i]['category'] == $currentCatID && $currentCatID != 18){
									$mainCatCount2++;
								}
							}
							for ($i=0; $i<count($this->menSetsFull); $i++){
				if($this->menSetsFull[$i][1] == $currentCatID){
					$menNum++;
					}
				}
							}
							
							if($this->menActive == 1 && $this->revisionActive == 1){
							$menRevsNum = 0;
							$currentCatID = $this->baCats['cat_set'][$x]['category_id'];
							$mainCatCount3 = 0;
							for ($i=0; $i<count($this->fullGallery['ba_set']); $i++){
								if($this->fullGallery['ba_set'][$i]['category'] == $currentCatID && $currentCatID != 18){
									$mainCatCount3++;
								}
							}
							for ($i=0; $i<count($this->menRevisionSetsFull); $i++){
				if($this->menRevisionSetsFull[$i][1] == $currentCatID){
					$menRevsNum++;
					}
					
				}
							}
							
							
							if((isset($revsNum) && $revsNum == 1 && $mainCatCount == 1) || (isset($menNum) && $menNum == 1 && $mainCatCount2 == 1)|| (isset($menRevsNum) && $menRevsNum == 1 && $mainCatCount3 == 1)){
								
							}else{
		$revLandingMenuOutput .=  '<li id="revMenuItem'.$currentCatID.'"><a href="'.$this->baseUrl.$this->cleanCat($this->baCats['cat_set'][$x]['category_name']).'/">';
		$revLandingMenuOutput .=  $this->landingMenuListItemCustomTags;
		 $revLandingMenuOutput .=  $this->baCats['cat_set'][$x]['category_name'].'</a></li>';
							}
		
			//check if a set for this category revision has a revision and create second category
			$currentCatID = $this->baCats['cat_set'][$x]['category_id'];
			for ($i=0; $i<count($this->revisionSets); $i++){
				if($this->revisionSets[$i][1] == $currentCatID){
					$revLandingMenuOutput .=  '<li id="revMenuItem'.$currentCatID.'"><a href="'.$this->baseUrl.$this->cleanCat($this->baCats['cat_set'][$x]['category_name']).'-revision/">';
		$revLandingMenuOutput .=  $this->landingMenuListItemCustomTags;
		$revLandingMenuOutput .=  $this->baCats['cat_set'][$x]['category_name'].' - Revision</a></li>';
					break;
				}
			}
			
			//check if for men for current category
			for ($i=0; $i<count($this->menSetsFull); $i++){
				if($this->menSetsFull[$i][1] == $currentCatID && $currentCatID != 18){
					$revLandingMenuOutput .=  '<li id="revMenuItem'.$currentCatID.'"><a href="'.$this->baseUrl.$this->cleanCat($this->baCats['cat_set'][$x]['category_name']).'-for-men/">';
		$revLandingMenuOutput .=  $this->landingMenuListItemCustomTags;
		$revLandingMenuOutput .=  $this->baCats['cat_set'][$x]['category_name'].' For Men</a></li>';
					break;
				}
			}
			
			//check if for men revision for current category
			for ($i=0; $i<count($this->menRevisionSetsFull); $i++){
				if($this->menRevisionSetsFull[$i][1] == $currentCatID && $currentCatID != 18){
					$revLandingMenuOutput .=  '<li id="revMenuItem'.$currentCatID.'"><a href="'.$this->baseUrl.$this->cleanCat($this->baCats['cat_set'][$x]['category_name']).'-for-men-revision/">';
		$revLandingMenuOutput .=  $this->landingMenuListItemCustomTags;
		$revLandingMenuOutput .=  $this->baCats['cat_set'][$x]['category_name'].' For Men - Revision</a></li>';
					break;
				}
			}
			
			
					
		} else{ 
		if($this->revisionActive == 1){
			$revsNum = 0;
							$currentCatID = $this->baCats['cat_set'][$x]['category_id'];
							$mainCatCount = 0;
							for ($i=0; $i<count($this->fullGallery['ba_set']); $i++){
								if($this->fullGallery['ba_set'][$i]['category'] == $currentCatID){
									$mainCatCount++;
								}
							}
							for ($i=0; $i<count($this->revisionSetsFull); $i++){
				if($this->revisionSetsFull[$i][1] == $currentCatID){
					$revsNum++;
					}
				}
		}
		
		if($this->menActive == 1){
							$menNum = 0;
							$currentCatID = $this->baCats['cat_set'][$x]['category_id'];
							$mainCatCount2 = 0;
							for ($i=0; $i<count($this->fullGallery['ba_set']); $i++){
								if($this->fullGallery['ba_set'][$i]['category'] == $currentCatID && $currentCatID != 18){
									$mainCatCount2++;
								}
							}
							for ($i=0; $i<count($this->menSetsFull); $i++){
				if($this->menSetsFull[$i][1] == $currentCatID){
					$menNum++;
					}
				}
							}
							
							if($this->menActive == 1 && $this->revisionActive == 1){
							$menRevsNum = 0;
							$currentCatID = $this->baCats['cat_set'][$x]['category_id'];
							$mainCatCount3 = 0;
							for ($i=0; $i<count($this->fullGallery['ba_set']); $i++){
								if($this->fullGallery['ba_set'][$i]['category'] == $currentCatID && $currentCatID != 18){
									$mainCatCount3++;
								}
							}
							for ($i=0; $i<count($this->menRevisionSetsFull); $i++){
				if($this->menRevisionSetsFull[$i][1] == $currentCatID){
					$menRevsNum++;
					}
					
				}
							}
							
							
							if((isset($revsNum) && $revsNum == 1 && $mainCatCount == 1) || (isset($menNum) && $menNum == 1 && $mainCatCount2 == 1)|| (isset($menRevsNum) && $menRevsNum == 1 && $mainCatCount3 == 1)){
								
							}else{
		$revLandingMenuOutput .=  '<li id="revMenuItem'.$currentCatID.'"><a href="'.$this->baseUrl.'?revCatname='.$this->cleanCat($this->baCats['cat_set'][$x]['category_name']).'/">';
		$revLandingMenuOutput .=  $this->landingMenuListItemCustomTags;
		$revLandingMenuOutput .=  $this->baCats['cat_set'][$x]['category_name'].'</a></li>';
							}
		
		//check if a set for this category revision has a revision and create second category
			$currentCatID = $this->baCats['cat_set'][$x]['category_id'];
			for ($i=0; $i<count($this->revisionSets); $i++){
				if($this->revisionSets[$i][1] == $currentCatID){
					$revLandingMenuOutput .=  '<li  id="revMenuItem'.$currentCatID.'"><a href="'.$this->baseUrl.'?revCatname='.$this->cleanCat($this->baCats['cat_set'][$x]['category_name']).'-revision/">';
		$revLandingMenuOutput .=  $this->landingMenuListItemCustomTags;
		$revLandingMenuOutput .=  $this->baCats['cat_set'][$x]['category_name'].' - Revision</a></li>';
					break;
				}
			}
			
			//check if for men for current category
			for ($i=0; $i<count($this->menSetsFull); $i++){
				if($this->menSetsFull[$i][1] == $currentCatID && $currentCatID != 18){
					$revLandingMenuOutput .=  '<li id="revMenuItem'.$currentCatID.'"><a href="'.$this->baseUrl.'?revCatname='.$this->cleanCat($this->baCats['cat_set'][$x]['category_name']).'-for-men/">';
		$revLandingMenuOutput .=  $this->landingMenuListItemCustomTags;
		$revLandingMenuOutput .=  $this->baCats['cat_set'][$x]['category_name'].' For Men</a></li>';
					break;
				}
			}
			
			//check if for men revision for current category
			for ($i=0; $i<count($this->menRevisionSetsFull); $i++){
				if($this->menRevisionSetsFull[$i][1] == $currentCatID && $currentCatID != 18){
					$revLandingMenuOutput .=  '<li id="revMenuItem'.$currentCatID.'"><a href="'.$this->baseUrl.'?revCatname='.$this->cleanCat($this->baCats['cat_set'][$x]['category_name']).'-for-men-revision/">';
		$revLandingMenuOutput .=  $this->landingMenuListItemCustomTags;
		$revLandingMenuOutput .=  $this->baCats['cat_set'][$x]['category_name'].' For Men - Revision</a></li>';
					break;
				}
			}
			
			
		}
							
							
							
								
						}	
						//}
						$revLandingMenuOutput .=  '</ul>';
						$revLandingMenuOutput .=  $this->fullMenuWrapClose;
					
					// End Print Full Menu
				} else {
					
				
					//Write Menu for Face Procedures
					for ($x=0; $x<count($this->baCats['cat_set']); $x++){
					if($this->baCats['cat_set'][$x]['cat_sort'] == "3"){
							$faceMenu = 1;
					}	
					}
					if(isset($faceMenu)){
						$revLandingMenuOutput .=  $this->faceMenuWrapOpen;
						$revLandingMenuOutput .=  '<div id="revFaceMenu">';
						if(isset($this->faceMenuLabel) && $this->faceMenuLabel != ""){
							$revLandingMenuOutput .=  '<h2>'.$this->faceMenuLabel.'</h2>';
						} else {
						$revLandingMenuOutput .=  '<h2>Face Procedures</h2>';
						}
						$revLandingMenuOutput .=  '<ul id="revfaceMenuList">';
						for ($x=0; $x<count($this->baCats['cat_set']); $x++){
						if($this->baCats['cat_set'][$x]['cat_sort'] == "3"){
							if($this->urlRewrite == true){
								if($this->revisionActive == 1){
								$revsNum = 0;
							$currentCatID = $this->baCats['cat_set'][$x]['category_id'];
							$mainCatCount = 0;
							for ($i=0; $i<count($this->fullGallery['ba_set']); $i++){
								if($this->fullGallery['ba_set'][$i]['category'] == $currentCatID){
									$mainCatCount++;
								}
							}
							for ($i=0; $i<count($this->revisionSetsFull); $i++){
				if($this->revisionSetsFull[$i][1] == $currentCatID){
					$revsNum++;
					}
				}
								}
						
							
							if($this->menActive == 1){
							$menNum = 0;
							$currentCatID = $this->baCats['cat_set'][$x]['category_id'];
							$mainCatCount2 = 0;
							for ($i=0; $i<count($this->fullGallery['ba_set']); $i++){
								if($this->fullGallery['ba_set'][$i]['category'] == $currentCatID && $currentCatID != 18){
									$mainCatCount2++;
								}
							}
							for ($i=0; $i<count($this->menSetsFull); $i++){
				if($this->menSetsFull[$i][1] == $currentCatID){
					$menNum++;
					}
				}
							}
							
							if($this->menActive == 1 && $this->revisionActive == 1){
							$menRevsNum = 0;
							$currentCatID = $this->baCats['cat_set'][$x]['category_id'];
							$mainCatCount3 = 0;
							for ($i=0; $i<count($this->fullGallery['ba_set']); $i++){
								if($this->fullGallery['ba_set'][$i]['category'] == $currentCatID && $currentCatID != 18){
									$mainCatCount3++;
								}
							}
							for ($i=0; $i<count($this->menRevisionSetsFull); $i++){
				if($this->menRevisionSetsFull[$i][1] == $currentCatID){
					$menRevsNum++;
					}
					
				}
							}
							
							
							if((isset($revsNum) && $revsNum == 1 && $mainCatCount == 1) || (isset($menNum) && $menNum == 1 && $mainCatCount2 == 1)|| (isset($menRevsNum) && $menRevsNum == 1 && $mainCatCount3 == 1)){
								
							}else{
		$revLandingMenuOutput .=  '<li  id="revMenuItem'.$currentCatID.'"><a href="'.$this->baseUrl.$this->cleanCat($this->baCats['cat_set'][$x]['category_name']).'/">';
		$revLandingMenuOutput .=  $this->landingMenuListItemCustomTags;
		$revLandingMenuOutput .=  $this->baCats['cat_set'][$x]['category_name'].'</a></li>';
							}
		
			//check if a set for this category revision has a revision and create second category
			$currentCatID = $this->baCats['cat_set'][$x]['category_id'];
			for ($i=0; $i<count($this->revisionSets); $i++){
				if($this->revisionSets[$i][1] == $currentCatID){
					$revLandingMenuOutput .=  '<li  id="revMenuItem'.$currentCatID.'"><a href="'.$this->baseUrl.$this->cleanCat($this->baCats['cat_set'][$x]['category_name']).'-revision/">';
		$revLandingMenuOutput .=  $this->landingMenuListItemCustomTags;
		$revLandingMenuOutput .=  $this->baCats['cat_set'][$x]['category_name'].' - Revision</a></li>';
					break;
				}
			}
			
			//check if for men for current category
			for ($i=0; $i<count($this->menSetsFull); $i++){
				if($this->menSetsFull[$i][1] == $currentCatID && $currentCatID != 18){
					$revLandingMenuOutput .=  '<li id="revMenuItem'.$currentCatID.'"><a href="'.$this->baseUrl.$this->cleanCat($this->baCats['cat_set'][$x]['category_name']).'-for-men/">';
		$revLandingMenuOutput .=  $this->landingMenuListItemCustomTags;
		$revLandingMenuOutput .=  $this->baCats['cat_set'][$x]['category_name'].' For Men</a></li>';
					break;
				}
			}
			
			//check if for men revision for current category
			for ($i=0; $i<count($this->menRevisionSetsFull); $i++){
				if($this->menRevisionSetsFull[$i][1] == $currentCatID && $currentCatID != 18){
					$revLandingMenuOutput .=  '<li id="revMenuItem'.$currentCatID.'"><a href="'.$this->baseUrl.$this->cleanCat($this->baCats['cat_set'][$x]['category_name']).'-for-men-revision/">';
		$revLandingMenuOutput .=  $this->landingMenuListItemCustomTags;
		$revLandingMenuOutput .=  $this->baCats['cat_set'][$x]['category_name'].' For Men - Revision</a></li>';
					break;
				}
			}
			
					
		} else{ 
		if($this->revisionActive == 1){
			$revsNum = 0;
							$currentCatID = $this->baCats['cat_set'][$x]['category_id'];
							$mainCatCount = 0;
							for ($i=0; $i<count($this->fullGallery['ba_set']); $i++){
								if($this->fullGallery['ba_set'][$i]['category'] == $currentCatID){
									$mainCatCount++;
								}
							}
							for ($i=0; $i<count($this->revisionSetsFull); $i++){
				if($this->revisionSetsFull[$i][1] == $currentCatID){
					$revsNum++;
					}
				}
		}
							
							if($this->menActive == 1){
							$menNum = 0;
							$currentCatID = $this->baCats['cat_set'][$x]['category_id'];
							$mainCatCount2 = 0;
							for ($i=0; $i<count($this->fullGallery['ba_set']); $i++){
								if($this->fullGallery['ba_set'][$i]['category'] == $currentCatID && $currentCatID != 18){
									$mainCatCount2++;
								}
							}
							for ($i=0; $i<count($this->menSetsFull); $i++){
				if($this->menSetsFull[$i][1] == $currentCatID){
					$menNum++;
					}
				}
							}
							
							if($this->menActive == 1 && $this->revisionActive == 1){
							$menRevsNum = 0;
							$currentCatID = $this->baCats['cat_set'][$x]['category_id'];
							$mainCatCount3 = 0;
							for ($i=0; $i<count($this->fullGallery['ba_set']); $i++){
								if($this->fullGallery['ba_set'][$i]['category'] == $currentCatID && $currentCatID != 18){
									$mainCatCount3++;
								}
							}
							for ($i=0; $i<count($this->menRevisionSetsFull); $i++){
				if($this->menRevisionSetsFull[$i][1] == $currentCatID){
					$menRevsNum++;
					}
					
				}
							}
							
							
							if((isset($revsNum) && $revsNum == 1 && $mainCatCount == 1) || (isset($menNum) && $menNum == 1 && $mainCatCount2 == 1)|| (isset($menRevsNum) && $menRevsNum == 1 && $mainCatCount3 == 1)){
								
							}else{
		$revLandingMenuOutput .=  '<li  id="revMenuItem'.$currentCatID.'"><a href="'.$this->baseUrl.'?revCatname='.$this->cleanCat($this->baCats['cat_set'][$x]['category_name']).'/">';
		$revLandingMenuOutput .=  $this->landingMenuListItemCustomTags;
		$revLandingMenuOutput .=  $this->baCats['cat_set'][$x]['category_name'].'</a></li>';
							}
		
		//check if a set for this category revision has a revision and create second category
			$currentCatID = $this->baCats['cat_set'][$x]['category_id'];
			for ($i=0; $i<count($this->revisionSets); $i++){
				if($this->revisionSets[$i][1] == $currentCatID){
					$revLandingMenuOutput .=  '<li  id="revMenuItem'.$currentCatID.'"><a href="'.$this->baseUrl.'?revCatname='.$this->cleanCat($this->baCats['cat_set'][$x]['category_name']).'-revision/">';
		$revLandingMenuOutput .=  $this->landingMenuListItemCustomTags;
		$revLandingMenuOutput .=  $this->baCats['cat_set'][$x]['category_name'].' - Revision</a></li>';
					break;
				}
			}
			
			//check if for men for current category
			for ($i=0; $i<count($this->menSetsFull); $i++){
				if($this->menSetsFull[$i][1] == $currentCatID && $currentCatID != 18){
					$revLandingMenuOutput .=  '<li id="revMenuItem'.$currentCatID.'"><a href="'.$this->baseUrl.'?revCatname='.$this->cleanCat($this->baCats['cat_set'][$x]['category_name']).'-for-men/">';
		$revLandingMenuOutput .=  $this->landingMenuListItemCustomTags;
		$revLandingMenuOutput .=  $this->baCats['cat_set'][$x]['category_name'].' For Men</a></li>';
					break;
				}
			}
			
			//check if for men revision for current category
			for ($i=0; $i<count($this->menRevisionSetsFull); $i++){
				if($this->menRevisionSetsFull[$i][1] == $currentCatID && $currentCatID != 18){
					$revLandingMenuOutput .=  '<li id="revMenuItem'.$currentCatID.'"><a href="'.$this->baseUrl.'?revCatname='.$this->cleanCat($this->baCats['cat_set'][$x]['category_name']).'-for-men-revision/">';
		$revLandingMenuOutput .=  $this->landingMenuListItemCustomTags;
		$revLandingMenuOutput .=  $this->baCats['cat_set'][$x]['category_name'].' For Men - Revision</a></li>';
					break;
				}
			}
			
			
		}
							
							
							
								
						}	
						}
						$revLandingMenuOutput .=  '</ul>';
						$revLandingMenuOutput .=  '</div>';
						$revLandingMenuOutput .=  $this->faceMenuWrapClose;
					}
					
					//Write Menu for Breast Procedures
					for ($x=0; $x<count($this->baCats['cat_set']); $x++){
					if($this->baCats['cat_set'][$x]['cat_sort'] == "1"){
							$breastMenu = 1;
					}	
					}
					if(isset($breastMenu)){
						$revLandingMenuOutput .=  $this->breastMenuWrapOpen;
						$revLandingMenuOutput .=  '<div id="revBreastMenu">';
						if(isset($this->breastMenuLabel) && $this->breastMenuLabel != ""){
							$revLandingMenuOutput .=  '<h2>'.$this->breastMenuLabel.'</h2>';
						} else {
						$revLandingMenuOutput .=  '<h2>Breast Procedures</h2>';
						}
						$revLandingMenuOutput .=  '<ul id="revbreastMenuList">';
						for ($x=0; $x<count($this->baCats['cat_set']); $x++){
						if($this->baCats['cat_set'][$x]['cat_sort'] == "1"){
								if($this->urlRewrite == true){
									if($this->revisionActive == 1){
									$revsNum = 0;
							$currentCatID = $this->baCats['cat_set'][$x]['category_id'];
							$mainCatCount = 0;
							for ($i=0; $i<count($this->fullGallery['ba_set']); $i++){
								if($this->fullGallery['ba_set'][$i]['category'] == $currentCatID){
									$mainCatCount++;
								}
							}
							for ($i=0; $i<count($this->revisionSetsFull); $i++){
				if($this->revisionSetsFull[$i][1] == $currentCatID){
					$revsNum++;
					}
				}
				}
							
							if($this->menActive == 1){
							$menNum = 0;
							$currentCatID = $this->baCats['cat_set'][$x]['category_id'];
							$mainCatCount2 = 0;
							for ($i=0; $i<count($this->fullGallery['ba_set']); $i++){
								if($this->fullGallery['ba_set'][$i]['category'] == $currentCatID && $currentCatID != 18){
									$mainCatCount2++;
								}
							}
							for ($i=0; $i<count($this->menSetsFull); $i++){
				if($this->menSetsFull[$i][1] == $currentCatID){
					$menNum++;
					}
				}
							}
							
							if($this->menActive == 1 && $this->revisionActive == 1){
							$menRevsNum = 0;
							$currentCatID = $this->baCats['cat_set'][$x]['category_id'];
							$mainCatCount3 = 0;
							for ($i=0; $i<count($this->fullGallery['ba_set']); $i++){
								if($this->fullGallery['ba_set'][$i]['category'] == $currentCatID && $currentCatID != 18){
									$mainCatCount3++;
								}
							}
							for ($i=0; $i<count($this->menRevisionSetsFull); $i++){
				if($this->menRevisionSetsFull[$i][1] == $currentCatID){
					$menRevsNum++;
					}
					
				}
							}
							
							
							if((isset($revsNum) && $revsNum == 1 && $mainCatCount == 1) || (isset($menNum) && $menNum == 1 && $mainCatCount2 == 1)|| (isset($menRevsNum) && $menRevsNum == 1 && $mainCatCount3 == 1)){
								
							}else{
		$revLandingMenuOutput .=  '<li  id="revMenuItem'.$currentCatID.'"><a '.$warning.' href="'.$this->baseUrl.$this->cleanCat($this->baCats['cat_set'][$x]['category_name']).'/">';
		$revLandingMenuOutput .=  $this->landingMenuListItemCustomTags;
		$revLandingMenuOutput .=  $this->baCats['cat_set'][$x]['category_name'].'</a></li>';
							}
		
		//check if a set for this category revision has a revision and create second category
			$currentCatID = $this->baCats['cat_set'][$x]['category_id'];
			for ($i=0; $i<count($this->revisionSets); $i++){
				if($this->revisionSets[$i][1] == $currentCatID){
					$revLandingMenuOutput .=  '<li  id="revMenuItem'.$currentCatID.'"><a '.$warning.' href="'.$this->baseUrl.$this->cleanCat($this->baCats['cat_set'][$x]['category_name']).'-revision">';
		$revLandingMenuOutput .=  $this->landingMenuListItemCustomTags;
		$revLandingMenuOutput .=  $this->baCats['cat_set'][$x]['category_name'].' - Revision</a></li>';
					break;
				}
			}
			
			//check if for men for current category
			for ($i=0; $i<count($this->menSetsFull); $i++){
				if($this->menSetsFull[$i][1] == $currentCatID && $currentCatID != 18){
					$revLandingMenuOutput .=  '<li id="revMenuItem'.$currentCatID.'"><a href="'.$this->baseUrl.$this->cleanCat($this->baCats['cat_set'][$x]['category_name']).'-for-men/">';
		$revLandingMenuOutput .=  $this->landingMenuListItemCustomTags;
		$revLandingMenuOutput .=  $this->baCats['cat_set'][$x]['category_name'].' For Men</a></li>';
					break;
				}
			}
			
			//check if for men revision for current category
			for ($i=0; $i<count($this->menRevisionSetsFull); $i++){
				if($this->menRevisionSetsFull[$i][1] == $currentCatID && $currentCatID != 18){
					$revLandingMenuOutput .=  '<li id="revMenuItem'.$currentCatID.'"><a href="'.$this->baseUrl.$this->cleanCat($this->baCats['cat_set'][$x]['category_name']).'-for-men-revision/">';
		$revLandingMenuOutput .=  $this->landingMenuListItemCustomTags;
		$revLandingMenuOutput .=  $this->baCats['cat_set'][$x]['category_name'].' For Men - Revision</a></li>';
					break;
				}
			}
		
		} else{ 
		if($this->revisionActive == 1){
			$revsNum = 0;
							$currentCatID = $this->baCats['cat_set'][$x]['category_id'];
							$mainCatCount = 0;
							for ($i=0; $i<count($this->fullGallery['ba_set']); $i++){
								if($this->fullGallery['ba_set'][$i]['category'] == $currentCatID){
									$mainCatCount++;
								}
							}
							for ($i=0; $i<count($this->revisionSetsFull); $i++){
				if($this->revisionSetsFull[$i][1] == $currentCatID && $currentCatID != 18){
					$revsNum++;
					}
				}
				}
							
							if($this->menActive == 1){
							$menNum = 0;
							$currentCatID = $this->baCats['cat_set'][$x]['category_id'];
							$mainCatCount2 = 0;
							for ($i=0; $i<count($this->fullGallery['ba_set']); $i++){
								if($this->fullGallery['ba_set'][$i]['category'] == $currentCatID && $currentCatID != 18){
									$mainCatCount2++;
								}
							}
							for ($i=0; $i<count($this->menSetsFull); $i++){
				if($this->menSetsFull[$i][1] == $currentCatID){
					$menNum++;
					}
				}
							}
							
							if($this->menActive == 1 && $this->revisionActive == 1){
							$menRevsNum = 0;
							$currentCatID = $this->baCats['cat_set'][$x]['category_id'];
							$mainCatCount3 = 0;
							for ($i=0; $i<count($this->fullGallery['ba_set']); $i++){
								if($this->fullGallery['ba_set'][$i]['category'] == $currentCatID && $currentCatID != 18){
									$mainCatCount3++;
								}
							}
							for ($i=0; $i<count($this->menRevisionSetsFull); $i++){
				if($this->menRevisionSetsFull[$i][1] == $currentCatID && $currentCatID != 18){
					$menRevsNum++;
					}
					
				}
							}
							
							
							if((isset($revsNum) && $revsNum == 1 && $mainCatCount == 1) || (isset($menNum) && $menNum == 1 && $mainCatCount2 == 1)|| (isset($menRevsNum) && $menRevsNum == 1 && $mainCatCount3 == 1)){
								
							}else{
		$revLandingMenuOutput .=  '<li id="revMenuItem'.$currentCatID.'"><a '.$warning.' href="'.$this->baseUrl.'?revCatname='.$this->cleanCat($this->baCats['cat_set'][$x]['category_name']).'/">';
		$revLandingMenuOutput .=  $this->landingMenuListItemCustomTags;
		$revLandingMenuOutput .=  $this->baCats['cat_set'][$x]['category_name'].'</a></li>';
							}
		
		//check if a set for this category revision has a revision and create second category
			$currentCatID = $this->baCats['cat_set'][$x]['category_id'];
			for ($i=0; $i<count($this->revisionSets); $i++){
				if($this->revisionSets[$i][1] == $currentCatID){
					$revLandingMenuOutput .=  '<li  id="revMenuItem'.$currentCatID.'"><a '.$warning.' href="'.$this->baseUrl.'?revCatname='.$this->cleanCat($this->baCats['cat_set'][$x]['category_name']).'-revision/">';
		$revLandingMenuOutput .=  $this->landingMenuListItemCustomTags;
		$revLandingMenuOutput .=  $this->baCats['cat_set'][$x]['category_name'].' - Revision</a></li>';
					break;
				}
			}
			
			//check if for men for current category
			for ($i=0; $i<count($this->menSetsFull); $i++){
				if($this->menSetsFull[$i][1] == $currentCatID && $currentCatID != 18){
					$revLandingMenuOutput .=  '<li id="revMenuItem'.$currentCatID.'"><a href="'.$this->baseUrl.'?revCatname='.$this->cleanCat($this->baCats['cat_set'][$x]['category_name']).'-for-men/">';
		$revLandingMenuOutput .=  $this->landingMenuListItemCustomTags;
		$revLandingMenuOutput .=  $this->baCats['cat_set'][$x]['category_name'].' For Men</a></li>';
					break;
				}
			}
			
			//check if for men revision for current category
			for ($i=0; $i<count($this->menRevisionSetsFull); $i++){
				if($this->menRevisionSetsFull[$i][1] == $currentCatID && $currentCatID != 18){
					$revLandingMenuOutput .=  '<li id="revMenuItem'.$currentCatID.'"><a href="'.$this->baseUrl.'?revCatname='.$this->cleanCat($this->baCats['cat_set'][$x]['category_name']).'-for-men-revision/">';
		$revLandingMenuOutput .=  $this->landingMenuListItemCustomTags;
		$revLandingMenuOutput .=  $this->baCats['cat_set'][$x]['category_name'].' For Men - Revision</a></li>';
					break;
				}
			}
		
		}
						}	
						}
						$revLandingMenuOutput .=  '</ul>';
						$revLandingMenuOutput .=  '</div>';
						$revLandingMenuOutput .=  $this->breastMenuWrapClose;
					}
					
					//Write Menu for Body Procedures
					for ($x=0; $x<count($this->baCats['cat_set']); $x++){
					if($this->baCats['cat_set'][$x]['cat_sort'] == "2"){
							$bodyMenu = 1;
					}	
					}
					if(isset($bodyMenu)){
						$revLandingMenuOutput .=  $this->bodyMenuWrapOpen;
						$revLandingMenuOutput .=  '<div id="revBodyMenu">';
						if(isset($this->bodyMenuLabel) && $this->bodyMenuLabel != ""){
							$revLandingMenuOutput .=  '<h2>'.$this->bodyMenuLabel.'</h2>';
						} else {
						$revLandingMenuOutput .=  '<h2>Body Procedures</h2>';
						}
						$revLandingMenuOutput .=  '<ul id="revbodyMenuList">';
						for ($x=0; $x<count($this->baCats['cat_set']); $x++){
						if($this->baCats['cat_set'][$x]['cat_sort'] == "2"){
								if($this->urlRewrite == true){
									if($this->revisionActive == 1){
									$revsNum = 0;
							$currentCatID = $this->baCats['cat_set'][$x]['category_id'];
							$mainCatCount = 0;
							for ($i=0; $i<count($this->fullGallery['ba_set']); $i++){
								if($this->fullGallery['ba_set'][$i]['category'] == $currentCatID){
									$mainCatCount++;
								}
							}
							for ($i=0; $i<count($this->revisionSetsFull); $i++){
				if($this->revisionSetsFull[$i][1] == $currentCatID){
					$revsNum++;
					}
				}
				}
							
							if($this->menActive == 1){
							$menNum = 0;
							$currentCatID = $this->baCats['cat_set'][$x]['category_id'];
							$mainCatCount2 = 0;
							for ($i=0; $i<count($this->fullGallery['ba_set']); $i++){
								if($this->fullGallery['ba_set'][$i]['category'] == $currentCatID && $currentCatID != 18){
									$mainCatCount2++;
								}
							}
							for ($i=0; $i<count($this->menSetsFull); $i++){
				if($this->menSetsFull[$i][1] == $currentCatID && $currentCatID != 18){
					$menNum++;
					}
				}
							}
							
							if($this->menActive == 1 && $this->revisionActive == 1){
							$menRevsNum = 0;
							$currentCatID = $this->baCats['cat_set'][$x]['category_id'];
							$mainCatCount3 = 0;
							for ($i=0; $i<count($this->fullGallery['ba_set']); $i++){
								if($this->fullGallery['ba_set'][$i]['category'] == $currentCatID && $currentCatID != 18){
									$mainCatCount3++;
								}
							}
							for ($i=0; $i<count($this->menRevisionSetsFull); $i++){
				if($this->menRevisionSetsFull[$i][1] == $currentCatID && $currentCatID != 18){
					$menRevsNum++;
					}
					
				}
							}
							
							
							if((isset($revsNum) && $revsNum == 1 && $mainCatCount == 1) || (isset($menNum) && $menNum == 1 && $mainCatCount2 == 1)|| (isset($menRevsNum) && $menRevsNum == 1 && $mainCatCount3 == 1)){
								
							}else{
		$revLandingMenuOutput .=  '<li id="revMenuItem'.$currentCatID.'"><a '.$warning.' href="'.$this->baseUrl.$this->cleanCat($this->baCats['cat_set'][$x]['category_name']).'/">';
		$revLandingMenuOutput .=  $this->landingMenuListItemCustomTags;
		$revLandingMenuOutput .=  $this->baCats['cat_set'][$x]['category_name'].'</a></li>';
							}
		
		//check if a set for this category revision has a revision and create second category
			$currentCatID = $this->baCats['cat_set'][$x]['category_id'];
			for ($i=0; $i<count($this->revisionSets); $i++){
				if($this->revisionSets[$i][1] == $currentCatID){
					$revLandingMenuOutput .=  '<li id="revMenuItem'.$currentCatID.'"><a '.$warning.' href="'.$this->baseUrl.$this->cleanCat($this->baCats['cat_set'][$x]['category_name']).'-revision/">';
		$revLandingMenuOutput .=  $this->landingMenuListItemCustomTags;
		$revLandingMenuOutput .=  $this->baCats['cat_set'][$x]['category_name'].' - Revision</a></li>';
					break;
				}
			}
			
			//check if for men for current category
			for ($i=0; $i<count($this->menSetsFull); $i++){
				if($this->menSetsFull[$i][1] == $currentCatID && $currentCatID != 18){
					$revLandingMenuOutput .=  '<li id="revMenuItem'.$currentCatID.'"><a href="'.$this->baseUrl.$this->cleanCat($this->baCats['cat_set'][$x]['category_name']).'-for-men/">';
		$revLandingMenuOutput .=  $this->landingMenuListItemCustomTags;
		$revLandingMenuOutput .=  $this->baCats['cat_set'][$x]['category_name'].' For Men</a></li>';
					break;
				}
			}
			
			//check if for men revision for current category
			for ($i=0; $i<count($this->menRevisionSetsFull); $i++){
				if($this->menRevisionSetsFull[$i][1] == $currentCatID && $currentCatID != 18){
					$revLandingMenuOutput .=  '<li id="revMenuItem'.$currentCatID.'"><a href="'.$this->baseUrl.$this->cleanCat($this->baCats['cat_set'][$x]['category_name']).'-for-men-revision/">';
		$revLandingMenuOutput .=  $this->landingMenuListItemCustomTags;
		$revLandingMenuOutput .=  $this->baCats['cat_set'][$x]['category_name'].' For Men - Revision</a></li>';
					break;
				}
			}
			
		} else{ 
			if($this->revisionActive == 1){
			$revsNum = 0;
							$currentCatID = $this->baCats['cat_set'][$x]['category_id'];
							$mainCatCount = 0;
							for ($i=0; $i<count($this->fullGallery['ba_set']); $i++){
								if($this->fullGallery['ba_set'][$i]['category'] == $currentCatID){
									$mainCatCount++;
								}
							}
							for ($i=0; $i<count($this->revisionSetsFull); $i++){
				if($this->revisionSetsFull[$i][1] == $currentCatID){
					$revsNum++;
					}
				}
			}
							
							
							if($this->menActive == 1){
							$menNum = 0;
							$currentCatID = $this->baCats['cat_set'][$x]['category_id'];
							$mainCatCount2 = 0;
							for ($i=0; $i<count($this->fullGallery['ba_set']); $i++){
								if($this->fullGallery['ba_set'][$i]['category'] == $currentCatID && $currentCatID != 18){
									$mainCatCount2++;
								}
							}
							for ($i=0; $i<count($this->menSetsFull); $i++){
				if($this->menSetsFull[$i][1] == $currentCatID){
					$menNum++;
					}
				}
							}
							
							if($this->menActive == 1 && $this->revisionActive == 1){
							$menRevsNum = 0;
							$currentCatID = $this->baCats['cat_set'][$x]['category_id'];
							$mainCatCount3 = 0;
							for ($i=0; $i<count($this->fullGallery['ba_set']); $i++){
								if($this->fullGallery['ba_set'][$i]['category'] == $currentCatID && $currentCatID != 18){
									$mainCatCount3++;
								}
							}
							for ($i=0; $i<count($this->menRevisionSetsFull); $i++){
				if($this->menRevisionSetsFull[$i][1] == $currentCatID){
					$menRevsNum++;
					}
					
				}
							}
							
							
							if((isset($revsNum) && $revsNum == 1 && $mainCatCount == 1) || (isset($menNum) && $menNum == 1 && $mainCatCount2 == 1)|| (isset($menRevsNum) && $menRevsNum == 1 && $mainCatCount3 == 1)){
								
							}else{
		$revLandingMenuOutput .=  '<li id="revMenuItem'.$currentCatID.'"><a '.$warning.' href="'.$this->baseUrl.'?revCatname='.$this->cleanCat($this->baCats['cat_set'][$x]['category_name']).'/">';
		$revLandingMenuOutput .=  $this->landingMenuListItemCustomTags;
		$revLandingMenuOutput .=  $this->baCats['cat_set'][$x]['category_name'].'</a></li>';
							}
		
		//check if a set for this category revision has a revision and create second category
			$currentCatID = $this->baCats['cat_set'][$x]['category_id'];
			for ($i=0; $i<count($this->revisionSets); $i++){
				if($this->revisionSets[$i][1] == $currentCatID){
					$revLandingMenuOutput .=  '<li id="revMenuItem'.$currentCatID.'"><a '.$warning.' href="'.$this->baseUrl.'?revCatname='.$this->cleanCat($this->baCats['cat_set'][$x]['category_name']).'-revision/">';
		$revLandingMenuOutput .=  $this->landingMenuListItemCustomTags;
		$revLandingMenuOutput .=  $this->baCats['cat_set'][$x]['category_name'].' - Revision</a></li>';
					break;
				}
			}
			
			//check if for men for current category
			for ($i=0; $i<count($this->menSetsFull); $i++){
				if($this->menSetsFull[$i][1] == $currentCatID && $currentCatID != 18){
					$revLandingMenuOutput .=  '<li id="revMenuItem'.$currentCatID.'"><a href="'.$this->baseUrl.'?revCatname='.$this->cleanCat($this->baCats['cat_set'][$x]['category_name']).'-for-men/">';
		$revLandingMenuOutput .=  $this->landingMenuListItemCustomTags;
		$revLandingMenuOutput .=  $this->baCats['cat_set'][$x]['category_name'].' For Men</a></li>';
					break;
				}
			}
			
			//check if for men revision for current category
			for ($i=0; $i<count($this->menRevisionSetsFull); $i++){
				if($this->menRevisionSetsFull[$i][1] == $currentCatID && $currentCatID != 18){
					$revLandingMenuOutput .=  '<li id="revMenuItem'.$currentCatID.'"><a href="'.$this->baseUrl.'?revCatname'.$this->cleanCat($this->baCats['cat_set'][$x]['category_name']).'-for-men-revision/">';
		$revLandingMenuOutput .=  $this->landingMenuListItemCustomTags;
		$revLandingMenuOutput .=  $this->baCats['cat_set'][$x]['category_name'].' For Men - Revision</a></li>';
					break;
				}
			}
		
		}
						}	
						}
						$revLandingMenuOutput .=  '</ul>';
						$revLandingMenuOutput .=  '</div>';
						$revLandingMenuOutput .=  $this->bodyMenuWrapClose;
					}
					
					//Write Menu for non-surgical Procedures
					for ($x=0; $x<count($this->baCats['cat_set']); $x++){
					if($this->baCats['cat_set'][$x]['cat_sort'] == "4"){
							$skinMenu = 1;
					}	
					}
					if(isset($skinMenu)){
						$revLandingMenuOutput .=  $this->skinMenuWrapOpen;
						$revLandingMenuOutput .=  '<div id="revSkinMenu">';
						if(isset($this->skinMenuLabel) && $this->skinMenuLabel != ""){
							$revLandingMenuOutput .=  '<h2>'.$this->skinMenuLabel.'</h2>';
						} else {
						$revLandingMenuOutput .=  '<h2>Non-Surgical Procedures</h2>';
						}
						$revLandingMenuOutput .=  '<ul id="revskinMenuList">';
						for ($x=0; $x<count($this->baCats['cat_set']); $x++){
						if($this->baCats['cat_set'][$x]['cat_sort'] == "4"){
								if($this->urlRewrite == true){
									if($this->revisionActive == 1){
									$revsNum = 0;
							$currentCatID = $this->baCats['cat_set'][$x]['category_id'];
							$mainCatCount = 0;
							for ($i=0; $i<count($this->fullGallery['ba_set']); $i++){
								if($this->fullGallery['ba_set'][$i]['category'] == $currentCatID){
									$mainCatCount++;
								}
							}
							for ($i=0; $i<count($this->revisionSetsFull); $i++){
				if($this->revisionSetsFull[$i][1] == $currentCatID){
					$revsNum++;
					}
				}
				}
							
							
							if($this->menActive == 1){
							$menNum = 0;
							$currentCatID = $this->baCats['cat_set'][$x]['category_id'];
							$mainCatCount2 = 0;
							for ($i=0; $i<count($this->fullGallery['ba_set']); $i++){
								if($this->fullGallery['ba_set'][$i]['category'] == $currentCatID && $currentCatID != 18){
									$mainCatCount2++;
								}
							}
							for ($i=0; $i<count($this->menSetsFull); $i++){
				if($this->menSetsFull[$i][1] == $currentCatID){
					$menNum++;
					}
				}
							}
							
							if($this->menActive == 1 && $this->revisionActive == 1){
							$menRevsNum = 0;
							$currentCatID = $this->baCats['cat_set'][$x]['category_id'];
							$mainCatCount3 = 0;
							for ($i=0; $i<count($this->fullGallery['ba_set']); $i++){
								if($this->fullGallery['ba_set'][$i]['category'] == $currentCatID && $currentCatID != 18){
									$mainCatCount3++;
								}
							}
							for ($i=0; $i<count($this->menRevisionSetsFull); $i++){
				if($this->menRevisionSetsFull[$i][1] == $currentCatID){
					$menRevsNum++;
					}
					
				}
							}
							
							
							if((isset($revsNum) && $revsNum == 1 && $mainCatCount == 1) || (isset($menNum) && $menNum == 1 && $mainCatCount2 == 1)|| (isset($menRevsNum) && $menRevsNum == 1 && $mainCatCount3 == 1)){
								
							}else{
		$revLandingMenuOutput .=  '<li id="revMenuItem'.$currentCatID.'"><a href="'.$this->baseUrl.$this->cleanCat($this->baCats['cat_set'][$x]['category_name']).'/">';
		$revLandingMenuOutput .=  $this->landingMenuListItemCustomTags;
		$revLandingMenuOutput .=  $this->baCats['cat_set'][$x]['category_name'].'</a></li>';
							}
		
		//check if a set for this category revision has a revision and create second category
			$currentCatID = $this->baCats['cat_set'][$x]['category_id'];
			for ($i=0; $i<count($this->revisionSets); $i++){
				if($this->revisionSets[$i][1] == $currentCatID){
					$revLandingMenuOutput .=  '<li id="revMenuItem'.$currentCatID.'"><a href="'.$this->baseUrl.$this->cleanCat($this->baCats['cat_set'][$x]['category_name']).'-revision/">';
		$revLandingMenuOutput .=  $this->landingMenuListItemCustomTags;
		$revLandingMenuOutput .=  $this->baCats['cat_set'][$x]['category_name'].' - Revision</a></li>';
					break;
				}
			}
			
			//check if for men for current category
			for ($i=0; $i<count($this->menSetsFull); $i++){
				if($this->menSetsFull[$i][1] == $currentCatID && $currentCatID != 18){
					$revLandingMenuOutput .=  '<li id="revMenuItem'.$currentCatID.'"><a href="'.$this->baseUrl.$this->cleanCat($this->baCats['cat_set'][$x]['category_name']).'-for-men/">';
		$revLandingMenuOutput .=  $this->landingMenuListItemCustomTags;
		$revLandingMenuOutput .=  $this->baCats['cat_set'][$x]['category_name'].' For Men</a></li>';
					break;
				}
			}
			
			//check if for men revision for current category
			for ($i=0; $i<count($this->menRevisionSetsFull); $i++){
				if($this->menRevisionSetsFull[$i][1] == $currentCatID && $currentCatID != 18){
					$revLandingMenuOutput .=  '<li id="revMenuItem'.$currentCatID.'"><a href="'.$this->baseUrl.$this->cleanCat($this->baCats['cat_set'][$x]['category_name']).'-for-men-revision/">';
		$revLandingMenuOutput .=  $this->landingMenuListItemCustomTags;
		$revLandingMenuOutput .=  $this->baCats['cat_set'][$x]['category_name'].' For Men - Revision</a></li>';
					break;
				}
			}
			
		} else{ 
		if($this->revisionActive == 1){
			$revsNum = 0;
							$currentCatID = $this->baCats['cat_set'][$x]['category_id'];
							$mainCatCount = 0;
							for ($i=0; $i<count($this->fullGallery['ba_set']); $i++){
								if($this->fullGallery['ba_set'][$i]['category'] == $currentCatID){
									$mainCatCount++;
								}
							}
							for ($i=0; $i<count($this->revisionSetsFull); $i++){
				if($this->revisionSetsFull[$i][1] == $currentCatID){
					$revsNum++;
					}
				}
		}
							
							
							if($this->menActive == 1){
							$menNum = 0;
							$currentCatID = $this->baCats['cat_set'][$x]['category_id'];
							$mainCatCount2 = 0;
							for ($i=0; $i<count($this->fullGallery['ba_set']); $i++){
								if($this->fullGallery['ba_set'][$i]['category'] == $currentCatID && $currentCatID != 18){
									$mainCatCount2++;
								}
							}
							for ($i=0; $i<count($this->menSetsFull); $i++){
				if($this->menSetsFull[$i][1] == $currentCatID){
					$menNum++;
					}
				}
							}
							
							if($this->menActive == 1 && $this->revisionActive == 1){
							$menRevsNum = 0;
							$currentCatID = $this->baCats['cat_set'][$x]['category_id'];
							$mainCatCount3 = 0;
							for ($i=0; $i<count($this->fullGallery['ba_set']); $i++){
								if($this->fullGallery['ba_set'][$i]['category'] == $currentCatID && $currentCatID != 18){
									$mainCatCount3++;
								}
							}
							for ($i=0; $i<count($this->menRevisionSetsFull); $i++){
				if($this->menRevisionSetsFull[$i][1] == $currentCatID){
					$menRevsNum++;
					}
					
				}
							}
							
							
							if((isset($revsNum) && $revsNum == 1 && $mainCatCount == 1) || (isset($menNum) && $menNum == 1 && $mainCatCount2 == 1)|| (isset($menRevsNum) && $menRevsNum == 1 && $mainCatCount3 == 1)){
								
							}else{
		$revLandingMenuOutput .=  '<li id="revMenuItem'.$currentCatID.'"><a href="'.$this->baseUrl.'?revCatname='.$this->cleanCat($this->baCats['cat_set'][$x]['category_name']).'/">';
		$revLandingMenuOutput .=  $this->landingMenuListItemCustomTags;
		$revLandingMenuOutput .=  $this->baCats['cat_set'][$x]['category_name'].'</a></li>';
							}
		
		//check if a set for this category revision has a revision and create second category
			$currentCatID = $this->baCats['cat_set'][$x]['category_id'];
			for ($i=0; $i<count($this->revisionSets); $i++){
				if($this->revisionSets[$i][1] == $currentCatID){
					$revLandingMenuOutput .=  '<li id="revMenuItem'.$currentCatID.'"><a href="'.$this->baseUrl.'?revCatname='.$this->cleanCat($this->baCats['cat_set'][$x]['category_name']).'-revision/">';
		$revLandingMenuOutput .=  $this->landingMenuListItemCustomTags;
		$revLandingMenuOutput .=  $this->baCats['cat_set'][$x]['category_name'].' - Revision</a></li>';
					break;
				}
			}
			
			//check if for men for current category
			for ($i=0; $i<count($this->menSetsFull); $i++){
				if($this->menSetsFull[$i][1] == $currentCatID && $currentCatID != 18){
					$revLandingMenuOutput .=  '<li id="revMenuItem'.$currentCatID.'"><a href="'.$this->baseUrl.'?revCatname='.$this->cleanCat($this->baCats['cat_set'][$x]['category_name']).'-for-men/">';
		$revLandingMenuOutput .=  $this->landingMenuListItemCustomTags;
		$revLandingMenuOutput .=  $this->baCats['cat_set'][$x]['category_name'].' For Men</a></li>';
					break;
				}
			}
			
			//check if for men revision for current category
			for ($i=0; $i<count($this->menRevisionSetsFull); $i++){
				if($this->menRevisionSetsFull[$i][1] == $currentCatID && $currentCatID != 18){
					$revLandingMenuOutput .=  '<li id="revMenuItem'.$currentCatID.'"><a href="'.$this->baseUrl.'?revCatname='.$this->cleanCat($this->baCats['cat_set'][$x]['category_name']).'-for-men-revision/">';
		$revLandingMenuOutput .=  $this->landingMenuListItemCustomTags;
		$revLandingMenuOutput .=  $this->baCats['cat_set'][$x]['category_name'].' For Men - Revision</a></li>';
					break;
				}
			}
		
		}
						}	
						}
						$revLandingMenuOutput .=  '</ul>';
						$revLandingMenuOutput .=  '</div>';
						$revLandingMenuOutput .=  $this->skinMenuWrapClose;
					}
				}//end else statement to print sorted categories
					$revLandingMenuOutput .=  '<br class="clearfixer" />';
		$revLandingMenuOutput .=  $this->landingMenuWrapClose;
		
		return $revLandingMenuOutput;
		
	}
	
	
	
	//Create menu to navigate thumbnails 
	function revThumbnailNav($revCatname, $thumbStart){
		$revCatname = $this->cleanCat($revCatname);
		
		$revThumbnailNavOutput;		

	$revThumbnailNavOutput = '<div id="revThumbNavDiv"><ul id="revThumbGalleryNav">';
	
	//write "previous" navigation item
	if($thumbStart >= 1){
		
		
						//$revLink = $revCatname."|".($thumbStart - 1);
		
		$revThumbnailNavOutput .= '<li><a class="thumbNavLink" href="javascript:;" data-revcatname="'.$revCatname.'" data-thumbstart="'.($thumbStart - 1).'"  rel="nofollow">&lt; <span class="revPrevNav">Previous</span></a></li>';
		
	}
	
	//write navigation menu
	if($thumbStart <= 4){
		
		$i = 0;
		while ($i<5 && ($i*$this->thumbLimit)<(count($this->baGallery['ba_set'])))
		  {
			
			  //check if is current record to highlight it
			  if($i == $thumbStart){
				$highlighted = ' baNavHighlight';
			  } else {
				  $highlighted = "";
			  }
						//$revLink = $revCatname."|".$i;
			
			$revThumbnailNavOutput .=  '<li><a class="thumbNavLink'.$highlighted.'" href="javascript:;" data-revcatname="'.$revCatname.'" data-thumbstart="'.$i.'" rel="nofollow">'.($i+1).'</a></li>';
		  $i++;
		  }
		
	} else if($thumbStart*$this->thumbLimit >= (count($this->baGallery['ba_set'])-(5*$this->thumbLimit))){
		
		
		
		$i = (count($this->baGallery['ba_set'])-(5*$this->thumbLimit))/$this->thumbLimit;
		$i = round($i, 0, PHP_ROUND_HALF_DOWN);
		while ($i*$this->thumbLimit<(count($this->baGallery['ba_set'])))
		  {
			  //check if is current record to highlight it
			  if($i == $thumbStart){
				$highlighted = ' baNavHighlight';
			  } else {
				  $highlighted = "";
			  }
						//$revLink = $revCatname."|".$i;
			  
			$revThumbnailNavOutput .=  '<li><a class="thumbNavLink'.$highlighted.'" href="javascript:;" data-revcatname="'.$revCatname.'" data-thumbstart="'.$i.'" rel="nofollow">'.($i+1).'</a></li>';
			
		  $i++;
		  }
		
	} else {
		
		$i = $thumbStart;
		
		while ($i<($thumbStart+5) )
		  {
			  //check if is current record to highlight it
			  if($i == $thumbStart){
				$highlighted = ' baNavHighlight';
			  } else {
				  $highlighted = "";
			  }
			 //$revLink = $revCatname."|".$i;
			$revThumbnailNavOutput .=  '<li><a class="thumbNavLink'.$highlighted.'" href="javascript:;" data-revcatname="'.$revCatname.'" data-thumbstart="'.$i.'" rel="nofollow">'.($i+1).'</a></li>';
			
		  $i++;
		  }
		
	}
	
	//write "next" navigation item
	if(($thumbStart*$this->thumbLimit)+$this->thumbLimit < count($this->baGallery['ba_set'])){
		
		// $revLink = $revCatname."|".($thumbStart+1);
		
		$revThumbnailNavOutput .=  '<li><a class="thumbNavLink" href="javascript:;" data-revcatname="'.$revCatname.'" data-thumbstart="'.($thumbStart+1).'" rel="nofollow"><span class="revNextNav">Next</span> &gt;</a></li>';
	}

	$revThumbnailNavOutput .=  '</ul></div>';
	
	return $revThumbnailNavOutput;
		
	}
	
	function curPageURL() {
 $pageURL = 'http';
 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["HTTP_HOST"];
 } else {
  $pageURL .= $_SERVER["HTTP_HOST"];
 }
 return $pageURL;
}
	
	
	function addAnalytics(){
		if(isset($this->analyticsID) && $this->analyticsID != ""){
		return "<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
  ga('create', '".$this->analyticsID."', 'auto', {'name': 'bbTracker'});
  ga('bbTracker.set', 'page', '/".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']."');
  ga('bbTracker.send', 'pageview');
</script>";
		}
	}

	function fullCatName($revCatname){
	for ($x=0; $x<count($this->baCats['cat_set']); $x++){
						if($this->cleanCat($revCatname) == $this->cleanCat($this->baCats['cat_set'][$x]['category_name'])){
							$revCatname = $this->baCats['cat_set'][$x]['category_name'];
						}
		}	
		return $revCatname;
	}
	
	//create full default gallery
	function revenezBAgallery($revCatname, $revID){
		//print_r($this->fullGallery);
		$galleryOutput;
		
		$galleryOutput = '<div id="revGalleryWrap">';
		if($revCatname == "Home"){
				$galleryOutput .= $this->revLandingPage();
		} else {
			if($revID == '999999'){
				$galleryOutput .= $this->categoryLandingPageWrapOpen;
				if(isset($this->hideJumpMenu) && $this->hideJumpMenu == 1){}else{$galleryOutput .= $this->revCategoryNavJumpMenu($revCatname);}
				$galleryOutput .= '<h1 id="revCategoryHeadline">';
				$fullCat = $this->fullCatName($revCatname);
				$galleryOutput .= str_replace('Revision', '- Revision',ucwords($fullCat)).' Before &amp; After Gallery';
				$galleryOutput .= ' </h1>';  
				$galleryOutput .= $this->categoryLandingPageIntro;
				$galleryOutput .= $this->revCategoryLandingPage($revCatname);
				$galleryOutput .= $this->categoryLandingPageWrapClose;
			} else{
			$galleryOutput .= $this->imageSetWrapOpen;
		$galleryOutput .= '<a id="ba" name="ba" aria-label="Select New Procedure"></a>';
		if(isset($this->hideJumpMenu) && $this->hideJumpMenu == 1){}else{$galleryOutput .= $this->revCategoryNavJumpMenu($revCatname);}
		$galleryOutput .= '<div id="revGalleryHeader">';
		if($this->myFavsActive == 1){$galleryOutput .=  $this->revFavoriteText($revID);}
		$galleryOutput .= '<h1 id="revPatientHeadline">';
        $galleryOutput .= $this->revHeadline($revCatname, $revID);
        $galleryOutput .= ' </h1>';  		
		
		$galleryOutput .= $this->revImageSetNav($revCatname, $revID);
		$galleryOutput .= '<div class="clearfixer"></div>';
		$galleryOutput .= '</div>';
		
		if($this->thumbnailsActive == 1 || $this->myFavsActive == 1){$galleryOutput .= '<div class="revThumbLaunchCon">';}
		if($this->thumbnailsActive == 1){
		$galleryOutput .= $this->revThumbnailButton();
		}
		if($this->thumbnailsActive == 1 && $this->myFavsActive == 1){$galleryOutput .='<span class="revButtonDivide"> | </span>';}
		if($this->myFavsActive == 1){$galleryOutput .=  $this->revFavoriteButton($revID);}
		if($this->thumbnailsActive == 1 || $this->myFavsActive == 1){$galleryOutput .= '</div>';}
		$galleryOutput .= $this->revImageSet($revCatname, $revID);
		$galleryOutput .= $this->revPatientInfo($revID);
		
		if($this->thumbnailsActive == 1 || $this->myFavsActive == 1){$galleryOutput .= '<div class="revThumbLaunchCon">';}
		if($this->thumbnailsActive == 1){$galleryOutput .= $this->revThumbnailButton();}
		if($this->thumbnailsActive == 1 && $this->myFavsActive == 1){$galleryOutput .='<span class="revButtonDivide"> | </span>';}
		if($this->myFavsActive == 1){$galleryOutput .= $this->revFavoriteButton($revID);}
		$galleryOutput .= $this->revCopyright();
		if($this->thumbnailsActive == 1 || $this->myFavsActive == 1){$galleryOutput .= '</div>';}
		if($this->thumbnailsActive == 1){
			if(isset($this->thumbLimit)){
				$galleryOutput .= $this->revHiddenThumbnails($revCatname, 0);
			} else{
				$galleryOutput .= $this->revHiddenThumbnails($revCatname);	
			}
		}
		
		$galleryOutput .= $this->imageSetWrapClose;
			}
		}
		$galleryOutput .= $this->addAnalytics();
		$galleryOutput .= '</div>';
		
		return $galleryOutput;
	}
	
	
	////////////////////////////////////// XML Sitemap Functions
	
	
	//loop and get the category URLs
	function revGetCatsSitemap(){
		
		$revXmlCatList = array();
		$menNum = "";
		$menRevsNum= "";
		$revsNum = "";

			for ($x=0; $x<count($this->baCats['cat_set']); $x++){
				
						
							if($this->revisionActive == 1){
							$revsNum = 0;
							$currentCatID = $this->baCats['cat_set'][$x]['category_id'];
							$mainCatCount = 0;
							for ($i=0; $i<count($this->fullGallery['ba_set']); $i++){
								if($this->fullGallery['ba_set'][$i]['category'] == $currentCatID){
									$mainCatCount++;
								}
							}
							for ($i=0; $i<count($this->revisionSetsFull); $i++){
				if($this->revisionSetsFull[$i][1] == $currentCatID){
					$revsNum++;
					}
				}
							}
							
							if($this->menActive == 1){
							$menNum = 0;
							$currentCatID = $this->baCats['cat_set'][$x]['category_id'];
							$mainCatCount2 = 0;
							for ($i=0; $i<count($this->fullGallery['ba_set']); $i++){
								if($this->fullGallery['ba_set'][$i]['category'] == $currentCatID && $currentCatID != 18){
									$mainCatCount2++;
								}
								
							}
							for ($i=0; $i<count($this->menSetsFull); $i++){
				if($this->menSetsFull[$i][1] == $currentCatID){
					$menNum++;
					}
								
				}
							}
							
				
							if($this->menActive == 1 && $this->revisionActive == 1){
								
							$menRevsNum = 0;
							$currentCatID = $this->baCats['cat_set'][$x]['category_id'];
							$mainCatCount3 = 0;
							for ($i=0; $i<count($this->fullGallery['ba_set']); $i++){
								if($this->fullGallery['ba_set'][$i]['category'] == $currentCatID && $currentCatID != 18){
									$mainCatCount3++;
								}
							}
							for ($i=0; $i<count($this->menRevisionSetsFull); $i++){
				if($this->menRevisionSetsFull[$i][1] == $currentCatID){
					$menRevsNum++;
					}
					
				}
							}
							
							
							if(($revsNum == 1 && $mainCatCount == 1) || ($menNum == 1 && $mainCatCount2 == 1)|| ($menRevsNum == 1 && $mainCatCount3 == 1)){
							//	$revXmlCatList[] =  $this->cleanCat($this->baCats['cat_set'][$x]['category_name']);
							}else{
							$revXmlCatList[] =  $this->cleanCat($this->baCats['cat_set'][$x]['category_name']);
							}
							
							//check if a set for this category revision has a revision and create second category
			
			for ($i=0; $i<count($this->revisionSetsFull); $i++){
				if($this->revisionSetsFull[$i][1] == $currentCatID){
					
					$revXmlCatList[] =  $this->cleanCat($this->baCats['cat_set'][$x]['category_name']).'-revision';
					break;
				}
			}
			
			//check if for men for current category
			for ($i=0; $i<count($this->menSetsFull); $i++){
				if($this->menSetsFull[$i][1] == $currentCatID && $currentCatID != 18) {
					
					$revXmlCatList[] =  $this->cleanCat($this->baCats['cat_set'][$x]['category_name']).'-for-men';
					break;
				}
			}
			
			//check if for men revision for current category
			for ($i=0; $i<count($this->menRevisionSetsFull); $i++){
				if($this->menRevisionSetsFull[$i][1] == $currentCatID && $currentCatID != 18){
					
					$revXmlCatList[] =  $this->cleanCat($this->baCats['cat_set'][$x]['category_name']).'-for-men-revision';
					break;
				}
			}
							
						
					}
		
		return $revXmlCatList;
	}
	
	
	
	//loop through and get URLS for image sets
	function revCategorySetsList($revCatname){
		
		$revBaSetsSitemapOutput = array();
		$revCatname = $this->cleanCat($revCatname);
		$recordLimit = count($this->baGallery['ba_set']);

		for ($x=0; $x<$recordLimit; $x++){
				if(isset($this->baGallery['ba_set'][$x]['oid'])){
						if(isset($this->baGallery['ba_set'][$x]['permalink'])){
							$revLink = $this->baGallery['ba_set'][$x]['permalink'];
						} else {
							$revLink = $this->baGallery['ba_set'][$x]['oid'];
						}
						
						$revSetModDate = $this->baGallery['ba_set'][$x]['date_modified'];
						
						$revBaSetsSitemapOutput[] = array('setid' => $revLink,'datemod' => $revSetModDate);
						
					}
				}	
		

				return $revBaSetsSitemapOutput;
		}
	
	
	
	/////////////////////////////////////// End XML Sitemap Functions
	
	
	


}
?>
