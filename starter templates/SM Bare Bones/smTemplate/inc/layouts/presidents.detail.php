<?php

	/*----------------------------------------------------------------------
		Sitemason, Inc.
	 	www.sitemason.com
	
	 	Boilerplate example template
		Presidents detail layout
		
	----------------------------------------------------------------------*/

	// get the President's record (a Sitemason® Item)
	$president = $smCurrentTool->getItem();
?>

<article class="article article-detail">
	<!-- 
		AddThis
	-->
	<div class="article-meta">
		<div class="article-share">
			<!-- AddThis Button BEGIN -->
			<div class="addthis_toolbox addthis_default_style addthis_16x16_style">
				<a class="addthis_button_print"></a>
				<a class="addthis_button_facebook"></a>
				<a class="addthis_button_twitter"></a>
				<a class="addthis_button_pinterest_share"></a>
				<a class="addthis_button_google_plusone_share"></a>
				<a class="addthis_button_compact"></a><a class="addthis_counter addthis_bubble_style"></a>
			</div>
			<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=xa-51b08b2d13b7a00d"></script>
			<!-- AddThis Button END -->	
		</div>
	</div>
	
	<?php
		/*
			Display the President's large image
		*/
		$image = $president->getLargeImageSize();
		if ($image) {
			echo '<div class="president-image">';
			
			// Image
			echo '	<img class="image" src="'. $image->getURL() .'" width="'. $image->getWidth() .'" height="'. $image->getHeight() .'" alt="'. $image->getAlt() .'" />';
			
			// Caption
			$caption = $image->getCaption();
			if ($caption) {
				echo '<p class="image-caption">'. $image->getCaption() .'</p>';	
			}
			
			echo '</div>';
		}
		
		echo '<div class="president-data">';
		/*
			We've used the "title" property to hold the President's last name and the "subtitle" property to hold the President's first name.
			Let's construct a string to display that
		*/
		$presidentsName = $president->getSubtitle() .' '. $president->getTitle();
		echo '	<h1 class="article-title article-title-detail">'. $presidentsName .'</h1>';
		
		
		/*
			We want to display several thing here, such as the dates of the President's term, home state, etc.
			We'll create some variables for use in this section, then display the data.
		*/
		
		
		/*
			Start and end date of the President's term
			
			We'll set two variables: one to store the date that this President took office and another to store the date when the President left office.
			We can assume that every President has a start date, but not necessarily an end date.  In the case where there is no end date, we'll display
			"present" (because we can also assume that, assuming the data was correctly entered, there is only one President without an end of term date
			and that is the current President.
		*/

		$tookOffice = date('M d, Y', strtotime($president->getStartTimestamp()));

		if ($president->getEndTimestamp()) {
			$leftOffice = date('M d, Y', strtotime($president->getEndTimestamp()));
		}
		else {
			$leftOffice = 'Present';
		}
		
		/*
			Home State
			
			We set the President's home state in each Item's Location object, so we'll need to grab the Item's Location (SMLocation object), 
			access the state property, then display it.
		*/
		
		$location = $president->getLocation(); // $location is an SMLocation object
		$homeState = $location->getState();
		
		/*
			Political Party
			
			We have chosen to assign the President's political party using Tags.  Tags are a good choice because it's easy to perform a search by tag 
			and the assignment of Tags is easy.  Additionally, we have assigned all of the political party Tags to a Tag Group with the title "Political Parties".
			It is worth noting that, while we can use Tags for multiple purposes and thus a President could have multiple Tags, we're only assigning each President
			ONE Tag representing the political party (we're choosing to forget about the whole "National Union Party" thing). 
			
			Our strategy is to use SMItem's getTagsInTagGroupWithTitle() method to fetch the Tags belonging to this President that are in the "Political Parties"
			Tag Group.  getTagsInTagGroupWithTitle() returns an array, but since we've declared that each President should have been tagged with only one
			political party, we only care about the first element of that array.
		*/
		
		// Get the Tags (SMTag objects) in the "Political Parties" Tag Group that have been assigned to this President
		$partyTags = $president->getTagsInTagGroupWithTitle('Political Parties');
		
		// We only care about the first (and only) element of the returned array, which is an SMTag object.
		$partyTag = $partyTags[0];
		
		// It's always good practice to sanity check the results.  If the content editor failed to assign a political party to this President, then
		// $partyTag will be null and we'll get a PHP error when we try to treat it as an SMTag object
		if ($partyTag) {
			// The Tag's title property is the party's name
			$party = $partyTag->getTitle();	
		}
		
		
		/*
			Vice President(s)
		
			Since there are several occasions throughout history where there were multiple Vice Presidents during the sitting President's term,
			we chose to store the Vice President(s)'s name(s) in a custom field, specifically, the custom field with the key "vicePresidents."
			
			You can see how this was accomplished interface-wise by examining the presidents.js interface file.
			
			However, to get the data out, we'll just need to use SMItem's getCustomFieldWithKey() method, which will return either a string or
			an array, depending on how we set up the custom field in the interface.  In this case, we set up the "vicePresidents" as an array
			since we needed to store multiple Vice President values per President in some cases.  
			
			Each Vice President record in that custom field is also an array (with one key: "name," representing the Vice President's name).  So,
			the custom field with the key "vicePresidents" is an array of associative arrays, to be specific.
			
			We'll grab all of the Vice President records from the custom field and, if multiple values are present, simply put them on a separate
			line.
		*/
		
		$vicePresidentData = $president->getCustomFieldWithKey('vicePresidents');
		
		// We'll create an array of just the Vice President's (or Vice Presidents') name(s)
		$vicePresidents = array();
		foreach ($vicePresidentData as $vicePresidentData) {
			$vicePresidents[] = $vicePresidentData['name'];
		}
		
		// Since we're doing our best to be gramatically correct, let's change the label based on whether there are multiple Vice Presidents or not.
		$vpLabel = 'Vice President';
		if (count($vicePresidents) > 1) {
			$vpLabel .= 's';
		}
		

		/*
			Finally, let's display all of that data!
		*/
		echo '	<ul>';
		echo '		<li><div class="label">Took Office</div><div class="value">'. $tookOffice .'</div></li>';
		echo '		<li><div class="label">Left Office</div><div class="value">'. $leftOffice .'</div></li>';
		echo '		<li><div class="label">Home State</div><div class="value">'. $homeState .'</div></li>';
		
		// let's make the party linked to a search, which is easy to do with Tags by using Sitemason's xtags query-string parameter
		echo '		<li><div class="label">Political Party</div><div class="value"><a href="'. $smCurrentTool->getPath() .'?xtags='. $party .'">'. $party .'</a></div></li>';
		echo '		<li><div class="label">'. $vpLabel .'</div><div class="value">'. implode($vicePresidents,'<br />') .'</div></li>';
		echo '	</ul>';
		echo '</div>';
	?>

	<!-- 
		MAIN CONTENT 
	-->

	<div class="president-content">
		<?php
			echo $president->getBody();
		?>
		
		<input type="button" value="Back to Listing" onClick="history.back(-1);" />
		
	</div>
</article>