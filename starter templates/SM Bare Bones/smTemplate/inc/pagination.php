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