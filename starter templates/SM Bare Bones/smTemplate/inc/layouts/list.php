<?php 
	$items = $smCurrentTool->getItems(); 
	$numberOfItemsPerPage = 2;
	if ($numberOfItemsPerPage) {
		$numberOfPages = ceil($smCurrentTool->getNumberOfItems() / $numberOfItemsPerPage);
		$offset = $smCurrentTool->getOffset();
		$currentPage = 1;
		if ($offset > 0) {
			$currentPage = $offset / $numberOfItemsPerPage + 1;
		}
	}
	if ($numberOfItemsPerPage && !$offset && $numberOfPages > 1) {
		$items = $smCurrentTool->getItemsWithLimitAndOffset($numberOfItemsPerPage, $offset);
	} else {
		$items = $smCurrentTool->getItems();
	}
?>

<section class="content">
	<div class="container">
		<?php
			foreach ($items as $item) {
				
				echo '<article class="article-excerpt">';
				if ($item->getThumbnailImageSize()) {
					echo '<a class="article-thumb" href="' . $item->getURL() . '"><img src="' . $item->getThumbnailImageSize()->getURL() . '" alt="' . $item->getTitle() . '"></a>';
				}
				echo '<h2><a href="' . $item->getURL() . '">' . $item->getTitle() . '</a></h2>';
				echo '<p class="date">';
				if ($item->getAuthorName()) {
					echo 'By <span class="author">' . $item->getAuthorName() . '</span> <span class="divider">|</span> ';
				}
				echo date('F j, Y',strtotime($item->getStartTimestamp())) . '</p>';
				
				echo '<div class="article-body">';
				echo $item->getSummary();
				echo '</div>';
				echo '</article>';
			}
		?>
		
		<?php include('inc/pagination.php'); ?>
	</div>
</section>