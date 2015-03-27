<?php

	/*----------------------------------------------------------------------
		Sitemason, Inc.
	 	www.sitemason.com
	
	 	Boilerplate example template
		Presidents page layout, based on the smDefault Tool Template Set's
		common/list.php layout, but customized for the Presidents page.
		
	----------------------------------------------------------------------*/


	//-----------------------
	// SETTINGS


	$numberOfItemsPerPage = 0; // show X items per page.  Set to 0 to disable pagination
	
	// END SETTINGS
	//-----------------------

	if ($numberOfItemsPerPage) {
		$numberOfPages = ceil($smCurrentTool->getNumberOfItems() / $numberOfItemsPerPage);
		$offset = $smCurrentTool->getOffset(); // really "start with index"
		$currentPage = 1;
		if ($offset > 0) {
			$currentPage = $offset / $numberOfItemsPerPage + 1;
		}	
	}

	/*
		If we've reached the landing page (no offset), limit the number of pages displayed
		and then set up pagination via URL manipulation.
	*/
	if ($numberOfItemsPerPage && !$offset && $numberOfPages > 1) {
		$items = $smCurrentTool->getItemsWithLimitAndOffset($numberOfItemsPerPage, $offset);
	}
	// Otherwise, display all Items returned from the API
	else {
		$items = $smCurrentTool->getItems();
	}
	

?>

<h1 class="title"><?php echo $smCurrentTool->getTitle(); ?></h1>
<?php
	/*
		Since we linked the President's political party from the detail page, there could be a filter applied to this
		listing.  Our link was filtering this list by "xtags" (a Sitemason query-string parameter).  We can check for
		that and, if present, show that this is a filtered listing.
	*/
	if ($_GET['xtags']) {
		echo '<h3 class="filter">Filter: '. $_GET['xtags'] .' <span class="remove">(<a href="'. $smCurrentTool->getPath() .'">remove</a>)</span></h3>';
	}
	


	/*
		Iterate through the Sitemason Items.  Each "Item" represents a President
	*/
	foreach ($items as $item) {
		echo '<article class="article presidents-list">';
		
		// display the thumbnail
		$thumbnail = $item->getThumbnailImageSize();
		if ($thumbnail) {
			echo '<div class="presidents-thumb">';
			echo '		<img src="'. $thumbnail->getURL() .'" width="70" height="70" border="0" title="'. $item->getTitle() .'" />';
			echo '</div>';
		}
		
		/*
			We've used the "title" property to hold the President's last name and the "subtitle" property to hold the President's first name.
			Let's construct a string to display that
		*/
		$presidentsName = $item->getSubtitle() .' '. $item->getTitle();
		echo '<h3 class="presidents-title"><a class="presidents-title-link" href="'. $item->getURL() .'">'. $presidentsName .'</a></h3>';
		
		/*
			Now we want to display some various data for each President.  Let's include the start and end dates of the President's
			term and also the President's home town and political party.  We'll save the other information for the detail page.
		*/
		echo '	<div class="presidents-meta">';
		
		// Display the start date of the President's term
		$tookOffice = date('M d, Y', strtotime($item->getStartTimestamp()));
		echo '<span class="presidents-date"><span class="meta-label">In office:</span> '. $tookOffice .' - ';
		
		// If the President has an end date, show it here, otherwise the President must be currnently in-office (or else we failed to set an end date)
		if ($item->getEndTimestamp()) {
			$leftOffice = date('M d, Y', strtotime($item->getEndTimestamp()));
			echo $leftOffice;
		}
		else {
			echo 'Present';
		}
		
		echo '</span><br />';
		
		
		
		
		
		// Display the President's home town, which is stored as the Item's Location
		echo '<span class="presidents-date"><span class="meta-label">Home State:</span> '. $item->getLocation()->getState() .'</span>';
		
		
		echo '</article>';
	}
?>

<div class="pagination">
	<ul class="pagination-pages">
	<?php
		// Pagination navigation
		if ($numberOfItemsPerPage && $numberOfPages > 1) {
		
			$previousUrl = '';
			$queryString = $_SERVER['QUERY_STRING'];
			$queryString = preg_replace('/p=[0-9]*/','', $queryString);
			
			// the URL without the offset
			$link = $smCurrentTool->getPath() .'/list/set/'. $numberOfItemsPerPage;
			
			//
			// Previous page button
			//

			$previousURL = null;
			if ($currentPage > 1) {
				$previousOffset = $offset - $numberOfItemsPerPage;
				if ($previousOffset > 0) { $previousOffset--; }	// subtract one more unless we hit zero
				$previousURL = $link .'/'. $previousOffset .'/';
				if ($queryString) { $previousURL .= '?'. $queryString; }
			}
			
			echo '<li class="pagination-nav pagination-nav-prev pagination-page';
			if (!$previousURL) { echo ' pagination-unavailable'; }
			echo '">';
			if ($previousURL) { echo '<a class="pagination-page-link" href="'. $previousURL .'">'; }
			echo '&laquo;';
			if ($previousURL) { echo '</a>'; }
			echo '</li>';

			//
			// page buttons
			//
			
			for ($i = 1; $i < $numberOfPages + 1; $i++) {
				$pageOffset = ($i - 1) * $numberOfItemsPerPage;
				if ($pageOffset > 0) { $pageOffset++; }
				
				$pageURL = $link .'/'. $pageOffset .'/';
				if ($queryString) { $pageURL .= '?'. $queryString; }
				echo '<li class="pagination-page"><a class="pagination-page-link" href="'. $pageURL .'"';
				if ($page == $i) { echo ' class="current"'; }
				echo '>'. $i .'</a></li>';
			}
			
			
			//
			// Next page button
			//
			
			$nextURL = null;
			if ($currentPage < $numberOfPages) {
				$nextOffset = $offset + $numberOfItemsPerPage + 1;
				$nextURL = $link .'/'. $nextOffset .'/';
				if ($queryString) { $$nextURL .= '?'. $queryString; }
			}
			
			echo '<li class="pagination-nav pagination-nav-next pagination-page';
			if (!$nextURL) { echo ' pagination-unavailable'; }
			echo '">';
			if ($nextURL) { echo '<a class="pagination-page-link" href="'. $nextURL .'">'; }
			echo '&raquo;';
			if ($nextURL) { echo '</a>'; }
			echo '</li>';
		}
	?>
	</ul>
</div>