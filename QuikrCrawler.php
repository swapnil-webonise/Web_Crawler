<?php

	/* Visiting www.quikr.com website */
	echo '<b>Website Name : </b> http://www.quikr.com/';
	echo "<br />";
	echo "<br />";
	$dom = new DOMDocument('1.0');
	@$dom->loadHTMLFile('http://www.quikr.com/');

	/* Selecting our city as Pune */
	$dom = new DOMDocument('1.0');
	@$dom->loadHTMLFile('http://pune.quikr.com/');
	echo '<b>Selecting Pune City : </b> http://pune.quikr.com/';
	echo "<br /><hr><br />";	
	/* Fetching Category names */
	$anchors = $dom->getElementsByTagName('a');

	$flag=0;
	foreach ($anchors as $element) {
    	$href = $element->getAttribute('class');

    	if (0 === strpos($href, 'catlinkstyle')) {
			echo "<b>Category Name : </b>". $element->nodeValue;	
			echo "<br />";
			$flag++;
			/* Fetching Category Type */
			$url='http://pune.quikr.com'.$element->getAttribute('href');	
			$dom = new DOMDocument('1.0');
			@$dom->loadHTMLFile($url);
			$catTypeDivs = $dom->getElementsByTagName('div');

			foreach ($catTypeDivs as $catTypeDiv) {
				$catTypeDivId = $catTypeDiv->getAttribute('id');

				if (0 === strpos($catTypeDivId, 'category_partial_div')) {
					echo "<br /><b>Category Type : </b>". $catTypeDiv->nodeValue;		

				echo "<br />";				
				/* Adds in that category ,address of it and creating link of it */
				$adds = $dom->getElementsByTagName('a');
				echo "<br /><b>Advertisements :</b><br />";
				$no=1;
				foreach ($adds as $add) {
					$addClass = $add->getAttribute('class');
			
					if (0 === strpos($addClass, 'adttllnk')) {
						echo "<br /><b>Add ".$no++." : </b>". $add->nodeValue."<br /><b>Add Address : </b>".$add->getAttribute('href')."<br /><b>Add Link : </b><a href='".$add->getAttribute('href')."' title='".$add->getAttribute('href')."'>Link</a><br />";									
					}
				}				
					
				}
			}

			echo "<br /><hr><br />";			
		}
		if($flag==5) // No denotes the number of categories
			break;
	}
?>
